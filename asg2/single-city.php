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
                    <div class="col-md-6"><?php loadCityInfo($connection); ?></div>
                    <?php
                    $code = $_GET["code"];
                    generateStaticMap($pdo, $code); 
                    ?>
                </div>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Images</div>
            <div class="panel-body" id="cityImg">
                <?php loadCityPic($pdo); ?>
                <?php getCoords($pdo);?>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.inc.php'; ?>
</body>
</html>
