<?php

class User {
    const STATUS_User = 1;
    const STATUS_Admin = 2;
    private $userName;
    private $passwd;
    private $fullName;
    private $email;
    private $data;
    private $status;
    
    public function __construct($userName, $fullName, $email, $passwd)
    {
        $this->status=USER::STATUS_User;
        $this->userName=$userName;
        $this->fullname=$fullName;
        $this->email=$email;
        $this->passwd=$passwd;
        $this->data=date("Y-m-d");
    }
    
    public function show()
    {
        echo 'Nazwa użytkownika: '; echo $this->userName; echo'</br>';
        echo 'Imie i Nazwisko: '; echo $this->fullname; echo'</br>';
        echo 'email: '; echo $this->email; echo'</br>';
        echo 'Hasło: '; echo $this->passwd; echo'</br>';
        echo 'Data: '; echo $this->data; 
    }   
    static function checkForm($userName,$passwd,$fullName,$email)
    {
       // $this->userName=$userName;
       // $this->fullname=$fullName;
       // $this->email=$email;
      //  $this->passwd=$passwd;
       $ile=0;
        
       $sprawdzNazwisko=array("options"=>array("regexp"=>"/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$/"));
       $sprawdzUser = array("options"=>array("regexp"=>"/^[a-zA-Z0-9]+$/"));
            
        
        if(filter_var($userName,FILTER_VALIDATE_REGEXP,$sprawdzUser)){$ile++; }
        else echo'Zła nazwa użytkownika';
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {$ile++;}
        else echo 'Podany Zły email!';
        
        if(filter_var($fullName,FILTER_VALIDATE_REGEXP,$sprawdzNazwisko)) {$ile++;}
        else echo'Złe Imie i nazwisko!';
        
        if(strlen($passwd)>8) {$ile++;}
        else echo " haslo jest zbyt krótkie";
        
        if($ile==4)
        {
            $user = new User($userName, $fullName, $email, $passwd);
            return $user;
        }
        else { echo'BŁĘDNE DANE!'; return null; }
        
        
        
    }
    static function getAllUsers()
    {
        $allUsers = simplexml_load_file('users.xml');
        echo "<ul>";
        foreach ($allUsers as $user):
            $userName = $user->username;
            $date = $user->date;
            echo "<li>$userName,$date</li>";
        endforeach;
        echo "</ul>";
    }
    
    static function addUser($userName,$passwd,$fullName,$email)
    {
        $xml = simplexml_load_file('users.xml');

        $xmlCopy = $xml->addChild("user");
        $xmlCopy->addChild("username", $userName);
        $xmlCopy->addChild("passwd",  $passwd);
        $xmlCopy->addChild("fullname", $fullName);
        $xmlCopy->addChild("email",$email);
        $xmlCopy->addChild("date", $data=date("Y-m-d"));
        $xmlCopy->addChild("status",$status=USER::STATUS_User);
        $xml->asXML('users.xml');
    }

}
?>