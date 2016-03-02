<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<head>
  <title>New Business Added Succesfully</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="bootstrap/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="ui/jquery-ui.min.js"></script>
<script src="js/md5.js"></script>
<link rel="stylesheet" type="text/css"
	href="bootstrap/css/bootstrap.min.css">
<Style>
#errormsg
{
text-align:center;
font-size: 30px; 
font-weight: bold;
padding-top:375px;
} 
.footer {
  position: relative;
  margin-top: 0px; /* negative value of footer height */
  height: 30px;
  clear:both;
  padding-top:0px;
} 
html, body {
  height: 34%;
}

#wrap {
  min-height: 100%;
}

#main {
  overflow:auto;
  padding-bottom:100px; /* this needs to be bigger than footer height*/
}
</Style>	
</head>
 <body>
<header>
<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
//For header
require  $path . "/common/header.php";
//Header end
?>
</header>
   <?php require_once('../../common/db.php');
   $id=mysqli_query($conn,"select max(address_id) from address");
   $row = mysqli_fetch_row($id);
   $aid=$row[0];
   $aid=$aid+1;
   $sql="INSERT INTO address(address_id,line1,line2,city,zip,state)
    VALUES
    ($aid,'$_POST[add1]','$_POST[add2]','$_POST[city]','$_POST[zip]','$_POST[region]')";
   
     if (mysqli_query($conn, $sql)) {
     	echo "";
     }
     else {
     	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
     ?>
     <?php require_once('../../common/db.php');
     $id=mysqli_query($conn,"select max(person_id) from person");
     $row = mysqli_fetch_row($id);
     $pid=$row[0];
     $pid=$pid+1;
     $addid=mysqli_query($conn,"select max(address_id) from address");
     $row = mysqli_fetch_row($addid);
     $addressid=$row[0];
     $sql="INSERT INTO person(person_id,address_id,first_name,middle_name,last_name,phone,type,email)
     VALUES
     ($pid,$addressid,'$_POST[BSFName]','$_POST[BSMName]','$_POST[BSLName]','$_POST[BContact]','B','$_POST[BEmail]')";
     if (mysqli_query($conn, $sql)) {
     	echo "";
     }
     else {
     	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
       ?>
     <?php require_once('../../common/db.php');
     $id=mysqli_query($conn,"select max(business_id) from business");
     $row = mysqli_fetch_row($id);
     $bid=$row[0];
     $bid=$bid+1;
     $perid=mysqli_query($conn,"select max(person_id) from person");
     $row = mysqli_fetch_row($perid);
     $personid=$row[0];
     $sql="INSERT INTO business(business_id,person_id,approved,business_name)
     VALUES
     ($bid,$personid,'$_POST[status]','$_POST[BName]')";
     if (mysqli_query($conn, $sql)) {
     	echo "<div id=\"errormsg\">New Business Data added succesfully </div>";
     }
     else {
     	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }  
    ?>
  </body>
<div id="wrap">
  <div id="main" class="container clear-top">
      </div>
</div>  
<footer>
<?php require  $path . "/common/footer.php";?>
</footer>
</html>