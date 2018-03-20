<?php include 'includes/functions.php'; ?>
<script src="jsFunctions.js" type="text/JavaScript"></script>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/settings.inc.php'; ?>
</head>

<body>
    <?php include 'includes/header.inc.php'; ?>
    <main class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Filters</div>
                <div class="panel-body">
                    <form action="browse-images.php" method="get" class="form-horizontal" id="imgForm">
                        <div class="form-inline">
                            <select name="continent" class="form-control" onchange="dynamicSelect()">
                            <option value="0">Select Continent</option>
                             <?php loadContinentList($pdo); ?>
                        </select>
                            <select name="country" class="form-control" onchange="dynamicSelect()">
                            <option value="0">Select Country</option>
                            <?php loadCountryList($pdo); ?>
                        </select>
                            <select name="city" class="form-control" onchange="dynamicSelect()">
                            <option value="0">Select City</option>
                            <?php loadCityList($pdo); ?>
                        </select>
                           <!-- <button type="submit" class="btn btn-primary">Filter</button> -->
                            <?php clearButton(); ?>
                        </div>
                        <div class="form-inline">
                            <input type="text" id="imgSrch" onkeyup="dynamicSearch()" placeholder="Search title" class="form-control" name=title>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Images</div>
                <div class="panel-body">
                    <ul class="caption-style-2" id="imgList">
                        <?php filterPic($pdo); ?>
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
     <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
