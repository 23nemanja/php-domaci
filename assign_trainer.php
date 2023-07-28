<?php 

	require_once 'config.php';

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$member_id = $_POST['member'];
		$trainer_id = $_POST['trainer'];

		$sql = "UPDATE members SET trainer_id = ? WHERE member_id = ?";
		$run = $conn->prepare($sql);
		$run->bind_param("ii", $trainer_id, $member_id);

		$run->execute();

		// Set a session variable with a success message
		$_SESSION['success_message'] = 'Trener uspesno dodeljen clanu';

		// Redirect to the admin_dashboard.php page
		header("Location: admin_dashboard.php");
		exit();
	}