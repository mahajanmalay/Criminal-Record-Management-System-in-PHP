<?php
$login=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $usertype=$_POST["usertype"];

    $sql="Select * from users where username='$username' AND password='$password' AND usertype='$usertype'";
    $result = mysqli_query($conn, $sql);
    $num= mysqli_num_rows($result);

    if($num==1){
                $login = true;
                session_start();

                $_SESSION['loggedin']= true;
                $_SESSION['username']= $username;
                $_SESSION['usertype']= $usertype;

                if($usertype=="admin"){

                    header("location: admin.php");
                }
                elseif($usertype=="police"){
                    header("location: police.php");

                }
                elseif($usertype=="court"){
                    header("location: court.php");

                }
            }
            else{
                $showError="Invalid Credentials";
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
    
</head>
<body>

<?php
if($login){

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are logged in.
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

        &nbsp&nbsp user
        
        
        
    </div>
    
    </div>
    
    <p class="disclaimer">
        Disclaimer! This is the official website of CID that manages records of crime cases. Only officials are allowed to visit the site if any unofficial found, will be punished accordingly...
    </p>


    <div class="mainContent">

        <div class="formBox">
            <form action="index.php" method="post">
                <h3>Login</h3>
                
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username"  name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <label for="usertype">User Type:</label>

                <select id="usertype" class="userbtn" name="usertype">
                <option value="admin">admin</option>
                <option value="police">police</option>
                <option value="court">court</option>
                </select><br>
                
                <button type="submit" class="btn btn-primary">Login</button>
                
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
