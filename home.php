
<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">


<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



</head>

<body >
 <?php include("common/header.php");

 $check=$_SESSION['first_name'];
 ?>
 <br /><br />
 
<div class="container">

 <div class="form-group">
 <label for="name">Welcome <?php  echo $check?></label>
 </div>
 <div class="form-group">
 <label for="name">Role: <?php 

 if($_SESSION['type']=="A")
 {
 	?>
 				   Admin 
 				  <?php }?>
 				    <?php if($_SESSION['type']=="S")
 				  {
 				  ?>
 				   Student
 				  <?php }
 ?></label>
 </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer>
<?php require  $home_path . "/common/footer.php";?>
</footer>

</body>
</html>