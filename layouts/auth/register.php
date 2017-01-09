<?php
require_once 'db.php';

if(isset($_POST['submit']))
{
 $id = mysqli_real_escape_string($conn, $_POST['id']);
 $pass = mysqli_real_escape_string($conn, $_POST['psw']);
 $pass = md5($pass);
 $fname = mysqli_real_escape_string($conn, $_POST['fname']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $dob = mysqli_real_escape_string($conn, $_POST['dob']);
 $fsem = mysqli_real_escape_string($conn, $_POST['fsem']);
 
 $query = "INSERT INTO student_info(id,std_name,email,DoB,pass,starting_semester) values('$id','$fname','$email','$dob','$pass','$fsem') ";
 $res= mysqli_query($conn, $query) or $en=mysql_errno();
 if($res)
 {
  ?>
        <script>alert('Registration Successful');</script>
        <?php
 }
 elseif($en==1062)
 { ?>
        <script>alert('Could not register.\nThis ID is already registered');</script>
        <?php
 }
 else{
  echo '<script>alert("Something went wrong")</script>';
 }
 
}

?>
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding: 5px 20px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-folder-open"></span>  Signup</h4>
        </div>
        <div class="modal-body" style="padding:0px 70px;">
          <form method="post">
            <div class="form-group">
              <label><span class="glyphicon glyphicon-user"></span> ID</label>
              <input type="text" class="form-control" name="id" placeholder="Enter EWU Student ID" required/>
            </div>
            <div class="form-group">
              <label><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="password" class="form-control" name="psw" placeholder="Enter password" required/>
            </div>
            <div class="form-group">
              <label><span class="glyphicon glyphicon-user"></span> Name</label>
              <input type="text" class="form-control" name="fname" placeholder="Enter You full name" required/>
            </div>
            <div class="form-group">
              <label><span class="glyphicon glyphicon-envelope"></span> Email</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email"/>
            </div>

            <div class="form-group">
              <label><span class="glyphicon glyphicon-list-alt"></span> Date of birth</label>
              <input type="date" class="form-control" name="dob" placeholder="Enter Date of birth"/>
            </div>
            <div class="form-group">
              <label><span class="glyphicon glyphicon-bell"></span> Admission Semester</label>
              <input type="text" class="form-control" name="fsem" placeholder="Enter name of your first semester"/>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button  type="submit" class="btn btn-success btn-block" name="submit"><span class="glyphicon glyphicon-plus"></span> Signup</button>
          </form>
        </div>
      </div>
      
    </div>
  </div> 
  <script>
$(document).ready(function(){
    $("#myBtn2").click(function(){
        $("#myModal2").modal();
    });
});
</script>