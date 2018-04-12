{"filter":false,"title":"fillforms.js","tooltip":"/asg3/fillforms.js","undoManager":{"mark":50,"position":50,"stack":[[{"start":{"row":0,"column":0},"end":{"row":116,"column":0},"action":"remove","lines":["var jsonData;","$(document).ready(function() {","    $.get(\"print-services.php\")","",".done (function(data){","    jsonData = data;","    $('.sizes').each(function(index, value){","       generateOptions(data.sizes, $(this));","    });","       $('.stock').each(function(index, value){","       generateOptions(data.stock, $(this)); ","    });","       $('.frame').each(function(index, value){","       generateOptions(data.frame, $(this)); ","    });","   setRadios();","    ","    ","    ","    ","})",".fail(function(){","    ","    ","})",".always(function(data){","  ","    $(\".total\").html(setInitialPrice());","    $(\"#subtotal\").html(setInitialSubtotal());"," ","    ","    $('#myModal .favPrints').on('', function(e){","    //Gets Values on each Post Change","       var sizeVal=parseFloat($(this).find(\".sizes\").val());","       var paperVal=parseFloat($(this).find(\".stock\").val());  ","       var frameVal=parseFloat($(this).find(\".frame\").val());","       var qtyVal=parseFloat($(this).find(\".quantity\").val());","       var paperPrice = generatePapersize(data, sizeVal, paperVal);","     //Console log to check values","       /* console.log(sizeVal);","        console.log(paperVal);","        console.log(frameVal);","        console.log(qtyVal);","        console.log(paperPrice);*/","        ","     //calculates the total and pastes in html","     var total= (data.sizes[sizeVal].cost + paperPrice + data.frame[frameVal].costs[sizeVal]) * qtyVal;","       $(this).find(\".total\").html(total);","      /* console.log(total);*/","    });","    ","    $('#myModal .favPrints').on('change', function(e){","    //Gets Values on each Post Change","       var sizeVal=parseFloat($(this).find(\".sizes\").val());","       var paperVal=parseFloat($(this).find(\".stock\").val());  ","       var frameVal=parseFloat($(this).find(\".frame\").val());","       var qtyVal=parseFloat($(this).find(\".quantity\").val());","       var paperPrice = generatePapersize(data, sizeVal, paperVal);","     //Console log to check values","       /* console.log(sizeVal);","        console.log(paperVal);","        console.log(frameVal);","        console.log(qtyVal);","        console.log(paperPrice);*/","        ","     //calculates the total and pastes in html","     var total= (data.sizes[sizeVal].cost + paperPrice + data.frame[frameVal].costs[sizeVal]) * qtyVal;","       $(this).find(\".total\").html(total);","      /* console.log(total);*/","    });","    ","});","","function generateOptions(info, e){","console.log(info);",""," for (var i = 0; i < info.length; i++) {","    var opt = $('<option value='+info[i].id+'>'+info[i].name+'</option>').attr('name', info[i].name );","    opt.attr('id', info[i].id);","    e.append(opt);"," }","","};","","function generatePapersize(data, sizeVal, paperVal){","    if(sizeVal < 2)","            {","               var stockPrice = data.stock[paperVal].small_cost;","                console.log(\"stockPrice: \"+stockPrice);","                console.log(\"in small\");","            }","            else {","               var stockPrice = data.stock[paperVal].large_cost;","                console.log(\"stockPrice: \"+stockPrice);","                console.log(\"in large\");","            }","            return stockPrice;","         }","function setInitialPrice(){","    var data = jsonData;","     var defaulttotal=data.sizes[0].cost + data.stock[0].small_cost + data.frame[0].costs[0];","     return defaulttotal;","}","function setInitialSubtotal(){","     var defaultsub= $(\".favPrints\").length *  setInitialPrice();","     return defaultsub;","}         ","function setRadios(){","   var data= jsonData;","   for (let i = 0; i < data.shipping.length; i++) {","       ","       $('#radiobut'+i).html(data.shipping[i].name);","   ","}","}","});",""],"id":2},{"start":{"row":0,"column":0},"end":{"row":205,"column":0},"action":"insert","lines":["var jsonData;","$(document).ready(function() {","    $.get(\"print-services.php\")","",".done (function(data){","    jsonData = data;","    $('.sizes').each(function(index, value){","       generateOptions(data.sizes, $(this));","    });","       $('.stock').each(function(index, value){","       generateOptions(data.stock, $(this)); ","    });","       $('.frame').each(function(index, value){","       generateOptions(data.frame, $(this)); ","    });","   setRadios();","    ","    ","    ","    ","})",".fail(function(){","    ","    ","})",".always(function(data){","  ","    $(\".total\").html(setInitialPrice());","    $(\"#subtotal\").html(setInitialSubtotal());","    $(\"#shipping\").html(setInitialShipping());","    $(\"#grandtotal\").html(setInitialPrice()+setInitialSubtotal());","    $(\"#radio0\").prop(\"checked\", true);","    var items=0;","    "," ","    ","    $('#myModal .favPrints').on('change', function(e){","    //Gets Values on each Post Change","       var sizeVal=parseFloat($(this).find(\".sizes\").val());","       var paperVal=parseFloat($(this).find(\".stock\").val());  ","       var frameVal=parseFloat($(this).find(\".frame\").val());","       var qtyVal=parseFloat($(this).find(\".quantity\").val());","       var paperPrice = generatePaperCost(data, sizeVal, paperVal);","       $(\"#subtotal\").html(updateSubtotal());","       //var framecount = calculateFrameQuant(frameVal); ","       var framecount1 = calculateFrameQuant1(frameVal, qtyVal); ","     //Console log to check values","        // console.log(\"size val=\"+sizeVal);","        // console.log(\"paper val=\"+paperVal);","        // console.log(\"frame val=\"+frameVal);","        // console.log(\"quantity val=\"+qtyVal);","        // console.log(\"paper price=\"+paperPrice);","        ","     //calculates the total and pastes in html","     var total= (data.sizes[sizeVal].cost + paperPrice + data.frame[frameVal].costs[sizeVal]) * qtyVal;","       $(this).find(\".total\").html(total);","      /* console.log(total);*/","    });","    ","$('#myModal .radio').on('change', function(e){","    ","    ","    ","    var shippingPrice = updateShipping(updateSubtotal());","    ","    });","    ","}); ","","function generateOptions(info, e){","console.log(info);",""," for (var i = 0; i < info.length; i++) {","    var opt = $('<option value='+info[i].id+'>'+info[i].name+'</option>').attr('name', info[i].name );","    opt.attr('id', info[i].id);","    e.append(opt);"," }","","};","","function generatePaperCost(data, sizeVal, paperVal){","    if(sizeVal < 2)","            {","               var stockPrice = data.stock[paperVal].small_cost;","                console.log(\"stockPrice: \"+stockPrice);","                console.log(\"in small\");","            }","            else {","               var stockPrice = data.stock[paperVal].large_cost;","                console.log(\"stockPrice: \"+stockPrice);","                console.log(\"in large\");","            }","            return stockPrice;","         }","function setInitialPrice(){","    var data = jsonData;","     var defaulttotal=data.sizes[0].cost + data.stock[0].small_cost + data.frame[0].costs[0];","     return defaulttotal;","}","function setInitialSubtotal(){","     var defaultsub= $(\".favPrints\").length *  setInitialPrice();","     return defaultsub;","} ","function setInitialShipping(){","    var data = jsonData;","     var defaultshipping= data.shipping[0].rules.none;","     return defaultshipping;","} ","function setRadios(){","   var data= jsonData;","   for (let i = 0; i < data.shipping.length; i++) {","       ","       $('#radiobut'+i).html(data.shipping[i].name);","   ","}","}","function updateSubtotal(){","    var subtotal = 0;","    $('.total').each(function () { ","    var a = $(this).text();","    subtotal += parseFloat(a);","    //console.log(\"Subtotal Print\");","    });","  return subtotal;  ","}","","function calculateFrameQuant(frameVal, qtyVal){","    var data=jsonData;","    var frameitems=0;","    var frameqty=0;","    var totalframes = 0;","    $(\".frame\").each(function(){","        if($(this).val()>0){ ","            frameitems++ ","            console.log( frameitems+\" frame item before quantity\");","        }","    });","     $(\".quantity\").each(function(){","        if($(this).val()>1) { ","            frameqty=frameqty+$(this).val();","            console.log(\"Frame Qty Where Frames are Selected = \"+frameqty); ","        }","    });","    totalframes = (frameitems * frameqty);","    console.log(\"Total Frame Items:\"+totalframes);","    ","}","function calculateFrameQuant1(frameVal, qtyVal){","   //maybe try grabbing the quantity items, and only increasing the counter if the FrameVal is > 0.","   //pretty sure this is the solution. Verify Tomorrow","    var frameitems=0;","    var frameqty=0;","    var totalframes = 0;","    $(\".favPrints\").each(function(){","        console.log(\"frame val=\"+frameVal);","        console.log(\"quantity val=\"+qtyVal);","        if(frameVal>0) ","            frameitems+frameVal; ","            console.log( frameitems+\" frame item before quantity\");","            frameqty+frameVal;","            //frameqty++;","            });","            console.log( frameqty+\" number of frames\");"," ","    totalframes = (frameitems * frameqty);","    console.log(\"Total Frame Items:\"+totalframes);","    ","}","","","","","","function updateShipping(subtotal){","    var data= jsonData;","    var shipping = 0;","    var isChecked0 = $('#radio0').prop(\"checked\");","    var isChecked1 = $('#radio1').prop(\"checked\");","    var standardFreeName = data.freeThresholds[0].name;","    var standardThresh = data.freeThresholds[0].amount; ","    var ExpressFreeName = data.freeThresholds[1].name;","    var ExpressThresh = data.freeThresholds[1].amount;","    console.log(\"standard name = \"+ standardFreeName);","    console.log(\"standard thresh = \"+ standardThresh);","    console.log(\"express name = \"+ ExpressFreeName);","    console.log(\"standard name = \"+ ExpressThresh);","   ","//   if (subtotal < )a","   ","   ","    if (isChecked0 === true)","    {","        console.log(\"Button 1 is Pressed\");","    }","    else if (isChecked1 === true)","    {","        console.log(\"Button 2 is Pressed\");","    }","    ","}","function updateGT(){","    ","}","","});",""]}],[{"start":{"row":43,"column":45},"end":{"row":44,"column":0},"action":"insert","lines":["",""],"id":3},{"start":{"row":44,"column":0},"end":{"row":44,"column":7},"action":"insert","lines":["       "]},{"start":{"row":44,"column":7},"end":{"row":44,"column":8},"action":"insert","lines":["v"]}],[{"start":{"row":44,"column":7},"end":{"row":44,"column":8},"action":"remove","lines":["v"],"id":4}],[{"start":{"row":44,"column":7},"end":{"row":44,"column":8},"action":"insert","lines":["v"],"id":5},{"start":{"row":44,"column":8},"end":{"row":44,"column":9},"action":"insert","lines":["a"]},{"start":{"row":44,"column":9},"end":{"row":44,"column":10},"action":"insert","lines":["r"]}],[{"start":{"row":44,"column":10},"end":{"row":44,"column":11},"action":"insert","lines":[" "],"id":6},{"start":{"row":44,"column":11},"end":{"row":44,"column":12},"action":"insert","lines":["s"]},{"start":{"row":44,"column":12},"end":{"row":44,"column":13},"action":"insert","lines":["g"]},{"start":{"row":44,"column":13},"end":{"row":44,"column":14},"action":"insert","lines":["i"]}],[{"start":{"row":44,"column":13},"end":{"row":44,"column":14},"action":"remove","lines":["i"],"id":7},{"start":{"row":44,"column":12},"end":{"row":44,"column":13},"action":"remove","lines":["g"]}],[{"start":{"row":44,"column":12},"end":{"row":44,"column":13},"action":"insert","lines":["h"],"id":8},{"start":{"row":44,"column":13},"end":{"row":44,"column":14},"action":"insert","lines":["i"]},{"start":{"row":44,"column":14},"end":{"row":44,"column":15},"action":"insert","lines":["p"]},{"start":{"row":44,"column":15},"end":{"row":44,"column":16},"action":"insert","lines":["i"]},{"start":{"row":44,"column":16},"end":{"row":44,"column":17},"action":"insert","lines":["n"]}],[{"start":{"row":44,"column":16},"end":{"row":44,"column":17},"action":"remove","lines":["n"],"id":9},{"start":{"row":44,"column":15},"end":{"row":44,"column":16},"action":"remove","lines":["i"]}],[{"start":{"row":44,"column":15},"end":{"row":44,"column":16},"action":"insert","lines":["p"],"id":10},{"start":{"row":44,"column":16},"end":{"row":44,"column":17},"action":"insert","lines":["i"]},{"start":{"row":44,"column":17},"end":{"row":44,"column":18},"action":"insert","lines":["n"]},{"start":{"row":44,"column":18},"end":{"row":44,"column":19},"action":"insert","lines":["g"]}],[{"start":{"row":44,"column":19},"end":{"row":44,"column":20},"action":"insert","lines":[" "],"id":11}],[{"start":{"row":44,"column":19},"end":{"row":44,"column":20},"action":"remove","lines":[" "],"id":12}],[{"start":{"row":44,"column":19},"end":{"row":44,"column":20},"action":"insert","lines":["="],"id":13},{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"insert","lines":["$"]}],[{"start":{"row":44,"column":21},"end":{"row":44,"column":23},"action":"insert","lines":["()"],"id":14}],[{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"insert","lines":["."],"id":15},{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"insert","lines":["s"]}],[{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"remove","lines":["s"],"id":16},{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"remove","lines":["."]}],[{"start":{"row":44,"column":22},"end":{"row":44,"column":24},"action":"insert","lines":["\"\""],"id":17}],[{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"insert","lines":["s"],"id":18}],[{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"remove","lines":["s"],"id":19},{"start":{"row":44,"column":22},"end":{"row":44,"column":24},"action":"remove","lines":["\"\""]}],[{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"insert","lines":["t"],"id":20},{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"insert","lines":["h"]},{"start":{"row":44,"column":24},"end":{"row":44,"column":25},"action":"insert","lines":["i"]}],[{"start":{"row":44,"column":24},"end":{"row":44,"column":25},"action":"remove","lines":["i"],"id":21},{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"remove","lines":["h"]},{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"remove","lines":["t"]}],[{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"insert","lines":["$"],"id":22}],[{"start":{"row":44,"column":23},"end":{"row":44,"column":25},"action":"insert","lines":["()"],"id":23}],[{"start":{"row":44,"column":24},"end":{"row":44,"column":25},"action":"insert","lines":["t"],"id":24},{"start":{"row":44,"column":25},"end":{"row":44,"column":26},"action":"insert","lines":["h"]},{"start":{"row":44,"column":26},"end":{"row":44,"column":27},"action":"insert","lines":["i"]},{"start":{"row":44,"column":27},"end":{"row":44,"column":28},"action":"insert","lines":["s"]},{"start":{"row":44,"column":28},"end":{"row":44,"column":29},"action":"insert","lines":["."]}],[{"start":{"row":44,"column":28},"end":{"row":44,"column":29},"action":"remove","lines":["."],"id":25}],[{"start":{"row":44,"column":28},"end":{"row":44,"column":29},"action":"remove","lines":[")"],"id":26}],[{"start":{"row":44,"column":29},"end":{"row":44,"column":30},"action":"insert","lines":["."],"id":27},{"start":{"row":44,"column":30},"end":{"row":44,"column":31},"action":"insert","lines":["f"]},{"start":{"row":44,"column":31},"end":{"row":44,"column":32},"action":"insert","lines":["u"]},{"start":{"row":44,"column":32},"end":{"row":44,"column":33},"action":"insert","lines":["b"]},{"start":{"row":44,"column":33},"end":{"row":44,"column":34},"action":"insert","lines":["d"]}],[{"start":{"row":44,"column":33},"end":{"row":44,"column":34},"action":"remove","lines":["d"],"id":28},{"start":{"row":44,"column":32},"end":{"row":44,"column":33},"action":"remove","lines":["b"]},{"start":{"row":44,"column":31},"end":{"row":44,"column":32},"action":"remove","lines":["u"]}],[{"start":{"row":44,"column":31},"end":{"row":44,"column":32},"action":"insert","lines":["i"],"id":29},{"start":{"row":44,"column":32},"end":{"row":44,"column":33},"action":"insert","lines":["n"]},{"start":{"row":44,"column":33},"end":{"row":44,"column":34},"action":"insert","lines":["s"]}],[{"start":{"row":44,"column":33},"end":{"row":44,"column":34},"action":"remove","lines":["s"],"id":30}],[{"start":{"row":44,"column":33},"end":{"row":44,"column":34},"action":"insert","lines":["d"],"id":31}],[{"start":{"row":44,"column":30},"end":{"row":44,"column":34},"action":"remove","lines":["find"],"id":32},{"start":{"row":44,"column":30},"end":{"row":44,"column":36},"action":"insert","lines":["find()"]}],[{"start":{"row":44,"column":35},"end":{"row":44,"column":37},"action":"insert","lines":["\"\""],"id":33}],[{"start":{"row":44,"column":36},"end":{"row":44,"column":37},"action":"insert","lines":["."],"id":34},{"start":{"row":44,"column":37},"end":{"row":44,"column":38},"action":"insert","lines":["a"]}],[{"start":{"row":44,"column":37},"end":{"row":44,"column":38},"action":"remove","lines":["a"],"id":35}],[{"start":{"row":44,"column":37},"end":{"row":44,"column":38},"action":"insert","lines":["s"],"id":36},{"start":{"row":44,"column":38},"end":{"row":44,"column":39},"action":"insert","lines":["h"]},{"start":{"row":44,"column":39},"end":{"row":44,"column":40},"action":"insert","lines":["i"]},{"start":{"row":44,"column":40},"end":{"row":44,"column":41},"action":"insert","lines":["p"]},{"start":{"row":44,"column":41},"end":{"row":44,"column":42},"action":"insert","lines":["p"]},{"start":{"row":44,"column":42},"end":{"row":44,"column":43},"action":"insert","lines":["i"]},{"start":{"row":44,"column":43},"end":{"row":44,"column":44},"action":"insert","lines":["n"]},{"start":{"row":44,"column":44},"end":{"row":44,"column":45},"action":"insert","lines":["f"]}],[{"start":{"row":44,"column":44},"end":{"row":44,"column":45},"action":"remove","lines":["f"],"id":37}],[{"start":{"row":44,"column":44},"end":{"row":44,"column":45},"action":"insert","lines":["g"],"id":38}],[{"start":{"row":44,"column":47},"end":{"row":44,"column":48},"action":"insert","lines":[";"],"id":39}],[{"start":{"row":44,"column":48},"end":{"row":45,"column":0},"action":"insert","lines":["",""],"id":40},{"start":{"row":45,"column":0},"end":{"row":45,"column":7},"action":"insert","lines":["       "]},{"start":{"row":45,"column":7},"end":{"row":45,"column":8},"action":"insert","lines":["c"]},{"start":{"row":45,"column":8},"end":{"row":45,"column":9},"action":"insert","lines":["o"]},{"start":{"row":45,"column":9},"end":{"row":45,"column":10},"action":"insert","lines":["n"]},{"start":{"row":45,"column":10},"end":{"row":45,"column":11},"action":"insert","lines":["s"]}],[{"start":{"row":45,"column":11},"end":{"row":45,"column":12},"action":"insert","lines":["o"],"id":41},{"start":{"row":45,"column":12},"end":{"row":45,"column":13},"action":"insert","lines":["l"]},{"start":{"row":45,"column":13},"end":{"row":45,"column":14},"action":"insert","lines":["e"]}],[{"start":{"row":44,"column":47},"end":{"row":44,"column":48},"action":"insert","lines":["."],"id":42},{"start":{"row":44,"column":48},"end":{"row":44,"column":49},"action":"insert","lines":["e"]}],[{"start":{"row":44,"column":48},"end":{"row":44,"column":49},"action":"remove","lines":["e"],"id":43}],[{"start":{"row":44,"column":48},"end":{"row":44,"column":49},"action":"insert","lines":["t"],"id":44},{"start":{"row":44,"column":49},"end":{"row":44,"column":50},"action":"insert","lines":["e"]}],[{"start":{"row":44,"column":48},"end":{"row":44,"column":50},"action":"remove","lines":["te"],"id":45},{"start":{"row":44,"column":48},"end":{"row":44,"column":54},"action":"insert","lines":["text()"]}],[{"start":{"row":44,"column":20},"end":{"row":44,"column":21},"action":"remove","lines":["$"],"id":46}],[{"start":{"row":44,"column":46},"end":{"row":45,"column":14},"action":"remove","lines":[".text();","       console"],"id":47}],[{"start":{"row":44,"column":46},"end":{"row":44,"column":47},"action":"insert","lines":[")"],"id":48},{"start":{"row":44,"column":47},"end":{"row":44,"column":48},"action":"insert","lines":["."]},{"start":{"row":44,"column":48},"end":{"row":44,"column":49},"action":"insert","lines":[";"]}],[{"start":{"row":44,"column":48},"end":{"row":44,"column":49},"action":"remove","lines":[";"],"id":49},{"start":{"row":44,"column":47},"end":{"row":44,"column":48},"action":"remove","lines":["."]}],[{"start":{"row":44,"column":47},"end":{"row":44,"column":48},"action":"insert","lines":[";"],"id":50}],[{"start":{"row":44,"column":48},"end":{"row":45,"column":0},"action":"insert","lines":["",""],"id":51},{"start":{"row":45,"column":0},"end":{"row":45,"column":7},"action":"insert","lines":["       "]},{"start":{"row":45,"column":7},"end":{"row":45,"column":8},"action":"insert","lines":["c"]},{"start":{"row":45,"column":8},"end":{"row":45,"column":9},"action":"insert","lines":["o"]},{"start":{"row":45,"column":9},"end":{"row":45,"column":10},"action":"insert","lines":["n"]},{"start":{"row":45,"column":10},"end":{"row":45,"column":11},"action":"insert","lines":["s"]},{"start":{"row":45,"column":11},"end":{"row":45,"column":12},"action":"insert","lines":["o"]},{"start":{"row":45,"column":12},"end":{"row":45,"column":13},"action":"insert","lines":["l"]},{"start":{"row":45,"column":13},"end":{"row":45,"column":14},"action":"insert","lines":["e"]},{"start":{"row":45,"column":14},"end":{"row":45,"column":15},"action":"insert","lines":["."]},{"start":{"row":45,"column":15},"end":{"row":45,"column":16},"action":"insert","lines":[","]}],[{"start":{"row":45,"column":15},"end":{"row":45,"column":16},"action":"remove","lines":[","],"id":52}]]},"ace":{"folds":[],"scrolltop":180,"scrollleft":0,"selection":{"start":{"row":47,"column":65},"end":{"row":48,"column":2},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":12,"state":"start","mode":"ace/mode/javascript"}},"timestamp":1523477965504,"hash":"abcbd1fe089a48c6ac3506152c8dad9cbe05c2b2"}