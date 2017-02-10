<?php
require_once 'auth/db.php';

if(isset($_SESSION['user'])=="")
{
    session_start();
}
function semname() {    $semesters=array("Spring","Summer","Fall");    $mnth = date("m");    $yr = date("Y");    if($mnth<4)      return $semesters[0];    elseif ($mnth>3 && $mnth<8)      return $semesters[1];    else return $semesters[2];      }function sel_semester(){  if(isset($_POST['search']))  {    if(isset($_POST['semester']))      return $_POST['semester'];    else      return 0;  }   else    return semname();}//function to send vlaaue o select year boxfunction sel_year(){  if(isset($_POST['search']))    return $_POST['year'];  else    return date('Y');} 
?>
<html  lang="en">
<head>
	<title>Welcome</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">      <!-- for Google --><meta name="description" content="A simple website for EWU students to keep track of their courses semester wise" /><meta name="keywords" content="courses, EWU, students" /><meta name="application-name" content="courses.sejan.xyz" /><!-- for Facebook -->          <meta property="og:title" content="Welcome to Courses" /><meta property="og:type" content="blog" /><meta property="og:image" content="http://courses.sejan.xyz/preview.png" /><meta property="og:url" content="http://courses.sejan.xyz" /><meta property="og:description" content="A simple website for EWU students to keep track of their courses semester wise" /><!-- for Twitter -->          <meta name="twitter:card" content="summary" /><meta name="twitter:title" content="Welcome to Courses" /><meta name="twitter:description" content="A simple website for EWU students to keep track of their semester wise courses" /><meta name="twitter:image" content="http://courses.sejan.xyz/preview.png" />    
  <link rel="icon" href="css-js/favicon.ico" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="css-js/main.css"/>
  <link rel="stylesheet" type="text/css" href="css-js/btn.css"/>
  <link rel="stylesheet" type="text/css" href="css-js/bootstrap.css"/>
<!--   <link rel="stylesheet" type="text/css" href="css-js/mdb.css"/> -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/> 
  <link rel="stylesheet" href="css-js/font-awesome.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="css-js/mdb.min.js"></script>
  <script type="text/javascript" src="css-js/tether.min.js"></script>
  <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script> -->
  <!-- <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->

<!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css"/>
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
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Not Now</button>
        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='logout.php'">Yes Logout Now</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $("#btn-reload").click(function(){
      $(this).text("Reloading. . .");
    });

    $("#btn-search").click(function(){
      $(this).text("Searching....");
    });
$("#btn-update").click(function(){
  confirm("Are you sure?");
});

$("#logout").click(function(){
      $("#logoutmodal").modal();
    });

  });
</script>


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
      {?>  <li class="hover"><a href="#register" id="myBtn2"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#login" id="myBtn"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        <?php 
      }
      else{?>
      <li class="active"><a><?php echo 'Hello '.$_SESSION['user'];?></a></li>
<li><a data-toggle="modal" id="logout" href="#signout" title="Logout"><span class="glyphicon glyphicon-off"></span></a></li>
    <?php  }
    ?>
      </ul>
    </div>
</nav>

