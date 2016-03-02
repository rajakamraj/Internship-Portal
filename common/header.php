<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php 
 if (!isset($_SESSION['person_name'])) {
	
               header("location: /index.php");
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php $home_path = $_SERVER['DOCUMENT_ROOT'];?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="<?php $home_path?>/bootstrap/jquery-1.11.2.min.js"></script>
<script src="<?php $home_path?>/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php $home_path?>/bootstrap/jPages.min.js"></script>
<script src="<?php $home_path?>/bootstrap/jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css"
	href="<?php $home_path?>/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css"
	href="<?php $home_path?>/bootstrap/jPages.css">
	<link rel="stylesheet" type="text/css"
	href="<?php $home_path?>/bootstrap/jquery-ui.min.css">
<title>Niner Internship</title>

<script>
function logoutFunc()
{
	
}

function homeFunc()
{
	
}

function redirectToPage(url)
{
	if(document.forms[0])
		{
			//alert("forms exist");
			document.forms[0].action=url;
			document.forms[0].method = "post";
			document.forms[0].submit();
		}
	else
		{
		//alert("no form");
		var f = document.createElement("form");
		f.setAttribute('method',"post");
		f.setAttribute('action',url);
		document.getElementsByTagName('body')[0].appendChild(f);
		document.forms[0].submit();
		}
}

function checkNumber(ele)
{
	var regex = /^[0-9]*$/;
	if(!regex.test(ele.value)	|| (parseInt(ele.value) < parseInt(0)) )
	{
	alert('Given field should be a positive number');
	ele.focus();
	ele.value='';
	return false;
	}
	return true;	
}

function checkEmail(ele)
{
	//var val='';
	 var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(ele.value) )
	{
	alert('Given field should be an Email');
	ele.value='';
	ele.focus();
	return false;
	}
	return true;	
}



</script>

<style>
.navbar{
background-color: #3366FF;
color: #FFFFFF;
border-radius: 0px;
}
.navbar:a{
color: #FFFFFF;
}
.color-white
{
color: #FFFFFF;
}
.navbar-brand
{
font-size: 25px;
font-weight: 250;
}
.header-btn .icon-bar{
    background:#FFF;
}
	
	
	
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}
</style>
</head>
<body>
	 <nav class="navbar navbar-static">
   <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle header-btn" data-toggle="collapse" data-target="#myNavbar" value="Menu">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand color-white" href="/home.php" ><b>Niner Internships</b></a>
    </div>
     
      <div class="collapse navbar-collapse" id="myNavbar">
      <?php if($_SESSION['type']=="S")
				  {?>
        <ul class="nav navbar-nav ">  
          <li><a href="/student/internshiplist/viewintern.php"
          class="color-white">View Internships</a></li>
          <li><a href="/student/apply/apply_internship.php" class="color-white">
          Apply for Internships</a></li>
          <li><a href="/student/checkstatus/checkstatus.php" class="color-white">
          Check Status</a></li>
          <li class="color-white "><a href="/student/skill/student_skill.php" class="color-white ">Update Skills</a></li>
       
        </ul>
        <?php }?>
        
         <?php if($_SESSION['type']=="A")
				  {
				  ?>
	<ul class="nav navbar-nav ">
        <li class="dropdown  color-white">
            <a  class="dropdown-toggle color-white" role="button" data-toggle="dropdown"  href="#">Internships 
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/admin/internship/add_internship.php">Add Internship</a></li>
                <li><a href="/admin/internship/update_or_delete_internship.php">Update/Delete Internship</a></li>
                
                <li><a href="/admin/internship/assign_internship.php">Assign Interrnship</a></li>
            </ul>
        </li>
       
        <li ><a href="/admin/addbusiness/AddBusiness.php"class="color-white ">Add Business</a></li>
         </ul>
        <?php }?>
<!--         <ul class="nav navbar-nav ">   -->
<!--           <li> -->
<!--         <a class="color-white" href="/about_us.php" >About Us</a> -->
<!--       </li></ul> -->
        
        <ul class="nav navbar-right navbar-nav ">
          <li class="dropdown color-white">
            <a href="#" class="dropdown-toggle color-white" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <i class="glyphicon glyphicon-chevron-down"></i></a>
            <ul class="dropdown-menu">
              <li><a href="/common/logout.php" >Log Out</a></li>
             </ul>
          </li>
        </ul>
      </div>
      
    </div>
</nav>

</body>

</html>