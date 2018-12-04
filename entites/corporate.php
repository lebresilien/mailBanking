<?php

class corporate {
    
    private $id;private $nom;private $AccountID;private $branch;
    private $phone;private $status = 1;private $email;
    
    public function getAccountID(){
        return $this->AccountID;
    }
    
    public function getNom(){
        return $this->nom;
    }

    public function getEmail(){
        return $this->email;
    }
    
    public function getPhone(){
        return $this->phone;
    }
   
    public function getStatus(){
        return $this->status;
    }

    public function getId(){
        return $this->id;
    }

    public function getBranch(){
        return $this->branch;
    }
   
    
    public function setAccountID($account){
        $this->AccountID = $account;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setPhone($phone){
        $this->phone = $phone;
    }
    public function setStatus($status){
        $this->status = $status;
    }
     public function setId($id){
        $this->id = $id;
    }
    public function setBranch($branch){
        $this->branch = $branch;
    }
    public function setEmail($mail){
        $this->email = $mail;
    }
    
}

?>
