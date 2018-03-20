<!-- This file was taken from lab 4 (php 3) -->
<header>
    <?php include 'includes/settings.inc.php'; 
    include 'includes/login.php';
   // include('session.php');
    ?>
    <div class="page-content-wrapper">
        <div class="container">
            <div class="pull-right">
                <ul class="list-inline">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    <li><a onclick="document.getElementById('loginid').style.display='block'"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-star"></span> Favorites</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end topHeaderRow -->

    <nav class="navbar navbar-default ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="/asg2/images/misc/logo_large.PNG" height="60" width="60" href="index.php"></img>
                <a class="navbar-brand" href="index.php"></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <li><a href="aboutus.php">Contact</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Browse <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="browse-countries.php">Countries</a></li>
                            <li><a href="browse-images.php">Images</a></li>
                            <li><a href="browse-user.php">Users</a></li>
                            <li><a href="browse-cities.php">Cities</a></li>
                            <li><a href="browse-posts.php">Posts</a></li>
                        </ul>
                    </li>
                </ul>

                <form action="browse-images.php?title=" class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class ="btn btn-primary">Submit</button>
                </form>


<!--                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form> -->
            </div> 
                <!-- /.navbar-collapse -->


        </div>
            <!-- /.container-fluid -->
    </nav>
</header>