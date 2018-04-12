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
    <main class="container">
        <h1>Favorites</h1>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <a href="favourites-setter.php?rmAll"><button type="button" class="btn btn-default">Remove All</button></a>
            <?php showPrintFavButton(); ?>
            <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Print Favorites</button> -->
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            
            <form action="order.php?" id="modalform" method="POST">
            
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">Print Favorites</h5>
                    </div>
                    <div class="modal-body">
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
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php 
                                    $counter = 1;
                                    $favImages = $_SESSION["favImages"];
                                    
                                    foreach($favImages as $key => $value) {
                                        //echo '<tr id = "'.$key.'"><td>
                                        echo '<tr class ="favPrints" id ="favPrints'.$counter.'"><td>
                                            <a href = "single-image.php?imgid='.$key.'" id="hrid'.$counter.'"><img name="path'.$counter.'" class = "media-object" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'"/></a>
                                            </td>
                                            <td><select class="sizes" id="sizes'.$counter.'" name="size'.$counter.'"></select></td>
                                            <td><select class="stock" id="stock'.$counter.'" name="paper'.$counter.'"></select></td>
                                            <td><select class="frame" id="frame'.$counter.'" name="frame'.$counter.'"></select></td>
                                            <td><input class="quantity" type="number" id="quantity'.$counter.'" value="1" min="1" name="qty'.$counter.'"/></input></td>
                                            <td><div class = "total" id="total'.$counter.'" class="total">

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
                         <div class = "row">
                            <div class = "col-md-8"></div>
                            <div class="col-md-2">Subtotal:</div>
                            <div class="col-md-2" id="subtotal"></div>
                        </div>
                             <div class = "row">
                            <div class = "col-md-6"></div>
                            <div class = "col-md-2">
                                <div class="radio">
                                    <label class="radio-inline"><input type="radio" name="optradio" id = "radio0"><span id = "radiobut0"></span></label>
                                    <label class="radio-inline"><input type="radio" name="optradio" id = "radio1"><span id = "radiobut1"></span></label>
                                </div>
                            </div>
                            <div class="col-md-2">Shipping:</div>
                            <div class="col-md-2" id="shipping"></div>
                        </div>
                        <hr>
                        <div class = "row">
                            <div class = "col-md-8"></div>
                            <div class="col-md-2">Grand Total:</div>
                            <div class="col-md-2" id="grandtotal"></div>
                        </div>
   
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="subbutton" class="btn btn-primary">Order</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                    </form>    
                
                    </div>
                </div>
            </div>
        </div>
        <!--fav panel-->
        <div class="panel panel-primary">
            <!--fav images-->

            <div class="panel-heading">
                <h3 class="panel-title">Favorite Images</h3>
            </div>
            <div class="panel-body">
                <?php displayFavourites('image'); ?>
            </div>

            <div class="panel-heading">
                <h3 class="panel-title">Favorite Posts</h3>
            </div>

            <div class="panel-body">
                <?php displayFavourites('post'); ?>
            </div>
        </div>
        <!--end panel-->

    </main>
    <script src="js/printFavfunctions.js" type='text/javascript' language= 'javascript'></script>
    <!--footer-->
    <?php include 'includes/footer.inc.php'; ?>
     <script>
        var jsonData;
    $(document).ready(function() {
        $.get("print-services.php")
    
        $(".favPrints img").mouseenter(function(e){
            var data = jsonData;
            var source=$(this).attr('src');
            var srcAlt=$(this).attr('alt');
            var newSrc = source.replace("small","medium");
            var frameVal=parseFloat($(this.parentNode.parentNode.parentNode).find(".frame").val());
            
            
            horiz=e.pageX-10;
            vert=e.pageY+10;
            bColor = data.frame[frameVal].color;
            bWidth = data.frame[frameVal].border;
            
            $(this.parentNode).append('<div id="preview"><img src="'+newSrc+'" alt="'+srcAlt+'"></div>');
            $("#preview img").css("border-style", "solid");
            $("#preview img").css("border-width", bWidth);
            $("#preview img").css("border-color", bColor);
            $("#preview img").css("width", "auto");
            $("#preview img").css("position", "fixed");
            
        });
        $(".favPrints img").mouseleave(function(e) {
            $("#preview").remove();
        })
        $(".favPrints img").mousemove(function(e){
            horiz=e.pageX-10;
            vert=e.pageY+10;
            $("#preview img").css({top: vert, left: horiz, display: "block"});
        })
        
        $("#modalform").on("submit",function(e) {
            var sArray = []; //sizes
            var pArray = []; //paper
            var fArray = []; //frames
            var qArray = []; //quantity
            
            for(var i=1;(i<=$(".favPrints").length);i++) {
                sArray[i-1] = ("size"+i+"="+$("#sizes"+i).val());
                pArray[i-1] = ("paper"+i+"="+$("#stock"+i).val());
                fArray[i-1] = ("frame"+i+"="+$("#frame"+i).val());
                qArray[i-1] = ("qty"+i+"="+$("#quantity"+i).val());
            }
            
           /* var formMod = $("#modalform").attr("action");
            for(var i=1;(i<=$(".favPrints").length);i++) {
                formMod += (sArray[i-1]+"&"+pArray[i-1]+"&"+fArray[i-1]+"&"+qArray[i-1]+"&");
            }
            $("#modalform").attr("action", formMod);*/
            var formMod = $("#modalform").attr("action");
            formMod += $("#modalform").serialize();
            $("#modalform").attr("action", formMod);

            console.log( $("#modalform").attr("action"));
            
//            console.log("formMod: "+formMod);
//            console.log("grabbing: "+$("#modalform").attr("action"));
        });
    });
    </script>
    

    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>

</html>