<?php 
$jsonData= file_get_contents('js/printRules.json');
//$decoded= json_decode($jsonData,true);
header ('Content-Type: application/json');
echo($jsonData);
?>