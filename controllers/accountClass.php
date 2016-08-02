<?php
class Account{
    function __construct($id,$pw,$pw2,$telephone,$address,$other){
       $this->id=$id;
       $this->pw=$pw;
       $this->pw2=$pw2;
       $this->telephone=$telephone;
       $this->address=$address;
       $this->other=$other;
    }
    function update_finish($id,$pw,$telephone,$address,$other){
        $sql = "UPDATE `Member_Table` SET `password`='$pw', `telephone`='$telephone', `address`='$address', `other`='$other' where `username`='$id'";  
        $this->connect_mysql($sql);
        $checkError=$this->selectResult();//判斷有沒有INSERT成功
        return $checkError;
    }
        
}
?>