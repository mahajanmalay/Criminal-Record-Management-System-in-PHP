<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: index.php");
    exit;

}

?>

<!-- this is insertion  -->
<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $c_id=$_POST["c_id"];
    $c_name=$_POST["c_name"];
    $crime=$_POST["crime"];
    $c_date=$_POST["c_date"];
    $police=$_POST["police"];
    $a_date=$_POST["a_date"];
    $court=$_POST["court"];
    $report=$_POST["report"];


    $existsql="SELECT * FROM `criminaltable` WHERE id = '$c_id'";
    $result=mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $showError="id Already Exists";
    }
    else{
       
            // $sql="INSERT INTO `users` (`username`, `password`, `usertype`, `timestamp`) VALUES ('$username', '$password', '$usertype', current_timestamp())";
            $sql="INSERT INTO `criminaltable` (`id`, `name`, `crime`, `cdate`, `police`, `adate`, `court`, `report`) VALUES ('$c_id', '$c_name', '$crime', '$c_date', '$police', '$a_date', '$court', '$report')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="addcrime.css">
    
</head>

<body>

<?php
    if($showAlert){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Data has been submitted successfully.
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
        
        




            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-person-circle usericon" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                <path fill-rule="evenodd"
                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>

            &nbsp&nbsp
            <?php echo $_SESSION['username']?>
            |<a href="admin.php"> Admin </a>


            <a href="logout.php" class="btn">Logout</a>



        </div>

    </div>

    <div class="insert">
        <form action="addcrime.php" method="post">
            <div class="formgroup">
                <label for="c_id">Criminal ID : </label>
                <input type="number" name="c_id" id="c_id">
            </div>
            <div class="formgroup">
                <label for="c_name">Name : </label>
                <input type="text" name="c_name" id="c_name">
            </div>
            <div class="formgroup">
                <label for="crime">Crime : </label>
                <input type="text" name="crime" id="crime">
            </div>
            <div class="formgroup">
                <label for="c_date">Crime date : </label>
                <input type="date" name="c_date" id="c_date">
            </div>
            <div class="formgroup">
                <label for="police">Police Station : </label>
                <input type="text" name="police" id="police">
            </div>
            <div class="formgroup">
                <label for="a_date">Arrest date : </label>
                <input type="date" name="a_date" id="a_date">
            </div>
            <div class="formgroup">
                <label for="court">Court : </label>
                <input type="text" name="court" id="court">
            </div><br> 
            <div class="formgroup">
                <label for="report">Report : </label>
                <textarea name="report" id="report" cols="150" rows="3" class="reportinsert"></textarea>
            </div><br> 

            <div class="formgroup">
                <button type="submit" class="btn btninert">Insert</button>
            </div>


            
            
        </form>
    </div>



    <footer>
        <hr>
        <p>Copyright &copy; reserved | CID India</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>