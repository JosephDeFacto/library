<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');

//include_once 'database.php';

class Admin {

	public $email;
	public $password;

	public function login($email, $password) {
		$dbh = getConn();
		$hash_password = hash('sha256', $this->password);

		$stmt = $dbh->prepare("SELECT * FROM admin WHERE email = :email OR password = :hash_password");
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':hash_password', $hash_password, PDO::PARAM_STR);
		$stmt->execute();
		$rowCount = $stmt->rowCount();
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		/*
		if ($rowCount) {
			$_SESSION['email'] = $data = $this->email;
			return true;
		} else {
			return false;
		}
		*/
		if($rowCount == 1) {
			$_SESSION['login'] = true;
			$_SESSION['email'] = $data = $this->email;
			return true;
		} else {
			return false;
		}
	}

	public function getSession() {

		return $_SESSION['login'];
	}

	public function adminLogout() {

		$_SESSION['login'] = false;
		unset($_SESSION);
		session_destroy();
	}

}

?>