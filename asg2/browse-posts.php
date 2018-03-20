
<?php include "includes/functions.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include 'includes/settings.inc.php'; ?>

</head>

<body>
    <header>
        <!-- PHP Call for header -->
       <?php include "includes/header.inc.php"; ?>
    </header>


    <!-- Page Content -->
    <main class="container">
        <div class="row">
            <?php loadSideBar($pdo);?>
            
            <div class="col-md-10">

                <div class="jumbotron" id="postJumbo">
                    <h1>Posts</h1>
                    <p>Read other travellers' posts ... or create your own.</p>
                    <p><a class="btn btn-warning btn-lg">Learn more &raquo;</a></p>
                </div>        
      

                    <!-- outputPostRow with one parameter call to specify post number -->
                          <?php getPosts($pdo); ?>
                            
            </div>  <!-- end col-md-10 -->
        </div>   <!-- end row -->
    </main>
    

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>