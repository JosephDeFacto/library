<?php 

//include_once 'database.php';
//include $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

class User {

	public $id;
	public $firstname;
	public $lastname;
	public $email;
	public $phonenumber;
	public $address;
	public $registerdate;
	public $activeuntil;

	public function newUser() {

		$dbh = getConn();

		$stmt = $dbh->prepare("INSERT IGNORE INTO users (id, firstname, lastname, email, phonenumber, address)
							   VALUES (:id, :firstname, :lastname, :email, :phonenumber, :address)");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
		$stmt->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':phonenumber', $this->phonenumber, PDO::PARAM_INT);
		$stmt->bindParam(':address', $this->address, PDO::PARAM_STR);

		if($stmt->execute()) {
			return true;
		}
	}

	public function editUser($id) {

		$dbh = getConn();

		$stmt = $dbh->prepare("UPDATE users SET id = :id, firstname = :firstname, 
							   lastname = :lastname, email = :email, 
							   phonenumber = :phonenumber, address = :adress WHERE id = :id");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':firstname', $this->firstname, PDO::PARAM_STR);
		$stmt->bindParam(':lastname', $this->lastname, PDO::PARAM_STR);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
		$stmt->bindParam(':phonenumber', $this->phonenumber, PDO::PARAM_INT);
		$stmt->bindParam('address', $this->address, PDO::PARAM_STR);

		if($stmt->execute()) {
			return true;
		}
		return false;
	}

	public function getUser($id) {

		$dbh = getConn();
		$stmt = $dbh->prepare("SELECT id, firstname, lastname, email, phonenumber, address users WHERE id = :id LIMIT 0, 1");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function getUsers() {

		$dbh = getConn();
		$stmt = $dbh->query("SELECT * FROM users");

		if($stmt->rowCount() > 0) {
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<table>
					<tr>
						<td><?php print($row['id']); ?></td>
						<td><?php print($row['firstname']); ?></td>
						<td><?php print($row['lastname']); ?></td>
						<td><?php print($row['email']); ?></td>
						<td><?php print($row['phonenumber']); ?></td>
						<td><?php print($row['address']); ?></td>
						<td align="center">
							<a href="editUser.php?id=<?php print($row['id']); ?>"></a>
						</td>
						<td abbr="center">
							<a href="deleteUser.php?id=<?php print($row['id']); ?>"></a>
						</td>
					</tr>
				</table>
				<?php
			}
		} else {
			?>
			<table>
				<tr>
					<td><b>Insert new user..</b></td>
				</tr>
			</table>
			<?php
		}
	}

	public function delete($id) {

		$dbh = getConn();

		$stmt = $dbh->prepare("DELETE FROM users WHERE id = :id");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

		if($stmt->execute()) {
			return true;
		}
		return false;
	}
}