<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once 'database.php';
class Book {

	public $id;
	public $isbn;
	public $author;
	public $year;
	public $created_at;
	public $updated_at;
/*
	public function ifBookExists() {

		$dbh = getConn();
		$stmt = $dbh->prepare("SELECT COUNT(id) AS number FROM books");
		$stmt->bindParam(':id', $this->id);

		$stmt->execute();

		while ($row = $stmt->fetch()) {
			$results[] = $row;
		}

		//return $results;
		foreach ($results as $result => $res) {
			var_dump( "$result = $res");
		}
	}
	*/


	public function ifBookExists() {

		$dbh = getConn();
		$stmt = $dbh->prepare("SELECT COUNT(*) AS number FROM books");
		//$stmt->bindParam(':id', $this->id); // unnecessary
		/*
		$exists = $stmt->fetchAll();
		if (count($exists) > 0) {
			foreach ($exists as $row) {
				var_dump($exists); // must show number of rows, like wtf[LOL]
			}
		
		} else {
			echo "No matches";
		}
		*/
		//$numRows = $exists['num'];
		/*
		if($exists['number'] > 0) {
			echo "Exists";
		} else {
			echo "Not";
		}
		

		if ($numRows > 0) {
			echo "Exists";
		}

		*/
		$stmt->execute();
		//$count = $stmt->fetch($this->id);
		//var_dump($count);
		//$stmt->rowCount();
		$numberOfRows = $stmt->fetchColumn();
		//echo $stmt;
		echo "There is: " . $numberOfRows . " row(s)!<br>";

	}

	public function getBookById($id) {

		

		$dbh = getConn();
		$stmt = $dbh->prepare("SELECT * FROM books WHERE id = :id");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();

		if($stmt->fetchAll()) {
			return true;
		} else {
			return false;
		}
	}

	public function getBooks() {

		$dbh = getConn();
		$stmt = $dbh->query("SELECT * FROM books");

		if($stmt->rowCount() > 0) {
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				?>
				<table>
					<tr>
						<td><?php print($row['id']); ?></td>
						<td><?php print($row['isbn']); ?></td>
						<td><?php print($row['title']); ?></td>
						<td><?php print($row['author']); ?></td>
						<td><?php print($row['year']); ?></td>
						<td><?php print($row['created_at']); ?></td>
						<td><?php print($row['updated_at']); ?></td>
						<td align="center">
							<a href="editBook.php?id=<?php print $row['id']; ?>">Edit</a>
						</td>
						<td align="center">
							<a href="deleteBook.php?id=<?php print $row['id']; ?>">Delete</a>
						</td>
					</tr>
				</table>
				<?php
			}
		} else {
			?>
			<table>
				<tr>
					<td><b>Insert new data...</b></td>
				</tr>
			</table>
			<?php 
		}
	}

	public function insertBook() {

		$dbh = getConn();

		$stmt = $dbh->prepare("SELECT COUNT(*) FROM users WHERE id = :id");
		$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$stmt->execute();
		
		$count = $stmt->fetchColumn();

		if ($count > 0) {
			echo "ID already exists";
		}
		

		$stmt = $dbh->prepare("INSERT IGNORE INTO books (id, isbn, title, author, year, created_at, updated_at) VALUES (:id, :isbn, :title, :author, :year, :created_at, :updated_at)");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':isbn', $this->isbn, PDO::PARAM_INT);
		$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
		$stmt->bindParam(':author', $this->author, PDO::PARAM_STR);
		$stmt->bindParam(':year', $this->year, PDO::PARAM_INT);
		$stmt->bindParam(':created_at', $this->created_at);
		$stmt->bindParam(':updated_at', $this->updated_at);

		$stmt->execute();

		if($stmt) {
			return true;
		} else {
			return false;
		}

	}

	public function editBook($id) {

		$dbh = getConn();
		$stmt = $dbh->prepare("UPDATE books SET id = :id, isbn = :isbn, title = :title, author = :author, year = :year, created_at = :created_at, updated_at = :updated_at WHERE id = :id");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->bindParam(':isbn', $this->isbn, PDO::PARAM_INT);
		$stmt->bindParam(':title', $this->title, PDO::PARAM_STR);
		$stmt->bindParam(':author', $this->author, PDO::PARAM_STR);
		$stmt->bindParam(':year', $this->year, PDO::PARAM_INT);
		$stmt->bindParam(':created_at', $this->created_at);
		$stmt->bindParam(':updated_at', $this->updated_at);

		$stmt->execute();

		if($stmt) {
			return true;
		} else {
			return false;
		}
	}

	public function getBook() {

		$dbh = getConn();
		$stmt = $dbh->prepare("SELECT isbn, title, author, year FROM books WHERE id = :id LIMIT 0, 1");
		$stmt->bindParam(':id',$this->id, PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//$row = $stmt->fetchAll();
		//print_r($row);
		return $row;	
		/*
		$this->isbn = $row['isbn'];
		$this->title = $row['title'];
		$this->author = $row['author'];
		$this->year = $row['year'];
		*/
	}

	public function deleteBook($id) {

		$dbh = getConn();
		$stmt = $dbh->prepare("DELETE FROM books WHERE id = :id");
		$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
		$stmt->execute();
		return true;
	}
	
}

//1, 1001, 'Rat i Mir', 'Tolstoj', 1888, '2020-02-1 22:11:05', '2020-02-1 22:12:10'
$book = new Book();

//$getNumber = $book->ifBookExists();
$book->ifBookExists();

//$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR!");
//$book->getBooks();