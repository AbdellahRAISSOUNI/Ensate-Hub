<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
<<<<<<< HEAD
define('DB_PASS','1234');
=======
define('DB_PASS','Ossamasm123');
>>>>>>> 0b415d43d3a1cf945e92b7daecfc46d302795232
define('DB_NAME','ocasdb');

// Establish database connection.
try {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
