<?php
// set error reporting on to help with debugging
error_reporting(E_ALL);
ini_set('display_errors','1');

define('DBHOST', 'localhost');
define('DBNAME', 'travel');
define('DBUSER', 'anguyen023');
define('DBPASS', '');
define('DBCONNSTRING','mysql:dbname=travel;charset=utf8mb4;');

try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   die( $e->getMessage() );
}

spl_autoload_register(function ($class) {
 $file = 'Gateways/' . $class . '.class.php';
 if (file_exists($file))
 include $file;
});

// connect to the database
$connection = DatabaseHelper::createConnectionInfo(array(DBCONNSTRING,DBUSER, DBPASS));

?>