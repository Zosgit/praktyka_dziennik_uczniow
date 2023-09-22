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
        h3{
            text-align: center;
            width:100%;
         
        }
        a:link, a:visited {
            text-align: center;
            width: 275px;
            height: 50px;
            font-size: 18px;
            padding: 12px 100px;
            border: 1px solid #D6EAF8;
            color: #2C3E50;
            text-shadow: 0 0 1px black;
            background: #D6EAF8 ;
            text-decoration: none;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        a:hover, a:active {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .potwierdz{
            text-align: center;
        }
    </style>
</head>
<body>
<h1>Dziennik uczniow</h1>
    </br>
<?php
 if (isset($_POST['potwierdz'])) {
    $id = $_POST['id'];
    // Delete the record from the database
    $sql = "DELETE FROM DZIENNIK_UCZNIOW_LZ WHERE id = :id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ":id", $id);
    $execute = oci_execute($stmt);

    if ($execute) {
        echo "</br>"."<h3>Rekord $id został usuniety prawidłowo.</h3>";
        echo "<div class='potwierdz'>";
        echo "</br>";
        echo "</br>".'<a href="index.php"> << Powrót</a>';
        echo "</div>";
    } else {
        $error = oci_error($stmt);
        echo "Error deleting record: " . $error['message'];
    }
}
oci_close($conn);
?>
</body>
</html>