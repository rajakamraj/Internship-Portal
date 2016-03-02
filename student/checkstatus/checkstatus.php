<?php

session_start();
?>

<html>
<head>

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
require  $path ."/common/header.php";
//Header end

	require_once($path ."/common/db.php");

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

$personId = $_SESSION['person_id'];

$sql = "
		SELECT
intern.internship_id,
intern.internship_name,
intern.internship_type,
intern.supervisor_contact,
intern.weekly_hours,
b.business_name,
app.app_status
FROM internship_oppurtunities intern,application app,
student stu,person per,business b
where intern.internship_id = app.internship_id
and app.student_id = stu.student_id
and per.person_id = stu.person_id
and b.business_id=intern.business_id	
";
$sql .= " and per.person_id = " . $personId;

if($name!='')
	$sql.=" and lower(intern.internship_name) like lower('" . $name . "%') ";	
if($type!='')
	$sql.=" and lower(intern.internship_type) like lower('" . $type . "') ";
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
	 <form class="form-inline" role="form" id="searchForm" method="post" action="<?php $home_path ?>/student/checkstatus/checkstatus.php">
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
          <th class="text-center">Business Name</th>
        <th class="text-center">Internship Name</th>
        <th class="text-center ">Type</th>
        <th class="text-center hidden-xs">Supervisor Contact</th>
        
        <th class="text-center hidden-xs">Weekly Hours </th>
        <th class="text-center">Status</th>
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
          <th class="text-center">Business Name</th>
			<th class="text-center">Internship Name</th>
			<th class="text-center">Type</th>
			<th class="text-center hidden-xs">Supervisor Contact</th>
			<th class="text-center hidden-xs">Weekly Hours </th>
			<th class="text-center">Status</th>
			</tr>
			</thead>
			<tbody>
		<?php 	
		}
		echo "<tr>";
		echo "<td class='text-center'>" .  ($i+1) ."</td><td> " . $row["business_name"]."</td><td> " . $row["internship_name"]."</td>";
		echo "<td class='text-center'>" . $row["internship_type"] . "</td>";
		echo "<td class='text-center hidden-xs'>" . $row["supervisor_contact"] . "</td>";
		
		echo "<td class='text-center hidden-xs'>" . $row["weekly_hours"] . "</td>";
		$tempstat = $row["app_status"];
		if($tempstat=='')
			$tempstat='Under Review';
		if($tempstat=='Y' || $tempstat=='y')
			$tempstat='Accepted';
		if($tempstat=='N'|| $tempstat=='n')
			$tempstat='Rejected'; 
		echo "<td class='text-center'>". $tempstat;
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