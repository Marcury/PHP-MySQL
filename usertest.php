<?php

include 'User.php';

//$user1 = new User('Imie', 'nazwisko imie', 'jakisemail@gmail.com', 'hasło');
//$user1->show();

    echo '<form method="get" action="usertest.php"><p>';
    echo 'Nazwa użytkownika: </br>'; echo '<input name="nazw" size="30"/><br/>';
    echo 'Hasło: </br>'; echo '<input name="haslo" size="30"/><br/>';
    echo 'Nazwisko i imię: </br>'; echo'<input name="pelnaNazwa" size="30"/></br>';
    echo 'Adres e-mail: </br>';  echo '<input name="email" size="30"/></br>';

    echo '<input type="reset"  value="Anuluj"/>';
    echo '<input type="submit" value="Rejestruj" name="Rejestruj"/>';
    echo '<input type="submit" value="Wyświetl" name="Wyswietl"/></p></form>';
    
  
    if(isset($_REQUEST['Rejestruj'])) {
        
       $user2= USER::checkForm($_GET['nazw'],$_GET['haslo'],$_GET['pelnaNazwa'],$_GET['email']);
        //$user2->show();  
       USER::addUser($_GET['nazw'],$_GET['haslo'],$_GET['pelnaNazwa'],$_GET['email']);
    }
    
    if(isset($_REQUEST['Wyswietl'])) {
       USER::getAllUsers();   
    }
?>