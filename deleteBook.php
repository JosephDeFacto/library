<?php 

//include_once 'classes/database.php';
include $_SERVER['DOCUMENT_ROOT'] . "/library/database.php";
include_once 'classes/book2.php';
include_once 'redirect.php';


$book = new Book();

if(isset($_GET['id'])) {
	$id = $_GET['id'];

	$book->id = $_GET['id'];

	$deleteBook = $book->deleteBook($id);

	if($deleteBook) {
		redirectTo('index.php');
	}
}

?>
