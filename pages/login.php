<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	// Database connection
	$servername = "localhost";
	$username = "your_username";
	$password = "your_password";
	$dbname = "your_database_name";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}

	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result) == 1){
		// Successful login
		header("Location: dashboard.php"); // Redirect to dashboard page
		exit();
	} else{
		// Invalid login credentials
		echo "Invalid login credentials";
	}

	mysqli_close($conn);
}
?>
