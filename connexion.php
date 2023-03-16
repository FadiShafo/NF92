<?php


$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a079';
$dbpass = '05NoShNc';
$dbname = 'nf92a079';


$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');




mysqli_set_charset($connect, 'utf8');

 ?>
