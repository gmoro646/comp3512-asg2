<?php

print_r($_POST['username']);
if (isset($_POST['username']) && isset($_POST['psw'])) {
    echo "inside if1";
    function cred($connection){
    try {
        $db = new LoginGateway($connection);
        $result=$db->getAuthValues($_POST['username']);//functionCall
        print_r($result);
    }
    catch(Exception $e) {
        die($e->getMessage());
    }


 
    if (($_POST['username'] == $user) && ($enc_pwd == $password)) {  
        echo "inside if2";
        if (isset($_POST['rememberme'])) {
            /* Set cookie to last 1 year */
            echo "inside remember me";
            setcookie('username', $_POST['username'], time()+60*60*24*365);
            setcookie('password', md5($_POST['psw']), time()+60*60*24*365);
        
        } else {
            /* Cookie expires when browser closes */
            echo "inside not remembered";
            setcookie('username', $_POST['username'], 0);
            setcookie('password', md5($_POST['password']), 0);
        }
        header('Location: /user-home.php');
        
    } else {
        echo 'Username/Password Invalid';
    }
    
    
} else {
    echo 'You must supply a username and password.';
}



?>