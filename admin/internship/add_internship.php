<?php session_start();?>

<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
//For header
require  $path ."/common/header.php"; ?>
<?php 
if(isset($_GET['view']))
{
	$view=$_GET['view'];
	$retrieve_internship_id=$_GET['internship_id'];
}
else {
	$view=null;
	$retrieve_internship_id=null;
}
if(isset($_GET['result_insert_msg']))
{
	$result_insert_msg=$_GET['result_insert_msg'];
}
else {
	$result_insert_msg=null;
}

if(isset($_GET['result_save_msg']))
{
	$result_save_msg=$_GET['result_save_msg'];
}
else {
	$result_save_msg=null;
}


if(isset($_POST['submitInternship']))
{
	
	extract($_POST);
	require_once($path ."/common/db.php");
	$business_id=$_POST['internship_business_name'];
	$supervisor_first_name=$_POST['supervisor_first_name'];
	$supervisor_middle_name=$_POST['supervisor_middle_name'];
	$supervisor_last_name=$_POST['supervisor_last_name'];
	$supervisor_contact_no=$_POST['supervisor_contact_no'];
	
	$start_date=$_POST['internship_start_date'];
	$startDtArr = explode("/", $start_date);
	$start_date = $startDtArr[2] . '-' . $startDtArr[0].'-' .$startDtArr[1];
	
	$end_date=$_POST['internship_end_date'];
	$endDtArr = explode("/", $end_date);
	$end_date = $endDtArr[2] . '-' . $endDtArr[0].'-' .$endDtArr[1];

	$pay=$_POST['internship_pay'];
	$weekly_hours=$_POST['internship_weekly_hours'];
	$job_description=$_POST['internship_des'];
	$internship_type=$_POST['internship_type'];
	$status="open";
	$no_of_positions=$_POST['internship_no_of_positions'];
	$internship_name=$_POST['internship_name'];
	$seq_query="select max(internship_id) as seq_internship_id from internship_oppurtunities";
	$seq_result = $conn->query($seq_query);
	if($seq_row=$seq_result->fetch_assoc())
	{
		$seq_id=$seq_row['seq_internship_id'] + 1;
	}
	
	$query="INSERT INTO internship_oppurtunities (internship_id,business_id,supervisor_fname,supervisor_mname,supervisor_lname,supervisor_contact,pay,start_date,end_date,weekly_hours,job_description,internship_type,status,no_of_positions,internship_name) VALUES (
	$seq_id,$business_id,'$supervisor_first_name','$supervisor_middle_name','$supervisor_last_name','$supervisor_contact_no',$pay,'$start_date','$end_date',$weekly_hours,'$job_description','$internship_type','$status',$no_of_positions,'$internship_name')";
	
	$result = $conn->query($query);
		if($result){
  		//header("Refresh:0");
  		//header("location: update_or_delete_internship.php");
		


			/*
			 $s=mysql_connect("localhost","root","");
			 $ss=mysql_select_db('anurag',$s);
			 $sql="SELECT * FROM result where length(email) > 5";
			 $query = mysql_query($sql);
			 while($row = mysql_fetch_array($query))
			 {
			 $sub1=$row['id1'];
			 $sub2=$row['id2'];
			 $sub3=$row['id3'];
			 $sub4=$row['id4'];
			 $sub5=$row['id5'];
			 $sub6=$row['id6'];
			 $g1=$row['grade1'];
			 $g2=$row['grade2'];
			 $g3=$row['grade3'];
			 $g4=$row['grade4'];
			 $g5=$row['grade5'];
			 $g6=$row['grade6'];
			 $message=$sub1.$g1.'\n'.$sub1.$g1.'\n'.$sub2.$g2.'\n'.$sub3.$g3.'\n'.$sub4.$g4.'\n'.$sub5.$g5.'\n'.$sub6.$g6;*/
			 
			//$message="The ".$_SESSION['h_name']." on ".$_SESSION['date']." is successfully booked";
			//$message=$message.$_SESSION['h_name'];
			 
			 
			require_once($path ."/admin/internship/class.phpmailer.php");
			 
			//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
			 
			$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
			 
			$mail->IsSMTP(); // telling the class to use SMTP
			//$mailto="gopal.adhith@gmail.com";//$_SESSION['mail1'];
			$mailto="rajakamraj@gmail.com";
			try {
				//$mail->Host       = "mail.yourdomain.com"; // SMTP server
				$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "dbtektons";  // GMAIL username
				$mail->Password   = "dbtektons@25";            // GMAIL password
				 
				 
				$mail->AddAddress($mailto, '');
				$mail->SetFrom('dbtektons@gmail.com', 'DB Tektons');
				//$mail->AddReplyTo('name@yourdomain.com', 'First Last');
				$mail->Subject = 'Internship Alert - DB Tektons';
				$mail->AltBody = 'Internship Alert - DB Tektons'; // optional - MsgHTML will create an alternate automatically
				 
				$a=$internship_name;
				//      $mail->MsgHTML("<h1><span style='color:red'>THE ".$a." ON ".$b." IS SUCCESSFULLY BOOKED!!!</span></h1>");
				$mail->MsgHTML("<table border='2px solid black' style='text-align:center;background-color:#AADD33;'> <tr><td><img src='/DB/InternshipProject/images/uncc_logo.jpg'></td><td><h1>Internship Tracking System - DB Tektons</h1></td></tr><tr><td colspan='2'><h2>A new Intership for the position  <span style='text-decoration:underline'>".$a."</span>  has been posted. Login to find more details!!!</h2></td></tr>");
				$mail->Send();
				 
				//mail loop
				/*$con=mysql_connect("localhost","root","");
				 mysql_select_db("test1",$con);
				 $res=mysql_query("select mailid from tech_detail");
				 while($m=mysql_fetch_array($res)){
				 $mail->AddAddress($m['mailid'], '');
				 $mail->SetFrom('hallbooking.skcet@gmail.com', 'SKCET HALL BOOKING');
				 //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
				 $mail->Subject = 'HALL BOOKING for';
				 $mail->AltBody = 'HALL BOOKING'; // optional - MsgHTML will create an alternate automatically
			
				 $a=$_SESSION['h_name'];
				 $b=$_SESSION['date'];
				 $mail->MsgHTML("THE ".$a." ON ".$b." IS SUCCESSFULLY BOOKED!!!");
				 $mail->Send();
				}*/
				//  echo "Message Sent OK</p>\n";
			} catch (phpmailerException $e) {
				// echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
				// echo $e->getMessage(); //Boring error messages from anything else!
			}
			 
			
  		$result_insert_msg='success';	
		$_SESSION['displayInsertMsg']="yes";	
  	}
  	else
  	{
  		 //die('Could not delete data: ' . mysql_error());
  		 $result_insert_msg='fail';
		$_SESSION['displayInsertMsg']="yes";	
  		
  	}
  	?>
  	  		
  	  		 <script type="text/javascript">
  	
  	  	  	//window.top.location.href="add_internship.php?result_insert_msg=<?php echo $result_insert_msg; ?>";
  	  		 </script>
  	  		<?php 
  	  		
  	  	
  	  		
  	  		
  	  		
  }
  
  

