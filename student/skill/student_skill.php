<?php session_start();?>

<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
//For header
$skill_no=0;

require  $path ."/common/header.php"; 

$person_id=$_SESSION["person_id"];
	require_once($path ."/common/db.php");
$student_res= $conn->query("select student_id from student where person_id=$person_id limit 1") or die(mysql_error());//".$_SESSION['student_id']."

if($student_row = $student_res->fetch_assoc())
{
	$student_id=$student_row['student_id'];
}
else {
	$student_id=$person_id;
}
?>
<?php 



if(isset($_POST['submitSkils']))
{
	
	extract($_POST);
	
	
	
	$chkbox = array();
	
	require_once($path ."/common/db.php");
	$res = $conn->query("select skill_id from skill") or die(mysql_error());//".$_SESSION['student_id']."
	while($res2 = $res->fetch_assoc())
		$chkbox[] = $res2['skill_id'];
	if(isset($_POST['skill']))
	{
	  $skill_check=$_POST['skill'];
	$values = array();
	foreach($chkbox as $selection )
	{  
	
		if(in_array($selection, $skill_check))
		{
			
			$sql_skill="select student_skill_mpg_id from student_skill_mapping 
			where student_id=$student_id and skill_id=$selection";
			require_once($path ."/common/db.php");
			$result = $conn->query($sql_skill);
			if ($result->num_rows > 0) {
				
			}
			else {
				$sql_insert_skill="insert into student_skill_mapping(student_id,skill_id)
			 values($student_id,$selection)";
				require_once($path ."/common/db.php");
				$result = $conn->query($sql_insert_skill);
			}
		
		}
	else
		{ 
		$sql_skill="select student_skill_mpg_id from student_skill_mapping 
		where student_id=$student_id and skill_id=$selection";
		require_once($path ."/common/db.php");
		$result = $conn->query($sql_skill);
		if ($result->num_rows > 0) {
			$sql_delete_skill="delete from student_skill_mapping 
		where student_id=$student_id and skill_id=$selection";
			require_once($path ."/common/db.php");
			$result = $conn->query($sql_delete_skill);
		}
	  	}
	  	
	}
	
	}
	else {
		$sql_skill="select student_skill_mpg_id from student_skill_mapping
		where student_id=$student_id";
		require_once($path ."/common/db.php");
		$result = $conn->query($sql_skill);
		if ($result->num_rows > 0) {
			$sql_delete_skill="delete from student_skill_mapping
			where student_id=$student_id";
			require_once($path ."/common/db.php");
			$result = $conn->query($sql_delete_skill);
	}
	

	}
	
// 	$result = $conn->query($query);
// 		if($result){
//   		//header("Refresh:0");
//   		//header("location: update_or_delete_internship.php");
		
// 			// the message
// 			$msg = "A new internship $internship_name has been posted\nPlease check it";
			
// 			// use wordwrap() if lines are longer than 70 characters
// 			$msg = wordwrap($msg,70);
			
// 			// send email
// 			mail("rajakamraj@gmail.com","Internship Alert",$msg);
			
//   		$result_insert_msg='success';	
// 		$_SESSION['displayInsertMsg']="yes";	
//   	}
//   	else
//   	{
//   		 //die('Could not delete data: ' . mysql_error());
//   		 $result_insert_msg='fail';
// 		$_SESSION['displayInsertMsg']="yes";	
  		
//   	}
  	
  	  		$_SESSION['skill_message']="The skill set has been saved successfully....";
  	  		//header("Location: /student/skill/student_skill.php");
	
  }
  
  

if(isset($_SESSION['skill_message']))
{
	$info_msg=$_SESSION['skill_message'];
	unset($_SESSION['skill_message']);
}
else {
	$info_msg=null;
}
?>
<!DOCTYPE html>
<html>
<head>

<!-- Latest compiled and minified CSS -->


</head>

<body >

<div class="container">
<?php 
if($info_msg!=null)
{
?>
<div class="alert alert-success" id="success-alert-skill">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong><?php echo $info_msg;?> </strong>   
</div>
<?php 
$info_msg=null;
}
?>
<form id="student_skill_form" action="" method="post">
<div class="form-group">
<h2><center>
Update your skills here...

</center></h2>
</div>
  <div class="form-group">
    <label for="internship_name_label">Skills:</label>
	<?php require_once($path ."/common/db.php");
	$query="select skill_id,skill_name from skill";
	$result=$conn->query($query);
	$skill_no=0;
	while($row=$result->fetch_assoc())
	{
		$skill_no++;
	?>

	
  <div class="checkbox">
      <label ><input name="skill[]" type="checkbox"
     <?php 
    $skill= $row['skill_id'];
      require_once($path ."/common/db.php");
	$query_selected="select student_skill_mpg_id from student_skill_mapping 
		where student_id=$student_id and skill_id=$skill";
	
	$result_skill=$conn->query($query_selected);
	if ($result_skill->num_rows > 0) {
	
	?>
       checked
       <?php }?>
        value="<?php echo $row['skill_id'] ?>"><?php echo $row['skill_name'] ?></label>
    </div>

  <?php }?>
    </div>
      <div class="form-group ">
 
  <button type="submit" class="btn btn-primary" name="submitSkils">Submit</button>
  
  </div>
</form>
</div>
<script type="text/javascript">

$(function(){
	  $("#success-alert-skill").fadeTo(2000, 500).slideUp(500, function(){
	        $("#success-alert-skill").alert('close');
	    });
})
  </script>
</body>
<footer>
<?php require  $home_path . "/common/footer.php";?>
</footer>
</html>
