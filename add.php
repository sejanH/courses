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
		echo '<script type="text/javascript">window.location.href="index.php";</script>';
}

if(isset($_POST['add']) && !isset($_POST['wd'])){
  echo '<script>alert("weekdays are required");</script>';
}

if(isset($_POST['add']) && isset($_POST['wd']))
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
 if(isset($_POST['wd']))
 $wd = $_POST['wd'];
else $wd="Sunday";
 $room = mysqli_real_escape_string($conn, $_POST['room']);
 $count = 0;
 if($wd!=null)
 for($i=0;$i<sizeof($wd);$i++)
 { $query = "INSERT INTO routine(regID,std_id,semester,course_code,section,starts,ends,weekdays,room) values('$regid','$s_id','$sem','$ccode','$section','$cstarts','$cends','$wd[$i]','$room') ";
 $res= mysqli_query($conn, $query) or die(mysqli_error($conn));
 $count++;
 }
 else{
  $query = "INSERT INTO routine(regID,std_id,semester,course_code,section,starts,ends,weekdays,room) values('$regid','$s_id','$sem','$ccode','$section','$cstarts','$cends','$wd','$room') ";

 $res= mysqli_query($conn, $query) or die(mysqli_error($conn));
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
        closeOnConfirm: false
        },
        function(){
           setTimeout(function(){
            window.location.replace("add.php")
          }, 100);
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
              closeOnConfirm: false
              },
        function(){
           setTimeout(function(){
            window.location.replace("add.php")
          }, 100);
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

<br><div class="col-md-3"></div>
<form method="post" class="col-md-7">
<input type="hidden" type="text" name="userid" required value="<?php echo $_SESSION['userid']; ?>"/>
<div class="form-group">
<label class="control-label col-md-3">Semester</label>
<div class="col-md-9">
<input class="form-control " type="text" name="sem" placeholder="Semester; eg: Fall-2016" required />*
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Course Code</label>
<div class="col-md-9">
<input class="form-control" type="text" name="ccode" placeholder="eg: CSE105" required />*
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3">Is it Lab Schedule?</label>
<div class="checkbox checkbox-inline">
<label class="control-label my-label"><input type="checkbox" name="lab" value=" (Lab)">Check this box if its Lab Schedule</input></label>
</div>
</div>

<div class="form-group">
<label class="control-label col-md-3">Section</label>
<div class="col-md-9">
<input class="form-control" type="text" name="sec" placeholder="Section" />
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3">Class Starts</label>
<div class="col-md-9">
<input class="form-control" type="time" name="strt" placeholder="Starting time. Use HH:MM AM/PM type time format" required  />*
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3">Class Ends</label>
<div class="col-md-9">
<input class="form-control" type="time" name="ends" placeholder="Ending time. Use HH:MM AM/PM type time format" required  />*
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3">Week days</label>
<div class="col-md-9">
<div class="checkbox">
<label class="control-label my-label"><input type="checkbox" value="Sunday" name="wd[]">Sunday</input></label>
<label class="control-label my-label"><input type="checkbox" value="Monday" name="wd[]">Monday</input></label>  
<label class="control-label my-label"><input type="checkbox" value="Tuesday" name="wd[]">Tuesday</input></label>
<label class="control-label my-label"><input type="checkbox" value="Wednesday" name="wd[]">Wednesday</input></label>  
<label class="control-label my-label"><input type="checkbox" value="Thursday" name="wd[]">Thursday</input></label>  
</div>*
 </div>
 </div>
<div class="form-group">
<label class="control-label col-md-3">Class Room</label>
<div class="col-md-9">
<input class="form-control" type="text" name="room" placeholder="Room no"/>
</div>
</div>
 
<div class="form-group" style="padding-left: 30%;"> <br/><br/>
    <div class="col-md-offset-2 col-md-9"><br/>
<button class="btn btn-outline-white" type="submit" name="add" onclick="return weekdays();">Add New Schedule</button> 
</div>
</div>
</form>
<?php
}

require_once 'layouts/footer.php';
?>