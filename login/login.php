<?php

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if($username === null){
	die('No username specified');
}
if($password === null){
	die('No password specified');
}

require '../include/database.php';

try{

	$username_stmt = $db->prepare('SELECT ID, Password FROM Users WHERE Username = ?');
	$username_stmt->execute([$username]);
	$username_result = $username_stmt->fetchAll();

	if(count($username_result) === 1){
		if(password_verify($password, $username_result[0]['Password'])){

			// Credentials are valid, create session
			session_set_cookie_params(time() + 43200);// Session cookie should expire after 12 hours
			session_start();
			session_unset();
			session_regenerate_id(true);
			$_SESSION['UserID'] = $username_result[0]['ID'];

			header('Location: ../index.php');
			exit('Successfully logged in');

		}
	}

}catch(PDOException $e){
	die('Error connecting to database');
}

die('Invalid credentials');