<?php

$path = $_SERVER['DOCUMENT_ROOT'];
	require_once($path ."/common/db.php");
session_start();
$person_id=$_SESSION["person_id"];
if(isset($_SESSION['message']))
{
	$msg=$_SESSION['message'];
	unset($_SESSION['message']);
}
else {
	$msg=null;
}


$sql = "
		SELECT
intern.internship_id,
intern.internship_name,
intern.internship_type,
intern.supervisor_contact,
intern.weekly_hours,
per.first_name,
stu.student_id,
b.business_name,
app.app_status
FROM internship_oppurtunities intern,application app,
student stu,person per,business b
where intern.internship_id = app.internship_id
and app.student_id = stu.student_id
and per.person_id = stu.person_id
and b.business_id=intern.business_id
";

$intern_app_res= $conn->query($sql) or die(mysql_error());//".$_SESSION['student_id']."


	
$res1=array();


$intern_app_res= $conn->query($sql) or die(mysql_error());//".$_SESSION['student_id']."

while($res2 = $intern_app_res->fetch_assoc())	
	$res1[] = $res2;
	//echo mysql_num_rows($res);
	//echo "<pre>";
	//print_r($res1);
	//exit;
	if($_POST)
	{
	//print_r($_POST);
// 	foreach($_POST['status'] as $status_value)





	$status_val=$_POST['status'];
	$internship_array=$_POST['hidden_internship_id'];
	$student_id_array=$_POST['hidden_student_id'];
	$old_status=$_POST['hidden_old_status'];
	for( $i = 0;$i < sizeof($status_val);$i++)
	{
		if($status_val[$i] !=$old_status[$i])
		{
			
		require_once($path ."/common/db.php");
		if($status_val[$i]=='y' || $status_val[$i]=='Y')
		{
		$verify_hours = $conn->query("CALL check_hours($internship_array[$i],$student_id_array[$i],@result_hour)");
		require_once($path ."/common/db.php");
		$rs = $conn->query( 'SELECT @result_hour' );
		 while($row=$rs->fetch_assoc()){
		
	if($row['@result_hour'])
	{
		 	//echo $status_val[$i];
		require_once($path ."/common/db.php");
		$update_sql="update application set app_status='$status_val[$i]' 
		where internship_id=$internship_array[$i] and student_id=$student_id_array[$i]
				";
	
$res_status=$conn->query($update_sql) or die(mysql_error());
	}
	else {
		$_SESSION['message']="fail";
	}
		 }
		  	 }
		  	 else
		  	 {
		  	 	require_once($path ."/common/db.php");
		  	 	$update_sql="update application set app_status='$status_val[$i]'
		  	 	where internship_id=$internship_array[$i] and student_id=$student_id_array[$i]
		  	 	";
		  	 	
		  	 	$res_status=$conn->query($update_sql) or die(mysql_error());
		  	 }
	}
	}
// 	$_SESSION['message']="Applied Successfully for ".count($_POST['chk'])." Internships";
	header("location:/admin/internship/assign_internship.php");
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
					Assign Internship
				</h1>
			</div>
		</div>
<?php 
if($msg=='fail')
{
?>
<div class="alert alert-warning" id="success-alert-assign">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong><?php echo "Internship working hours should not exceed more than 25 hours";?> </strong>   
</div>
<?php 
$msg=null;
}
?>
<?php if(count($res1)!=0){ ?>
<form name="apply" id="apply" method="post" action="">
<table  id="assign" class="table table-striped table-bordered">
<thead>
<tr>
<th width="15%">Business Name</th>
<th width="25%">Internship Name</th>
<th width="10%">Student ID</th>
<th width="10%">Student Name</th>
<th width="10%">Skills</th>
<th width="10%">Internship Type</th>
<th width="10%">Weekly hours</th>
<th width="10%">Status</th>

</tr>
</thead>
 <tbody>
<?php
foreach($res1 as $data)
{
?>
<tr>

<td><?php echo $data['business_name'] ?></td>
<td><?php echo $data['internship_name'] ?></td>
<td><?php echo $data['student_id'] ?></td>
<td><?php echo $data['first_name'] ?></td>
<td><?php require_once($path ."/common/db.php");
$query_selected="select sk.skill_name from skill sk,student_skill_mapping skm where sk.skill_id=skm.skill_id and skm.student_id=".$data['student_id'];

	$result_skill=$conn->query($query_selected);
	if ($result_skill->num_rows > 0) {
		$before='';
	while ($skill_row=$result_skill->fetch_assoc()) {
		echo $before.$skill_row['skill_name'];
		$before=',';
}
}?></td>
<td><?php echo $data['internship_type'] ?></td>
<td><?php echo $data['weekly_hours'] ?></td>
<td>
<select name="status[]" >
<option value="" <?php  if($data['app_status']==null)
{
	?>selected<?php 
}
	?>>Under Review</option>
<option value="Y"  <?php  if($data['app_status']=='Y'|| $data['app_status']=='y')
{
	?>selected<?php 
}
	?>>Selected</option>
<option value="N"  <?php  if($data['app_status']=='N'|| $data['app_status']=='n')
{
	?>selected<?php 
}
	?>>Rejected</option>
</select>
<input type="hidden" name="hidden_internship_id[]" value=<?php echo $data['internship_id'] ?>>
<input type="hidden" name="hidden_old_status[]" value=<?php echo $data['app_status'] ?>>
<input type="hidden" name="hidden_student_id[]" value=<?php echo $data['student_id']  ?>>

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
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
  
  $(function(){
	 $("#assign").dataTable();
	 
	 $("#success-alert-assign").fadeTo(2000, 500).slideUp(500, function(){
	        $("#success-alert-assign").alert('close');
	    });
		
    
})
 
</script>
  
</form>
<?php } else echo "No open Internships available."; ?>
</div>
<br><br>
<footer>
<?php require  $path . "/common/footer.php";?>
</footer>

</body>
</html>