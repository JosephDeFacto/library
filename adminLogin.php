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

//include 'classes/database.php';
include $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";
include 'classes/admin2.php';

$admin = new Admin();

if (isset($_POST['login']) && isset($_POST['email'])) {
	$admin->email = $_POST['email'];
	$admin->password = $_POST['password'];

	//$getLogin = $admin->login($email, $password);
	$getLogin = $admin->login($email, $password);

	if ($getLogin) {
		header('Location: index.php');
	}
}
?>

<form action="" method="POST">
	<table>
		<tr>
			<th>Email</th>
			<td>
				<input type="text" name="email">
			</td>
		</tr>
		<tr>
			<th>Password</th>
			<td>
				<input type="password" name="password">
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="login" value="Login"></td>
		</tr>
	</table>
</form>