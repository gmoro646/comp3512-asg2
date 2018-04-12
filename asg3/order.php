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
                     
<div class = "row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Size</th>
                                            <th>Paper</th>
                                            <th>Frame</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php 
                                    $counter = 1;
                                    $favImages = $_SESSION["favImages"];
                                    
                                    foreach($favImages as $key => $value) {
                                        echo '<tr class ="favPrints" id ="favPrints'.$counter.'"><td>
                                            <a href = "single-image.php?imgid='.$key.'" id="hrid'.$counter.'"><img name="path'.$counter.'" class = "media-object" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'"/></a>
                                            </td>
                                            <td class="sizes" id="sizes'.$counter.'" name="size'.$counter.'">'.$_POST["size${counter}"].'</td>
                                            <td class="stock" id="stock'.$counter.'" name="paper'.$counter.'">'.$_POST["paper${counter}"].'</td>
                                            <td class="frame" id="frame'.$counter.'" name="frame'.$counter.'">'.$_POST["frame${counter}"].'</td>
                                            <td class="quantity" id="quantity'.$counter.'" name="qty'.$counter.'"/>'.$_POST["qty${counter}"].'</td>
                                            

                                            </div></td>
                                    </tr>';   
                
                                    $counter++;
                                    }
                                    ?>
                                    </tbody>
                             
                                </table>
                                </div>
                                </div>
                        </div>
                        <!-- shipping Row-->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-3"><strong><?php $id = $_POST['optradio']; if($id == "on"){ echo "<p>Standard Shipping</p>"; } else { echo "<p>Express Shipping</p>" ;} ?></strong></div>
                        </div>
                        
                    </div><!--end panel body-->
                
                </div><!--end panel-->
            
            </div><!--end row-->
            
        </main>
        
        
        <?php include 'includes/footer.inc.php' ?>
      
  <script src="ordersummary.js">
            
        </script>
       </body>
    </html>
    