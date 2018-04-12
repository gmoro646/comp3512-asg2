var jsonData;
$(document).ready(function() {
    $.get("print-services.php")

.done (function(data){
    jsonData = data;
    $('.sizes').each(function(index, value){
       generateOptions(data.sizes, $(this));
    });
       $('.stock').each(function(index, value){
       generateOptions(data.stock, $(this)); 
    });
       $('.frame').each(function(index, value){
       generateOptions(data.frame, $(this)); 
    });
   setRadios();
    
    
    
    
})
.fail(function(){
    
    
})
.always(function(data){
  
    $(".total").html(setInitialPrice());
    $("#subtotal").html(setInitialSubtotal());
    $("#shipping").html(setInitialShipping());
    $("#grandtotal").html(updateGT());
    $("#radio0").prop("checked", true);
    var items=0;
    
 
    
    $('#myModal .favPrints').on('change', function(e){
    //Gets Values on each Post Change
       var sizeVal=parseFloat($(this).find(".sizes").val());
       var paperVal=parseFloat($(this).find(".stock").val());  
       var frameVal=parseFloat($(this).find(".frame").val());
       var qtyVal=parseFloat($(this).find(".quantity").val());
       var paperPrice = generatePaperCost(data, sizeVal, paperVal);
       var framecount1 = calculateFrameQuant(frameVal, qtyVal); 
        
     //calculates the total and pastes in html
     var total= (data.sizes[sizeVal].cost + paperPrice + data.frame[frameVal].costs[sizeVal]) * qtyVal;
       $(this).find(".total").html(total);
    });
    
$('#myModal').on('change', function(e){
    
    var shippingPrice = updateShipping(updateSubtotal(), calculateFrameQuant());
    $("#subtotal").html(updateSubtotal());
    $("#shipping").html(checkFreeShipping());
    $("#grandtotal").html(updateGT());
    
    });
    
}); 

function generateOptions(info, e){
// console.log(info);

 for (var i = 0; i < info.length; i++) {
    var opt = $('<option value='+info[i].id+'>'+info[i].name+'</option>').attr('name', info[i].name );
    opt.attr('id', info[i].id);
    e.append(opt);
 }

};

function generatePaperCost(data, sizeVal, paperVal){
    if(sizeVal < 2)
    {
       var stockPrice = data.stock[paperVal].small_cost;
    }
    else {
       var stockPrice = data.stock[paperVal].large_cost;
    }
    return stockPrice;
}
function setInitialPrice(){
    var data = jsonData;
     var defaulttotal=data.sizes[0].cost + data.stock[0].small_cost + data.frame[0].costs[0];
     return defaulttotal;
}
function setInitialSubtotal(){
     var defaultsub= $(".favPrints").length *  setInitialPrice();
     return defaultsub;
} 
function setInitialShipping(){
    var data = jsonData;
     var defaultshipping= data.shipping[0].rules.none;
     return defaultshipping;
} 
function setRadios(){
   var data= jsonData;
   for (let i = 0; i < data.shipping.length; i++) {
       
       $('#radiobut'+i).html(data.shipping[i].name);
   
    }
}
function updateSubtotal(){
    var subtotal = 0;
    $('.total').each(function () { 
    var a = $(this).text();
    subtotal += parseFloat(a);
    });
  return subtotal;  
}

function calculateFrameQuant(){
    var frameitems=0;
    var frameqty=0;
    $(".frame").each(function(index,value){
        var i =index +1;
        if($(this).val()>0){ 
             frameqty+= parseInt($("#quantity"+i).val());
        }
    });
    return frameqty;
}


function updateShipping(subtotal, frameqty){
    var data= jsonData;
    var shipping = 0;
    var isChecked0 = $('#radio0').prop("checked"); //standard
    var isChecked1 = $('#radio1').prop("checked"); //express
  

    if (isChecked0 === true)
    {
        if (frameqty == 0){
             shipping=parseFloat($("#shipping").html(data.shipping[0].rules.none).text());
        }
        else if ((frameqty<10)&&(frameqty>0)){
            shipping=parseFloat($("#shipping").html(data.shipping[0].rules.under10).text());
        }
        else if(frameqty >= 10){
            shipping=parseFloat($("#shipping").html(data.shipping[0].rules.over10).text());
        }
    }
    else if (isChecked1 === true)
    {
        if (frameqty == 0){
             shipping=parseFloat($("#shipping").html(data.shipping[1].rules.none).text());
        }
        else if ((frameqty<10)&&(frameqty>0)){
            shipping=parseFloat($("#shipping").html(data.shipping[1].rules.under10).text());
        }
        else if(frameqty >= 10){
            shipping=parseFloat($("#shipping").html(data.shipping[1].rules.over10).text());
        }
    }
}
function checkFreeShipping() {
    var data= jsonData;
    var standardFreeName = data.freeThresholds[0].name;
    var standardThresh = data.freeThresholds[0].amount; 
    var ExpressFreeName = data.freeThresholds[1].name;
    var ExpressThresh = data.freeThresholds[1].amount;
    var isChecked0 = $('#radio0').prop("checked"); //standard
    var isChecked1 = $('#radio1').prop("checked"); //express
    var subtotal = parseFloat($('#subtotal').text());
    
    if ((isChecked0 === true) && (subtotal >= standardThresh)){
        $('#shipping').html(0);
    }
    
    if((isChecked1 === true) && (subtotal >= ExpressThresh)){
         $('#shipping').html(0);
    }
}

function updateGT(){
    
    var shipping = parseFloat($('#shipping').text());
    var subtotal = parseFloat($('#subtotal').text());
    var total = 0;
    
    total = subtotal+shipping;
    return total;
}

});
