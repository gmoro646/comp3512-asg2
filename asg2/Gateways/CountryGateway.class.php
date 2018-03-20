<?php
    class CountryGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }

    protected function getSelectStatement(){
        return "SELECT ISO, ISONumeric, CountryName, Capital, Countries.CityCode, Area, Population,
                Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages
                Neighbours, CountryDescription FROM Countries";
    }

    protected function getOrderFields() {
        return 'CountryName';
    }
 
    protected function getPrimaryKeyName() {
        return "ISO";
    }
    
    public function getFilteredCountry() {
        $sql= "select ISO,CountryName from Countries inner join ImageDetails on ISO=ImageDetails.CountryCodeISO group by CountryName ASC";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function getCountryPic($id) {
        $sql = "select CountryCodeISO,ImageID,Path from ImageDetails WHERE CountryCodeISO =:id";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetchAll();
    }
        public function getCoordinate($id) {
        $sql = "select Latitude, Longitude from ImageDetails WHERE CountryCodeISO =:id";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetchAll();
    }
    
}
?>