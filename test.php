<!DOCTYPE html>
<html>
<head>


<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="bootstrap/jquery-1.11.2.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="ui/jquery-ui.min.js"></script>
<script src="js/md5.js"></script>
<link rel="stylesheet" type="text/css"
	href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"           1
	href="ui/jquery-ui.min.css">
</head>
<body>

<div class="container">


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
        background: #EBCFFF;
	color: #3366FF;
}

.error {
        color: #FF0000;
}



#mainDesign h1 {
        background: #EBCFFF;
	padding-top: 20px;
	font-weight: 900;
	font-size: 100px;
	font-family: "Browallia New";
}

#mainDesign h4 {
	font-weight: 500;
	font-size: 30px;
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




<div id="mainContainer" class="container-full">
		<div class="modal fade" id="basicModal" tabindex="-1" role="dialog"
			aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog" >
				<div class="modal-content">

				<form id="loginFom" action="Validation.php" method="Get">
			<input type="hidden" name="actionName" id="actionName" value="" />
			<input	type="hidden" name="classId" id="classId" value="" />
			<input	type="hidden" name="encPwd" id="encPwd" value="" />  1

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-hidden="true">X</button>
						<h4 class="modal-title" id="myModalLabel">Login</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="UserName">UserName:</label>
							 <input type="UserName"	class="form-control" id="UserName" name="UserName">
						</div>



						<div class="form-group">
							<label for="Password">Password:</label> <input type="Password"
								class="form-control" id="Password" name="Password">



						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<!--	<button type="button" input type="submit" class="btn btn-primary" onclick="validation.php">Login</button>  -->
                                              <input type="submit" class="btn btn-default">
					</div>
					</form>
				</div>
			</div>
		</div>

		<!-- sign up -->

		<div class="modal fade" id="SignupModal" tabindex="-1" role="dialog"
			aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog" style="width:25%">
				<div class="modal-content">
				<form id="SignUpFom" action = "inserting_data.php" method="get">
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
							<label for="UserName">UserName:</label>
							 <input type="text"	class="form-control" id="UserName" name="UserName">

                                                </div>
						<div class="form-group">
							<label for="password">Password:</label> <input type="password"
								class="form-control" id="password" name="password">

						</div>

					<div class="form-group">
							<label for="pwd">Confirm Password:</label> <input type="password"
								class="form-control" id="confpassword" name="confpassword">

						</div>
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<!-- <button type="button" class="btn btn-primary" onclick="signUpFunc();">Signup</button> -->
						<input type="submit" class="btn btn-primary">


					</div>
					</form>
				</div>
			</div>
		</div>




		<div class="row">
			<div class="col-md-12 all-font ">
				<div class="bp-bc ">
					<div class="overlay" id="mainDesign">
						<div class="col-md-8 col-md-offset-2 text-center">
							<h1>Internship USA</h1>
							<h4>
								<p></p>
								<p></p>
								<p></p>

								<a href="#" class="btn btn-info btn-lg hp-href"
									data-toggle="modal" data-target="#basicModal">Login</a> <a
									href="#" class="btn btn-info btn-lg hp-href"
									data-toggle="modal" data-target="#SignupModal">Signup</a>
							</h4>
						</div>
                                             <div class = "col-md-2  text-left">
                                                <img src="images/homepage/wanted_interns.jpg">
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
							<img src="images/homepage/internship_USA_1.jpg" alt="Chania">
							<div class="carousel-caption all-font">
							</div>
						</div>

						<div class="item">
							<img src="images/homepage/internship_USA_2.jpg" alt="Chania">
							<div class="carousel-caption all-font">
							</div>
						</div>

						<div class="item">
							<img src="images/homepage/internship_USA_3.jpg" alt="Flower">
							<div class="carousel-caption all-font">
							</div>
						</div>

						<div class="item">
							<img src="images/homepage/internship_USA_4.jpg" alt="Flower">
							<div class="carousel-caption all-font">
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
						DBTeckons</div>
					<div class="col-md-6  bc-font-color text-right">Last Updated
						29th March 2015</div>
				</div>
			</div>
		</div>
	</div>
</body>
</div>
</body>
</html>
