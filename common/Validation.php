


<?php session_start();?>
<html>
<body>


<?php
$user_name = $_GET["username"];
$user_password = $_GET["password"];


	require_once("db.php");


$sql = "SELECT user_name,password,person_id FROM login";
$result = $conn->query($sql);


$i = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
    {

      echo $password;
      if($user_name == $row["user_name"] &&  $user_password == $row["password"] )
      {

               
               $_SESSION["person_name"] = $user_name;
               $_SESSION["password"] = $user_password;
               $_SESSION["person_id"] = $row["person_id"];
               $user_id=$row["person_id"];
              $_SESSION['displayInsertMsg']="yes";
               $_SESSION['displaySaveMsg']="yes";

               require_once("db.php");
				$type_sql = "SELECT first_name,type FROM person where person_id=$user_id limit 1";
				$type_result = $conn->query($type_sql);
				if($type_row = $type_result->fetch_assoc())
				{
					$_SESSION['type']=$type_row["type"];
					$_SESSION['first_name']=$type_row["first_name"];
				}
               $i = $i+1 ;
               $_SESSION['login']="yes";
               header("location: /home.php");
               exit(0);
      }

}

if ($i==0)
{
 header("location: /index.php?login_msg=fail");
}
}
?>

</body>
</html>









