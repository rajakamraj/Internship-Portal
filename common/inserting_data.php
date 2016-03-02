<html>
<body>

<?php

$path = $_SERVER['DOCUMENT_ROOT'];
require($path ."/common/db.php");


        $first_name = $_GET['first_name'];
        $middle_name = $_GET['middle_name'];
        $last_name = $_GET['last_name'];
        $email = $_GET['email'];
        $line1 = $_GET['line1'];
        $line2 = $_GET['line2'];
        $city = $_GET['city'];
        $state = $_GET['state'];
        $zip = $_GET['zip'];
        $phone = $_GET['phone'];
        $password = $_GET['password'];
        $confpassword = $_GET['confpassword'];
        $student_level = $_GET['student_level'];
        $major = $_GET['major'];


        //Getting max of person_id

        $query = "select max(person_id) from login";
        $result = $conn -> query($query);
        if($result){
            $row = $result->fetch_assoc();
            $i = $row["max(person_id)"];
        }
        echo "max of person is ";
        echo "$i";
        $i = $i + 1;


        //getting max of address_id

        $query = "select max(address_id) from address";
        $result = $conn -> query($query);
        if($result){
            $row = $result->fetch_assoc();
            $j = $row["max(address_id)"];
        }
        echo "max of person is ";
        echo "$j";
        $j = $j + 1;




        //getting max of student_id

        $query = "select max(student_id) from student";
        $result = $conn -> query($query);
        if($result){
            $row = $result->fetch_assoc();
            $k = $row["max(student_id)"];
        }
        echo "max of person is ";
        echo "$k";
        $k = $k + 1;





        $query = "INSERT INTO address (address_id,line1,line2,city,zip,state) VALUES ($j,'$line1','$line2','$city',$zip,'$state')";
        $result = $conn -> query($query);
        if($result){
            echo " address tables updated ";
        }

        $query = "INSERT INTO person (person_id,address_id,first_name,middle_name,last_name,email,phone,type) VALUES ($i,$j,'$first_name','$middle_name','$last_name','$email','$phone','S')";
        $result = $conn -> query($query);
        if($result){
            echo " person tables updated ";
        }


        $query = "INSERT INTO login (person_id,user_name,password) VALUES ($i,'$email','$password')";
        $result = $conn -> query($query);
        if($result){
            echo " login tables updated ";
        }


        $query = "INSERT INTO student (person_id,student_id,student_level,major) VALUES ($i,$k,'$student_level','$major')";
        $result = $conn -> query($query);
        if($result){
           
 header("location: /index.php?reg_msg=success");
        }
        else {

        	header("location: /index.php?reg_msg=fail");
        }





?>
</body>
</html>