<?php 
include 'includes/config.php';

function cardStyle($img, $alt, $title, $desc, $redir, $linkDesc) {
echo'<div class="col-md-4">
        <div class="card">
            <img class="img-responsive" src="'.$img.'" alt="'.$alt.'">
            <div class="panel panel-default">
                <div class="list-group-item"><h3>'.$title.'</h3><p>'.$desc.'</p></div>
                <div class="list-group-item"><a href="'.$redir.'"><p>'.$linkDesc.'</p></a></div>
            </div>
        </div>
    </div>';
}

function genLinkCountry($connection) {
    try {
        $db = new CountryGateway($connection);
        $result=$db->getFilteredCountry();
        foreach($result as $row) {
            echo '<div class="col-md-3"><a href="single-country.php?id='.$row["ISO"].'">'.$row["CountryName"].'</a></div>';
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function genCityList($connection) {
  try {
    $db = new CitiesGateway($connection);
    $result=$db->getFilteredCities();
    foreach($result as $row) {
         echo '<div class="col-md-3"><a href="single-city.php?code='.$row["CityCode"].'">'.$row["AsciiName"].'</a></div>';
    }
}
catch(Exception $e) {
    die($e->getMessage());
}
}


function genUserList($connection) {
    try {
        $db = new UsersGateway($connection);
        $result=$db->getFilteredUsers();
        foreach($result as $row) {
            echo '<div class="col-md-3"><a href="single-user.php?id='.$row["UserID"].'">'.$row["FirstName"].' '.$row["LastName"].'</a></div>';
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function loadCityInfo($connection) {
    try {
    $id = $_GET["code"];
    $db = new CitiesGateway($connection);
    $row=$db->findById($id);
    
    echo '<h3>'.$row["AsciiName"].'</h3>';
        echo 'Latitude: <b>'.$row["Latitude"].'</b> <p></p>
              Longitude: <b>'.$row["Longitude"].'</b> <p></p>
              Population: <b>'.$row["Population"].'</b> <p></p>
              Elevation: <b>'.$row["Elevation"].'</b> meters above sea level<p></p>
              TimeZone: <b>'.$row["TimeZone"].'</b> <p></p>';
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function loadCityPic($connection) {
    try {
        $id = $_GET["code"];
        $db = new CitiesGateway($connection);
        $result=$db->getCityPicture($id);
        foreach($result as $row) {
            echo'<div class="col-md-1">
            <a href="single-image.php?imgid='.$row["ImageID"].'"><img class="img-responsive" src="images/square-small/'.$row["Path"].'" alt="Image"></a>
            </div>';
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function loadCountryInfo($connection) {
    try {
        $id = $_GET["id"];
        $db = new CountryGateway($connection);
        $row=$db->findById($id);
        
        echo '<h3>'.$row["CountryName"].'</h3>';
        echo'Capital: <b>'.$row["Capital"].'</b> <p></p>
             Area: <b>'.number_format($row["Area"]).'</b> sq km <p></p>
             Population: <b>'.number_format($row["Population"]).'</b> <p></p> 
             Currency Name: <b>'.$row["CurrencyName"].'</b> <p></p>
            '.$row["CountryDescription"];
        
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function loadUserPicture($connection) {
    try {
        $id = $_GET["id"];
        $db = new UsersGateway($connection);
        $result=$db->getUserPictures($id);
        foreach($result as $row) {
            echo '<div class="col-md-1">
        <a href="single-image.php?imgid='.$row["ImageID"].'"><img class="img-responsive" src="images/square-small/'.$row["Path"].'" alt="Image"></a>
        </div>';
        }
    }
    catch (Exception $e) {
        die($e->getMessage());
    }
}

function loadCountryPicture($connection) {
    try {
        $id=$_GET["id"];
        $db = new CountryGateway($connection);
        $result=$db->getCountryPic($id);
        foreach($result as $row) {
          echo '<div class="col-md-1">
        <a href="single-image.php?imgid='.$row["ImageID"].'"><img class="img-responsive" src="images/square-small/'.$row["Path"].'" alt="Image"></a>
        </div>';  
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function loadSingleImage($pdo) {
    $sql = "select ImageID,Path,Title,Description,ImageDetails.UserID,FirstName,LastName,ISO,CountryName,AsciiName 
            from ImageDetails 
            inner join Users on ImageDetails.UserID=Users.UserID 
            inner join Countries on ImageDetails.CountryCodeISO=Countries.ISO 
            inner join Cities on ImageDetails.CityCode=Cities.CityCode 
            where ImageID=?;";
    $statement=$pdo->prepare($sql);
    $statement->bindValue(1,$_GET["imgid"]);//this needs to be fixes. 
    $statement->execute();
        
    $row=$statement->fetch();
    if($statement->rowCount() > 0) {
    echo '<aside class="col-md-2">
            <div class="panel panel-info">
                <div class="panel-heading">Continents</div>
                <ul class="list-group">';
                loadSideCont($pdo);
    echo       '</ul>
            </div>
            <div class="panel panel-info">
            <div class="panel-heading">Popular</div>
                <ul class="list-group">';
                loadSideCountry($pdo);
    echo'       </ul>
            </div>
        </aside>';
    echo '<div class="col-md-6"><img class="img-responsive" src="images/medium/'.$row["Path"].'"alt="'.$row["Title"].'"><p>'.$row["Description"].'</p></div>';
    echo '<div class="col-md-4"><h2>'.$row["Title"].'</h2>
            <div class="panel panel-heading">
            <p>By:<a href=single-user.php?id='.$row["UserID"].'> '.$row["FirstName"].' '.$row["LastName"].'</a></p>
            <p>Country:<a href=single-country.php?id='.$row["ISO"].'> '.$row["CountryName"].'</a></p>
            <p>City: '.$row["AsciiName"].'</p>
            </div>
            
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
      
                <a href="favourites-setter.php?type=image&imgPath='.$row["Path"].'&imgTitle='.$row["Title"].'&imgId='.$_GET["imgid"].'" >
                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button>
                </a></div>
                <div class="btn-group" role="group"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save" aria-hidden="true"></span></button></div>
                <div class="btn-group" role="group"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button></div>
                <div class="btn-group" role="group"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></button></div>
            </div>
            <div id="map"></div>
  
        </div>';
        
    }
    else {
        header('Location:error.php');
    }
}

function loadUserInfo($connection) {
    try {
        $id = $_GET["id"];
        $db = new UsersGateway($connection);
        $result=$db->findById($id);
        
    echo '<h3>'.$result["FirstName"].' '.$result["LastName"].'</h3>';
    echo $result["Address"].'<p></p>'.
         $result["City"].' ,'.$result["Postal"].' ,'.$result["Country"].'<p></p>'.
         $result["Phone"].'<p></p>'.
         $result["Email"];
    }
    catch (Exception $e) {
        die($e->getMessage());
    }
}

function loadSideCont($connection) {
   
    try {
        $db = new ContinentsGateway($connection);
        $result=$db->findAll();
        foreach($result as $row) {
            echo '<div class="list-group-item"><a href="browse-images.php?continent='.$row["ContinentCode"].'">'.$row["ContinentName"].'</a></div>';
        }
    }
    catch(Exception $e) {
        die($e->getMessage());
    }
}

function loadSideCountry($connection) {
    try {
        $db = new CountryGateway($connection);
        $result=$db->getFilteredCountry();
        foreach ($result as $row) {
            echo '<div class="list-group-item"><a href="single-country.php?id='.$row["ISO"].'">'.$row["CountryName"].'</a></div>';
        }
    }
    catch (Exception $e) {
        die($e->getMessage());
    }
}

function getCoords($connection, $id) {
    try {
        $db = new CountryGateway($connection);
        $result=$db->getCoordinate($id);
    
            $maploc = array ($result["Latitude"], $result["Longitude"]);
            return $maploc;
    }
    catch (Exception $e) {
        die($e->getMessage());
    }
}

function loadContinentList($pdo) {
    $sql = "select ContinentName, Continents.ContinentCode from Continents inner join ImageDetails on Continents.ContinentCode=ImageDetails.ContinentCode group by ContinentName ASC;";
    $result=$pdo->query($sql);
    while($row=$result->fetch()) {
      echo '<option value='.$row["ContinentCode"].'>'.$row["ContinentName"].'</option>';
    }
}

function loadCountryList($pdo) {
    $sql="select ISO, CountryName from Countries inner join ImageDetails on ISO = ImageDetails.CountryCodeISO group by CountryName ASC;";
    $result=$pdo->query($sql);
    while($row=$result->fetch()) {
      echo '<option value='.$row["ISO"].'>'.$row["CountryName"].'</option>';
    }
}

function loadCityList($pdo) {
    
    $sql="select AsciiName, Cities.CityCode from Cities inner join ImageDetails on Cities.CityCode=ImageDetails.CityCode group by AsciiName ASC;";
    $result=$pdo->query($sql);
    while($row=$result->fetch()) {
        echo '<option value='.$row["CityCode"].'>'.$row["AsciiName"].'</option>';
    }
}

function clearButton() {
    if((isset($_GET["continent"]) && $_GET["continent"] != '0') || (isset($_GET["country"])&& $_GET["country"] != '0') || (isset($_GET["city"]) && $_GET["city"] != '0') || (isset($_GET["title"]) && $_GET["title"] != '')) {
        echo '<button type="submit" class="btn btn-success">Clear</button>';
    }
}


function filterPic($pdo) {
    if((isset($_GET["continent"]) && $_GET["continent"] != '0') || (isset($_GET["country"])&& $_GET["country"] != '0') || 
    (isset($_GET["city"]) && $_GET["city"] != '0') || (isset($_GET["title"]) && $_GET["title"] != '')) {
     
        $continent=$_GET["continent"];
        $country=$_GET["country"];
        $city=$_GET["city"];
        $title=$_GET["title"];
        
        if($continent != "0") {
            $sql="select ImageID,Path,Title,Description from ImageDetails where ContinentCode=\"".$continent."\"";
        }
        else if($country != "0") {
            $sql="select ImageID,Path,Title,Description from ImageDetails where CountryCodeISO=\"".$country."\"";
        }
        else if($city != "0") {
            $sql="select ImageID,Path,Title,Description from ImageDetails where CityCode=\"".$city."\"";
        }
        else if(isset($title) && !empty($title)) {
            $sql="select ImageID,Path,Title,Description from ImageDetails where Title like '%".$title."%'";
        }
        else {
            $sql="select ImageID,Path,Title,Description from ImageDetails";
        }
    }
    else {
      $sql="select ImageID,Path,Title,Description from ImageDetails";
    }
            
    $result=$pdo->query($sql);
    while($row=$result->fetch()) {
       echo '<li>
             <a href="single-image.php?imgid='.$row["ImageID"].'" class="img-responsive">
                <img src="images/square-medium/'.$row["Path"].'" alt="'.$row["Title"].'">
                <div class="caption">
                    <div class="blur"></div>
                    <div class="caption-text"><p>'.$row["Title"].'</p></div>
                </div>
            </a>
         </li>';
    }
}
    
function getPosts($pdo){
   
    
    $sql="select PostID, Posts.UserID, Users.FirstName, Users.LastName, ImageDetails.Path, PostTime, Message, Posts.Title
        from Posts inner join Users on Posts.UserID=Users.UserID
        inner join ImageDetails on Posts.MainPostImage=ImageDetails.ImageID";
    $statement=$pdo->prepare($sql);
    $statement->execute();
    
    if($statement->rowCount() > 0) {
        while($row=$statement->fetch()) {
 
        echo '<div class="row">';
                     echo "<div class=\"col-md-4\">";
      echo '<img src="images/medium/'.$row["Path"].'" alt= "'.$row["Title"].'" class="img-responsive">';
      echo '</div>';
      echo '<div class="col-md-8">'; 
      echo '<h2>'.$row["Title"].'</h2>';
      echo '<div class="details">';
      echo 'Posted by ';
      echo '<a href="single-user.php?id='.$row["UserID"].'">'.$row["FirstName"]. " ".$row["LastName"].'</a>';
      echo '<span class="pull-right"> <strong>'.substr($row["PostTime"],0,10).'</strong> </span>';
      echo '</div>';
      echo '<p class=\"excerpt\">'.substr($row["Message"],0,200).'...'.'</p>';
      echo '<p class="pull-right">';
      echo '<a href="single-post.php?id='.$row["PostID"].'"class="btn btn-primary btn-sm">Read more</a>';
      echo "</p>";
      echo "</div>";
      echo "</div>";
      echo "<hr>";
   
            }
    }
}

function getSinglePost($pdo, $post){
        
    $sql='select PostID, Posts.UserID, Users.FirstName, Users.LastName, ImageDetails.Path, PostTime, Message, Posts.Title
          from Posts inner join Users on Posts.UserID=Users.UserID
          inner join ImageDetails on Posts.MainPostImage=ImageDetails.ImageID
          where PostID="'.$post.'"';
    $statement=$pdo->prepare($sql);
    $statement->execute();
    $row=$statement->fetch();

                  echo '<div class="row">';
                     echo "<div class=\"col-md-4\">";
      echo '<img src="images/medium/'.$row["Path"].'" alt= "'.$row["Title"].'" class="img-responsive">';
      echo '</div>';
      echo '<div class="col-md-8">'; 
      echo '<h2>'.$row["Title"].'</h2>';
      echo '<div class="details">';
      echo 'Posted by ';
      echo '<a href="single-user.php?id='.$row["UserID"].'">'.$row["FirstName"]. " ".$row["LastName"].'</a>';
      echo '<span class="pull-right"><strong>'.substr($row["PostTime"],0,10).'</strong> </span>';
      echo '</div>';
      echo '<p class=\"excerpt\">'.$row["Message"].'...'.'</p>';
      echo "</div>";
      echo "</div>";
      
}

function loadSmallPostPic($pdo, $id) {
    $sql = "select Posts.UserID, Path, ImageID from Posts inner join ImageDetails on ImageDetails.UserID=Posts.UserID where PostId = $id order by Path;";
    
    $statement=$pdo->prepare($sql);
    $statement->execute();
    
    if($statement->rowCount() > 0) {
        while($row=$statement->fetch()) {
        echo '<div class="col-md-1">
        <a href="single-image.php?imgid='.$row["ImageID"].'"><img class="img-responsive" src="images/square-small/'.$row["Path"].'" alt="Image"></a>
        </div>';
        }
    }
}
function loadSideBar($pdo)
{
        echo '<aside class="col-md-2">
            <div class="panel panel-info">
                <div class="panel-heading">Continents</div>
                <ul class="list-group">';
                loadSideCont($pdo);
    echo       '</ul>
            </div>
            <div class="panel panel-info">
            <div class="panel-heading">Popular</div>
                <ul class="list-group">';
                loadSideCountry($pdo);
    echo'       </ul>
            </div>
        </aside>';
}

function generateStaticMap($pdo,$code){
     $sql="select AsciiName,CountryCodeISO from Cities where CityCode = $code";
   
    $statement=$pdo->prepare($sql);
    $statement->execute();
    $row=$statement->fetch();
    if($statement->rowCount() > 0) {
       
    
   echo'<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?autoscale=1&size=600x300&maptype=roadmap&key=AIzaSyBKchuPY8rlTwgFNGRiWP3aAYNx8I7529Q&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0x5bc0de%7Clabel:1%7C'.$row["AsciiName"].',+'.$row["CountryCodeISO"].'" alt="Google Map of '.$row["AsciiName"].', '.$row["CountryCodeISO"].'">';
    
    }  
}

function generateStaticCountryMap($pdo,$id){
    
    $markers = null;
    $alt = null;
    $multimap = '<img width="600" src="https://maps.googleapis.com/maps/api/staticmap?autoscale=1&size=600x300&maptype=roadmap&key=AIzaSyBKchuPY8rlTwgFNGRiWP3aAYNx8I7529Q&format=png&visual_refresh=true';
    $sql="select distinct AsciiName, ImageDetails.CountryCodeISO from Cities inner join ImageDetails on Cities.CityCode = ImageDetails.CityCode where ImageDetails.CountryCodeISO = '$id';";
    
    $statement=$pdo->prepare($sql);
    $statement->execute();
   
    while($row=$statement->fetch()) {
       
   $markers .='&markers=size:mid%7Ccolor:0x5bc0de%7Clabel:1%7C'.$row["AsciiName"].'';
   $alt =$row["CountryCodeISO"];
    }
 echo($multimap.$markers.'%"'." alt=".'%"'."Google Map of ".$alt.'%"'.'>');
}

function login3($connection){
    print_r($_POST['username']);
    try {
    $db = new LoginGateway($connection);
    $result=$db->getUserInfos();
    foreach($result as $row) {
      $user = $row["UserName"];
      $pass = $row["Password"];
    }
    
}
catch (Exception $e) {
    die($e->getMessage());
    }
}

function getUserNameInfo($connection){
     try {
    $db = new LoginGateway($connection);
    $result=$db->getUserInfos();
    foreach($result as $row) {
      $user = $row["UserName"];
      $pass = $row["Password"];
    }
     }
    catch(Exception $e) {
        die($e->getMessage());
    }
    

}
   function addToFavoriteList($type, $title, $img, $id) {

    if ($type == "post") {

        if (isset($_SESSION['favPosts'])) {

            $array = $_SESSION["favPosts"];

            if (!array_key_exists($id, $array)) {

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
            if(empty($array)) {
                unset($_SESSION['favImages']);
            }
            else {
                $_SESSION['favImages'] = $array;
            }
        }
    }
}



function removeAllFavourites() {
    unset($_SESSION["favPosts"]);
    unset($_SESSION["favImages"]);
}



function displayFavourites($type) {

    if ($type == "post") {
        if (isset($_SESSION["favPosts"])) {

            $favourite_posts = $_SESSION["favPosts"];
            foreach($favourite_posts as $key => $value) {

                 echo '<div class="media"> 
                    <div class = "media-left" >
                    <a href = "single-post.php?id='.$key.'" > 
                        <img class = "media-object" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'" >
                    </a>
                    </div> 
                <div class = "media-body" >
                    <h4 class = "media-heading">'.$value[0].'</h4>
                    <a href="favourites-setter.php?action=rmPost&pId='.$key.'" > 
                    <button type="button" class="btn btn-default"> Remove </button>
                    </a>
                </div> 
            </div>';
            }
        }
    } else if ($type == "image") {
        if (isset($_SESSION["favImages"])) {

            $favImages = $_SESSION["favImages"];
            foreach($favImages as $key => $value) {
             echo '<div class="media"> 
                    <div class = "media-left" >
                    <a href = "single-image.php?imgid='.$key.'" > 
                        <img class = "media-object" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'" >
                    </a>
                    </div> 
                <div class = "media-body" >
                    <h4 class = "media-heading">'.$value[0].'</h4>
                    <a href="favourites-setter.php?action=rmImg&imgId='.$key.'" > 
                    <button type="button" class="btn btn-default"> Remove </button>
                    </a>
                </div> 
            </div>';
            }

        }
    }

}
  
function displayImagesUser($connection){
     try {
    $db = new LoginGateway($connection);
    $result=$db->getUserPosts();
    foreach($result as $row) {
  echo '<div class="col-md-1">
        <a href="single-image.php?imgid='.$row["ImageID"].'"><img class="img-responsive" src="images/square-small/'.$row["Path"].'" alt="Image"></a>
        </div>';
      }
    }
    catch (Exception $e) {
        die($e->getMessage());
    }
}
function getUserCreds($connection){
     try {
    $db = new LoginGateway($connection);
    echo $_POST['username'];
    $result=$db->getAuthValues();
   return result;
}
catch (Exception $e) {
    die($e->getMessage());
}
}

function printSmallImageID($result,$id,$link)
{
$id='ImageID';
$link='single-image.php?id=';
    foreach ($result as $key => $row) {
        
        $num = $row[$id];
        echo '<div class="col-md-4 singleCountryImg" id='.$num.'>';
        echo '<a href = "' . $link . '' . $num . '">';
        echo '<img src ="/images/square-small/'. $row['Path'] .'" class="img-responsive single-image" alt = "'.$row['Title'].'" name = "'.$row['Path'].'">';
        echo '</a>';
        echo '</div>';
    }
    
}



function getSinglePost2($pdo, $post){
        
    $sql='select PostID, Posts.UserID, Users.FirstName, Users.LastName, ImageDetails.Path, PostTime, Message, Posts.Title
          from Posts inner join Users on Posts.UserID=Users.UserID
          inner join ImageDetails on Posts.MainPostImage=ImageDetails.ImageID
          where PostID="'.$post.'"';
    $statement=$pdo->prepare($sql);
    $statement->execute();
    $row=$statement->fetch();
            
    echo '<div class="row">
            <div class="col-md-4">
                <img src="images/medium/'.$row["Path"].'" alt="'.$row["Title"].'" class="img-responsive">
                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                    <div class="btn-group" role="group">
                        <a href="favourites-setter.php?type=post&postPath='.$row["Path"].'&postTitle='.$row["Title"].'&postId='.$row["PostID"].'" >
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Add to Favorites</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h2>'.$row["Title"].'</h2>
                <div class="details">
                    Posted by: <a href="single-user.php?id='.$row["UserID"].'">'.$row["FirstName"]. " ".$row["LastName"].'</a> 
                    <span class="pull-right"><strong>'.substr($row["PostTime"],0,10).'</strong> </span>
                </div>
                <p class=\"excerpt\">'.$row["Message"].'</p>
            </div>
        </div>';
}
function showPrintFavButton() {
    if(isset($_SESSION['favImages'])) {
        echo '<a><button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Print Favorites</button></a>';
    }
}

function changeLoginLogout() {
    if(isset($_SESSION['UserID'])) {
        echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
    }
    else {
        echo '<li><a href="logintest.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
    }
}

function displayPrintFavorites(){
    echo '<div class = "col-md-12">
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
                    </thead>';
                 $favImages = $_SESSION["favImages"];
            foreach($favImages as $key => $value) {
                echo'
                    <tbody>
                        <tr>
                            <td><a href = "single-image.php?imgid='.$key.'" > 
                        <img class = "media-object" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'" >
                    </a></td>
                            <td><select id="sizes">
                                </select></td>
                            <td><select id = "stock">
                                </select></td>
                                 <td><select id = "frame">
                                </select></td>
                            <td><input type=\'text\' name=\'quantity-id\'maxlength=\'3\' size=\'3\'></td>
                            <td>$100,000,000</td>
                        </tr>';
            }
            echo '</tbody>
                </table>
            </div>
        </div>';
        
       
      
     
}

function displayOrder() {


        if (isset($_SESSION["favImages"])) {

            $favImages = $_SESSION["favImages"];
            foreach($favImages as $key => $value) {
             echo 
                        '<div><img class = "media-object" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'" >

            </div>';
            }

        }
    }
    
    
function displayOrderPic() {

     echo' <div class="carousel-inner" role="listbox">';
      
              if (isset($_SESSION["favImages"])) {

            $favImages = $_SESSION["favImages"];
            foreach($favImages as $key => $value) {
             echo '<div class="carousel-item active">';
             echo '<img class = "d-block w-100" src = "images/square-small/'.$value[1].'" alt = "'.$value[0].'" >';
             echo '</div>';
            }

        }
}

    

  
?>