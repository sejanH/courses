<?php

require_once 'db.php';


if(isset($_POST['submit']))

{
 $sid = mysqli_real_escape_string($conn, $_POST['sid']);
 $pass = mysqli_real_escape_string($conn, $_POST['psw']);
 $pass = md5($pass);
 $fname = mysqli_real_escape_string($conn, $_POST['fname']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $fsem = mysqli_real_escape_string($conn, $_POST['fsem']);

 $query = "INSERT INTO student_info(std_id,std_name,email,pass,starting_semester) values('$sid','$fname','$email','$pass','$fsem') ";

 $res= mysqli_query($conn, $query); //or die(mysql_errno());

 if($res)
 {
  echo '<script>swal({
        title:"Success",
        text: "You can login now",
        type: "success",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Close",
        closeOnConfirm: true
        });</script>';
 }
 else{
  echo '<script>alert("'.mysqli_error($conn).'")</script>';
 }
}



?>

<div class="modal fade" id="myModal2" role="dialog">

    <div class="modal-dialog">

    
      <!-- Modal content-->

      <div class="modal-content modal-lg">
        <div class="modal-header" style="padding: 15px 15px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-folder-open"></span>  &nbsp;Signup</h4>
        </div>
        <div class="modal-body" style="padding:10px 15px;">
          <form method="post" class="form-horizontal" name="register">
            <div class="form-group">
              <label class="col-md-3"><span class="glyphicon glyphicon-user"></span> ID</label>
              <div class="col-md-8">
                <input   type="text" class="form-control" name="sid" placeholder="Enter EWU Student ID eg. 201X-X-XX-XXX" /> &nbsp;*
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <div class="col-md-4">
              <input id="pwd" type="password" class="form-control" name="psw" placeholder="Enter password min. 6 characters" required/> &nbsp;*
              </div>
              <div class="col-md-4">
              <input id="confpwd" type="password" class="form-control" name="psw" placeholder="Enter password again" required/> &nbsp;*
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3"><span class="glyphicon glyphicon-user"></span> Name</label>
              <div class="col-md-8">
              <input id="fullname" type="text" class="form-control" name="fname" placeholder="Enter You full name" required/> &nbsp;*
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3"><span class="glyphicon glyphicon-envelope"></span> Email</label>
              <div class="col-md-8">
              <input id="email" type="email" class="form-control" name="email" placeholder="Enter email"/> &nbsp;*
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3"><span class="glyphicon glyphicon-bell"></span> Admission Semester</label>
              <div class="col-md-8">
              <input type="text" class="form-control" name="fsem" placeholder="Enter name of your first semester"/>
              </div>
            </div>

            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
            <div class="form-group" align="center">
              <button onclick="return validation();" type="submit" class="btn btn-secondary" name="submit"><span class="glyphicon glyphicon-plus"></span> Signup</button>
              <input id="reset" class="btn btn-secondary" type="reset" value="Reset" />
              </div>
          </form>

        </div>

      </div>

    </div>

  </div> 

  <script>


    function validation(){
      //var sid = document.getElementById('sid').value;
      var sid = register.sid.value;
      var sidPattern = /^([0-9]{4,4}-[0-9]{1,1}-[0-9]{2,2}-[0-9]{3,3})$/
      var pass = document.getElementById('pwd').value;
      var cpass = document.getElementById('confpwd').value;
      var fullname = document.getElementById('fullname').value;
      var email = document.getElementById('email').value;
      var emailPattern = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
      
      var msg ;
      if(sid.length==0){
         
        msg="Student ID can\'t be empty"; 
       // document.getElementById("errsid").innerHTML = msg;
       swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        }); 
        return false;
      }
      else if(!sidPattern.test(sid) && sid.length!=0 && sid.length == 13)
      { 
          msg="Invaild Id Format";
       swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        }); 
        return false;
      }
      else if(sid.length > 13)
      { 
        msg = "Student ID can\'t excede 13 characters";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        }); 
        return false;
      }
      else if(sid.length <13)
      { 
        msg = "Student IDs are 13 characters long at EWU";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        }); 
        return false;
      }
      if(pass=="")
      { 
        msg = "Password can\'t be empty";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });

        return false;
      }
      else if(pass.length<6)
      {
        msg = "Password must be 6 characters long";
       swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });
        return false;
      }
      if(cpass=="")
      { 
        msg = "Confirm password can\'t be empty";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });
        return false;
      }
      if(pass!==cpass)
      { 
        msg = "Password and Confirm Password didn\'t matched";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });
        return false;
      }
      if(fullname==="")
      {
        msg = "Full Name is required";
         swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });
        return false;
      }
      if(email==="")
      {
        msg = "Email is required";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });
        return false;
      }
      else if(!emailPattern.test(email))
      {
        msg = "Email is not valid";
        swal({
        title: msg,
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Try Again",
        timer: 1100,
        showConfirmButton: false
        });
        return false;
      }
      
    }

$(document).ready(function(){

    $("#myBtn2").click(function(){

        $("#myModal2").modal();

    });

});


  document.querySelector('#reset').onclick = function(){
  swal({
    title: "Success",
    text: "Your request proccessed",
    type: "success",
    timer: 1100,
    showConfirmButton: false
  });
};
</script>
