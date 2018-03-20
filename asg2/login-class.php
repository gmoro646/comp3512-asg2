
<?php 

class Log_in {
   
   protected  $username;
   protected  $password;
  
 function __construct($uname,$pwd){
   $this->username= uname;
   $this->password= pwd;
   
 }

    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }
    
    
    function Login()
{
    if(empty($_POST['username']))
    {
        $this->HandleError("UserName is empty!");
        return false;
    }
    
    if(empty($_POST['psw']))
    {
        $this->HandleError("Password is empty!");
        return false;
    }
    
    $username = trim($_POST['username']);
    $password = trim($_POST['psw']);
    
    if(!$this->CheckLoginInDB($username,$password))
    {
        return false;
    }
    
    session_start();
    
    $_SESSION[$this->GetLoginSessionVar()] = $username;
    
    return true;
}

function CheckLoginInDB($username,$password)
{
   /*
    if(!$this->DBLogin())
    {
        $this->HandleError("Database login failed!");
        return false;
    }  */
    
    $username = $this->SanitizeForSQL($username);
    printr(username);
    $pwdmd5 = md5($password);
    print_r(pwdmd5);
    $qry = "Select name, email from $this->tablename ".
        " where username='$username' and password='$pwdmd5' ".
        " and confirmcode='y'";

    $result = mysql_query($qry,$this->connection);
    
    if(!$result || mysql_num_rows($result) <= 0)
    {
        $this->HandleError("Error logging in. ".
            "The username or password does not match");
        return false;
    }
    return true;
}
function CheckLogin()
{
     session_start();

     $sessionvar = $this->GetLoginSessionVar();
     
     if(empty($_SESSION[$sessionvar]))
     {
        return false;
     }
     return true;
}

}