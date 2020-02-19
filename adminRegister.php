<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
//include 'classes/database.php';
//include 'init.php';

/*
if(isset($_POST['log_btn'])) {
	include 'classes/Admin.php';
	$admin = new Admin($db);

	$email = $_POST['email'];
	$password = md5($_POST['password']);


	if ($admin->checkAdmin($email, $password)) {
		header('index.php');
	}

}
*/
// ONLY LOGIN
//include 'classes/database.php';
include $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";
include 'classes/admin.php';


$admin = new Admin();

if (isset($_POST['reg'])) {
	$admin->email = $_POST['email'];
	$admin->password = $_POST['password'];

	//$getLogin = $admin->login($email, $password);
	$getReg = $admin->register();

	if ($getReg) {
		header('Location: index.php');
	}
}
?>

<form action="" method="POST">
	<table>
		<tr>
			<th>Email</th>
			<td>
				<input type="email" name="email">
			</td>
		</tr>
		<tr>
			<th>Password</th>
			<td>
				<input type="password" name="password">
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="reg" value="Login"></td>
		</tr>
	</table>
</form>