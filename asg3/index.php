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
                <?php 
                cardStyle("images/misc/home_countries.jpg","home countries","Countries","View all countries for which we have pictures","browse-countries.php","View Countries"); 
                cardStyle("images/misc/home_images.jpg","home images","Images","See all of our travel images","browse-images.php","View Images");
                cardStyle("images/misc/home_users.jpg","home users","Users","See information about our contributing users","browse-user.php","View Users");
                cardStyle("images/misc/home_posts.jpg","home posts","Posts","See all the posts from our users","browse-posts.php","View Posts");
                cardStyle("images/misc/home_cities.jpg","home cities","Cities","See the cities the pictures were taken in","browse-cities.php","View Cities");
                ?>
            </div>
        </div>
    </main>
    <?php include 'includes/footer.inc.php'; ?>
     <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>