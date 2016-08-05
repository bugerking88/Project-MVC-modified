<?php
class connect_one{
        protected $result;
        protected $Link;
        function connect_mysql($com){
        $db=new PDO("mysql:host=localhost;dbname=MyDB;port=3306","root","");
        $db->exec("set names utf8");
        $this->result=$db->query($com);
        }
        
        function insertAndgetLastId($com){
        $db=new PDO("mysql:host=localhost;dbname=MyDB;port=3306","root","");
        $db->exec("set names utf8");
        $db->query($com);
        $this->result=$db->lastInsertId();
        }
        
        function selectResult()
        {
                return $this->result;
        }
        
}
        
?> 