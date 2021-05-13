<?php
$showError="false"; 
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbConnect.php';
    $email=$_POST['loginEmail'];
    $pass=$_POST['password'];
    // check whether this email exists
    $existSql="SELECT * FROM `users` where user_email
    ='$email'";
    $result=mysqli_query($conn,$existSql);
    $numRows=mysqli_num_rows($result);
    if($numRows==1)
    {
      $row=mysqli_fetch_assoc($result);
      if(password_verify($pass,$row['user_pass'])){
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['sno']=($row['sno']);
        $_SESSION['useremail']=$user_email;
        // echo "logged in". $user_email;
        header('Location:/upmeet/index.php');
        exit();
      }
      else{
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
        <strong>Error!</strong>There is some issue.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
    }
    header('Location:/forum');
    exit();
    // echo "dsdsdfs";
    

    }
    
  
  ?>