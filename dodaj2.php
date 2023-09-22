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
<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = $_GET['id'];
    //echo $id;
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $polski = $_POST['ocena_polski'];
    $matematyka = $_POST['ocena_matematyka'];
    $angielski = $_POST['ocena_angielski'];
    $informatyka = $_POST['ocena_informatyka'];
    $fizyka = $_POST['ocena_fizyka'];

    $sr_arytmetyczna = ($polski + $matematyka + $angielski + $informatyka + $fizyka) / 5;
    $sr_geometryczna= ROUND(POW(SQRT($polski * $matematyka * $angielski * $informatyka * $fizyka), 0.2), 2);
    $sr_harmoniczna = ROUND(5 / (1 / $polski + 1 / $matematyka + 1 / $angielski + 1 / $informatyka + 1 / $fizyka), 2);

    $strSQL = "INSERT INTO DZIENNIK_UCZNIOW_LZ (id, imie, nazwisko, ocena_pol, ocena_mat, ocena_ang, ocena_inf, ocena_fiz, sred_art, sred_geo, sred_har)
    VALUES(:id, :imie, :nazwisko, :polski, :matematyka, :angielski, :informatyka, :fizyka, :sr_arytmetyczna, :sr_geometryczna, :sr_harmoniczna)";  
    
    $objParse = oci_parse($conn, $strSQL);  

    oci_bind_by_name($objParse, ":id", $id);
    oci_bind_by_name($objParse, ":imie", $imie);
    oci_bind_by_name($objParse, ":nazwisko", $nazwisko);
    oci_bind_by_name($objParse, ":polski", $polski);
    oci_bind_by_name($objParse, ":matematyka", $matematyka);
    oci_bind_by_name($objParse, ":angielski", $angielski);
    oci_bind_by_name($objParse, ":informatyka", $informatyka);
    oci_bind_by_name($objParse, ":fizyka", $fizyka);
    oci_bind_by_name($objParse, ":sr_arytmetyczna", $sr_arytmetyczna);
    oci_bind_by_name($objParse, ":sr_geometryczna", $sr_geometryczna);
    oci_bind_by_name($objParse, ":sr_harmoniczna", $sr_harmoniczna);

    $objExecute = oci_execute($objParse, OCI_DEFAULT); 
    
    if($objExecute)  
    {  
    oci_commit($conn); //*** Commit Transaction ***//  
    echo "</br>"."</br>"."<h3>Uczeń został dodany.</h3>";  
    echo "<div class='potwierdz'>";
        echo "</br>";
        echo "</br>".'<a href="index.php"> << Powrót</a>';
        echo "</div>";
    }  
    else  
    {  
    oci_rollback($conn); //*** RollBack Transaction ***//  
    $e = oci_error($objParse);  
    echo "Error Save [".$e['message']."]";  
    }  
    oci_close($conn);  
}else{
    echo "errrrorr";
}
?>
</body>
</html>