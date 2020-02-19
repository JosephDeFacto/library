<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

//include_once 'classes/database.php';
include $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";
include_once 'classes/book2.php';
include_once 'redirect.php';

//$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR");
//$id = null;

if(isset($_GET['id'])) {
	$id = $_GET['id'];

$book = new Book();

$book->id = $id;

$getBooks = $book->getBook();
//var_dump($test);
// cek, ne diraj nis
}
//"<pre>" . var_dump($id) . "</pre>";
// cini mi se da imas problem s arrayom,. cek da proucim jos malo 

if(isset($_POST['edit'])) {
	$book->id = $_POST['id'];
	if(empty($book->id)) {
		echo "Id is empty";
	} else {
		echo "It works!";
	}
	$book->isbn = $_POST['isbn'];
	$book->title = $_POST['title'];
	$book->author = $_POST['author'];
	$book->year = $_POST['year'];

	//$book->isbn = htmlentities(trim($_POST['isbn']));

	if($book->editBook($id)) {
		redirectTo('index.php');
	} else {
		echo "Something went wrong.";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit book</title>
</head>
<body>
	<h2>Edit Book</h2>
	<a href="newBook.php">Set new Book</a>
	<a href="index.php" style="float: right;">Go to index</a>
	<form action="editBook.php" method="POST">
		<table>
			<tr>
				<td>ISBN</td>
				<td><input type="text" name="isbn" value="<?php echo $getBooks['isbn']; ?>" placeholder="Enter ISBN"></td>
			</tr>
			<tr>
				<td>Title</td>
				<td><input type="text" name="title" value="<?php echo $getBooks['title']; ?>" placeholder="Enter title"></td>
			</tr>
			<tr>
				<td>Author</td>
				<td><input type="text" name="author" value="<?php echo $getBooks['author']; ?>" placeholder="Enter author"></td>
			</tr>
			<tr>
				<td>Year</td>
				<td><input type="text" name="year" value="<?php echo $getBooks['year']; ?>" placeholder="Enter year"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
				<td><input type="submit" name="edit" value="Submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>

