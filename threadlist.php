<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
    #threadspace {
        min-height: 250px;
    }
    </style>
    <title>iDiscuss Form</title>
</head>

<body>

    <!-- this is a header of the website -->
    <?php  include 'partials/header.php'; ?>
    <?php include 'partials/dbconnect.php';?>
    <!-- insert comment to database script  -->
    <?php
         $id =$_GET['threadid']; 
        $method=$_SERVER['REQUEST_METHOD'];
        $showalert=false;
        if($method=='POST'){
            
            $cm_desc=$_POST['description'];
            $sql="INSERT INTO `comment` (`comment_id`, `comment_content`, `thread_id`, `comment_time`) VALUES (NULL, '$cm_desc', '$id', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            $showalert=true;

        }
        if($showalert){
            echo '<div class="alert alert-success" role="alert">
            your comment has submited successfully
          </div>';
        }
        ?>
    <div class="container" id="threadspace">
        <?php
       
    $sql="SELECT * FROM `threads` WHERE `thread_id` = $id";
    $result=mysqli_query($conn,$sql);
    
    while($row=mysqli_fetch_assoc($result)){
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $noresult=false;
    }
    echo '
    <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Ques. '.$title.'</h1>
    <p class="lead">Ques description. '.$desc.'</p>
  </div>
</div>';
   
   
     
   ?>
    </div>
    <!-- insert commment to database -->
    
    <div class="container" style="min-height:300px;">
        <h2>Comments</h2>
        <p>

            <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample"
                aria-expanded="false" aria-controls="collapseExample">
                Add comment
            </button>
        </p>
<?php        
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){    
        echo'<div class="collapse" id="collapseExample">
            <div class="card card-body">
                <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">

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
        echo '<p class=lead>Ensure that you are login.';
    }    
   

        ?>
        <?php
         $id =$_GET['threadid'];    
         $sql="SELECT * FROM `comment` WHERE `thread_id` = $id";
         $result=mysqli_query($conn,$sql);
         $noresult=true;
         while($row=mysqli_fetch_assoc($result)){
             $id=$row['thread_id'];
             $comment_desc=$row['comment_content'];
             
             $noresult=false;
             echo' <div class="media my-3 ">
             <img src="img/userdefault.png" width="64px" class="mr-3" alt="...">
             <div class="media-body">                
              <textarea class="form-control"> '.$comment_desc.'</textarea>
               </div>
        </div>';
    }
    if($noresult &&(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)){
        echo '<b>Be the first person to add a Question.</b>';
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