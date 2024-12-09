<?php
// DB INDENTIFICATION
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'prs_industries');
 
// Connection to MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connexion and die connect error message
if($conn === false){
    die("ERROR: UNABLE TO CONNECT " . mysqli_connect_error());
}
?>