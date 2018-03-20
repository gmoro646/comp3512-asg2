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
    $sql = "select Path,Title,Description,ImageDetails.UserID,FirstName,LastName,ISO,CountryName,AsciiName 
            from ImageDetails 
            inner join Users on ImageDetails.UserID=Users.UserID 
            inner join Countries on ImageDetails.CountryCodeISO=Countries.ISO 
            inner join Cities on ImageDetails.CityCode=Cities.CityCode 
            where ImageID=?;";
    $statement=$pdo->prepare($sql);
    $statement->bindValue(1,$_GET["imgid"]);
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
                <div class="btn-group" role="group"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></button></div>
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
   // $statement->bindValue(1,$_GET["imgid"]);
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
 
   /* $sql='select PostID, Posts.UserID, Users.FirstName, Users.LastName, ImageDetails.Path, PostTime, Message, Posts.Title
        from Posts inner join Users on Posts.UserID=Users.UserID
        inner join ImageDetails on Posts.MainPostImage=ImageDetails.ImageID
        where PostID ="'.$post.'"';*/
        
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
    //print_r($code);
     $sql="select AsciiName,CountryCodeISO from Cities where CityCode = $code";
   
    $statement=$pdo->prepare($sql);
    //$statement->bindValue(1,$_GET["codes"]);
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
    $sql="select distinct AsciiName, ImageDetails.CountryCodeISO from Cities inner join ImageDetails on Cities.CountryCodeISO = ImageDetails.CountryCodeISO where ImageDetails.CountryCodeISO = '$id';";
    
    $statement=$pdo->prepare($sql);
    //$statement->bindValue(1,$_GET["codes"]);
    $statement->execute();
   
    while($row=$statement->fetch()) {
       
   $markers .='&markers=size:mid%7Ccolor:0x5bc0de%7Clabel:1%7C'.$row["AsciiName"].'';
   $alt =$row["CountryCodeISO"];
// print_r($markers);
    }
   //print_r($markers);
  // print_r($alt);
 echo($multimap.$markers.'%"'." alt=".'%"'."Google Map of ".$alt.'%"'.'>');
// / print_r($multimap.$markers$alt);
// '"'.""alt="."Google Map of".=.".$alt.'>');
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

    

/*
function get_uID($username,$pdo){
    
    $sql = "Select UserID from UsersLogin where UserName='$username'";
    //rint_r($sql);
    $statement= $pdo->prepare($sql);
//  $statement->bindValue(':userid', $_GET["id"]);
    $statement->execute();
    $row = $statement->fetch();

    if($statement->rowCount() > 0){
return($row['UserID']);     
    }
   
} 
   
function print_userLogin($userId,$pdo){

       $sql="Select * from Users where UserID='$userId'";
       $statement= $pdo->prepare($sql);
         $statement->execute();
        $row= $statement->fetch();
       echo '<h2> Welcome</h2>';
          echo '<h3>'.$row["FirstName"].' '.$row["LastName"].'</h3>';
          echo $row["Address"].'<p></p>'.
         $row["City"].' ,'.$row["Postal"].' ,'.$row["Country"].'<p></p>'.
         $row["Phone"].'<p></p>'.
         $row["Email"];       
       
       
   }
  */
  
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
    
    
    
     //$images=loadSmallPicture($pdo,$sql);
   // return $images;
}




/*function mainSearch($pdo){
    $continent=$_GET["continent"];
    $country=$_GET["country"];
    $city=$_GET["city"];
    $title=$_GET["title"];
    
    if(isset($continent) || isset($country) || isset($city) || isset($title)) && (($continent != "0") || ($country != "0") || ($city != "0") || (!empty($title)) {
     
            $sql="select ImageID,Path,Title,Description from ImageDetails where 
            ContinentCode like '%".$continent."%' and
            CountryCodeISO like '%".$country."%' and
            CityCode like '%".$city."%'and
            Title like '%".$title."%'";
  
    }*/

?>