<html>
<head>
<?php session_start();?>
<?php $home_path = $_SERVER['DOCUMENT_ROOT'];?>
<script>
function search()
{
	document.getElementById('searchForm').submit();
}
function clearForm()
{
	document.getElementById('name').value="";
	document.getElementById('type').value="";
	document.getElementById('searchForm').submit();	
}
function submitIntern(formId)
{
	document.getElementById(formId).submit();
	
}
</script>

</head>
<body>
<header>
<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
//For header
require  $path . "/common/header.php";
//Header end
require_once  $path . "/common/db.php";

$name="";
if( isset($_POST['name']) )
{
	$name = $_POST["name"];
}
$type = "";
if( isset($_POST['type']) )
{
	$type = $_POST["type"];
}

$sql = "select internship_id,internship_name,weekly_hours,internship_type,supervisor_contact,supervisor_fname,supervisor_mname,supervisor_lname,pay,job_description,no_of_positions from internship_oppurtunities";
$sql.=" where status='open'";
if($name!='')
	$sql.="and lower(internship_name) like lower('" . $name . "%') ";	
if($type!='')
	$sql.="and lower(internship_type) like lower('" . $type . "') ";
$result = mysqli_query($conn, $sql);
?>
</header>
<div class="container-full">
<!-- Page Heading -->
	<div class="row">
			<div class="col-md-12">
				<h1 class="page-header text-center">
					Internships
				</h1>
			</div>
		</div>

<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10 text-center">
	 <form class="form-inline" role="form" id="searchForm" method="post" action="<?php $home_path ?>/student/internshiplist/viewintern.php">
  <div class="form-group">
    <label for="name">Internship Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
  </div>
  <div class="form-group">
    <label for="type">Internship Type </label>
    <select class="form-control" id="type" name="type">
    <option value="">All</option>
    <option value="paid">Paid</option>
    <option value="unpaid">Unpaid</option>
  </select>
  </div>
  <input type="button" class="btn btn-primary" onclick="search();" value="Search">
   <input type="button" class="btn btn-defualt" onclick="clearForm();" value="Reset">
</form>
</div>
<div class="col-md-1"></div>
</div>			
		
<div class="row">
			<div class="col-md-12 text-center">
			<div class="holder text-center" id="holder">
			</div>
			</div>
		</div>

<br>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-10">
<ul id="page">
<?php 
if (mysqli_num_rows($result) > 0) {
	// output data of each row as Internships Exist
	
	?>
	<li>
	<table class="table table-hover table-bordered  ">
    <thead>
      <tr class="text-center">
        <th class="text-center">Sr. No.</th>
        <th class="text-center">Internship Name</th>
        <th class="text-center ">Type</th>
        <th class="text-center hidden-xs">Supervisor Contact</th>
        
        <th class="text-center hidden-xs">Weekly Hours </th>
        <th class="text-center">More</th>
      </tr>
    </thead>
    <tbody>
	<?php 
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
		
		if($i%5==0 && $i!=0){
			
			?>
			</tbody>
			</table>
			</li>
			<li>
			<table class="table table-hover table-bordered ">
			<thead>
			<tr class="text-center">
			<th class="text-center">Sr. No.</th>
			<th class="text-center">Internship Name</th>
			<th class="text-center">Type</th>
			<th class="text-center hidden-xs">Supervisor Contact</th>
			<th class="text-center hidden-xs">Weekly Hours </th>
			<th class="text-center">More</th>
			</tr>
			</thead>
			<tbody>
		<?php 	
		}
		echo "<tr>";
		echo "<td class='text-center'>" .  ($i+1) ."</td><td> " . $row["internship_name"]."</td>";
		echo "<td class='text-center'>" . $row["internship_type"] . "</td>";
		echo "<td class='text-center hidden-xs'>" . $row["supervisor_contact"] . "</td>";
		
		echo "<td class='text-center hidden-xs'>" . $row["weekly_hours"] . "</td>";
		echo "<td class='text-center'>";
		echo "<a href='#' class='btn btn-primary'	data-toggle='modal' data-target='#basicModal";
		echo $i;
		echo "' >View</a>";
		?>
		<div class="modal fade" id="basicModal<?php echo $i; ?>" tabindex="-1" role="dialog"	aria-labelledby="basicModal<?php echo $i ?>" aria-hidden="true">
			<div class="modal-dialog" >
				<div class="modal-content">
				<form id="ApplyIntern<?php echo $i; ?>" method="post" action="<?php echo $row["internship_id"];?>"><?php // add action for intergration here?>
			<input	type="hidden" name="internshipId" id="intershipId" value="" />
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">X</button>
						<h4 class="modal-title" id="myModalLabel"><?php echo $row["internship_name"];?></h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="email">Job Description :</label> 
							 <textarea class="form-control" rows="5" 	id="jobdesc" name="jobdesc" disabled="disabled"><?php echo trim($row["job_description"]);?></textarea>
						</div>
						<div class="form-group">
							<label for="email">Supervisor Name:</label> 
							 <input type="text" class="form-control" rows="1" 	id="sname" name="jobdesc" disabled="disabled"
							 value="<?php echo $row["supervisor_fname"] ." ". $row["supervisor_mname"] ." " . $row["supervisor_lname"];?>"?>
						</div>
						
						<div class="form-group">
							<label for="email">Pay:</label> 
							 <input type="text" class="form-control" rows="1" 	id="pay" name="pay" disabled="disabled" value="<?php echo $row["pay"];?>">
						</div>
						<div class="form-group">
							<label for="email">No of Positions:</label> 
							 <input type="text" class="form-control" rows="1" 	id="nop" name="nop" disabled="disabled" value="<?php echo $row["no_of_positions"];?>">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary" onclick="submitIntern('ApplyIntern<?php //echo $i; ?>');">Apply</button> -->
					</div>
					
					</form>
				</div>
			</div>
		</div>
		
	
		<?php 
		echo "</td>";
	?>
	
	<?php 
	$i = $i +1;
	}
} else {
	echo "<div class='row'><div class='col-md-12 text-center'><h4>No Internships Found</h4></div></div>";
}
mysqli_close($conn);
?>

 </tbody>
    </table>
    </li>
    </ul>
    
</div>
<div class="col-md-1"></div>
</div>


</div>
</body>
<footer>
<?php require  $path . "/common/footer.php";?>
</footer>
<script>
var jq = $.noConflict();
jq(function(){
	jq("#holder").jPages({
		    containerID : "page",
		    perPage : 1,
		    previous    : false,
		      next        : false
		  });
	

		});
document.getElementById('type').value="<?php echo $type;?>";
</script>
<style>
table{
  border-collapse: collapse !important;
  border-spacing: 0px;
  border: 1px solid #DDD;
}
table tr{
  border-bottom: 1px solid #DDD !important;
}
</style>
</html>