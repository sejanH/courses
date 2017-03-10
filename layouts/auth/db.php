<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "dmsm";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (mysqli_connect_errno())
  {
  die ("Failed to connect to MySQL: " . mysqli_connect_error());
  }

 $routine ="CREATE TABLE IF NOT EXISTS `routine` (
  `std_id` varchar(20) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `section` int(5) NOT NULL,
  `starts` time NOT NULL,
  `ends` time NOT NULL,
  `weekdays` varchar(5) NOT NULL,
  `room` int(11) NOT NULL,
  KEY `semester` (`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$conn->query($routine);

//creating table for the first time
  $std_dtls = "CREATE TABLE IF NOT EXISTS `student_info` (
  `id` varchar(20) NOT NULL,
  `std_name` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `DoB` date DEFAULT NULL,
  `pass` varchar(20) NOT NULL,
  `starting_semester` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
$conn->query($std_dtls);


