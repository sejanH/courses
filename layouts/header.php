<?php
require_once 'db/db.php';

if(isset($_SESSION['user'])=="")
  {
    session_start();
    
}
function semname() {
    $semesters=array("Spring","Summer","Fall");
    $mnth = date("m");
    $yr = date("Y");

    if($mnth<4)
      return $semesters[0];
    elseif ($mnth>3 && $mnth<8)
      return $semesters[1];
    else return $semesters[2];
    
  } 

?>
<html>
<head>
	<title>Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="css-js/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="css-js/main.css"/>
   <link rel="stylesheet" type="text/css" href="css-js/bootstrap.css"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="css-js/font-awesome.min.css"/>
  <script src="css-js/jquery-confirm.js"></script>
  <script src="css-js/bootbox.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Play:700,400' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> 
  <link href="https://fonts.googleapis.com/css?family=Exo:500" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <style type="text/css">
.navbar{
  font-family: 'Exo', cursive;
  font-size: 17px;
  border-radius: 0px;
  margin-bottom: 0px;
}
</style>


<!-- Modal -->
<div class="modal fade" id="logoutmodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Logout?</h4>
      </div>
      <div class="modal-body">
      Are You Sure You Want To Logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No! No!! Abort Abort</button>
        <button type="button" class="btn btn-primary" onclick="window.location.href='logout.php'">Yes I am fucking sure</button>
      </div>
    </div>
  </div>
</div>

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php" style="font-size: 22px;">Student Course Schedule Manager</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="add.php">Add New Schedule</a></li>
        <li class=" "><a href="update.php">Update Schedule</a></li> 
        <li class="disabled"><a href="#">View History</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right"><?php
      if(isset($_SESSION['user'])=="")
      {?>  <li class="hover"><a href="#" id="myBtn2"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#" id="myBtn"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php 
      }
      else{?>
      <li class="active"><a><?php echo 'Hello '.$_SESSION['user'];?></a></li>
<li><a data-toggle="modal" id="logout" href="logout.php" title="Logout"><span class="glyphicon glyphicon-off"></span></a></li>
    <?php  }
    ?>
      </ul>
    </div>
</nav>
<div class="container-fluid">
