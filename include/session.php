<?php

session_start();

// Check if user is logged in
if(isset($_SESSION['UserID'])){
	$logged_in = true;
	$user_id = $_SESSION['UserID'];
}else{
	$logged_in = false;
}

// Redirect to login page if not logged in
function require_login(){
	global $logged_in;
	if(!$logged_in){
		http_response_code(401);
		header('Location: user-login.php');
		die('Error: Not logged in');
	}
}

// Get information about user
function get_user_information($id = false){
	global $user_id;
	if($id === false) $id = $user_id;
	require 'database.php';
	try{
		$user_stmt = $db->prepare('SELECT Username, Admin FROM Users WHERE ID = ?');
		$user_stmt->execute([$id]);
		$user = $user_stmt->fetchAll();
		if(count($user) == 1){
			return $user[0];
		}else{
			return false;
		}
	}catch(PDOException $e){
		return false;
	}
}