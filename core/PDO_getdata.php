<?php 
require_once("PDO_connect.php");
class connect_two extends connect_one{
    
    function connect_getdata($com){
        $this->connect_mysql($com);
        $row=$this->result->fetchAll(PDO::FETCH_ASSOC);
        return $row;
        
    }
}


?>