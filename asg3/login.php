<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Log In</title>

    <?php 
    include 'includes/settings.inc.php';
    ?>
</head>

<body>
  

        <main class="container">
              
    <?php include 'includes/header.inc.php';
    if(isset($_SESSION['Username']) && !empty($_SESSION['Username'])) { $username = $_SESSION['Username']; }?>
               
                <div class = "row">
                    
                        <br>
                        <?php if ($_GET['id'] == 'no'){ echo '<div class="alert alert-danger" role="alert"> Incorrect username or password </div>'; } ?>
                        <form action='user-home.php' method='post' role='form' >
                        <div class="panel panel-default form-rounded">
                          <div class="panel-heading">
                            <div class="panel-heading text-center">Login</h3></div>
                          </div>
                          <div class="panel-body">
                                <label for='username'><h3>Username</h3></label>
                              <input type='text' name='username' class='form-control form-rounded' value = "<?php echo $username ?>" />
                          </div>
                          <div class="panel-body">
                                <label for='pword'><h3>Password</h3></label>
                              <input type='password' name='pword' class='form-control form-rounded'/>
                          </div>
                          <div class="panel-body "><input type='submit' value='Login' class='form-control form-rounded btn btn-danger' /></div>
                        </div>
                        </form>
                    
                </div>
        </main>
        
     <?php include 'includes/footer.inc.php'; ?>
     <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
       </body>
    </html>