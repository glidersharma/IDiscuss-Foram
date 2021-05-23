<?php
 $showError="false";
 $showalert="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'dbconnect.php';
    $user_email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
   
    $existsql="SELECT * FROM `userlogin_db` WHERE `user_email` = '$user_email'";
    $result=mysqli_query($conn,$existsql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0){
        $showError="Email already in use";
    }
    else{
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `userlogin_db` (`srno`, `user_email`, `password`, `Date`) VALUES (NULL, '$user_email', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
                // $showalert=true;
                header("location:/Foram/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="Password do not match";
            header("location:/Foram/index.php?signupsuccess=false&error=$showError");
        }
    }
    header("location:/Foram/index.php?signupsuccess=false&error=$showError");
}

?>