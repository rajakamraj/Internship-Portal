<?php

session_start();

$path = $_SERVER['DOCUMENT_ROOT'];
	require_once($path ."/common/db.php");
$query="select * from internship_oppurtunities";
$result=$conn->query($query);
if(isset($_GET['result_msg']))
{
	$result_msg=$_GET['result_msg'];
}
else {
	$result_msg=null;
}

?>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
  <!-- Latest compiled and minified CSS -->


  
</head>
<body>
<?php 
//For header
require  $path ."/common/header.php"; ?>
<div class="container">
<div class="row">
			<div class="col-md-12">
				<h1 class="page-header text-center">
					Update/Delete Internships
				</h1>
			</div>
		</div>
<?php 
if($result_msg=='success')
{
?>
<div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Internship has been successfully deleted! </strong>   
</div>
<?php 
$result_msg=null;
}
else if($result_msg=='fail')
{
?>
<div class="alert alert-warning"" id="fail-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>There has been a problem with internship deletion.  Please try again!!! </strong>   
</div>
<?php 
$result_msg=null;
}
?>
  <table id="intern" class="table table-striped table-bordered">
    <thead>
      <tr><th width="34%">Internship Name</th>
      <th width="20%">Company Name</th>
      <th width="10%">Start Date</th>
      <th width="10%">End Date</th>
      <th width="10%">Status</th>
      <th width="8%">Edit</th>
      <th width="8%">Delete</th>
      </tr>
      
    </thead>
    <tbody>
    <?php 
    if($result->num_rows==0)
{
	?><tr><td><?php echo 'No Internships created!!!';?>
	</td></tr>
	<?php 
}
else {
	$sn=0;
			while($row=$result->fetch_assoc())
			{
			$sn++;
			require_once($path ."/common/db.php");
			$business_id=$row['business_id'];
			$business_name=null;
			$buiness_query="select business_name from business where approved='Y' and business_id=$business_id limit 1";
			$business_result=$conn->query($buiness_query);
			while($business_row=$business_result->fetch_assoc())
			{
				$business_name=$business_row['business_name'];
			}
			?>
      <tr><td><?php echo $row['internship_name'];?></td>
      <td><?php echo $business_name;?></td>
      <td><?php echo $row['start_date'];?></td>
      <td><?php echo $row['end_date'];?></td>
  <td><?php echo $row['status'];?></td>
      <td id="edit" ><a data-id="<?php echo $row['internship_id'];?>" data-name="<?php echo $row['internship_name'];?>"
									href="/admin/internship/add_internship.php?view=edit&internship_id=<?php echo $row['internship_id']; ?>" class="glyphicon glyphicon-edit"
									></a></td>
      <td id="remove" ><a data-id="<?php echo $row['internship_id'];?>" data-name="<?php echo $row['internship_name'];?>"
									href="#" class="open-AddBookDialog glyphicon glyphicon-remove"
									data-toggle="modal" data-target="#deleteModal"></a></td>
      </tr>
      <?php }}?>
      
    </tbody>
  </table>
  </div>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
  <script type="text/javascript">
  $(function(){
    $("#intern").dataTable();
    $("#check").click(function(e) {

       
    });

    $(document).on("click", ".open-AddBookDialog", function () {
        var internshipName = $(this).data('name');
        var internshipId= $(this).data('id');
        $(".modal-body #nameInternship").text( internshipName );
        $(".modal-body #internshipID").val(internshipId);
   });

    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").alert('close');
    });

    $("#fail-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#fail-alert").alert('close');
    });
    

//     $(document).on("hide.bs.modal", "#deleteModal", function () {
//     	alert("cme");
//    });

//     $("#deleteModal").on('hide.bs.collapse', function () {
//         alert("cme");
//         window.location.reload();
//     });

    
//     $('#deleteForm').submit(function(e){
//     	location.reload();
//     });
    
//     $('#deleteModal').on('hidden', function (e) {
//     	  e.preventDefault();
// alert("close");
//         location.reload();
// });
//     $("#remove").click(function(e) {
//         alert("Are you sure you want to remove this internship?");
        
//     });
  })
  </script>
  <?php 
  if(isset($_POST['deleteInternship']))
  {
  	extract($_POST);
	require_once($path ."/common/db.php");
  	$internship_id=(int)$_POST['internshipID'];
  	$query = "delete from internship_oppurtunities where internship_id=$internship_id";
  	
  	$result = $conn->query($query);
  	if($result){
  		//header("Refresh:0");
  		//header("location: update_or_delete_internship.php");
  		$result_msg='success';		
  	}
  	else
  	{
  		 //die('Could not delete data: ' . mysql_error());
  		 $result_msg='fail';
  		
  	}
  	?>
  	  		
  	  		 <script type="text/javascript">
  	
  	  	  	window.top.location.href="/admin/internship/update_or_delete_internship.php?result_msg=<?php echo $result_msg; ?>";
  	  		 </script>
  	  		<?php 
  }
  
  ?>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
			aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog" style="width:25%">
				<div class="modal-content">
				
				<form id="deleteForm" action = "#" method="post">
			<input type="hidden" name="actionName" id="actionName2" value="" />
			<input	type="hidden" name="classId" id="classId2" value="" />
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">X</button>
						<h4 class="modal-title" id="myModalLabel">Confirm Delete?</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
						
			<input	type="hidden" name="internshipID" id="internshipID" value="" />
							<label for="confirm">Are you sure that you want to delete </label>
							<label for="nameInternship" id="nameInternship" ></label> <label> internship?</label> 
							       
                                                </div>
						

						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
						<!-- <button type="button" class="btn btn-primary" onclick="signUpFunc();">Signup</button> -->
						<input type="submit" name="deleteInternship" id="deleteInternship" class="btn  btn-danger" value="Yes">


					</div>
					</form>
				</div>
			</div>
		</div>
  <br>
</body><?php 
require  $path ."/common/footer.php";
?>
</html>