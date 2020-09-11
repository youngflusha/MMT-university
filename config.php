<?php
define('DBSERVER', 'localhost'); //DB SERVER
define('DBUSERNAME', 'root'); //DB username
define('DBPASSWORD', ''); //DB $password
define('DBNAME', 'users'); //DB name


// connect to MySQL database
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

//check db connection

if($db === false) {
  die("Error: connection error." . mysqli_connect_error());
}
