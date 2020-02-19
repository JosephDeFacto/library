<!DOCTYPE html>
<html>
<head>
	<title>Insert New Book</title>
</head>
<body>
	<h2 style="color: red; font-family: Arial, sans-serif; opacity: 0.5;"> Insert new book</h2>
	<a href="index.php" style="float: right; text-decoration: none; color: red;">Go to index</a>

	<form action="newBook.php" method="POST">
		<table>
			<tr>
				<td>ID</td>
				<td><input type="text" name="id" placeholder="Enter ID"></td>
			</tr>
			<tr>
				<td>ISBN</td>
				<td><input type="text" name="isbn" placeholder="Enter ISBN"></td>
			</tr>
			<tr>
				<td>Title</td>
				<td><input type="text" name="title" placeholder="Enter book title"></td>
			</tr>
			<tr>
				<td>Author</td>
				<td><input type="text" name="author" placeholder="Enter author"></td>
			</tr>
			<tr>
				<td>Year</td>
				<td><input type="text" name="year" placeholder="Enter year"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="insert" value="INSERT"></button></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php 

//include_once 'classes/database.php';
include $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";
include_once 'classes/book2.php';
//include_once 'classes/validation.php';

include 'redirect.php';

if (isset($_POST['insert']) && !empty($_POST['year'])) {

	$book = new Book();

	$book->id = $_POST['id'];
	$book->isbn = $_POST['isbn'];
	$book->title = htmlentities(trim($_POST['title']));
	$book->author = htmlentities(trim($_POST['author']));
	$book->year = (int)$_POST['year'];

	if ($book->insertBook()) {
		redirectTo('index.php');
	}
}
?>