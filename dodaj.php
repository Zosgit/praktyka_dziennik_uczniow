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
        }
        h1 {
            text-align: center;
            background-color:#f1f9fd;
            width:100%;
            height: 40px;
        }
        .dodaj{
            display: block;
            text-align: center;
            line-height: 150%;
            margin-bottom: 50px;
            font-size: 25px;
            width: 470px; 
            margin: 0 auto; 
            padding: 15px 0 0;
            background: #fff;
            border: 1px solid white;
            background: linear-gradient(to top right, #dbeffa , white );
            border-radius: 10px;
        }
        label{
            font-size:22px;
        }
        input[name="dodaj_ucz"] { 
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
        input[name="imie"],input[name="nazwisko"],
        input[name="ocena_polski"],input[name="ocena_matematyka"],
        input[name="ocena_angielski"],input[name="ocena_informatyka"],
        input[name="ocena_fizyka"]{
            display: inline;
            text-align: center;
            margin: 0 auto;
            width:150px;
            height:30px;
            border: 1px solid white;
            font-size: 18px;
            border-radius: 5px;
        }
       
        #imie:focus, #nazwisko:focus, #ocena_polski:focus,
        #ocena_matematyka:focus, #ocena_angielski:focus, #ocena_informatyka:focus,
        #ocena_fizyka:focus{
            outline: 2px solid #85C1E9 ;
        } 
        input[name="add"]{
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
        input[name="add"]:hover, input[name="add"]:active {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Dziennik uczniow</h1>
    </br>
    <div class="dodaj">
        <?php

        //Check if the student ID already exists
        $sql = "SELECT MAX(id) AS max_id FROM dziennik_uczniow_lz";
        $stmt = oci_parse($conn, $sql);
        oci_execute($stmt);
        $row = oci_fetch_assoc($stmt);

        $result = $row['MAX_ID'];
        $result2=$result+1;
     
        echo "<h3>Dodaj dane ucznia o id: </h3>" . $result2."</br>";
       
        ?>
        <form action="dodaj2.php?id=<?php echo $result2; ?>" name="dodaj" method="post">
        
        <label for="imie">Imię: </label>
        <input type="text" name="imie" required><br>

        <label for="nazwisko">Nazwisko: </label>
        <input type="text" name="nazwisko" required><br>

        <label for="ocena_polski">J. Polski: </label>
        <input type="text" name="ocena_polski" required><br>

        <label for="ocena_matematyka">Matematyka: </label>
        <input type="text" name="ocena_matematyka" required><br>

        <label for="ocena_angielski">J. Angielski: </label>
        <input type="text" name="ocena_angielski" required><br>

        <label for="ocena_informatyka">Informatyka: </label>
        <input type="text" name="ocena_informatyka" required><br>

        <label for="ocena_fizyka">Fizyka: </label>
        <input type="text" name="ocena_fizyka" required><br>
        </br>
        <input type="submit" name="add" value="Dodaj ucznia">
 
   
  </form>
    </div>
</body>
</html>