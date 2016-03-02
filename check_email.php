<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
require  $path ."/common/db.php"; 
$email = mysql_real_escape_string(strtolower($_POST["email"]));
$sql = "SELECT user_name FROM login WHERE LOWER(user_name) = '" . $email . "'";
 $result_exec = $conn -> query($sql);
 $result=$result_exec->num_rows;
if($result > 0) {
    echo "0";
}
else {
    echo "1";
}

?>