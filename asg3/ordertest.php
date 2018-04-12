<?php 
session_start(); 
include 'includes/functions.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<!--head-->

<head>
    <meta charset="utf-8">
    <title>Favorites</title>
    <?php include 'includes/settings.inc.php'; ?>
</head>

<body>
    
    <?php include 'includes/header.inc.php' ?>
    
 
        
        <main class="container-fluid">
            
            <div id="row">
               
                
                <div class="panel panel-primary">
                    
                    <div class="panel-heading">Order Summary</div> <!--end panel heading-->
                    
                    <div class="panel-body ordertest">
                        
                        <!--Heading Row-->
                      
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2"><p><strong>Size</strong></p></div>
                            <div class="col-md-2"><p><strong>Paper</strong></p></div>
                            <div class="col-md-2"><p><strong>Frame</strong></p></div>
                            <div class="col-md-2"><p><strong>Quantity</strong></p></div>
                        </div>

                            
                        <!--Content Row-->
                       
                        
                        <?php 

                            $len =(count($_POST))/5;
                            for($i=1; $i<=$len+1; $i++){
                        ?>
                        <div class="row ordernum" id=<?php echo "val$i";?> >
                              
                                          <div class ="col-md-2 displayimages">
                                           <?php 
                                          
                                           //echo "<src='images/square-small/".$_POST["path${i}"]."'/>"; 
                                           
                                           ?> 
                                          </div>
                                          <div class ="col-md-2 ">
                                              <?php echo '<p id="size'.$i.'">'.$_POST["size${i}"].'</p>'; ?>
                                          </div>
                                          <div class ="col-md-2 ">
                                              <?php echo '<p id="paper'.$i.'">'.$_POST["paper${i}"].'</p>'; ?>
                                          </div>
                                          <div class ="col-md-2 ">
                                              <?php echo '<p id="frame'.$i.'">'.$_POST["frame${i}"].'</p>'; ?>
                                          </div>
                                          <div class ="col-md-2 ">
                                              <?php echo '<p id="quantity'.$i.'">'.$_POST["qty${i}"].'</p>'; ?>
                                          </div>
                                      
                            
                           
                            
                        </div>
                        <?php } 
                        ?>
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                        <div class="carousel-item active">
                      <?php 
                      displayOrderPic();
                      ?>
                      </div>
                       </div>
                        </div>
    </div>
                        <?php?
                        
                        ?>
                        <script>
                            $(.)
                            
                        </script>
                        
                        <!-- shipping Row-->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-3"><strong><?php $id = $_POST['optradio']; if($id == 1){ echo "<p>Standard Shipping</p>"; } else { echo "<p>Express Shipping</p>" ;} ?></strong></div>
                        </div>
                        
                    </div><!--end panel body-->
                
                </div><!--end panel-->
            
            </div><!--end row-->
            
        </main>
        
        
        <?php include 'includes/footer.inc.php' ?>
      
        <script src="jqueryfun.js">
            
        </script>
        
       
       </body>
    </html>