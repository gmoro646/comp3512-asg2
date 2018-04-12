<?php include 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <?php include 'includes/settings.inc.php'; ?>
</head>
<body>
    <?php include 'includes/header.inc.php'; ?>
    <main class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron" id="infoJumbo">
                    <?php
                    $post=$_GET["id"];
                    getSinglePost2($pdo, $post); ?>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Related Images</div>
            <div class="panel-body" id="countryImg">
                <?php 
                $id = $_GET["id"];
                loadSmallPostPic($pdo, $id); 
                ?>
                </div>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.inc.php'; ?>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
