<?php
    session_start();
include 'includes/functions.php';
    
if(isset($_GET['action'])){    
    if($_GET['action']=="rmPost"){
        removeFromFavorites('post', $_GET['pId']);
    }
    else if ($_GET['action']=="rmImg") {
       removeFromFavorites('image', $_GET['imgId']);
    }
}
else if(isset($_GET['type'])){
    //call add to fav function with type, title, path and id
    if($_GET['type']=="image"){    
        addToFavoriteList('image',$_GET['imgTitle'], $_GET['imgPath'], $_GET['imgId']);
    }
    else if($_GET['type']=="post"){
         addToFavoriteList('post',$_GET['postTitle'], $_GET['postPath'], $_GET['postId']);
    }
}
else if(isset($_GET['rmAll'])){
    removeAllFavourites();   
}

    echo ($_SESSION['favImages']);
    header("Location: ".$_SERVER['HTTP_REFERER']);

?>