if(isset($_POST['saveInternship']))
{
	extract($_POST);
	require_once($path ."/common/db.php");
	$business_id=$_POST['internship_business_name'];
	$supervisor_first_name=$_POST['supervisor_first_name'];
	$supervisor_middle_name=$_POST['supervisor_middle_name'];
	$supervisor_last_name=$_POST['supervisor_last_name'];
	$supervisor_contact_no=$_POST['supervisor_contact_no'];
	$start_date=$_POST['internship_start_date'];
	$end_date=$_POST['internship_end_date'];
	$pay=$_POST['internship_pay'];
	$weekly_hours=$_POST['internship_weekly_hours'];
	$job_description=$_POST['internship_des'];
	$internship_type=$_POST['internship_type'];
	$status=$_POST['internship_status'];
	$no_of_positions=$_POST['internship_no_of_positions'];
	$internship_name=$_POST['internship_name'];
	$query="update internship_oppurtunities set 
			business_id=$business_id,supervisor_fname='$supervisor_first_name',
			supervisor_mname='$supervisor_middle_name',supervisor_lname='$supervisor_last_name',
			supervisor_contact='$supervisor_contact_no',pay=$pay,start_date='$start_date',end_date='$end_date',
			weekly_hours=$weekly_hours,job_description='$job_description',internship_type='$internship_type',status='$status',
			no_of_positions=$no_of_positions,internship_name='$internship_name' 
			where internship_id=$retrieve_internship_id";
	$result = $conn->query($query);
	if($result){
		//header("Refresh:0");
		//header("location: update_or_delete_internship.php");
		$result_save_msg='success';
		$_SESSION['displaySaveMsg']="yes";
	}
	else
	{
		//die('Could not delete data: ' . mysql_error());
		//echo $query;
		$result_save_msg='fail';
		$_SESSION['displaySaveMsg']="yes";
	
	}
	?>
	  	  		
	  	  		 <script type="text/javascript">
	  	
	  	  	  //	window.top.location.href="add_internship.php?view=edit&internship_id=<?php echo $retrieve_internship_id; ?>&result_save_msg=<?php echo $result_save_msg; ?>";
	  	  		 </script>
	  	  		<?php 
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Internship Project</title>
<!-- Latest compiled and minified CSS -->


</head>

<body >

<div class="container">
<?php 
if($view=='edit')
{

	require_once($path ."/common/db.php");
	$retrieve_query="select * from internship_oppurtunities where internship_id=$retrieve_internship_id";

	$retrieve_result = $conn->query($retrieve_query);
	$retrieve_row=$retrieve_result->fetch_assoc();
}

?>
<?php 
if($result_insert_msg=='success' && $_SESSION['displayInsertMsg']=='yes')
{
?>
<div class="alert alert-success" id="success-alert-insert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Internship has been successfully Added! </strong>   
</div>
<?php 
$result_insert_msg=null;
$_SESSION['displayInsertMsg']="no";
}
else if($result_insert_msg=='fail' && $_SESSION['displayInsertMsg']=='yes')
{
?>
<div class="alert alert-warning" id="fail-alert-insert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>There has been a problem with internship insertion.  Please try again!!! </strong>   
</div>
<?php 
$result_insert_msg=null;
$_SESSION['displayInsertMsg']="no";
}
?>
<?php 
if($result_save_msg=='success' && $_SESSION['displaySaveMsg']=='yes')
{
?>
<div class="alert alert-success" id="success-alert-save">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Internship has been Saved successfully! </strong>   
</div>
<?php 
$result_save_msg=null;
$_SESSION['displaySaveMsg']="no";
}
else if($result_save_msg=='fail'  && $_SESSION['displaySaveMsg']=='yes')
{
?>
<div class="alert alert-warning" id="fail-alert-save">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>There has been a problem with internship updation.  Please try again!!! </strong>   
</div>
<?php 
$result_save_msg=null;
$_SESSION['displaySaveMsg']="no";
}
?>
<form id="addIntern" action="#" method="post">
<div class="form-group">
<h2><center>
<?php if($view=='edit')
{
	?>
	View/Update 
	<?php 
}else {
	?>
	Create 
	<?php }
	?>
Internship
</center></h2>
</div>
  <div class="form-group">
    <label for="internship_name_label">Internship Name:</label>
   <input type="text" class="form-control" required name="internship_name" 
   <?php if($view=='edit')
{
	?>value="<?php echo $retrieve_row['internship_name'];?>"
	<?php 
}
	else
	{
?>
   placeholder="Internship name"
   <?php  }?>>
  </div>
  <div class="form-group">
    <label for="internship_desc_label">Internship Description:</label>
 <textarea name="internship_des" required class="form-control" rows="3">
 <?php 
 if($view=='edit')
 {
 	 echo $retrieve_row['job_description'];
 }
 
 ?>
 </textarea> </div>
  
  <?php if($view=='edit')
{
	?>
	 <div class="form-group">
	 
    <label for="internship_status_label">Internship Status:</label>
   <select name="internship_status"   class="form-control">
  <option value="open"
   <?php  
  if($view=='edit')
  {
  	if("open"==$retrieve_row['status'])
  	{
		
  		?>selected<?php 
  	}
}
  ?>>open</option>
  <option value="closed" <?php  
  if($view=='edit')
  {
  	if("closed"==$retrieve_row['status'])
  	{
		
  		?>selected<?php 
  	}
}
  ?>>closed</option>

</select>

</div>
<?php }?>
 <div class="form-group">
    <label for="internship_business_name_label">Business Name:</label>
    <select name="internship_business_name"  class="form-control">
    <?php
	require_once($path ."/common/db.php");
$query="select business_id,business_name from business where approved='Y'";
$result=$conn->query($query);
while($row=$result->fetch_assoc())
{
?>
  <option value=<?php  echo $row['business_id'];?>
  <?php  
  if($view=='edit')
  {
  	if($row['business_id']==$retrieve_row['business_id'])
  	{
		
  		?>selected<?php 
  	}
}
  ?>
  ><?php echo $row['business_name'];?></option>
  <?php }?>
  
</select>
</div>
  <div class="form-group">
    <label for="internship_type_label">Internship Type:</label>
    <select name="internship_type"  class="form-control">
  <option value="paid"
   <?php  
  if($view=='edit')
  {
  	if("paid"==$retrieve_row['internship_type'])
  	{
		
  		?>selected<?php 
  	}
}
  ?>>paid</option>
  <option value="unpaid" <?php  
  if($view=='edit')
  {
  	if("unpaid"==$retrieve_row['internship_type'])
  	{
		
  		?>selected<?php 
  	}
}
  ?>>unpaid</option>

</select>
</div>
 
  <div class="form-group">
    <label for="internship_start_date_label">Start Date:</label>
    <input type="text" class="form-control" required name="internship_start_date" id="internship_start_date"
     <?php  
  if($view=='edit')
  {
  	if($retrieve_row['start_date']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['start_date'];?>"
  		<?php 
  	}
}
  ?>
     >
  </div>
  <div class="form-group">
    <label for="internship_end_date_label">End Date:</label>
    <input type="text" class="form-control" name="internship_end_date" id="internship_end_date"
     <?php  
  if($view=='edit')
  {
  	if($retrieve_row['end_date']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['end_date'];?>"
  		<?php 
  	}
}
  ?>
     >
  
  </div>
   <div class="form-group">
    <label for="internship_no_of_positions_label">No of positions:</label>
    <input type="number" class="form-control" required name="internship_no_of_positions"
     <?php  
  if($view=='edit')
  {
  	if($retrieve_row['no_of_positions']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['no_of_positions'];?>"
  		<?php 
  	}
}
  ?>
     >
  
  </div>
   <div class="form-group">
    <label for="internship_weekly_hours_label">Weekly hours:</label>
    <input type="number" class="form-control" required name="internship_weekly_hours" 
    <?php  
  if($view=='edit')
  {
  	if($retrieve_row['weekly_hours']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['weekly_hours'];?>"
  		<?php 
  	}
}
  ?>
    >
  
  </div>
  <div class="form-group">
    <label for="internship_pay_label">Pay:</label>
   $ <input type="number" class="form-control" required name="internship_pay"
   
     <?php  
  if($view=='edit')
  {
  	if($retrieve_row['pay']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['pay'];?>"
  		<?php 
  	}
}
  ?> >
  
  </div>
 <div class="form-group">
    <label for="supervisor_first_name_label">Supervisor First Name:</label>
   <input type="text" class="form-control" required name="supervisor_first_name" 
    <?php  
  if($view=='edit')
  {
  	if($retrieve_row['supervisor_fname']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['supervisor_fname'];?>"
  		<?php 
  	}
}
  ?>
    >
  </div>
  <div class="form-group">
    <label for="supervisor_middle_name_label">Supervisor Middle Name:</label>
   <input type="text" class="form-control" name="supervisor_middle_name" 
    <?php  
  if($view=='edit')
  {
  	if($retrieve_row['supervisor_mname']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['supervisor_mname'];?>"
  		<?php 
  	}
}
  ?>
   >
  </div>
  <div class="form-group">
    <label for="supervisor_last_name_label">Supervisor Last Name:</label>
   <input type="text" class="form-control"  required name="supervisor_last_name" 
   <?php  
  if($view=='edit')
  {
  	if($retrieve_row['supervisor_lname']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['supervisor_lname'];?>"
  		<?php 
  	}
}
  ?>
   >
  </div>
  <div class="form-group">
    <label for="supervisor_contact_no_label">Supervisor Contact Number:</label>
   <input type="text" class="form-control" required name="supervisor_contact_no"
    <?php  
  if($view=='edit')
  {
  	if($retrieve_row['supervisor_contact']!=null)
  	{
		
  		?>value="<?php echo $retrieve_row['supervisor_contact'];?>"
  		<?php 
  	}
}
  ?>
   >
  </div>
    <div class="form-group text-center">
  <?php  
  if($view!='edit')
  {
  	?>
  <button type="submit" class="btn btn-primary" name="submitInternship">Submit</button>
  <button type="reset" class="btn btn-default" name="resetInternship">Reset</button>
  <?php }
  else{
  	?>
  <button type="submit" class="btn btn-primary" name="saveInternship">Save Changes</button>
  <button type="button" class="btn btn-default" id="cancelInternship" name="cancelInternship">Cancel</button>
  	<?php 
  }
  ?>
  </div>
  
</form>
</div>
<script type="text/javascript">

$(function(){
    $("#success-alert-insert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert-insert").alert('close');
    });

    $("#fail-alert-insert").fadeTo(2000, 500).slideUp(500, function(){
        $("#fail-alert-insert").alert('close');
    });
    $("#success-alert-save").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert-save").alert('close');
    });

    $("#fail-alert-save").fadeTo(2000, 500).slideUp(500, function(){
        $("#fail-alert-save").alert('close');
    });
    $( "#cancelInternship" ).click(function() {
        	window.top.location.href="/admin/internship/update_or_delete_internship.php";
    	});
})
 $('#internship_end_date').datepicker();
$('#internship_start_date').datepicker();
  </script>
</body>
<style>
  .ui-icon-circle-triangle-e
  {
  color:white;
  }
</style>
<footer>
<?php require  $home_path . "/common/footer.php";?>
</footer>
</html>
