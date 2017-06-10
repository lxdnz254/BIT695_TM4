# BIT695 TM4
Open Polytechnic of NZ Assignment: BIT695 TM4 - Upgrade a website

by Alex McBride: Student Number - 4206960

## Instructions
This repository features the completed assignment tasks for the course.
* The written assigments are available in the [/docs](https://github.com/lxdnz254/BIT695_TM4/tree/master/docs)
folder or by visiting
  the projects [gh-pages](https://lxdnz254.github.io/BIT695_TM4/)
* The sql for the database is contained in the [/sql](https://github.com/lxdnz254/BIT695_TM4/tree/master/sql)
folder. The files to check are
  + [create_tables.sql](https://github.com/lxdnz254/BIT695_TM4/blob/master/sql/create_tables.sql)
  + [create_test_data.sql](https://github.com/lxdnz254/BIT695_TM4/blob/master/sql/create_test_data.sql)
  + [test_actions.sql](https://github.com/lxdnz254/BIT695_TM4/blob/master/sql/test_actions.sql)
* The public facing website is accessed in the [/www](https://github.com/lxdnz254/BIT695_TM4/tree/master/www) folder.
* The latest release can be found [here](https://github.com/lxdnz254/BIT695_TM4/releases)

## Assumptions in the project
We assume that the database is correctly installed and matched to the server. Access to the database can be
altered at the file [connect.php](https://github.com/lxdnz254/BIT695_TM4/blob/master/www/admin/connect.php)

To make this a secure website, authority pages/code needs to be implemented. As this is outside the scope
of the assignment, I have allowed access to the admin pages from the main facing pages. Normal practice would require 
some form of verification and storing of login details via $_SESSION and php's 
[password_hash()](http://php.net/manual/en/function.password-hash.php). For development in the future I have already
already implemented the columns for storing passwords and admin codes in the 'players' table, although these are not
necessary to run the project as it is.

## Help
If the database needs to be restarted from afresh (i.e. a blank slate), the file 
[reset_tables.sql](https://github.com/lxdnz254/BIT695_TM4/blob/master/sql/reset_tables.sql)
contains the necessary code to implement this without destroying the tables.

The link to the [admin](https://github.com/lxdnz254/BIT695_TM4/tree/master/www/admin) pages 
is in the footer of the public facing webpages.



