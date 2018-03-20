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
                <div class="panel panel-info">
                    <div class="panel-heading">Browse Cities</div>
                    <div class="panel-body">
                        <?php genCityList($connection); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
</body>
</html>