<?php
require_once 'layouts/header.php';
//require_once 'layouts/auth/login.php';
//require_once 'layouts/auth/register.php';
if(!isset($_SESSION['user']))
{	echo '<div class="col-md-3"></div><center><div style="margin-top:12%; font-family: Exo; font-size: 26px;font-weight: bold;" class="col-md-6 alert alert-danger">You need to be logged in to see the contents of this page.<br/>Please Register or Login if registered earlier<div class="alert-warning">You will be redirected to home page shortly</div>
   </center>';
		 ob_end_flush();
		 flush();
		 usleep(2000000);
		echo '<script type="text/javascript">';
echo 'window.location.href="index.php";';
echo '</script>';
}


if(isset($_POST['add']))
{
 $regid = $_SESSION['regid'];
 $s_id = $_SESSION['userid'];
 $sem = strip_tags(mysqli_real_escape_string($conn, $_POST['sem']));
 if(isset($_POST['lab']))
 	$ccode = strip_tags(mysqli_real_escape_string($conn, $_POST['ccode']).mysqli_real_escape_string($conn, $_POST['lab']));
 else
 	$ccode= strip_tags(mysqli_real_escape_string($conn, $_POST['ccode']));
 
 $section = mysqli_real_escape_string($conn, $_POST['sec']);
 $cstarts = mysqli_real_escape_string($conn, $_POST['strt']);
 $cends = mysqli_real_escape_string($conn, $_POST['ends']);
 $wd = $_POST['wd'];
 $room = mysqli_real_escape_string($conn, $_POST['room']);
 $count = 0;
 for($i=0;$i<sizeof($wd);$i++)
 { $query = "INSERT INTO routine(regID,std_id,semester,course_code,section,starts,ends,weekdays,room) values('$regid','$s_id','$sem','$ccode','$section','$cstarts','$cends','$wd[$i]','$room') ";
 $res= mysqli_query($conn, $query) or die(mysql_error());
 $count++;
 }
 if($res && $count!=0)
 {
  ?>   
  <script>swal({
        title:"Congratulations",
        text: "Course Added Successfully",
        type: "success",
        confirmButtonColor: "green",
        confirmButtonText: "Close",
        closeOnConfirm: true
        });
//        window.location.href="add.php";

    </script>
  <?php
  }
 if(!$res)
 { ?>
        <script>
            swal({
              title:"Error",
              text: "Course addition failed",
              type: "error",
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Close",
              closeOnConfirm: true
              });
        </script>
        <?php
    
 }
 
}

if(isset($_SESSION['user']))
{
	//inactivity check
if(time()-$_SESSION['logged_in']>300)
  {

    echo '<script>window.alert("You have been auto logged out for 5 minutes inactivity");</script>';
    echo '<script>window.location.href="logout.php";</script>';
  }
  else{
    $_SESSION['logged_in']= time();
  }


	?>

<br>
<form method="post"  style="width: auto 60%;" class="container">
<input type="hidden" type="text" name="userid" required value="<?php echo $_SESSION['userid']; ?>"/>
<div class="form-group">
<label class="control-label col-md-2">Semester</label>
<div class="col-md-9">
<input class="form-control " type="text" name="sem" placeholder="Semester; eg: Fall-2016" requ ired />
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Course Code</label>
<div class="col-md-9">
<input class="form-control" type="text" name="ccode" placeholder="eg: CSE105" requi red  />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Is it Lab Schedule?</label>
<div class="checkbox checkbox-inline">
<label class="control-label my-label"><input type="checkbox" name="lab" value=" (Lab)">Check this box if its Lab Schedule</input></label>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Section</label>
<div class="col-md-9">
<input class="form-control" type="text" name="sec" placeholder="Section" />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Class Starts</label>
<div class="col-md-9">
<input class="form-control" type="time" name="strt" placeholder="Starting time. Use HH:MM AM/PM type time format" requi red  />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Class Ends</label>
<div class="col-md-9">
<input class="form-control" type="time" name="ends" placeholder="Ending time. Use HH:MM AM/PM type time format" requ ired  />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Week days</label>
<div class="col-md-9">
<div class="checkbox">
<label class="control-label my-label"><input type="checkbox" value="Sunday" name="wd[]">Sunday</input></label>
<label class="control-label my-label"><input type="checkbox" value="Monday" name="wd[]">Monday</input></label>  
<label class="control-label my-label"><input type="checkbox" value="Tuesday" name="wd[]">Tuesday</input></label>
<label class="control-label my-label"><input type="checkbox" value="Wednesday" name="wd[]">Wednesday</input></label>  
<label class="control-label my-label"><input type="checkbox" value="Thursday" name="wd[]">Thursday</input></label>  
</div>
 </div>
 </div>
<div class="form-group">
<label class="control-label col-md-2">Class Room</label>
<div class="col-md-9">
<input class="form-control" type="text" name="room" placeholder="Room no" />
</div>
</div>
 
<div class="form-group" style="padding-left: 30%;"> <br/><br/>
    <div class="col-md-offset-2 col-md-9"><br/>
<button class="btn btn-outline-white" type="submit" name="add">Add New Schedule</button> 
</div>
</div>
</form>
<?php
}

require_once 'layouts/footer.php';
?>