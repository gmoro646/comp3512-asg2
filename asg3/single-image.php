<?php include 'includes/functions.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'includes/settings.inc.php'; ?>
</head>
<style>
      #map {
        height: 400px;
        width: 100%;
       }
       

</style>

<body>
   
    <?php include 'includes/header.inc.php'; ?>
    <main class="container">
        <div class="col-md-12">
            <?php 
            $id = $_GET["imgid"];
            loadSingleImage($pdo);
            ?>
            <script>
            /*
            function initMap() {
                var latitude ="<?php echo $maploc [0] ;?>"
                var longtude ="<?php echo $maploc[1] ;?>"
                var center = {lat: $maploc[0].value, lng: $maploc[1].value};
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: center,
                map: map
            });
      }*/
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXC3LS_MbVk4EnRQdtJs0GDVLUtJKtV1U&callback=initMap">
    </script>
        </div>
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>
