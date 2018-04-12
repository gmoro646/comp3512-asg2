<?php
    class CitiesGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }

    protected function getSelectStatement(){
        return "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone FROM Cities";
    }

    protected function getOrderFields() {
        return 'AsciiName';
    }
 
    protected function getPrimaryKeyName() {
        return "CityCode";
    }
    
    public function getFilteredCities() {
         $sql="select Cities.CityCode,AsciiName from Cities inner join ImageDetails on Cities.CityCode=ImageDetails.CityCode group by CityCode order by AsciiName";
         $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
         return $statement -> fetchAll();
    }
    
    public function getCityPicture($id) {
        $sql = "select CityCode,ImageID,Path from ImageDetails WHERE CityCode =:id";
        $statement = DatabaseHelper::runQuery($this->connection, $sql,  Array(':id' => $id));
        return $statement->fetchAll();
    }
}
?>