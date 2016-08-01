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
        
}
?>