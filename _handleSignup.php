<?php
$showError="false"; 
if($_SERVER['REQUEST_METHOD']=='POST'){
    include '_dbConnect.php';
    $user_email=$_POST['signupEmail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['signupcpassword'];

    // check whether this emaill exists
    $existSql="SELECT * FROM `users` where user_email
    ='$user_email'";
    $result=mysqli_query($conn,$existSql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0)
    {
        $showError="Email already in use";
    }
    else{
        if($pass==$cpass){
            $hash=password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`)
            VALUES ('$user_email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            // echo($result);
            if($result){
                $showAlert=true;
                header('Location:/upmeet/index.php?signupsuccess=true');
                exit();
              }       
        }
        else{
          $showError="Passwords dont match";  
        }
    }
    header("Location:/upmeet/index.php?signupsuccess=false&error='.$showError.'");
    exit();
  }
  ?>