<?php
require_once 'db.php';
//require_once 'layouts/header.php';

if(isset($_POST['login']))
{

 $id = mysql_real_escape_string($_POST['usrname']);
 $pass = mysql_real_escape_string($_POST['psw']);
 //$pass= md5($pass);
 $query = "SELECT * FROM student_info WHERE id='$id' AND pass='$pass'";
 $res= @mysql_query($query) or die(mysql_error());
 $row=mysql_fetch_array($res);
 $count=mysql_num_rows($res);
 if($count >= 1)
 {
  session_start();
  $_SESSION['logged_in']= time();
  
  $_SESSION['user'] = $row['std_name'];
   $_SESSION['userid'] = $row['id'];
  header("Location:index.php");
  
 }
 else
 {
    echo
    '<div class="jumbotron alert-info" style="text-align:center;">
  <h3>Failed!</h3><hr/>
  <p>Login credentials you provided were incorrect.</p>
  <p id="tryagain" ><a class="btn btn-warning"href="#">Try Again</a></p>
</div>';
 }
 
}

?>


<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });

    $("#tryagain").click(function(){
        $("#myModal").modal();
    });
});
</script>

<center>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 60%">
        <div class="modal-header" style="padding:15px 30px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:20px 40px;">
          <form method="post">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" name="usrname" placeholder="Enter username" required/>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" name="psw" placeholder="Enter password" required/>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" class="btn btn-success btn-block" name="login" id="logginin"><span class="glyphicon glyphicon-log-in"></span> Login</button>
          </form>
        </div>
      </div>
      
    </div>
  </div> 
  </center>
