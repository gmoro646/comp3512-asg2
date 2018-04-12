<?php
class ImagesGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement(){
        return "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, Path FROM ImageDetails";
    }

    protected function getOrderFields() {
        return 'Title';
    }
 
    protected function getPrimaryKeyName() {
        return "ImageID";
    }
    
}
?>