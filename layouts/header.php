<?php
require_once 'auth/db.php';
ob_start();
if(!isset($_SESSION['user']))
{
  session_start();
}  
function semname() {
  $semesters=array("Spring","Summer","Fall");
  $mnth = date("m");
  $yr = date("Y");
  if($mnth<4) return $semesters[0];
  elseif ($mnth>3 && $mnth<8) return $semesters[1];
  else return $semesters[2];
}
function sel_semester(){
  if(isset($_POST['search']))
  {   
     if(isset($_POST['semester']))
      return $_POST['semester'];
    else
      return 0;
  }
  else 
    return semname();
}//function to send vlaaue o select year box
// function sel_year(){
//   if(isset($_POST['search'])) 
//    return $_POST['year'];
//  else 
//    return date('Y');
// } 
?>
<html  lang="en">
<head>
	<title><?php if(!isset($_SESSION["userid"])) echo "Welcome"; else echo $_SESSION["userid"];?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">      <!-- for Google --><meta name="description" content="A simple website for EWU students to keep track of their courses semester wise" /><meta name="keywords" content="courses, EWU, students" /><meta name="application-name" content="http:// " /><!-- for Facebook -->          <meta property="og:title" content="Welcome to Courses" /><meta property="og:type" content="blog" /><meta property="og:image" content="/preview.png" /><meta property="og:url" content="http:// " /><meta property="og:description" content="A simple website for EWU students to keep track of their courses semester wise" /><!-- for Twitter -->          <meta name="twitter:card" content="summary" /><meta name="twitter:title" content="Welcome to Courses" /><meta name="twitter:description" content="A simple website for EWU students to keep track of their semester wise courses" /><meta name="twitter:image" content="http:// " />    
  <link rel="icon" href="css-js/favicon.ico" type="image/x-icon"/>
  <link rel="stylesheet" type="text/css" href="css-js/btn.css"/>
  <link rel="stylesheet" type="text/css" href="css-js/bootstrap.css"/>
  <link rel="stylesheet" type="text/css" href="css-js/main.css"/>
  <script src="css-js/jQuery-v1.12.4.js"></script>
  <script src="css-js/bootstrap.js"></script>
  <script src="css-js/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css-js/sweetalert.css"/>
  <style type="text/css">
.navbar{
  font-family: 'Exo', Sans-serif;
  font-size: 17px;
  border-radius: 0px;
}
</style>


<!--Logout Modal -->
<div class="modal fade" id="logoutmodal" tabindex="1" role="dialog">
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
        <button type="button" class="btn btn-outline-danger" onclick="window.location.href='logout.php'">Logout Now</button>
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
<nav class="navbar navbar-inverse navbar-fixed-top hdr">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="index.php" style="font-size: 22px;">Student Course Schedule Tracker</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right" style="font-size: 14px;"><?php
      if(isset($_SESSION['user'])=="")
      {?>  <li class="hover"><a href="#register" id="myBtn2"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#login" id="myBtn"><span class="glyphicon glyphicon-log-in"></span> Login &nbsp;&nbsp;</a></li>
        <?php 
      }
      else{?>
            <li><a href="add.php">Add New Schedule</a></li>
            <li><a href="update.php">Update Schedule</a></li> 
            <li class="active"><a href="profile.php"><?php echo $_SESSION['user'];?></a></li>
            <li role="separator" class="divider"></li>
            <li><a data-toggle="modal" id="logout" href="#signout" title="Logout"><span class="glyphicon glyphicon-off"></span> Logout &nbsp;&nbsp;</a></li> 
  <?php  }
    ?>
      </ul>
    </div>
</nav>
<br><br><br>
