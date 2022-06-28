<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;

}

?>

<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    $usertype=$_POST["usertype"];


    $existsql="SELECT * FROM `users` WHERE username = '$username'";
    $result=mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError="Username Already Exists";
    }
    else{
        
        
        // $exists=false;
        if($password==$cpassword){
            // $sql="INSERT INTO `users` ( `username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp())";
            $sql="INSERT INTO `users` (`username`, `password`, `usertype`, `timestamp`) VALUES ('$username', '$password', '$usertype', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
        }
        else{
            $showError="Password and conform password do not match";
        } 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciminal Database Management System</title>    
    <link rel="stylesheet" href="Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="Stylesignup.css">
    <style>
        .buttonClass{
    position: relative;
    left: 800px;
    }
    </style>
</head>
<body>

    <?php
    if($showAlert){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> New account is added.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span area-hidden="true">&times;</span></button>  
        </div>';
    }
    if($showError){

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span area-hidden="true">&times;</span></button>  
        </div>';
    }
    ?>

    <div class="header">
    
    <div class="logo">
        <img src="img/logo.png" alt="">
        <h1>Criminal Database</h1>
    </div>

    
    
    <div class="buttonClass">
    <a href="instructions.html" class="btn">Instructions!</a>
        

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle usericon" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>
        
        &nbsp&nbsp
            <?php echo $_SESSION['username']?>
            |<a href="admin.php"> Admin </a>


            <a href="logout.php" class="btn">Logout</a>
        
    </div>
    
    </div>
    
    <p class="disclaimer">
        Disclaimer! This is the official website of CID that manages records of crime cases. Only officials are allowed to visit the site if any unofficial found, will be punished accordingly...
    </p>


    <div class="mainContent">

        <div class="formBox">
            <form action="signup.php" method="post">
                <h3>Add Account</h3>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username"  name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="cpassword" maxlength="23" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text">Make sure to type same password.</small>
            </div>

                <label for="usertype">User Type:</label>

                <select id="usertype" class="userbtn" name="usertype">
                <option value="admin">admin</option>
                <option value="police">police</option>
                <option value="court">court</option>
                </select><br>
                
                <button type="submit" class="btn btn-primary">Add</button>
                
            </form>
            
        </div>
    </div>
    
    <footer>
        <hr>
        <p>Copyright &copy; reserved | CID India</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
