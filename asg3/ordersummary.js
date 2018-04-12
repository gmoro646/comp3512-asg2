

function updateOrders() {

    let childCount = ($(".favPrints").length);
  

    $.get("print-services.php", function(data) {

        for (let i = 1; i <=childCount ; i++) {
            let orderRow = $("#favPrints" + i);
           
            let paper =($("#stock"+i).html());
            let size = orderRow.find("#sizes"+i).html();
            let frame = orderRow.find("#frame"+i).html();

            $("#sizes"+i).html(data.sizes[size].name);
            $("#stock"+i).html(data.stock[paper].name);
            $("#frame"+i).html(data.frame[frame].name);
        
            //orderRow.removeClass(".ordernum");
        }
    }); //end get




}
updateOrders();
