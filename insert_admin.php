<?php

require_once 'config.php';

$username = 'nemanja';
$password = '23sifra';

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";

$run = $conn->prepare($sql);
$run->bind_param("ss", $username, $hashed_password);
$run->execute();