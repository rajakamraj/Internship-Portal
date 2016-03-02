<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>



<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="bootstrap/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css"
	href="bootstrap/css/bootstrap.min.css">

	<script src="../bootstrap/js/find_location.js"></script>


<title>DB Tecktons</title>
<style>

.img {
        background: #EBCFFF;
	padding-top: 5px;
}

.bc-color {
	background: #3366FF
}

.bc-font-color {
	color: #FFFFFF;
}

.hp-href {
	background: #FFFFFF;
	color: #3366FF;
	border-color: #FFFFFF;
	font-weight: 400;
	font-size: 30px;
	font-family: "Browallia New";
}

.hp-href:hover {
	background: #EBCCFF;
	color: #FFFFFF;
	border-color: #3366FF;
}

.all-font {
	color: #3366FF;
}

.bp-bc {
	min-height: 390px;
	background: url("images/homepage/home.jpg") no-repeat scroll center
		center/cover transparent;
	padding: 0px;
	background-repeat: no-repeat;
	text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);
	font-weight: 500;
	border: 0px solid #CCC;
}

.overlay {
	padding-top: 90px;
	background-color: rgba(51, 102, 255, 0.75);
	min-height: 400px;
	color: #FFF;
}

#mainDesign h1 {
	font-weight: 900;
	font-size: 100px;
	font-family: "Browallia New";
}

#mainDesign h4 {
	font-weight: 500;
	font-size: 35px;
	font-family: "Browallia New";
}

#mainContainer1 {
	opacity: 0.1;
	-webkit-transition: opacity 0.15s linear;
	-moz-transition: opacity 0.15s linear;
	-o-transition: opacity 0.15s linear;
	transition: opacity 0.15s linear;
}
</style>
<script type="text/javascript">

function checkNumber(ele)
{
	if(ele.value!='')
	{
		var regex = /^[0-9]*$/;
		if(!regex.test(ele.value)	|| (parseInt(ele.value) < parseInt(0)) )
		{
			alert('Given field should be a positive number');
			ele.focus();
			ele.value='';
			return false;
		}
	}
	return true;	
}

function checkEmail(ele)
{
	if(ele.value!='')
	{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(!regex.test(ele.value) )
		{
			alert('Given field should be an Email');
			ele.value='';
			ele.focus();
			return false;
		}
	}
	return true;	
}
function loginFunc() {
	document.getElementById("actionName").value = "login";
	document.getElementById("classId").value = "3";
	document.getElementById("encPwd").value =
		CryptoJS.MD5(document.getElementById("pwd").value);
	var loginFom = document.getElementById("loginFom");
	loginFom.action = "main";
	loginFom.method = "post";
	loginFom.submit();
}
function signUpFunc() {
	if(validateSignUp())
		{
		document.getElementById("actionName2").value = "signup";
		document.getElementById("classId2").value = "5";
		document.getElementById("encPwd2").value =
			CryptoJS.MD5(document.getElementById("pwdS").value);
		var SignUpFom = document.getElementById("SignUpFom");
		SignUpFom.action = "main";
		SignUpFom.method = "post";
		SignUpFom.submit();
		}
}

function valiPass()
{
	if(document.getElementById("password").value!=document.getElementById("confpassword").value)
	{
		alert('Passwords do not match');
		document.getElementById("password").value = '';
		document.getElementById("confpassword").value = '';
		document.getElementById("password").focus();
		
	}
	
}


</script>
</head>
<body>


	<div id="mainContainer" class="container-full">
		<div class="modal fade" id="basicModal" tabindex="-1" role="dialog"
			aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog" >
				<div class="modal-content">

				<form id="loginFom" action="/common/Validation.php" method="Get">
			<input type="hidden" name="actionName" id="actionName" value="" />
			<input	type="hidden" name="classId" id="classId" value="" />
			<input	type="hidden" name="encPwd" id="encPwd" value="" />

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">X</button>
						<h4 class="modal-title" id="myModalLabel">Login</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="username">Email ID</label>
							 <input type="username"	class="form-control" id="username" name="username">
						</div>



						<div class="form-group">
							<label for="password">Password:</label> <input type="password"
								class="form-control" id="password1" name="password">



						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<!--	<button type="button" input type="submit" class="btn btn-primary" onclick="/common/validation.php">Login</button>  -->
                                              <input type="submit" value="Login" class="btn btn-primary">
					</div>
					</form>
				</div>
			</div>
		</div>






		<?php
// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = "";
/*$name = $email  = $password = ""; */

if ($_SERVER["REQUEST_METHOD"] == "GET") {
   if (empty($_GET["UserName"])) {
     $nameErr = "Name is required";
   } else {
     $UserName = test_input($_GET["UserName"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$UserName)) {
       $nameErr = "Only letters and white space allowed";
     }
   }

   if (empty($_GET["password"])) {
     $passwordErr = "password is required";
   } else {
     $password = test_input($_GET["password"]);
     // check if e-mail address is well-formed
     if (!filter_var($password, FILTER_VALIDATE_EMAIL)) {
       $passwordErr = "Invalid password format";
     }
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

		<div class="modal fade" id="SignupModal" tabindex="-1" role="dialog"
			aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog" >
				<div class="modal-content">
				<p><span class="error">* required field.</span></p>
				<form id="SignUpFom" action = "/common/inserting_data.php" method="GET">
			<input	type="hidden" name="encPwd2" id="encPwd2" value="" />
			<input type="hidden" name="actionName" id="actionName2" value="" />
			<input	type="hidden" name="classId" id="classId2" value="" />
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">X</button>
						<h4 class="modal-title" id="myModalLabel">SignUp</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="first_name">First Name:</label>
							 <input type="text"  class="form-control" id="first_name" name="first_name" required title="This is a Mandatory field">
                                                         <span class="error"> <?/*php echo $nameErr; */?></span>
                                                </div>


                                                 <div class="form-group">
                                                         <label for="middle_name">Middle Name:</label> <input type="text"
							  class="form-control" id="middle_name" name="middle_name">

                                                 </div>

                                                <div class="form-group">
							<label for="last_name">Last Name:</label>
							 <input type="text"	class="form-control" id="last_name" name="last_name" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>

                                                <div class="form-group">
							<label for="email">Email:</label>
							 <input type="text"	class="form-control" id="email" name="email"  required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>


                                                <div class="form-group">
							<label for="student_level">Level:</label>
							 <input type="text"	class="form-control" id="student_level" name="student_level" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>



                                                <div class="form-group">
							<label for="major">Major:</label>
							 <input type="text"	class="form-control" id="major" name="major" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>


                                                <div class="form-group">
							<label for="line1">Address line 1</label>
							 <input type="text"	class="form-control" id="line1" name="line1" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>

                                                <div class="form-group">
							<label for="line2">Address line 2</label>
							 <input type="text"	class="form-control" id="line2" name="line2" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>

                                                <div class="form-group">
							<label for="city">City</label>
							 <input type="text"	class="form-control" id="city" name="city" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>

                                                <div class="form-group">
							<label for="state">State</label>
							 <input type="text"	class="form-control" id="state" name="state" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>

                                                <div class="form-group">
							<label for="zip">Zip</label>
							 <input type="text"	class="form-control" id="zip" name="zip" onblur="checkNumber(this);" required title="This is a Mandatory field" >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>

                                                <div class="form-group">
							<label for="phone">Phone</label>
							 <input type="text"	class="form-control" id="phone" name="phone" onblur="checkNumber(this);" required title="This is a Mandatory field"  >
                                                         <span class="error"> <? /*php echo $nameErr; */?></span>
                                                </div>


						<div class="form-group">
							<label for="password">Password:</label> <input type="password"
							class="form-control" id="password" name="password" required title="This is a Mandatory field" >
                                                         <span class="error">  <?php echo $passwordErr; ?> </span>
						</div>

					        <div class="form-group">
							<label for="confpassword">Confirm Password:</label> <input type="password"
								class="form-control" id="confpassword" name="confpassword" onblur="valiPass();" required title="This is a Mandatory field" >

						</div>
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary" onclick="/common/inserting_data.php">Signup</button> -->
						<input type="submit" value="SignUp" class="btn btn-primary">


					</div>
					</form>
				</div>
			</div>
		</div>











		<!--

		<div class="jumbotron bg-primary bc-color bc-font-color">
			<div class="row">
				<div class="col-md-9"></div>
				<div class="col-md-1">
					<a href="#" class="btn btn-info btn-lg hp-href">Login</a>
				</div>
				<div class="col-md-2">
					<a href="#" class="btn btn-info btn-lg hp-href">Signup</a>
				</div>
			</div>
			<h1>Exam Portal</h1>
		</div>
		 -->
		<div class="row">
			<div class="col-md-12 all-font ">
				<div class="bp-bc ">
					<div class="overlay" id="mainDesign">
						<div class="col-md-8 col-md-offset-2 text-center">
							<h1>Niner Internship Portal</h1>
							<h4>
								<p></p>
								<p></p>
								<p></p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;Internship Project Description</p>
								<a href="#" class="btn btn-info btn-lg hp-href"
									data-toggle="modal" data-target="#basicModal">Login</a> <a
									href="#" class="btn btn-info btn-lg hp-href"
									data-toggle="modal" data-target="#SignupModal">Signup</a>
							</h4>
							<?php 
							if(isset($_GET['login_msg']))
							{
								if(($_GET['login_msg'])=="fail")
								{
									?>
									<script>
    alert('Login not successful. Username / Password Invalid.');   
</script>
									<?php 
								}
							}
							if(isset($_GET['reg_msg']))
							{
								if(($_GET['reg_msg'])=="fail")
								{
							?><div class="alert alert-warning" id="fail_reg">
    	<script>
    alert('Registration not successful. Please Try Agains');   
</script>
									<?php 
								}
								else if(($_GET['reg_msg'])=="success"){
									?>
									<script>
    alert('Registration successful... Login to Get Started!');   
</script>	
									<?php 
							}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						<li data-target="#myCarousel" data-slide-to="3"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="images/homepage/avail.jpg" alt="Chania">
							<div class="carousel-caption all-font">
								<h3>Availability</h3>
								<p>You can take up Internships from Any Place at Any Time on Internship
									Portal</p>
							</div>
						</div>

						<div class="item">
							<img src="images/homepage/reliable.jpg" alt="Chania">
							<div class="carousel-caption all-font">
								<h3>Reliability</h3>
								<p>Internship Portal is one of the most reliable things you will
									find in Life..! So use it without any glicthes.</p>
							</div>
						</div>

						<div class="item">
							<img src="images/homepage/easy.jpg" alt="Flower">
							<div class="carousel-caption all-font">
								<h3>Easy</h3>
								<p>Internship Portal is the really easy to use. We believe
									simplicity is the best way to go.</p>
							</div>
						</div>
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control " href="#myCarousel" role="button"
						data-slide="prev"> <span
						class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a> <a class="right carousel-control " href="#myCarousel"
						role="button" data-slide="next"> <span
						class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>


			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron bc-color bc-font-color">
					<div class="col-md-6  bc-font-color text-left">Copy Right
						DBTektons</div>
					<div class="col-md-6  bc-font-color text-right">Last Updated
						25th April 2015</div>

				</div>
			</div>
		</div>

	</div>
</body>
<script>
$(document).ready(function() {
    //listens for typing on the desired field
   
    $("#email").blur(function() {
        //gets the value of the field
         checkEmail(document.getElementById('email'),'Email');
        var email = $("#email").val();

        //here would be a good place to check if it is a valid email before posting to your db

        //displays a loader while it is checking the database

        //here is where you send the desired data to the PHP file using ajax
        $.post("check_email.php", {email:email},
            function(result,status) {
                if(result.indexOf("1")> -1) {
                    //the email is available
                   //alert("available");
                }
                else {
                    //the email is not available
                    document.getElementById('email').value='';
                	alert("Entered Email is already Registered."); 
                }
            });
     });
});
</script>
</html>