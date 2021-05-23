<?php
$showError="false";
$showalert="false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
   include 'dbconnect.php';
   $email=$_POST['email'];
   $pass=$_POST['password'];
  
   $sql="SELECT * FROM `userlogin_db` WHERE `user_email` = '$email'";
   
   $result=mysqli_query($conn,$sql);
   $numRows=mysqli_num_rows($result);
   if($numRows==1){     
      $row=mysqli_fetch_assoc($result);
          if(password_verify($pass,$row['password'])){
              session_start();
              $_SESSION['loggedin']=true;
              $_SESSION['useremail']=$email;
              $_SESSION['srno']=$row['srno'];
              $showError="Welcome to idiscuss foram";
              header("location:/Foram/index.php?loginsuccess=true");
              exit();
            //   echo $_SESSION['useremail'];
              }
             else{
               $showError="Invalid credintials";
               header("location:/Foram/index.php?loginsuccess=false&error=$showError");
               exit();
             } 
         
   }
   else{
      $showError="No user found.invalid email id";
      header("location:/Foram/index.php?loginsuccess=false&error=$showError");
   }


}

?>