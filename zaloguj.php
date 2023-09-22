<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $username=$_POST['username'];
    // $password=$_POST['password'];
   
    if (empty($_POST["username"])) {
        echo "Login jest wymagany.";
      } else {
        $username = $_POST["username"];
        header("Location: index.php");
      }
    if (empty($_POST["password"])) {
        echo "</br>"."Hasło jest wymagane.";
      } else {
        $password = $_POST["password"];
        header("Location: index.php");
      }
    
    // if ($username=$_POST['username'] && $password=$_POST['password']) {
    //     // Jeśli dane są poprawne, przenieś użytkownika do innej strony (np. panelu użytkownika)
    //     header("Location: index.php");
    //     exit;
    // } else {
    //     // Jeśli dane są niepoprawne, wyświetl komunikat błędu
    //     echo "Niepoprawna nazwa użytkownika lub hasło.";
    // }
}


?>