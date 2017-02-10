<?php
$servername = "mysql7.000webhost.com";
$username = "a4163525_sejan";
$password = "faucet30";
$db = "a4163525_faucet";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }