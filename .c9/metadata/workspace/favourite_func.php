{"changed":true,"filter":false,"title":"favourite_func.php","tooltip":"/favourite_func.php","value":"\n<?php\nfunction addToFavoriteList($type, $title, $img, $id) {\n\n    if ($type == \"post\") {\n\n        if (isset($_SESSION['favPosts'])) {\n\n            $array = $_SESSION[\"favPosts\"];\n\n            if (!array_key_exists($id, $arr)) {\n\n                $array[$id] = [$title, $img];\n\n                $_SESSION['favPosts'] = $array;\n\n            }\n\n        } else {\n            $array = array();\n\n            $array[$id] = [$title, $img];\n\n            $_SESSION['favPosts'] = $array;\n        }\n\n\n    } else if ($type == \"image\") {\n\n        if (isset($_SESSION['favImages'])) {\n\n            $array = $_SESSION[\"favImages\"];\n\n            if (!array_key_exists($id, $array)) {\n                $array[$id] = [$title, $img];\n\n                $_SESSION['favImages'] = $array;\n\n            }\n\n        } else {\n            $array = array();\n\n            $array[$id] = [$title, $img];\n\n            $_SESSION['favImages'] = $array;\n        }\n\n    }\n\n\n}\n\n\n\nfunction removeFromFavorites($type, $id) {\n\n    if ($type == \"post\") {\n        $array = $_SESSION['favPosts'];\n        if (array_key_exists($id, $array)) {\n            unset($array[$id]);\n            $_SESSION['favPosts'] = $array;\n        }\n    } else if ($type == \"image\") {\n        $array = $_SESSION['favImages'];\n        if (array_key_exists($id, $array)) {\n            unset($array[$id]);\n            $_SESSION['favImages'] = $array;\n        }\n    }\n}\n\n\n\nfunction removeAllFavouritelList() {\n    unset($_SESSION[\"favPosts\"]);\n    unset($_SESSION[\"favImages\"]);\n}\n\n\n\nfunction displayFavourites($type) {\n\n    if ($type == \"post\") {\n        if (isset($_SESSION[\"favPosts\"])) {\n\n            $favourite_posts = $_SESSION[\"favPosts\"];\n            foreach($favourite_posts as $key => $value) {\n                echo '<div class=\"media\"> <\n                    div class = \"media-left\" >\n                    <\n                    a href = \"single-post.php?id=' . $key . '\" > < img class = \"media-object\"\n                src = \"images/square-small/' . $value[1] . '\"\n                alt = \"' . $value[0] . '\" > < /a> <\n                    /div> <\n                    div class = \"media-body\" >\n                    <\n                    h2 class = \"media-heading\" > ' . $value[0] . ' < /h2> <\n                    a href = \"set-fav.php?action=rmPost&pId='.$key.'\" > < p > remove < /p></a >\n                    <\n                    /div> <\n                    /div>';\n            }\n        }\n    } else if ($type == \"image\") {\n        if (isset($_SESSION[\"favImages\"])) {\n\n            $favImages = $_SESSION[\"favImages\"];\n            foreach($favImages as $key => $value) {\n                echo '<div class=\"media\"> <\n                    div class = \"media-left\" >\n                    <\n                    a href = \"single-image.php?id=' . $key . '\" > < img class = \"media-object\"\n                src = \"images/square-small/' . $value[1] . '\"\n                alt = \"' . $value[0] . '\" > < /a> <\n                    /div> <\n                    div class = \"media-body\" >\n                    <\n                    h2 class = \"media-heading\" > ' . $value[0] . ' < /h2> <\n                    a href = \"set-fav.php?action=rmImg&imgId='.$key.'\" > < p > remove < /p></a >\n                    <\n                    /div> <\n                    /div>';\n            }\n\n        }\n    }\n\n}\n?>","undoManager":{"mark":30,"position":34,"stack":[[{"start":{"row":0,"column":0},"end":{"row":126,"column":1},"action":"insert","lines":["function addToFav($type, $title, $img, $id) {","","    if ($type == \"post\") {","","        if (isset($_SESSION['favPosts'])) {","","            $arr = $_SESSION[\"favPosts\"];","","            if (!array_key_exists($id, $arr)) {","","                $arr[$id] = [$title, $img];","","                $_SESSION['favPosts'] = $arr;","","            }","","        } else {","            $arr = array();","","            $arr[$id] = [$title, $img];","","            $_SESSION['favPosts'] = $arr;","        }","","","    } else if ($type == \"image\") {","","        if (isset($_SESSION['favImages'])) {","","            $arr = $_SESSION[\"favImages\"];","","            if (!array_key_exists($id, $arr)) {","                $arr[$id] = [$title, $img];","","                $_SESSION['favImages'] = $arr;","","            }","","        } else {","            $arr = array();","","            $arr[$id] = [$title, $img];","","            $_SESSION['favImages'] = $arr;","        }","","    }","","","}","","","","function removeFromFav($type, $id) {","","    if ($type == \"post\") {","        $array = $_SESSION['favPosts'];","        if (array_key_exists($id, $array)) {","            unset($array[$id]);","            $_SESSION['favPosts'] = $array;","        }","    } else if ($type == \"image\") {","        $array = $_SESSION['favImages'];","        if (array_key_exists($id, $array)) {","            unset($array[$id]);","            $_SESSION['favImages'] = $array;","        }","    }","}","","","","function removeAllFav() {","    unset($_SESSION[\"favPosts\"]);","    unset($_SESSION[\"favImages\"]);","}","","","","function displayFav($type) {","","    if ($type == \"post\") {","        if (isset($_SESSION[\"favPosts\"])) {","","            $favPosts = $_SESSION[\"favPosts\"];","            foreach($favPosts as $key => $value) {","                echo '<div class=\"media\"> <","                    div class = \"media-left\" >","                    <","                    a href = \"single-post.php?id=' . $key . '\" > < img class = \"media-object\"","                src = \"images/square-small/' . $value[1] . '\"","                alt = \"' . $value[0] . '\" > < /a> <","                    /div> <","                    div class = \"media-body\" >","                    <","                    h2 class = \"media-heading\" > ' . $value[0] . ' < /h2> <","                    a href = \"set-fav.php?action=rmPost&pId='.$key.'\" > < p > remove < /p></a >","                    <","                    /div> <","                    /div>';","            }","        }","    } else if ($type == \"image\") {","        if (isset($_SESSION[\"favImages\"])) {","","            $favImages = $_SESSION[\"favImages\"];","            foreach($favImages as $key => $value) {","                echo '<div class=\"media\"> <","                    div class = \"media-left\" >","                    <","                    a href = \"single-image.php?id=' . $key . '\" > < img class = \"media-object\"","                src = \"images/square-small/' . $value[1] . '\"","                alt = \"' . $value[0] . '\" > < /a> <","                    /div> <","                    div class = \"media-body\" >","                    <","                    h2 class = \"media-heading\" > ' . $value[0] . ' < /h2> <","                    a href = \"set-fav.php?action=rmImg&imgId='.$key.'\" > < p > remove < /p></a >","                    <","                    /div> <","                    /div>';","            }","","        }","    }","","}"],"id":2}],[{"start":{"row":6,"column":16},"end":{"row":6,"column":17},"action":"insert","lines":["a"],"id":3},{"start":{"row":6,"column":17},"end":{"row":6,"column":18},"action":"insert","lines":["y"]}],[{"start":{"row":10,"column":20},"end":{"row":10,"column":21},"action":"insert","lines":["a"],"id":4},{"start":{"row":10,"column":21},"end":{"row":10,"column":22},"action":"insert","lines":["y"]}],[{"start":{"row":12,"column":44},"end":{"row":12,"column":45},"action":"insert","lines":["a"],"id":5},{"start":{"row":12,"column":45},"end":{"row":12,"column":46},"action":"insert","lines":["y"]}],[{"start":{"row":17,"column":16},"end":{"row":17,"column":17},"action":"insert","lines":["a"],"id":6},{"start":{"row":17,"column":17},"end":{"row":17,"column":18},"action":"insert","lines":["y"]}],[{"start":{"row":19,"column":16},"end":{"row":19,"column":17},"action":"insert","lines":["a"],"id":7},{"start":{"row":19,"column":17},"end":{"row":19,"column":18},"action":"insert","lines":["y"]}],[{"start":{"row":21,"column":40},"end":{"row":21,"column":41},"action":"insert","lines":["a"],"id":8},{"start":{"row":21,"column":41},"end":{"row":21,"column":42},"action":"insert","lines":["y"]}],[{"start":{"row":29,"column":16},"end":{"row":29,"column":17},"action":"insert","lines":["a"],"id":9},{"start":{"row":29,"column":17},"end":{"row":29,"column":18},"action":"insert","lines":["y"]}],[{"start":{"row":31,"column":43},"end":{"row":31,"column":44},"action":"insert","lines":["a"],"id":10},{"start":{"row":31,"column":44},"end":{"row":31,"column":45},"action":"insert","lines":["y"]}],[{"start":{"row":32,"column":20},"end":{"row":32,"column":21},"action":"insert","lines":["a"],"id":11},{"start":{"row":32,"column":21},"end":{"row":32,"column":22},"action":"insert","lines":["y"]}],[{"start":{"row":34,"column":45},"end":{"row":34,"column":46},"action":"insert","lines":["a"],"id":12},{"start":{"row":34,"column":46},"end":{"row":34,"column":47},"action":"insert","lines":["y"]}],[{"start":{"row":39,"column":16},"end":{"row":39,"column":17},"action":"insert","lines":["a"],"id":13},{"start":{"row":39,"column":17},"end":{"row":39,"column":18},"action":"insert","lines":["y"]}],[{"start":{"row":41,"column":16},"end":{"row":41,"column":17},"action":"insert","lines":["a"],"id":14},{"start":{"row":41,"column":17},"end":{"row":41,"column":18},"action":"insert","lines":["y"]}],[{"start":{"row":43,"column":41},"end":{"row":43,"column":42},"action":"insert","lines":["a"],"id":15},{"start":{"row":43,"column":42},"end":{"row":43,"column":43},"action":"insert","lines":["y"]}],[{"start":{"row":0,"column":0},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":16}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"insert","lines":["<"],"id":17},{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"insert","lines":["?"]},{"start":{"row":0,"column":2},"end":{"row":0,"column":3},"action":"insert","lines":["p"]},{"start":{"row":0,"column":3},"end":{"row":0,"column":4},"action":"insert","lines":["h"]},{"start":{"row":0,"column":4},"end":{"row":0,"column":5},"action":"insert","lines":["p"]}],[{"start":{"row":127,"column":1},"end":{"row":128,"column":0},"action":"insert","lines":["",""],"id":18},{"start":{"row":128,"column":0},"end":{"row":128,"column":1},"action":"insert","lines":["?"]},{"start":{"row":128,"column":1},"end":{"row":128,"column":2},"action":"insert","lines":[">"]}],[{"start":{"row":85,"column":12},"end":{"row":85,"column":21},"action":"remove","lines":["$favPosts"],"id":19},{"start":{"row":85,"column":12},"end":{"row":85,"column":28},"action":"insert","lines":["$favourite_posts"]},{"start":{"row":86,"column":20},"end":{"row":86,"column":29},"action":"remove","lines":["$favPosts"]},{"start":{"row":86,"column":20},"end":{"row":86,"column":36},"action":"insert","lines":["$favourite_posts"]}],[{"start":{"row":1,"column":17},"end":{"row":1,"column":18},"action":"insert","lines":["o"],"id":20},{"start":{"row":1,"column":18},"end":{"row":1,"column":19},"action":"insert","lines":["r"]},{"start":{"row":1,"column":19},"end":{"row":1,"column":20},"action":"insert","lines":["i"]},{"start":{"row":1,"column":20},"end":{"row":1,"column":21},"action":"insert","lines":["t"]},{"start":{"row":1,"column":21},"end":{"row":1,"column":22},"action":"insert","lines":["e"]},{"start":{"row":1,"column":22},"end":{"row":1,"column":23},"action":"insert","lines":["L"]},{"start":{"row":1,"column":23},"end":{"row":1,"column":24},"action":"insert","lines":["i"]},{"start":{"row":1,"column":24},"end":{"row":1,"column":25},"action":"insert","lines":["s"]},{"start":{"row":1,"column":25},"end":{"row":1,"column":26},"action":"insert","lines":["t"]}],[{"start":{"row":54,"column":22},"end":{"row":54,"column":23},"action":"insert","lines":["o"],"id":21},{"start":{"row":54,"column":23},"end":{"row":54,"column":24},"action":"insert","lines":["i"]}],[{"start":{"row":54,"column":23},"end":{"row":54,"column":24},"action":"remove","lines":["i"],"id":22}],[{"start":{"row":54,"column":23},"end":{"row":54,"column":24},"action":"insert","lines":["r"],"id":23},{"start":{"row":54,"column":24},"end":{"row":54,"column":25},"action":"insert","lines":["i"]},{"start":{"row":54,"column":25},"end":{"row":54,"column":26},"action":"insert","lines":["t"]},{"start":{"row":54,"column":26},"end":{"row":54,"column":27},"action":"insert","lines":["e"]},{"start":{"row":54,"column":27},"end":{"row":54,"column":28},"action":"insert","lines":["s"]}],[{"start":{"row":73,"column":20},"end":{"row":73,"column":21},"action":"remove","lines":["v"],"id":24},{"start":{"row":73,"column":19},"end":{"row":73,"column":20},"action":"remove","lines":["a"]},{"start":{"row":73,"column":18},"end":{"row":73,"column":19},"action":"remove","lines":["F"]}],[{"start":{"row":73,"column":18},"end":{"row":73,"column":19},"action":"insert","lines":["f"],"id":25},{"start":{"row":73,"column":19},"end":{"row":73,"column":20},"action":"insert","lines":["a"]},{"start":{"row":73,"column":20},"end":{"row":73,"column":21},"action":"insert","lines":["v"]}],[{"start":{"row":73,"column":20},"end":{"row":73,"column":21},"action":"remove","lines":["v"],"id":26},{"start":{"row":73,"column":19},"end":{"row":73,"column":20},"action":"remove","lines":["a"]},{"start":{"row":73,"column":18},"end":{"row":73,"column":19},"action":"remove","lines":["f"]}],[{"start":{"row":73,"column":18},"end":{"row":73,"column":19},"action":"insert","lines":["F"],"id":27},{"start":{"row":73,"column":19},"end":{"row":73,"column":20},"action":"insert","lines":["a"]},{"start":{"row":73,"column":20},"end":{"row":73,"column":21},"action":"insert","lines":["v"]},{"start":{"row":73,"column":21},"end":{"row":73,"column":22},"action":"insert","lines":["o"]},{"start":{"row":73,"column":22},"end":{"row":73,"column":23},"action":"insert","lines":["u"]},{"start":{"row":73,"column":23},"end":{"row":73,"column":24},"action":"insert","lines":["r"]},{"start":{"row":73,"column":24},"end":{"row":73,"column":25},"action":"insert","lines":["i"]},{"start":{"row":73,"column":25},"end":{"row":73,"column":26},"action":"insert","lines":["t"]},{"start":{"row":73,"column":26},"end":{"row":73,"column":27},"action":"insert","lines":["e"]}],[{"start":{"row":73,"column":27},"end":{"row":73,"column":28},"action":"insert","lines":["l"],"id":28},{"start":{"row":73,"column":28},"end":{"row":73,"column":29},"action":"insert","lines":["i"]},{"start":{"row":73,"column":29},"end":{"row":73,"column":30},"action":"insert","lines":["t"]}],[{"start":{"row":73,"column":29},"end":{"row":73,"column":30},"action":"remove","lines":["t"],"id":29},{"start":{"row":73,"column":28},"end":{"row":73,"column":29},"action":"remove","lines":["i"]}],[{"start":{"row":73,"column":28},"end":{"row":73,"column":29},"action":"insert","lines":["L"],"id":30},{"start":{"row":73,"column":29},"end":{"row":73,"column":30},"action":"insert","lines":["i"]},{"start":{"row":73,"column":30},"end":{"row":73,"column":31},"action":"insert","lines":["s"]},{"start":{"row":73,"column":31},"end":{"row":73,"column":32},"action":"insert","lines":["t"]}],[{"start":{"row":80,"column":19},"end":{"row":80,"column":20},"action":"insert","lines":["o"],"id":31},{"start":{"row":80,"column":20},"end":{"row":80,"column":21},"action":"insert","lines":["u"]},{"start":{"row":80,"column":21},"end":{"row":80,"column":22},"action":"insert","lines":["r"]},{"start":{"row":80,"column":22},"end":{"row":80,"column":23},"action":"insert","lines":["i"]},{"start":{"row":80,"column":23},"end":{"row":80,"column":24},"action":"insert","lines":["t"]},{"start":{"row":80,"column":24},"end":{"row":80,"column":25},"action":"insert","lines":["e"]}],[{"start":{"row":80,"column":25},"end":{"row":80,"column":26},"action":"insert","lines":["s"],"id":32}],[{"start":{"row":0,"column":0},"end":{"row":1,"column":0},"action":"insert","lines":["",""],"id":33}],[{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"insert","lines":["/"],"id":34},{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"insert","lines":["/"]}],[{"start":{"row":0,"column":2},"end":{"row":0,"column":3},"action":"insert","lines":[" "],"id":35},{"start":{"row":0,"column":3},"end":{"row":0,"column":4},"action":"insert","lines":["i"]},{"start":{"row":0,"column":4},"end":{"row":0,"column":5},"action":"insert","lines":["m"]}],[{"start":{"row":0,"column":4},"end":{"row":0,"column":5},"action":"remove","lines":["m"],"id":36},{"start":{"row":0,"column":3},"end":{"row":0,"column":4},"action":"remove","lines":["i"]},{"start":{"row":0,"column":2},"end":{"row":0,"column":3},"action":"remove","lines":[" "]},{"start":{"row":0,"column":1},"end":{"row":0,"column":2},"action":"remove","lines":["/"]},{"start":{"row":0,"column":0},"end":{"row":0,"column":1},"action":"remove","lines":["/"]}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":0,"column":0},"end":{"row":0,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1522030185500}