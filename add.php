<?php
require_once 'layouts/header.php';
require_once 'layouts/auth/login.php';
require_once 'layouts/auth/register.php';

if(!isset($_SESSION['user']))
    {
    	//	ob_start();
    	
    		echo '<div class="col-md-3"></div><center><div style="margin-top:6%; font-family: Lato; font-size: 26px;font-weight: bold;" class="col-md-6 alert alert-danger">You need to be logged in to see the contents of this page.<br/>Please Register or Login if registered earlier<div class="alert-warning">You will be redirected to home page shortly</div>
   </center>';

	
		 ob_end_flush();
		 flush();
		 usleep(2000000);
		
		echo '<script type="text/javascript">';
echo 'window.location.href="index.php";';
echo '</script>';
		//	header('Location:index.php');
    }


if(isset($_POST['submit']))
{
 $id = mysqli_real_escape_string($conn, $_POST['userid']);
 $sem = mysqli_real_escape_string($conn, $_POST['sem']);
 if(isset($_POST['lab']))
 	$ccode = mysqli_real_escape_string($conn, $_POST['ccode']).mysqli_real_escape_string($conn, $_POST['lab']);
 else
 	$ccode= mysqli_real_escape_string($conn, $_POST['ccode']);
 	
 $section = mysqli_real_escape_string($conn, $_POST['sec']);
 $cstarts = mysqli_real_escape_string($conn, $_POST['strt']);
 $cends = mysqli_real_escape_string($conn, $_POST['ends']);
 $wd = mysqli_real_escape_string($conn, $_POST['wd']);
 $room = mysqli_real_escape_string($conn, $_POST['room']);
 

 

 for($i=0;$i<sizeof($wd);$i++)
 { $query = "INSERT INTO routine(  std_id,semester,course_code,section,starts,ends,weekdays,room) values('$id','$sem','$ccode','$section','$cstarts','$cends','$wd[$i]','$room') ";
 $res= mysqli_query($conn, $query) or die(mysql_error());
 }
 if($res)
 {
  ?>
        <script>alert('Course Added Successfully');</script>
        <?php
 }
 else
 { ?>
        <script>alert('Something went wrong!');</script>
        <?php
    
 }
 
}
?>

<?php if(isset($_SESSION['user']))
{
	if(time()-$_SESSION['logged_in']>600)
  {

    echo '<script>window.alert("Logged out for 10minutes inactivity");</script>';
    echo '<script>window.location.href="logout.php";</script>';
  }
  else{
  	$_SESSION['logged_in']= time();
  }


	?>


<form method="post"  style="padding-top:6%;width: auto 60%;" class="container">
<input type="hidden" type="text" name="userid" required value="<?php echo $_SESSION['userid']; ?>"/>
<div class="form-group">
<label class="control-label col-md-2">Semester</label>
<div class="col-md-9">
<input class="form-control " type="text" name="sem" placeholder="Semester; eg: Fall-2016" required />
</div>
</div>

<div class="form-group">
<label class="control-label col-md-2">Course Code</label>
<div class="col-md-9">
<input class="form-control" type="text" name="ccode" placeholder="eg: CSE105" required  />
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
<input class="form-control" type="time" name="strt" placeholder="Starting time. Use HH:MM AM/PM type time format" required  />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-2">Class Ends</label>
<div class="col-md-9">
<input class="form-control" type="time" name="ends" placeholder="Ending time. Use HH:MM AM/PM type time format" required  />
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
<button class="btn btn-outline-info" type="submit" name="submit">Add New Schedule</button> 
</div>
</div>
</form>
<?php
}
?>
<script type="text/javascript">
	function disable(select_val,input_id) {
                var e = document.getElementById(select_val);
                var strUser = e.options[e.selectedIndex].value;
                if(strUser === "100"){
                    document.getElementById(input_id).disabled = false;
                }
                else{
                    document.getElementById(input_id).value = document.getElementById(input_id).defaultValue;
                    document.getElementById(input_id).disabled = true;
                }
}
</script>


<?php
require_once 'layouts/footer.php';
?>