<?php
class connect_one{
        protected $result;
        protected $Link;
        function connect_mysql($com){
               //資料庫設定
                //資料庫位置
                $db_server = "localhost";
                //資料庫名稱
                $db_name = "MyDB";
                //資料庫管理者帳號
                $db_user = "root";
                //資料庫管理者密碼
                $db_passwd = "";
                
                //對資料庫連線
                $this->Link = mysql_connect($db_server, $db_user, $db_passwd) or die("無法對資料庫連線");
                //資料庫連線採UTF8
                $this->result = mysql_query("SET NAMES utf8",$this->Link);
                mysql_selectdb($db_name, $this->Link);
                $this->result = mysql_query($com,$this->Link);   
                
        }
        function selectResult()
        {
                return $this->result;
        }
        
}
        
?> 