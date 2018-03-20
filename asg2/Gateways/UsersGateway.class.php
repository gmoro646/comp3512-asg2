<?php
    class UsersGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }

    protected function getSelectStatement(){
        return "SELECT UserId, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM Users";
    }

    protected function getOrderFields() {
        return 'LastName, FirstName';
    }
 
    protected function getPrimaryKeyName() {
        return "UserID";
    }
    
    public function getFilteredUsers() {
         $sql = "select UserID, FirstName, LastName from Users order by LastName ASC";
         $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
         return $statement -> fetchAll();
    }
    
    public function getUserPictures($id) {
        $sql = 'select UserID,ImageID,Path from ImageDetails WHERE UserId =:id';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetchAll();
    }
    
    
   /* public function findById($id)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' .
      $this->getPrimaryKeyName() . '=:id';

      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
      return $statement->fetch();
   } */
}
?>