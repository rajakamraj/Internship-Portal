

<?php

$path = $_SERVER['DOCUMENT_ROOT'];
	require_once($path ."/common/db.php");
session_start();
$person_id=$_SESSION["person_id"];
$student_res= $conn->query("select student_id from student where person_id=$person_id limit 1") or die(mysql_error());//".$_SESSION['student_id']."

if($student_row = $student_res->fetch_assoc())
{
	$student_id=$student_row['student_id'];
}
else {
	$student_id=$person_id;
}
$success_msg=null;

if(isset($_SESSION['message']))
	{
	$success_msg=$_SESSION['message'];
	unset($_SESSION['message']);
	}
		
$res1=array();

require_once($path ."/common/db.php");
	$res = $conn->query("select a.internship_id,a.internship_name,a.job_description,a.weekly_hours,a.start_date,a.end_date,a.internship_type from internship_oppurtunities as a where a.status='open' 
	and a.internship_id not in (select internship_id from application where student_id=$student_id)") or die(mysql_error("SStudent saasdsadds"));//".$_SESSION['student_id']."
	
	while($res2 = $res->fetch_assoc())	
	$res1[] = $res2;
	//echo mysql_num_rows($res);
	//echo "<pre>";
	//print_r($res1);
	//exit;
	if($_POST)
	{
	//print_r($_POST);
	foreach($_POST['chk'] as $chk)
	{	
		require_once($path ."/common/db.php");
		
	$res=$conn->query("insert into application values($chk,$student_id,'0','','')") or die(mysql_error($conn));//".$_SESSION['student_id']."

	}
	$_SESSION['message']="Applied Successfully for ".count($_POST['chk'])." Internships";
	header("location:/student/apply/apply_internship.php");
	}
?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
 


</head>
<body>
<?php 
//For header
require  $path ."/common/header.php"; ?>
<div class="container">
<div class="row">
			<div class="col-md-12">
				<h1 class="page-header text-center">
					Apply Internship
				</h1>
			</div>
		</div>
<?php 
if($success_msg!=null)
{
?>
<div class="alert alert-success" id="success-alert-apply">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong><?php echo $success_msg;?> </strong>   
</div>
<?php 
$success_msg=null;
}
?>
<?php if(count($res1)!=0){ ?>
<form name="apply" id="apply" method="post" action="">
<table name="apply_data" id="apply_data" class="table table-striped table-bordered">
   <thead>
<tr>
<th width="25%">Internship Name</th>
<th width="25%">Description</th>
<th width="10%">Hours Per Week</th>
<th width="10%">Start date</th>
<th width="10%">End date</th>
<th width="10%">Internship Type</th>
<th width="10%">Apply</th>

</tr>
</thead>
<tbody>
<?php
foreach($res1 as $data)
{
?>
<tr>
<td><?php echo $data['internship_name'] ?></td>
<td><?php echo $data['job_description'] ?></td>
<td><?php echo $data['weekly_hours'] ?></td>
<td><?php echo $data['start_date'] ?></td>
<td><?php echo $data['end_date'] ?></td>
<td><?php echo $data['internship_type'] ?></td>
<td><input type="checkbox" name="chk[]" value="<?php echo $data['internship_id'] ?>"> </td>
</tr>
<?php
}
?>
</tbody>
</table>
<div class="row">
<div class="col-md-12 text-center">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">
</div>
</div>
</form>
<?php } else echo "No open Internships available."; ?>
</div>
<br><br>
<footer>
<?php require  $path . "/common/footer.php";?>
</footer>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
 
<script type="text/javascript">

$(function(){
    $("#apply_data").dataTable();

	
    $("#success-alert-apply").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert-apply").alert('close');
    });
})
</script>
  
</body>
</html>