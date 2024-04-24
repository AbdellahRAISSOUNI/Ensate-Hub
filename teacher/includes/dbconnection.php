<?php 
// DB credentials.
define('DB_HOST','localhost');
<<<<<<< HEAD
define('DB_USER','root');
define('DB_PASS','1003');
=======
<<<<<<< HEAD
define('DB_USER','root');
define('DB_PASS','Ossamasm123');
=======
define('DB_USER','jihane');
define('DB_PASS','password');
>>>>>>> c3b229f7885c4347ff688e2f8e65a7f636c44e9e
>>>>>>> 7979e583f7779a4f85171f8c01ded0544073c632
define('DB_NAME','ocasdb');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>