<?php 
include 'includes/functions.php';
session_start();
try {
    if (!isset($_SESSION['UserID']) || $_SESSION['UserID'] == null) {
        $_SESSION['Username'] = $_POST['username'];
        $_SESSION['Password'] = $_POST['pword'];
    }

    if (!isset($_SESSION['Username']) || $_SESSION['Password'] == null) {
        header("Location: login.php?");
    }
    else if (!isset($_SESSION['UserID']) || $_SESSION['UserID'] == null) {
        $db = new LoginGateway($connection);
        //database helper run query 17.
        $statement = $db->retrieveRecords($db->getUsernameCheck(), $_POST['username']);

        foreach($statement as $result) {
            $str = $_SESSION['Password'].$result['Salt'];
        }
        $pass = md5($str);
        $statement = $db-> retrieveRecords($db-> getUserLoginCheck(), array(':user' => $_POST['username'], ':pass' => md5($str)));

        if (count($statement) > 0) {
            foreach($statement as $row) {
                $_SESSION['UserID'] = $row['UserID'];
            }
        }
        else {
            header("Location:index.php");
        }
    }
}
catch( Exception $e ){
    die($e->getMessage());
}
$db = new UsersGateway($connection);
$result = $db->findById($_SESSION['UserID']);
    $name = $result['FirstName'].' '.$result['LastName'];
    $address = $result['Address'];
    $rest = $result['City'].' '.$result['Region'].' '.$result['Country'].' '.$result['Postal'];
    $phone = $result['Phone'];
    $email = $result['Email'];
?>

<!DOCTYPE html>

<html lang="en">
    
<head>
    <meta charset="utf-8">
    <title>Profile</title>

</head>
    
    <body>

       <?php include 'includes/header.inc.php' ?>
        
        <!-- end of header  -->
        
        <main class = "container">
             <div class = "row bg-alter col-md-6">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <h2><b>Name:</b> <?php echo $name ?></h2>
                        </div>
                        
                        <div class="col-md-12">
                            <p><b>Address:</b> <?php echo $address ?><p>
                        </div>
                        <div class="col-md-12">
                            <p> <b>City: </b><?php echo  $result['City'] ?><br>
                                <b>Region: </b><?php echo  $result['Region'] ?><br> 
                                <b>Country: </b><?php echo  $result['Country'] ?> <br>
                                <b>Postal: </b><?php echo  $result['Postal'] ?>
                            <p>
                        </div>
                        <div class="col-md-12">
                            <p> <b>Phone Number:</b> <?php echo $phone ?><p>
                        </div>
                        <div class="col-md-12">
                            <p><b>Email:</b> <?php echo $email ?><p>
                        </div>
                        
                    </div>
                </div>
                <br>
                 <div class= "bottom-container col-md-6">
                        <div class= "panel panel-primary">
                            <div class ="panel-heading"> Your Images</div>
                            <div class="panel-body">
                            
                            <?php
                            $db=new UsersGateway($connection);
                            $result=$db->getUserPictures($_SESSION['UserID']);
                            foreach($result as $row) {
                                echo '<div class="col-md-3">
                                <a href="single-image.php?imgid='.$row["ImageID"].'"><img class="img-responsive" src="images/square-small/'.$row["Path"].'" alt="Image"></a>
                                </div>';
                            }
                            ?>
                            </div>
                        </div>
                </div>
                </main>
    <?php include 'includes/footer.inc.php'; ?>
     <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script></body>
</html>