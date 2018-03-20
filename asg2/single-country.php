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
                    <?php loadCountryInfo($connection); ?>
                    
                    <?php
                    $id = $_GET["id"];
                    generateStaticCountryMap($connection, $id); 
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Images</div>
            <div class="panel-body" id="countryImg">
                <?php loadCountryPicture($connection); ?>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.inc.php'; ?>
</body>
</html>
