<?php
require_once 'db/db.php'; 
require_once 'layouts/header.php';

if(!isset($_SESSION['user']))
    {
    		echo '<div class="col-md-3"></div><center><div style="margin-top:6%; font-family: Lato; font-size: 26px;font-weight: bold;" class="col-md-6 alert alert-danger">You need to be logged in to see the contents of this page.<br/>Please Register or Login if registered earlier<div class="alert-warning">You will be redirected to home page shortly</div>
   </center>';

	
		 ob_end_flush();
		 flush();
		 usleep(2000000);
		
		echo '<script type="text/javascript">';
echo 'window.location.href="index.php";';
echo '</script>';

    }
else{
  if(!isset($_SESSION['sem']))
 $_SESSION['sem']= semname().'-'.date('Y');
 
//inactivity check
if(time()-$_SESSION['logged_in']>600)
  {
    echo '<script>window.alert("Logged out for 10minutes inactivity");</script>';
    echo '<script>window.location.href="logout.php";</script>';
  }
  else{
    $_SESSION['logged_in']= time();
  }

$sid = mysql_real_escape_string($_SESSION['userid']);
//$_SESSION['sem']= semname().'-'.date('Y');
 if (isset($_POST['delete']))
 {
        $sem=mysql_real_escape_string($_SESSION['sem']);
        $ccode = mysql_real_escape_string($_POST['ccode']);
        $csec = mysql_real_escape_string($_POST['csec']);
        $cstarts = mysql_real_escape_string($_POST['cstarts']);
        $cends = mysql_real_escape_string($_POST['cends']);
        $wd = mysql_real_escape_string($_POST['wd']);
        $croom = mysql_real_escape_string($_POST['croom']);
$del = "DELETE FROM routine where course_code='$ccode' and std_id='$sid' and semester='$sem'";
//echo $del;
   $res = mysql_query($del) or die("Error: ".mysql_error());
      if($res)
      {
        echo '<script>alert("Course: '.$ccode.' Deleted"); window.location.replace("update.php");</script>';
      }
      else{
        echo '<script>alert("Operation unsuccessful");</script>';
      }
}
echo '<center><form method="post" class="form-horizontal "><div class=" col-sm-2">
  <select name="semester" class="form-control" required>
  <option selected hidden value="">Select Semester</option>
    <option value="Summer">Summer</option>
    <option value="Fall">Fall</option>
    <option value="Spring">Spring</option>
  </select></div><div class=" col-sm-2"><input name="year" class="form-control" type="number" value="'.date('Y').'" placeholder="Select Year" /></div>
  <div class=" col-sm-2">
  <button id="btn-search" type="submit" class="btn btn-primary" name="search">Get Schedule to Modify</button>
  </div>
  </form><button id="btn-reload" onclick="window.location.reload()" type="submit" class="btn btn-default">Reload</button></center>';


 if(isset($_POST['search']))
    {
      $sem= $_POST['semester'].'-'.$_POST['year'];
  $_SESSION['sem']= $sem;
  $q = "SELECT * FROM routine join weekdays on routine.weekdays=weekdays.weekdays where std_id='$sid' and semester='$sem' order by weekdays.wid ASC";
   $res= mysql_query($q) or die(mysql_error());
  
if(mysql_num_rows($res)>0)
 { echo '<div class="container"><br/><h1 style="text-align:center">Course Schedule for '.$sem.'</h1> <table class="table table-condensed" border="0">
            <tr>
      <th>Course Code</th>
      <th width="35px">Section</th>
      <th>Starting Time</th>
      <th>Ending Time</th>
      <th>Week days</th>
      <th>Room</th>
      <th>Actions</th>
            </tr>';

        while ($row = mysql_fetch_assoc($res)) {
            //output($row);
      echo '<form class="form-horizontal" action="" method="POST"> <tr>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["course_code"]).'" name="ccode"></input></td>
      <td width="35px"><input class="form-control" value="'.mysql_real_escape_string($row["section"]).'" type="number" name="csec"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["starts"]).'" type="time" name="cstarts"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["ends"]).'" type="time" name="cends"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["weekdays"]).'" name="wd"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["room"]).'" name="croom"></input></td>
      <td><span class="btn-group"><button id="btn-update" name="edit" class="btn btn-warning">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button><button name="delete" class="btn btn-danger">Delete</button></span></td>
            </tr> </form>';
        }
     echo '</table></div>';
}
else{
  echo '<br/><br/><hr class="style9"/><div class="col-md-3"></div><center><div class="col-md-6 alert alert-danger"><strong>Sorry!</strong> There was no record found for your selected semester: <i>'.$sem.'</i><br/>Would you like to <a class="my-label alert" href="add.php">ADD</a> a schedule for '.$sem.'?</div></center>';
}


 }
 else
 {
  if($_SESSION['sem']==""){
  $_SESSION['sem']= semname().'-'.date('Y');
  $sem=$_SESSION['sem'];
}else{
  $sem=$_SESSION['sem'];
}

  $q = "SELECT * FROM routine join weekdays on routine.weekdays=weekdays.weekdays where std_id='$sid' and semester='$sem' order by weekdays.wid ASC";
   $res= mysql_query($q) or die(mysql_error());
  

  echo '<div class="container"><br/><h1 style="text-align:center">Course Schedule for '.$sem.'</h1> <table class="table table-condensed">
            <tr style="font-weight:  ;">
      <th>Course Code</th>
      <th width="35px auto">Section</th>
      <th>Starting Time</th>
      <th>Ending Time</th>
      <th>Week days</th>
      <th>Room</th>
      <th>Actions</th>
            </tr>';

        while ($row = mysql_fetch_assoc($res)) {
            //output($row);
      echo '<form class="form-inline"  method="POST"><tr>
      <td class="form-group"><input class="form-control" value="'.mysql_real_escape_string($row["course_code"]).'" name="ccode"></input></td>
      <td class="form-group" width="35px"><input class="form-control" value="'.mysql_real_escape_string($row["section"]).'" type="number" name="csec"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["starts"]).'" type="time" name="cstarts"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["ends"]).'" type="time" name="cends"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["weekdays"]).'" name="wd"></input></td>
      <td><input class="form-control" value="'.mysql_real_escape_string($row["room"]).'" name="croom"></input></td>
      <td><span class="btn-group"><button name="edit" class="btn btn-warning">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button><button name="delete" class="btn btn-danger">Delete</button></span></td>
            </tr> </form>';
        }
     echo '</table></div>';



 }

if(isset($_POST['edit']))
 {
    $sem=mysql_real_escape_string($_SESSION['sem']);
    $ccode = mysql_real_escape_string($_POST['ccode']);
    $csec = mysql_real_escape_string($_POST['csec']);
    $cstarts = mysql_real_escape_string($_POST['cstarts']);
    $cends = mysql_real_escape_string($_POST['cends']);
    $wd = mysql_real_escape_string($_POST['wd']);
    $croom = mysql_real_escape_string($_POST['croom']);

$edit = "UPDATE routine set course_code='$ccode',section='$csec',starts='$cstarts',ends='$cends',weekdays='$wd',room='$croom' WHERE std_id='$sid' and semester='$sem' and course_code='$ccode' and weekdays='$wd'";

$res = mysql_query($edit) or die("Error: ".mysql_error());
 
      if($res){
        echo '<script>alert("Course: '.$ccode.' Edit Successful");window.location.replace("update.php");</script>';
      }
      else{
        echo '<script>alert("Operation unsuccessful");</script>';
      }
}


}
?>

<?php
require_once 'layouts/footer.php';
?>
