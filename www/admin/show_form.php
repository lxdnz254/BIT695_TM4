<?php

function replace_tags($template, $placeholders){
    $placeholders = array_merge($placeholders, array('<?'=>'', '?>'=>''));
	
    return str_replace(array_keys($placeholders), $placeholders, $template);
}

	$vars = array('{{firstname}}'=>'', 
				'{{familyname}}'=>'',
				'{{email}}'=>'', 
				'{{phone}}'=>'',
				'{{Register}}' =>'Add Player',
				'{{action}}'=>'add_player.php');
				
	$template = file_get_contents('table1_form_template.html', true);

	echo replace_tags($template, $vars);

?>