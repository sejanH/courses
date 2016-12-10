<?php
require_once 'db/db.php'; 
require_once 'header.php';

if(!isset($_SESSION['user']))
    {
    	//	ob_start();
    	
    		echo '<div class="col-md-3"></div><center><div style="margin-top:6%; font-family: Lato; font-size: 26px;font-weight: bold;" class="col-md-6 alert alert-danger">You need to be logged to see the contents of this page.<br/>Please Register or Login if registered earlier<div class="alert-warning">You will be redirected to home page shortly</div>
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

 $id = mysql_real_escape_string($_POST['userid']);
 $sem = mysql_real_escape_string($_POST['sem']);
 if(isset($_POST['lab']))
 	$ccode = mysql_real_escape_string($_POST['ccode']).mysql_real_escape_string($_POST['lab']);
 else
 	$ccode= mysql_real_escape_string($_POST['ccode']);
 	
 $section = mysql_real_escape_string($_POST['sec']);
 $cstarts = mysql_real_escape_string($_POST['strt']);
 $cends = mysql_real_escape_string($_POST['ends']);
 $wd = mysql_real_escape_string($_POST['wd']);
 $room = mysql_real_escape_string($_POST['room']);
 
 $query = "INSERT INTO routine(	std_id,semester,course_code,section,starts,ends,weekdays,room) values('$id','$sem','$ccode','$section','$cstarts','$cends','$wd','$room') ";
 $res= mysql_query($query) or die(mysql_error());
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

<form method="post"  style="padding-top:6%;" class="container form-inline">
<div class="row">
<label class="control-label">Semester?</label>
<select name="semester" class="form-control" required>
  <option selected hidden value=""></option>
    <option value="Summer">Summer</option>
    <option value="Fall">Fall</option>
    <option value="Spring">Spring</option>
  </select>
  <input name="year" class="form-control" type="number" value="2016" />

<label class="control-label">How many courses?</label>
<input class="form-control" type="number" name="noc" value="3"/>
<button name="first_step" class="btn btn-submit" type="submit">Next</button>
</div>
</form>





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
<div class="checkbox">
<label >
<input type="checkbox" name="lab" value=" (Lab)">Check this box if its Lab</input>
</label>
</div>
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
<select class="form-control" name="wd" id="wd" required onchange="disable('wd', 'othrs')">
	<option selected hidden value="">Select a week day</option>
    <option value="ST">ST</option>
    <option value="SR">SR</option>
    <option value="MW">MW</option>
    <option value="TR">TR</option>
    <option value="100">Others</option>
  </select>
  <input id="othrs" disabled value="" class="form-control" type="text" name="wd" placeholder="Other week days" required  />
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
<button class="btn btn-warning btn-lg" type="submit" name="submit">Add New Schedule</button> 
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
require_once 'footer.php';
?>