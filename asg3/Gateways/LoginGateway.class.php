<?php
    class LoginGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    public function getUserLoginCheck(){
            return  "SELECT	* FROM UsersLogin WHERE Username=:user and Password=:pass";
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
        public function getTableName(){
            return 'UsersLogin';
        }
        public function getUsernameCheck(){
            return "SELECT	* FROM UsersLogin WHERE UserName=:id";
        }
   
   public function getAuthValues($Username,$password) {
        $sql = "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin WHERE UserName =:Username and  Password=:pass";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':UserName' => $Username,':Password'=>$password));
        return $statement->fetchAll();
    }
    
   public function getUsersPosts()
   {
        $sql = "select Path,ImageID from ImageDetails where UserID='UserName' order by Path;";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    
    public function retrieveRecords($sql,$id=null){
            if(count($id) >= 2){
                
                $statement = DatabaseHelper::runQuery($this->connection,$sql, $id);
                
            }
            else if(isset($id)){
                 $statement = DatabaseHelper::runQuery($this->connection,$sql, array(':id' => $id));
            }
            else{
               $statement = DatabaseHelper::runQuery($this->connection,$sql,null); 
            }
            
           return $statement->fetchAll();
        }
    }
    ?>