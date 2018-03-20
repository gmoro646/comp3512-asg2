<?php
class ContinentsGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }

    protected function getSelectStatement(){
        return "SELECT ContinentCode, ContinentName, GeoNameId FROM Continents";
    }

    protected function getOrderFields() {
        return 'ContinentName';
    }
 
    protected function getPrimaryKeyName() {
        return "ContinentCode";
    }
}
?>