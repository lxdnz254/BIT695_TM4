<?php
/*  ensure text doesnot get code injection */
function html($text)
{
	return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/* Output html to text */
function htmlout($text)
{
	echo html($text);
}

/* Convert from markdown to html */
function markdown2html($text)
{
	$text = html($text);
	
	// Convert plain-text formatting to HTML
	
	// strong emphasis
	$text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
	$text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
	
	// emphasis
	$text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
	$text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);
	
	// Convert Windows (\r\n) to Unix (\n)
	$text = str_replace("\r\n", "\n", $text);
	// Convert Macintosh (\r) to Unix (\n)
	$text = str_replace("\r", "\n", $text);
	
	// Paragraphs
  $text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';
	// Line breaks
	$text = str_replace("\n", '<br>', $text);
	
	// Url links
	$text = preg_replace(
			'/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i',
			'<a href="$2">$1</a>', $text);
	
	return $text;
}

/* Markdown to text function */
function markdownout($text)
{
	echo markdown2html($text);
}

/* Replace {{tags}} in html form */
function replace_tags($template, $placeholders){
    	
    return str_replace(array_keys($placeholders), $placeholders, $template);
}

/* Prepare statements for all tables */
function statement_prep($connection, $sql) {
	
	if($stmt = $connection->prepare($sql)) {
		
		/*No Bind params */
		
		/*execute statement*/
		$stmt->execute();
		
		/*get result*/
		$result=$stmt->get_result();
		
		$stmt->close();
		
	} else {
			$result=null;
			echo 'Prepared statement error: %s\n'. $connection->error;
	}
	
	return $result;
}

/* stores a temporary file on users device */
function temporaryFile($name, $content)
{
    $file = trim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) .
            DIRECTORY_SEPARATOR .
            ltrim($name, DIRECTORY_SEPARATOR);

    file_put_contents($file, $content);

    register_shutdown_function(function() use($file) {
        unlink($file);
    });

    return $file;
}

