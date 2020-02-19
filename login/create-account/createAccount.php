<?php

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$favorite_ingredients = $_POST['favorite_ingredients'] ?? null;
$allergies = $_POST['allergies'] ?? null;

if($username === null){
	die('No username specified');
}
if($password === null){
	die('No password specified');
}

// Validate Username: Must be 1-32 characters and only contain A-z, 0-9, _, -
if(!preg_match('/^[\w\d_-]{1,32}$/', $username)){
	// Invalid Username
	die('Username must be between 1 and 32 characters and only contain letters, numbers, underscores, and hyphens');
}

// Validate Password: Must be at least 12 characters
if(strlen($password) < 12){
	die('Password must be at least 12 characters');
}

require '../../include/database.php';

// Check that username is available
try{
	$check_username_stmt = $db->prepare('SELECT COUNT(*) FROM Users WHERE Username = ?');
	$check_username_stmt->execute([$username]);
	if($check_username_stmt->fetchColumn() > 0){
		die('Username is not available');
	}
}catch(PDOException $e){
	die('Failed to check if username is available');
}

// Hash Password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Create Account
try{
	$create_account_stmt = $db->prepare('INSERT INTO Users (Username, Password, FavoriteIngredients, Allergies) VALUES (?, ?, ?, ?)');
	$create_account_stmt->execute([$username, $password_hash, $favorite_ingredients, $allergies]);
}catch(PDOException $e){
	die('Failed to create account');
}

header('Location: ../../user-login.php');