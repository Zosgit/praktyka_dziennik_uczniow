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
        table
        {
            border-collapse: collapse;
            border: 1px solid #dddfe1;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            border: 1px solid black;
            padding: 12px;
            text-align: center;
            border-color: white;
            font-size:20px;  
        }   
        tr:nth-child(odd) {
            background-color: #dbeffa;
        }
        input[name="potwierdz_zmiany"]{
            text-align: center;
            width: 275px;
            height: 50px;
            font-size: 20px;
            padding: 5px 13px;
            border: 1px solid #D6EAF8;
            color: #2C3E50;
            text-shadow: 0 0 1px black;
            background: #D6EAF8 ;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        input[name="potwierdz_zmiany"]:hover, input[name="potwierdz_zmiany"]:active {
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

    <form  action="edytuj3.php?id=<?=$_GET['id']?>"  name="edit" method="post">  
    <?php
    $id=$_GET['id'];
    $strSQL = "SELECT * FROM DZIENNIK_UCZNIOW_LZ WHERE ID = :id";  
    //echo $_GET['id'];
    $objParse=oci_parse ($conn, $strSQL); 
    oci_bind_by_name($objParse, ":id", $id);
    oci_execute ($objParse,OCI_DEFAULT);  

    if(!oci_execute ($objParse,OCI_DEFAULT))  {  
        echo "Not found CustomerID=".$id;  
    }  
    else {
        echo "<table>
        <tr>
        <th>Id</th>     
        <th>Imię</th> 
        <th>Nazwisko</th>
        <th>J. Polski</th>
        <th>Matematyka</th>     
        <th>J. Angielski</th> 
        <th>Informatyka</th>
        <th>Fizyka</th>
        <th>Srednia art</th> 
        <th>srednia geo</th>
        <th>srednia har</th>
        </tr>";
        while ($row = oci_fetch_array($objParse)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['IMIE'] . "</td>";
            echo "<td>" . $row['NAZWISKO'] . "</td>";
            echo "  <td><input type='hidden' name='id' value='" . $row['ID'] . "'>
                        <input type='number'  name='edyt_pol' value='" . $row['OCENA_POL'] . "'></td>
                    <td><input type='number'  name='edyt_mat' value='" . $row['OCENA_MAT'] . "'></td>
                    <td><input type='number'  name='edyt_ang' value='" . $row['OCENA_ANG'] . "'></td>
                    <td><input type='number'  name='edyt_inf' value='" . $row['OCENA_INF'] . "'></td>
                    <td><input type='number'  name='edyt_fiz' value='" . $row['OCENA_FIZ'] . "'></td>";
                    echo "<td>" . $row['SRED_ART'] . "</td>";
                    echo "<td>" . $row['SRED_GEO'] . "</td>";
                    echo "<td>" . $row['SRED_HAR'] . "</td>";
            echo "<tr>";
        }
        echo "</table>";
        echo "</br>";
        echo "</br>";
    }
    ?>
    <div class="potwierdz">
    <input type="submit" name="potwierdz_zmiany" value="Potwierdź zmiany">  
    </div>
    </form>
</body>
</html>