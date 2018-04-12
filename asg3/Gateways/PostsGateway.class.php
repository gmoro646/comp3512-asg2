<?php
class PostsGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }

    protected function getSelectStatement(){
        return "SELECT PostID, UserID, MainPostImage, Title, Message, PostTime FROM Posts";
    }

    protected function getOrderFields() {
        return 'Title';
    }
 
    protected function getPrimaryKeyName() {
        return "PostID";
    }
}
?>