<?php

# Database credentials file
# Contains a PHP array $db_credentials with the host, username, password, and database
require 'databaseCredentials.php';

try{
	$db = new PDO("mysql:host={$db_credentials['host']};dbname={$db_credentials['database']}", $db_credentials['username'], $db_credentials['password']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo 'Error connecting to database: ', $e->getMessage();
}