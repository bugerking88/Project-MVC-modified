<?php
class memberManager extends connect_two{
    var $id;
    var $pw;
    var $pw2;
    var $telephone;
    var $address;
    var $other;
    function __construct($user){
        $this->id=$user['id'];
        $this->pw=$user['pw'];
        $this->pw2=$user['pw2'];
        $this->telephone=$user['telephone'];
        $this->address=$user['address'];
        $this->other=$user['other'];
    }
	function isCurrent(){
	    return ($_SESSION['username'] != null && $this->pw != null && $this->pw2 != null && $this->pw == $this->pw2);
	}
	function update_finish(){
	    if($this -> isCurrent()){
        $sql = "UPDATE `Member_Table` SET `password`='{$this->pw}', `telephone`='{$this->telephone}', `address`='{$this->address}', `other`='{$this->other}' where `username`='{$this->id}'";  
        $this->connect_mysql($sql);
        return $this->selectResult();//判斷有沒有INSERT成功
	    }
	    return false;
    }
}
?>