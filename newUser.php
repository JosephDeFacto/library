<?php 

//include_once 'classes/database.php'; //(cannot redeclare getConn() (previously declared in C:\path))
include_once 'classes/user.php';
//include_once 'classes/database.php';
include_once $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";
include 'redirect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enter']) && isset($_POST['firstname'])) {

	$user = new User();

	$user->id = $_POST['id'];
	$user->firstname = $_POST['firstname'];
	$user->lastname = $_POST['lastname'];
	$user->email = $_POST['email'];
	$user->phonenumber = $_POST['phonenumber'];
	$user->address = $_POST['address'];


	if($user->newUser()) {
		redirectTo('index.php');
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>New User</title>
</head>
<body>
	<form action="newUser.php" method="POST">
		<a href="index.php">Go to index</a>
		<table>
			<tr>
				<td>ID</td>
				<td><input type="text" name="id" placeholder="Enter ID"></td>
			</tr>
			<tr>
				<td>Firstname</td>
				<td><input type="text" name="firstname" placeholder="Enter firstname"></td>
			</tr>
			<tr>
				<td>Lastname</td>
				<td><input type="text" name="lastname" placeholder="Enter lastname"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" placeholder="Enter email"></td>
			</tr>
			<tr>
				<td>Phone number</td>
				<td><input type="number" name="phonenumber" placeholder="Enter phone number"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="address" placeholder="Enter address"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="enter" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>
