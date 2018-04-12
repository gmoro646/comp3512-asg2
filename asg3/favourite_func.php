
<?php
function addToFavoriteList($type, $title, $img, $id) {

    if ($type == "post") {

        if (isset($_SESSION['favPosts'])) {

            $array = $_SESSION["favPosts"];

            if (!array_key_exists($id, $arr)) {

                $array[$id] = [$title, $img];

                $_SESSION['favPosts'] = $array;

            }

        } else {
            $array = array();

            $array[$id] = [$title, $img];

            $_SESSION['favPosts'] = $array;
        }


    } else if ($type == "image") {

        if (isset($_SESSION['favImages'])) {

            $array = $_SESSION["favImages"];

            if (!array_key_exists($id, $array)) {
                $array[$id] = [$title, $img];

                $_SESSION['favImages'] = $array;

            }

        } else {
            $array = array();

            $array[$id] = [$title, $img];

            $_SESSION['favImages'] = $array;
        }

    }


}



function removeFromFavorites($type, $id) {

    if ($type == "post") {
        $array = $_SESSION['favPosts'];
        if (array_key_exists($id, $array)) {
            unset($array[$id]);
            $_SESSION['favPosts'] = $array;
        }
    } else if ($type == "image") {
        $array = $_SESSION['favImages'];
        if (array_key_exists($id, $array)) {
            unset($array[$id]);
            $_SESSION['favImages'] = $array;
        }
    }
}



function removeAllFavouritelList() {
    unset($_SESSION["favPosts"]);
    unset($_SESSION["favImages"]);
}



function displayFavourites($type) {

    if ($type == "post") {
        if (isset($_SESSION["favPosts"])) {

            $favourite_posts = $_SESSION["favPosts"];
            foreach($favourite_posts as $key => $value) {
                echo '<div class="media"> <
                    div class = "media-left" >
                    <
                    a href = "single-post.php?id=' . $key . '" > < img class = "media-object"
                src = "images/square-small/' . $value[1] . '"
                alt = "' . $value[0] . '" > < /a> <
                    /div> <
                    div class = "media-body" >
                    <
                    h2 class = "media-heading" > ' . $value[0] . ' < /h2> <
                    a href = "set-fav.php?action=rmPost&pId='.$key.'" > < p > remove < /p></a >
                    <
                    /div> <
                    /div>';
            }
        }
    } else if ($type == "image") {
        if (isset($_SESSION["favImages"])) {

            $favImages = $_SESSION["favImages"];
            foreach($favImages as $key => $value) {
                echo '<div class="media"> <
                    div class = "media-left" >
                    <
                    a href = "single-image.php?id=' . $key . '" > < img class = "media-object"
                src = "images/square-small/' . $value[1] . '"
                alt = "' . $value[0] . '" > < /a> <
                    /div> <
                    div class = "media-body" >
                    <
                    h2 class = "media-heading" > ' . $value[0] . ' < /h2> <
                    a href = "set-fav.php?action=rmImg&imgId='.$key.'" > < p > remove < /p></a >
                    <
                    /div> <
                    /div>';
            }

        }
    }

}
?>