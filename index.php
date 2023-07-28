<?php

	require_once 'config.php';

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT admin_id, password FROM admins WHERE username = ?";

		$run = $conn->prepare($sql);
		$run->bind_param("s", $username);
		$run->execute();

		$results = $run->get_result();

		if ($results->num_rows == 1) {
			
			$admin = $results->fetch_assoc();

			if (password_verify($password, $admin['password'])) {
				$_SESSION['admin_id'] = $admin['admin_id'];

				$conn->close();
				header('location: admin_dashboard.php');
			} else {
				$_SESSION['error'] = "Netacan password!";

				$conn->close();
				header('location: index.php');
				exit();
			}

		} else {
			$_SESSION['error'] = "Netacan username!";

			$conn->close();
			header('location: index.php');
			exit();
		}

	} 

?>

<?php

	if (isset($_SESSION['error'])) {
		echo $_SESSION['error'] . "<br>";
		unset($_SESSION['error']);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="glavniDiv">
		<form action="" method="POST" class="forma">
			<div class="user">Username: <input type="text" name="username" class="input"></div><br>
			<div class="password">Password: <input type="password" name="password" class="input"></div><br>
			<input type="submit" value="Login" class="button">
		</form>
	</div>

</body>
</html>