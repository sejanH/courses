<?php
session_start();
require_once 'layouts/header.php';
if(!isset($_SESSION['user']))
{	echo '<div class="col-md-3"></div><center><div style="margin-top:12%; font-family: Exo; font-size: 26px;font-weight: bold;" class="col-md-6 alert alert-danger">You need to be logged in to see the contents of this page.<br/>Please Register or Login if registered earlier<div class="alert-warning">You will be redirected to home page shortly</div>
   </center>';
		 ob_end_flush();
		 flush();
		 usleep(2000000);
		echo '<script type="text/javascript">window.location.href="index.php";</script>';
}
else{
	//inactivity check
if(time()-$_SESSION['logged_in']>300)
  {

    echo '<script>window.alert("You have been auto logged out for 5 minutes inactivity");</script>';
    echo '<script>window.location.href="logout.php";</script>';
  }
  else{
    $_SESSION['logged_in']= time();
  }

echo '<style>table,tr,td showDtls{
	font-family: Verdana;
	line-height: 40px;
}</style>';
$std_id = $_SESSION["userid"];
	$details = "SELECT * FROM student_info  where std_id='$std_id'";
	$result = mysqli_query($conn,$details);
	echo '<center><table class="showDtls" name="tbl">';
	$row = mysqli_fetch_array($result);
  $rawAGE = date_diff(date_create($row["DoB"]),date_create(date('d-m-Y')));
  $age = "<b>".$rawAGE->y."</b>years <b>".$rawAGE->m."</b>months <b>".$rawAGE->d."</b>days";
		echo "<tr><td width='150px'>Student ID: </td><td>".$row["std_id"]."</td></tr>" ;
		echo "<tr><td>Student Name: </td><td name='nm'>".$row["std_name"]."</td></tr>" ;
		echo "<tr><td>Email: </td><td>".$row["email"]."</td></tr>" ;
		echo "<tr><td>Date of Birth: </td><td>".$row["DoB"]."</td></tr>" ;
    echo "<tr><td>Age: </td><td>".$age."</td></tr>" ;
		echo "<tr><td>Batch: </td><td>".$row["starting_semester"]."</td>
		</tr>" ;

	echo " </table><a id='edit' href='#edit' class='btn btn-info'><span class='glyphicon glyphicon-edit'></a></center>";

  if(isset($_POST["edit"])){
    $loggedIN = $_SESSION["userid"];
    $sid = mysqli_real_escape_string($conn, $_POST['std_id']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $pass = md5($pass);
    $fname = mysqli_real_escape_string($conn, $_POST['std_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $string = strtotime($dob);
    $dobFormated = date("Y-m-d", $string);
    $fsem = mysqli_real_escape_string($conn, $_POST['batch']);
    $update = "update student_info set std_id='$sid', pass='$pass',std_name='$fname',email='$email', DoB='$dobFormated',starting_semester='$fsem' where std_id='$loggedIN'";
    //echo $update;
    $run = mysqli_query($conn,$update);
    if(mysqli_affected_rows($conn)>0){
      echo '<script>swal({
        title:"Success",
        text: "Updated Successfully\nYou may need to logout to see the changes.",
        type: "success",
        confirmButtonColor:"#00c0ad",
        confirmButtonText: "Refresh",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        },
        function(){
           setTimeout(function(){
            window.location.replace("profile.php")
          }, 1100);
       });</script>';
    }
    else
      echo mysqli_error($conn);

  }
}

?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#edit").click(function(){
      $("#editmodal").modal();
    });
	});
</script>

<div class="modal fade" id="editmodal" tabindex="1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit</h4>
      </div> 
      <?php 
		$std_id = $_SESSION["userid"]; 
      echo '<div class="modal-body">';
      	echo '<form method="post" class="form-inline">';
      	echo '<label class="form-group col-md-3">Your ID: </label><input style="width:70%;" class="form-control" type="text" name="std_id" value='.$row["std_id"].' required/>
        <label class="form-group col-md-3">Password:  </label><input style="width:70%;" class="form-control" type="password" name="pass" value="" required/>
        <label class="form-group col-md-3">Your Name: </label><input style="width:70%;" class="form-control" name="std_name" value="'.$row["std_name"].'" required/>
        <label class="form-group col-md-3">Email: </label><input style="width:70%;" class="form-control" type="text" name="email" value='.$row["email"].' required/>
        <label class="form-group col-md-3">Date of Birth:  </label><input style="width:70%;" class="form-control" type="date" name="dob" value='.$row["DoB"].' required/>
        <label class="form-group col-md-3">Batch:  </label><input style="width:70%;" class="form-control" type="text" name="batch" value='.$row["starting_semester"].' required/>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
        <input type="submit" class="btn btn-outline-danger" name="edit" value="Modify"/>
      </div>      </form>';
      echo "You need to enter your Password everytime. Old or New";
     ?>
    </div>
  </div>
</div>

<?php
include 'layouts/footer.php'; 

?>