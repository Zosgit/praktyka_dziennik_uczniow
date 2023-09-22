<?php
$username = "scott";                 
$password = "tiger";             
$database = "dev";   
$conn = oci_connect($username, $password, $database);

if(!$conn){ echo "Your Connection Has an error";}
else{echo "Your Connection is Successful </br>";}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dziennik uczniów</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        h1 {
            text-align: center;
            background-color:#f1f9fd;
            width:100%;
            height: 40px;
        }
        h3{
            text-align: center;
            width:100%;
        }
        label{
            font-size:20px;
        }
        .usuniecie{
            display: block;
            text-align: center;
            line-height: 150%;
            margin-bottom: 50px;
            font-size: 25px;
            width: 700px;  
            height: 370px;
            margin: 0 auto; 
            padding: 15px 0 0;
            background: #fff;
            border: 1px solid white;
            background: linear-gradient(to top right, #dbeffa , white );
            border-radius: 10px;
        }
        input[name="potwierdz"]{
            width: 275px;
            height: 50px;
            font-size: 20px;
            padding: 5px 13px;
            border: 1px solid #D6EAF8;
            color: #2C3E50;
            text-shadow: 0 0 1px black;
            background: white ;
            position: relative;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        input[name="potwierdz"]:hover, input[name="potwierdz"]:active {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        a:link, a:visited {
            margin-left:10px;
            font-size: 20px;
            padding: 12px 120px;
            border: 1px solid #D6EAF8;
            color: #2C3E50;
            text-decoration: none;
            text-shadow: 0 0 1px black;
            background: white ;
            position: relative;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        a:hover, a:active {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        input[name="usun"]{
            border: 1px solid black;
            padding: 10px, 20px;
            background-color: white;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        #usun:focus{
            outline: 3px solid #85C1E9 ;
        } 
       
    </style>
</head>
<body>
<h1>Dziennik uczniow</h1>
    </br>
<div class="usuniecie">
<form  action="usun2.php?id=<?=$_GET['id']?>"  name="usun" method="post">  
    <?php

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM DZIENNIK_UCZNIOW_LZ WHERE id = :id";
        $stmt = oci_parse($conn, $sql);
        oci_bind_by_name($stmt, ":id", $id);
        $execute = oci_execute($stmt);
            
        if ($execute) {
            $row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC);
            if ($row) {
                echo "<h3>Czy na pewno chcesz usunąć tego ucznia?</h3>";
                echo "<p>ID: " . $row['ID'] . "</p>";
                echo "<p>Imię: " . $row['IMIE'] . "</p>";
                echo "<p>Nazwisko: " . $row['NAZWISKO'] . "</p>";
                    
                echo "<input type='hidden' name='id' value='" . $row['ID'] . "'>";
                echo "<input type='submit' name='potwierdz' value='Tak'>";
                echo "<a href='index.php'>Nie</a>";
                    
            } else {
                echo "Rekord: $id nie został znaleziony.";
            }
        } else {
            $error = oci_error($stmt);
            echo "Error fetching record details: " . $error['message'];
        }
        echo "</form>";
        }
    else {
        echo "Invalid ID parameter.";
    }
    ?>
    
    </div>
    </form>
</body>
</html>