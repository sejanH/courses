<?php 
require_once 'layouts/header.php';
require_once 'layouts/auth/login.php';
require_once 'layouts/auth/register.php';

//funtion to calculate semester name

	$sem2= semname();
 $sem1= $sem2."-".date('Y');

function sel_year()
{
  if(isset($_POST['search']))
    return $_POST['year'];
  else
    return date('Y');
} 

if(isset($_SESSION['user'])=="")
  {

echo '<center><div class="col-sm-3"></div><div style="margin: 12% 0% 0 0%; font-family: Exo; font-size: 26px;font-weight: bold;" class="col-md-6 alert alert-info">This simple PHP based website helps students of <br>East West University<br/> to keep track of completed and on goinging courses<br/>along side with its schedule, section and class room number.</div></center>';
}
else
{//inactivity check
if(time()-$_SESSION['logged_in']>300)
  {

    echo '<script>window.alert("You have been auto logged out for 5 minutes inactivity");</script>';
    echo '<script>window.location.href="logout.php";</script>';
  }
  else{
    $_SESSION['logged_in']= time();
  }
//search option
 $sid = mysqli_real_escape_string($conn, $_SESSION['userid']);
 $std_name = mysqli_real_escape_string($conn, $_SESSION['user']);
	echo '<center ><div class=" col-sm-2"><form method="post" class="form-group">
	<select name="semester" class="form-control" required>
	<option selected hidden value="'.sel_semester().'">'.sel_semester().'</option>
    <option value="Summer">Summer</option>
    <option value="Fall">Fall</option>
    <option value="Spring">Spring</option>
  </select></div><div class=" col-sm-2"><input name="year" class="form-control" type="number" value="'.sel_year().'" /></div>
  <div class=" col-sm-3 ">
  <button id="btn-search" class="btn btn-outline-white" name="search">Get Schedule</button>
  </form>
  
  </div></center><span style="float:right" class="alert alert-info">Your current semester is: '.$sem1.'</span>
   ';
   // <button id="btn-reload" onclick="window.location.href=\'.\'" type="submit" class="btn btn-outline-white">Reload</button>

   //showing searched details
  if(isset($_POST['search']))
  	{
  		$sem= $_POST['semester'].'-'.$_POST['year'];

  		$q = "SELECT * FROM routine join weekdays on routine.weekdays=weekdays.weekdays where std_id='$sid' and semester='$sem' order by weekdays.wid ASC,routine.starts ASC";
	 $res= mysqli_query($conn, $q) or die(mysqli_error($conn));
	 
if(mysqli_num_rows($res)>0)
	{echo '<div class="container" style="font-weight: bold"><br/><h1 style="text-align:center">Course Schedule for '.$sem.'</h1> <table style="background: rgba(255,255,255, .3);" class="table table-responsive">
        <tr style="font-weight: bold">
			     <th>Course Code</th>
			     <th>Section</th>
			     <th>Time</th>
			     <th>Week days</th>
			     <th>Room</th>
            </tr>';

        while ($row = mysqli_fetch_assoc($res)) {
            //output($row);
            echo ' <tr style="font-weight: bold">
			<td> '.$row["course_code"]. '</td>
			<td> '.$row["section"]. '</td>
			<td> '.date('h:i A', strtotime($row["starts"])). ' - '.date('h:i A', strtotime($row["ends"])). '</td>
			<td> '.$row["weekdays"]. '</td>
			<td> '.$row["room"]. '</td>
            </tr> ';
        }
     echo '</table></div>';}
     else{
     	echo '<br/><br/><hr class="style9"/><div class="col-md-3"></div><center><div class="col-md-6 alert alert-danger"><strong>Sorry!</strong> There was no record found for your selected semester: <i>'.$sem.'</i><br/>Would you like to <a class="my-label alert" href="add.php">ADD</a> a schedule for '.$sem.'?</div></center>';
     }
 }
 else
 { //default information showing
 
$q2="SELECT * FROM routine join weekdays on routine.weekdays=weekdays.weekdays where std_id='$sid' and semester='$sem1' order by weekdays.wid ASC,routine.starts ASC";

	
	 $res2= mysqli_query($conn, $q2) or die(mysqli_error($conn));
	 

	echo '<div class="container"><br/><h1 style="text-align:center">Course Schedule for current semester</h1> <table style="background: rgba(255,255,255, .3);" class="table table-responsive">
            <tr style="font-weight:  ;">
			<th>Course Code</th>
			<th>Section</th>
			<th>Time</th>
			<th>Week days</th>
			<th>Room</th>
            </tr>';

        while ($row2 = mysqli_fetch_array($res2)) {
            
            echo ' <tr style="font-weight: bold">
			<td> '.$row2["course_code"]. '</td>
			<td> '.$row2["section"]. '</td>
			<td> '.date('h:i:s A', strtotime($row2["starts"])). ' - '.date('h:i:s A', strtotime($row2["ends"])). '</td>
			<td> '.$row2["weekdays"]. '</td>
			<td> '.$row2["room"]. '</td>
            </tr> ';
        }
     echo '</table></div>';
 }

}

?>

<?php
  require_once 'layouts/footer.php';
?>