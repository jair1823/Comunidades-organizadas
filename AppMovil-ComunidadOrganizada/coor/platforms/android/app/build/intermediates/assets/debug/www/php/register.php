<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATH, PUT, DELETE, OPTIONS');

//require 'Credentials.php';
    $host = "localhost";
    $user = "root";
    $passwd = "root";
    $database = "comunidadesorganizadas";

    $con = mysqli_connect($host, $user, $passwd, $database) or die("connection error");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $new_username = $_POST['new_username'];
    $first_lastname = $_POST['first_lastname'];
    $second_lastname = $_POST['second_lastname'];
    $official_id = $_POST['official_id'];
    $gender = $_POST['gender'];
    $foreigner = $_POST['foreigner'];
    $photo = $_POST['photo'];

    if(isset($_POST['register']))
    {   
        $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email`='$email'");
        $register = mysqli_num_rows($query);
        if($register == 0)
        {
            $insertPeople = mysqli_query($con,"INSERT INTO `people` (`name`, `last_name`, `second_last_name`, `official_id`, `gender`,`foreigner`) VALUES ('$new_username', '$first_lastname','$second_lastname', '$official_id','$gender','$foreigner')");
            
            $person_id = mysqli_insert_id($con);
            
            $insertUser = mysqli_query($con,"INSERT INTO `users` (`role_id`, `person_id`, `email`, `email_verified_at`, `password`,`avatar_path`) VALUES ('1', '$person_id','$email', date('Y-m-d H:i:s'),'$password','$photo')");
            if($insertUser)
                echo "success";
            else
                echo "error";
        }
        else if($register != 0)
            echo "exist";
    }
    
    mysqli_close($con);
?>