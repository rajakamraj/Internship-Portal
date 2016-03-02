<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
<head>
  <title>Add New Business</title>
  <meta charset="utf-8">
<style>
.well {
-webkit-box-shadow: none !important;
-moz-box-shadow: none !important;
border-color: blue !important;
background: #E6EBFA !important; 
}
p {
    font-size: 20px;
}
</style>
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
<Form Name ="form1" Method ="POST" ACTION = "InsertAddBusiness.php">
<div class="heading" style="text-align: center">
<h2>Enter new business details here!!</h2>
<p align:center> <span>
 <p style="color:red"><b>*Required Fields</b></p>
</span><p> 
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3"><div class="well">
        <div class="BName"><label class="star"> * </label><strong>Business Name</strong><br><input name="BName" type="text" style="width: 230px" required title="This is a Mandatory field"></div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3"><div class="well">
          <label class="star"> * </label><strong>Supervisor First Name</strong><br>
  <input name="BSFName" type="text" style="width: 230px" required title="This is a Mandatory field">
        </div></div>
        <div class="col-md-3"><div class="well">
        <strong>Supervisor Middle Name</strong><br>
  <input name="BSMName" type="text" style="width: 230px"></div></div>
        <div class="col-md-3"><div class="well">
        <label class="star"> * </label><strong>Supervisor Last Name</strong><br>
  <input name="BSLName" type="text" style="width: 230px" required title="This is a Mandatory field"></div></div>
    </div>
    <div class="row">
        <div class="col-lg-3"><div class="well"><label class="star"> * </label><strong>Contact details</strong><br><input
 name="BContact" type="text" style="width: 230px" maxlength="10" pattern="[0-9]{10}" required title="This is a Mandatory field and should only contain Numerics">
        </div></div>
    </div>
    <div class="row">
        <div class="col-lg-3"><div class="well"><label class="star"> * </label><strong>E-mail ID</strong><br><input name="BEmail"
 type="email" style="width: 230px" placeholder="sample@domain.com" required title="This is a Mandatory field and shoud be in this format:sample@domain.com">
        </div></div>
    </div>
  	<div class="row">
        <div class="col-md-3"><div class="well"><label class="star"> * </label><strong>Address Line1</strong><br><input name="add1"
 type="text" style="width: 230px" required title="This is a Mandatory field">
        </div></div>
        <div class="col-md-3"><div class="well"><strong>Address Line2</strong><br><input name="add2"
 type="text" style="width: 230px">
        </div></div>
    </div>
  	<div class="row">
        <div class="col-md-3"><div class="well"><label class="star"> * </label><label><strong>State</strong></label>
  <input name="region" id="region" type="text" style="width: 230px" pattern="[a-zA-Z\s]+" required title="This is a Mandatory field and should only contain Alphabets">
        </div></div>
    </div>
    <div class="row">
        <div class="col-md-3"><div class="well"><label class="star"> * </label><label><strong>City</strong></label>
   <input name="city" id="city" type="text" style="width: 230px" pattern="[a-zA-Z\s]+" required title="This is a Mandatory field and should only contain Alphabets">
        </div></div>
    </div>
    <div class="row">
        <div class="col-lg-3"><div class="well"><label class="star"> * </label><strong>ZIP</strong><br><input name="zip" type="text" style="width: 230px" maxlength="5" pattern="[0-9]{5}" required title="This is a Mandatory field and should only contain Numerics"></div></div>
    </div>
    <div class="row">
        <div class="col-lg-2"><div class="well"><label class="star"> * </label><label><strong>Business Status</strong></label>
<br><input name="status" value="Y"
 type="radio" checked>Approved</input><br>
  <input name="status" value="N" type="radio">Not
Approved</input>
  </div></div>
   
    <div class="row">
        <div class="col-lg-12"><div style="text-align: center"><input type="submit"></div></div>
    </div> 
     </div>
     </form>
     </div></div>
<footer>
<?php require  $path . "/common/footer.php";?>
</footer>
</body>
</html>