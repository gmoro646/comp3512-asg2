<?php
    class LoginGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }

    protected function getSelectStatement(){
        return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin";
    }

    protected function getOrderFields() {
        return 'UserName';
    }
 
    protected function getPrimaryKeyName() {
        return "UserID";
    }
    
    public function getUserInfos() {
        $sql="Select * from Users inner join UsersLogin on Users.UserID=UsersLogin.UserID";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
   
   public function getAuthValues($Username) {
        $sql = "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin WHERE UserName =:Username";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':UserName' => $Username));
        return $statement->fetchAll();
    }
    
   public function getUsersPosts()
   {
        $sql = "select Path,ImageID from ImageDetails where UserID='UserName' order by Path;";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
?>