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
    $c_id=$_POST["c_id"];
    $prison=$_POST["prison"];
    

    $existsql="SELECT * FROM `criminaltable` WHERE id = '$c_id'";
    $result=mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);
    if($numExistRows > 0){
        $sql="UPDATE `criminaltable` SET `prison` = '$prison' WHERE `criminaltable`.`id` = '$c_id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $showAlert = true;
        }
        else{
            $showError="No record Found";
           
            }
    }
        
}

?>

<?php
include '_dbconnect.php';

?>

<?php
    if($showAlert){

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Data has been updated successfully.
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
    <link rel="stylesheet" href="viewcrime.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="addpolice.css">
    
</head>

<body>


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

    <div class="updatePolice">
        <h3>Add/Update Court by Case ID</h3>
        <form action="addprison.php" method="post">
            <label for="c_id">C_ID</label>
            <input type="number" name="c_id" >
            <label for="set_prison">Set prison</label>
            <input type="varchar" name="prison" ><br>
            <button type="submit" class="btn">Add/Update</button>
        </form>

    </div>

    <div class="display">
        

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Case ID</th>
                    <th scope="col">Nmae</th>
                    <th scope="col">Crime</th>
                    <th scope="col">C_date</th>
                    <th scope="col">Police</th>
                    <th scope="col">A_date</th>
                    <th scope="col">Court</th>
                    <th scope="col">Punishment</th>
                    <th scope="col">Prison</th>
                    <th scope="col">report</th>

                </tr>
            </thead>
            <tbody>
            <?php 
            $sql="SELECT * FROM `criminaltable`";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){
                echo"<tr>
                <th scope='row'>".$row['id']."</th>
                <td>". $row['name'] ."</td>
                <td>". $row['crime'] ."</td>
                <td>". $row['cdate'] ."</td>
                <td>". $row['police'] ."</td>
                <td>". $row['adate']  ."</td>
                <td>". $row['court']   ."</td>
                <td>". $row['punishment']  ."</td>
                <td>". $row['prison']  ."</td>
                <td>". $row['report']  ."</td>
                </tr>";
            }   
            ?>   
                
            </tbody>
        </table>

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
        <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
    </script>


</body>

</html>