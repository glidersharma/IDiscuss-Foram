<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>iDiscuss Form</title>
</head>

<body>

    <!-- this is a header of the website -->
    <?php  include 'partials/header.php'; ?>
    <?php include 'partials/dbconnect.php';?>
    <?php
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
    $usermail=$_SESSION['useremail'];
     $sql1="SELECT * FROM `userlogin_db` WHERE `user_email` LIKE '$usermail'";
     $result=mysqli_query($conn,$sql1);
     $row2=mysqli_fetch_assoc($result);
     $userid=$row2['srno'];
        }
    
    ?>
    
    <?php
    

    $id =$_GET['catid'];    
    $sql="SELECT * FROM `categories` WHERE `category_id` = $id";
    $result=mysqli_query($conn,$sql);
    
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['category_name'];
        $catdesc=$row['category_description'];
    }
        ?>
        <?php
        if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
        $method=$_SERVER['REQUEST_METHOD'];
        $showalert=false;
        if($method=='POST'){           
            $th_title=$_POST['title'];
            $th_desc=$_POST['description'];                       
            $sql="INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_categ_user_id`, `thread_categ_id`, `date_time`) VALUES (NULL, '$th_title', '$th_desc', '$id', $userid, current_timestamp());";
            $result=mysqli_query($conn,$sql);
            $showalert=true;

        }
        if($showalert){
            echo '<div class="alert alert-success" role="alert">
            your question has submited successfully
          </div>';
        }
    }
        ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"></h1>
            <h1>Welcome to <?php echo $catname; ?></h1>
            <hr class="my-4">
            <p><?php
            echo $catdesc;
            ?>
            </p>
            <ul>
                <li>No Spam / Advertising / Self-promote in the forums.
                </li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images. ...</li>
                <li>Do not cross post questions. ...</li>
                <li>Do not PM users asking for help. ...</li>
            </ul>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <div class="container">
    <p>
 
 <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
   Ask Question 

 </button>
</p>
<?php

if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
        echo'<div class="collapse" id="collapseExample">
            <div class="card card-body">
            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            </div>';
}

else{
    echo '<p class="lead">please login to ask your Question.<?p>';
}

?>
        <h2 class="py-2">Browse Question</h2>
        <?php
         $id =$_GET['catid'];
        //  $sql1="SELECT * FROM `userlogin_db` WHERE `srno` =$id+1";
        //  $result1=mysqli_query($conn,$sql1);         
        //  while($row1=mysqli_fetch_assoc($result1)){
        //      $commbyuser=$row1['user_email'];
        //  }    
         $sql="SELECT * FROM `threads` WHERE `thread_categ_user_id`=$id";
         $result=mysqli_query($conn,$sql);
         $noresult=true;
         while($row=mysqli_fetch_assoc($result)){
             $id=$row['thread_id'];
             $title=$row['thread_title'];
             $desc=$row['thread_desc'];
             $emailid=$row['thread_categ_id'];
             $sql3="SELECT * FROM `userlogin_db` WHERE `srno` =$emailid
             ";
             $result3=mysqli_query($conn,$sql3);
             $row2=mysqli_fetch_assoc($result3);
             $emailname=$row2['user_email'];
             $noresult=false;
            echo' <div class="media my-3">
            <img src="img/userdefault.png" width="64px" class="mr-3" alt="...">
            <div class="media-body">
                <p>posted by :'.$emailname.'</p>
                <h5 class="mt-0"><a href="threadlist.php?threadid='.$id.'" style="color:black">'.$title.'</a></h5>
                <textarea class="form-control"> '.$desc.'</textarea>';
                if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){
                echo '<a href="threadlist.php?threadid='.$id.'" style="color:black"><button class="btn btn-success my-3">Reply</button></a>';
            }
            else{
                echo '</p class="lead">To reply this Question you hav to login.';
            }
       
            echo'</div>
        </div>';
            
    }   
         if($noresult){
            echo '<p class="lead"><b>Be the first person to add a Question.</b></p>';
        }
        ?>
        
    </div>
    <!-- this is a footer here u have to put icons  -->
    <div><?php include 'partials/footer.php';   ?> </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>