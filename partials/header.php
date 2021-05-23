<?php
session_start();

echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light  " >
  <a class="navbar-brand" href="#">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="\Foram/index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="\Foram/partials/aboutus.php">About </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Catogries
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Contact us</a>
      </li>
    </ul>
    <div class="row my-3">';
    if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true){ 
      echo '<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      <a href="partials/logout.php"><button  type="button" class="btn btn-outline-success mx-2" data-toggle="modal">Logout</button></a>
      <p class="form-inline mx-3">'.$_SESSION['useremail'].'</p>
      </form>';
    }
   else{
      echo '
      <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button></form>
      <button  type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#loginModal">Login</button>
      <button type="button" class="btn btn-outline-success mx-1" data-toggle="modal" data-target="#signupModal">Sign up</button>';
   
    }
    echo '
    </div>
  </div>
  
</nav>
 
';

include 'loginmodal.php';
include 'sign.php';
if(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-warning alert-success fade show my-0" role="alert">
  <strong>you can login now.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
elseif(isset($_GET['signupsuccess'])&&$_GET['signupsuccess']=="false"){
 
  echo '<div class="alert alert-warning alert-danger fade show my-0" role="alert">
  <strong>'. $_GET['error'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

if(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="true"){
  echo '<div class="alert alert-warning alert-success fade show my-0" role="alert">
  <strong>You are logged in .Welcome to iDiscuss.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
elseif(isset($_GET['loginsuccess'])&&$_GET['loginsuccess']=="false"){
 
  echo '<div class="alert alert-warning alert-danger fade show my-0" role="alert">
  <strong>'. $_GET['error'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

?>