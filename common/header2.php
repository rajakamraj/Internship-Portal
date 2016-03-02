

<header>
<div class="jumbotron">
<div class="container">
<h1> Welcome to Internship Tracking System</h1>
</div>
</div>
    
</header>
<div class="container">
<nav class="navbar navbar-default" role="navigation">
<div class="container-fluid">
  
 <ul class="nav navbar-nav">
 <?php 
 if (!isset($_SESSION['person_name'])) {
	
               header("location: /index.php");
}
?>
        <li ><a href="/home.php">Home</a></li>
         <?php if($_SESSION['type']=="A")
				  {
				  ?>
        <li class="dropdown">
            <a  class="dropdown-toggle" role="button" data-toggle="dropdown"  href="#">Internships 
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href="/admin/internship/add_internship.php">Add Internship</a></li>
                <li><a href="/admin/internship/update_or_delete_internship.php">update/Delete Internship</a></li>
                
                <li><a href="#">Assign Interrnship</a></li>
            </ul>
        </li>
       
        <li><a href="AddBusiness.php">Add Business</a></li>
        <li><a href="#">Student Skill Mapping</a></li>
        <?php }?>
         <?php if($_SESSION['type']=="S")
				  {
				  ?>
		<li><a href="/student/apply_internship.php">List of internships</a></li>
        <li><a href="#">Check Status</a></li>
        <?php }?>
        <li><a href="/common/logout.php" id="logout">Log out</a></li>
    </ul>

 
</div>
</nav>
</div>
                       		