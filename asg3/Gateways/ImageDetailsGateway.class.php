<?php
    class ImageDetailsGateway extends TableGateway{
        //constructor to instantiate object
        public function __construct($connection){
            parent::__construct($connection);
            
        }
       public function getOrderFields(){
           return "Title";
       }
        public function getPath(){
            return 'Path';
        }
        public function getPrimaryKeyName(){
            return 'ImageID';
        }
        public function getTableName(){
            return 'ImageDetails';
        }
        public function getDescription(){
            return 'Description';
        }
        public function getRightDetails(){
            return 'SELECT c.CityCode, c.AsciiName, i.ImageID,u.FirstName, u.LastName, coun.CountryName,coun.ISO, i.Title, u.UserID from Cities c, ImageDetails i, Users u, Countries coun where i.CityCode = c.CityCode and u.UserID = i.UserID and coun.ISO = i.CountryCodeISO and i.ImageID = :id';
        }
       public function getRating(){
           return 'Select avg(Rating) from ImageRating where ImageID = :id';
       }
 
    }
?>