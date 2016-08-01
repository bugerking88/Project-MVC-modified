<?php 
include_once("mysql_connect.php");
class connect_two extends connect_one{
    
    function connect_getdata($com){
        
        $this->connect_mysql($com);
        $g = 0 ;
        while($tmp = mysql_fetch_assoc($this->result))
        {
            // $i = $g;
            
            $row[$g] = $tmp;
            
            $g = $g + 1;
        }
            return $row;
        
    }
}


?>