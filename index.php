
<?php 
/*
$connection = new mysqli("localhost", "root", "", "mylibrary");

$sql = "SELECT * FROM admin";

$results = $connection->query($sql);

while ($rows = $results->fetch_assoc()) {
	
	extract($rows);

	echo $rows['email'];
}

?>

*/
?>

<?php 
/*
if admin is logged in, redirect him to index(entry point), otherwise go to login page
index has navigation bar and lists all books
˙navigation bar: 
newBook, editBook, newRent, returnBook, notAvailableBooks, newUser, editUser, deleteBook, allUsers, genres(possibly), logout(admin)
*/
//include_once 'classes/database.php';
include_once 'classes/book2.php';
include_once 'classes/user.php';
include_once 'classes/admin2.php';
include_once 'redirect.php';

$admin = new Admin();
$book = new Book();

$email = $_SESSION['email'];

if(!$admin->getSession()) {
	redirectTo('adminLogin.php');
}

if(isset($_GET['logout'])) {
	$admin->adminLogout();
	redirectTo('adminLogin.php');
}

?>
<div>
	<a href="index.php?logout=logout" style="float: right; text-decoration: none;">Logout</a>
</div>
<div>
	<a href="newBook.php" style="color: red; text-decoration: none; font-size: 20px;">Insert new book</a>
	<!--<a href="newUser.php" style="color: red; text-decoration: none; font-size: 20px;">Insert new user</a> -->
</div>
<table>
	<tr>
		<th>ID</th>
		<th>ISBN</th>
		<th>Title</th>
		<th>Author</th>
		<th>Year</th>
		<th>Created at</th>
		<th>Updated at</th>
	</tr>
	<?php 

	$book->getBooks();
	?>
</table>

<div>
	<br><br>
	<a href="newUser.php" style="color: red; text-decoration: none; font-size: 20px;">Insert new user</a>
</div>
<table>
	<tr>
		<th>ID</th>
		<th>First name</th>
		<th>Last name</th>
		<th>Email</th>
		<th>Phone number</th>
		<th>Address</th>
	</tr>
	<?php 
	$user = new User();
	$user->getUsers();
	?>
</table>
