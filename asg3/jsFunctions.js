function dynamicSearch() {
    var srchBar,input,a;
    var ul = document.getElementById("imgList");
    var li = ul.getElementsByTagName('li');
    
    srchBar = document.getElementById("imgSrch");
    input = srchBar.value.toUpperCase();
    
    for(var i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if(a.innerHTML.toUpperCase().indexOf(input) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

function dynamicSelect() {
    document.forms["imgForm"].submit();
}


function setupMap() {
    var location = {lat: -25.363, lng: 131.044};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 4,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
}

function loginlogout() {
    
}