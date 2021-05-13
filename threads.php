<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>

    <title>Welcome to iDiscuss - Coding Forum</title>
</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbConnect.php';?>
    <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `categories` where category_id=$id";
    $result= mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
        $catname= $row['category_name'];
        $desc=$row['category_description'];
    }
    ?>
    <?php
    $showAlert=false;
    $method=$_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // Insert into thread db
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        
        $th_desc=str_replace("<", "&lt", $th_desc);
        $th_desc=str_replace(">", "&gt", $th_desc);

        // $email=$_POST['user_email'];
          //  $sno1="SELECT sno FROM `users` where user_email=$email";        
        $sno1=$_POST['sno'];
        echo var_dump($sno1);
        $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `dt`) 
        VALUES ( '$th_title', '$th_desc', '$id', '$sno1',current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>Please wait for community to respond.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
    ?>
    <!-- Category contianer starts here -->
    <div class="container my-3" id="ques">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?></h1>
            <p class="lead"><?php echo$desc; ?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum for sharing knowledge with
                esch other.
                No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Remain respectful of other members at all times.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <?php
        // <!-- INorder to save it on same page "php_self" will give me path of smae file Im preasent in i.e forum/threads.php  "PHP_SELF" IS SAME AS "REQUEST_URI"-->
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
  {     echo '<div class="container">
        <h1 class="py-3">Start a Discussion</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1"><b>Problem Title</b></label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title short and crisp.</small>
            </div>
            <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            <div class="form-group">    
                <label for="exampleFormControlTextarea1"><b>Elaborate your concern</b></label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success ">Submit</button>
        </form>
    </div>';}
    else{
        echo ' 
        <div class="container">
            <h1 class="py-3"> Start a Discussion</h1>
            <p>You are not logged in. Please Login to start a discussion.</p>
        </div>';
    }
    ?>


    <div class="container my-1">
        <h1 class="py-3"> Browse Questions</h1>
        <?php
        // catching threads from thread table, iDiscuss DB
        $id=$_GET['catid'];
        $sql1="SELECT * FROM `threads` where thread_cat_id='$id'";
        $result= mysqli_query($conn,$sql1);
        //Tracking whether entered while loop or not
        $noresult=true;
        while($row= mysqli_fetch_assoc($result)){
            $noresult=false;
            $id=$row['thread_id'];
            $title= $row['thread_title'];
            $threaddesc=$row['thread_desc'];
            $threadtime=$row['dt'];
            $thread_id=$row['thread_user_id'];
            // var_dump($thread_id);
            $sql2="SELECT user_email FROM `users` where sno='$thread_id'";
            $result2= mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            
            echo '<div class="media my-3">
                    <img src="img/user.jpg" width="84px"class="mr-3" alt="...">
                    <div class="media-body">'.
                    '<h5 class="mt-1"><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                       '.$threaddesc.'</div>'.'
                    <p class="font-weight-bold my-0">Asked by:'.($row2['user_email']).' <small><small><b>'.$threadtime.'</b></small></small></p>
                    </div>';    
        }   
    
        // echo var_dump($noresult);
        if($noresult){

            echo '<div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-4">No Threads found</h1>
                        <p class="lead"><b> Be the first person to ask the question </b>.</p>
                        </div>
                  </div>';
        }    
        ?>
    </div>
    <?php include 'partials/_footer.php';?>


    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>