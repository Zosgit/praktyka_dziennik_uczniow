<?php
$username = "scott";                 
$password = "tiger";             
$database = "dev";   
$conn = oci_connect($username, $password, $database);

if(!$conn){ echo "Your Connection Has an error";}
else{echo "Your Connection is Successful </br>";}

if(isset($_GET['page'])){
    $page_number = $_GET['page'];
} else {
    $page_number=1;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dziennik uczniów</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
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
        h1 {
            text-align: center;
            background-color:#f1f9fd;
            width:100%;
            height: 40px;
        }
        .wybor{
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
            font-size:20px;
        }
        input[name="wczytaj"], input[name="dodaj"] { 
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
        a:link, a:visited {
            text-align: center;
            background-color: #dbeffa;
            color: black;
            padding: 14px 25px;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
            margin-right: auto;
            border-radius: 5px;
            border: 1px solid white;
        }
        a:hover, a:active {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .pagination{
            text-align:center;
            font-size:22px;
        }
        select{
            display: inline;
            text-align: center;
            margin: 0 auto;
            width:150px;
            border: 1px solid white;
            outline: 5px solid white;
            font-size: 18px;
            border-radius: 5px;
        }
        input[name="p_srednia_od"],input[name="p_srednia_do"]{
            display: inline;
            text-align: center;
            margin: 0 auto;
            width:150px;
            border: 1px solid white;
            outline: 5px solid white;
            font-size: 18px;
            border-radius: 5px;
        }
        #p_rodzaj_sredniej:focus, #p_srednia_od:focus, #p_srednia_do:focus{
            outline: 3px solid #85C1E9 ;
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
        .usun{
            border: 1px solid black;
            padding: 10px, 20px;
            background-color: white;
            font-size: 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Dziennik uczniow</h1>
    </br>
    <div class="form">
    <div class="wybor">
        <h4>Wybierz rodzaj średniej:</h4>
        <form action="index.php" method="post" >
            <label for="p_rodzaj_sredniej">Rodzaj średniej:&nbsp;</label>
            <select name="p_rodzaj_sredniej" id="p_rodzaj_sredniej">
                <option value="ARYTMETYCZNA">Arytmetyczna</option>
                <option value="GEOMETRYCZNA">Geometryczna</option>
                <option value="HARMONICZNA">Harmoniczna</option>
            </select>
            <br>
            <label for="p_srednia_od">Średnia od: &nbsp;</label>
            <input type="number" step="0.01" name="p_srednia_od" id="p_srednia_od">
            <br>
            <label for="p_srednia_do">Średnia do: &nbsp;</label>
            <input type="number" step="0.01" name="p_srednia_do" id="p_srednia_do">
            <br>
            <br>
            <input type="submit" name="wczytaj" value="Filtruj"> 
        </form>
        <form action="dodaj.php" method="post" >
            <input type="submit" name="dodaj" value="Dodaj ucznia">
        </form>
    </div>
    </div>

    <?php 
    $rows_per_page = 20;
    
    if(isset($_GET['page'])){
        $page_number = $_GET['page'];
        $result = $_GET['result']; 
        $srednia = $_GET['srednia'];
        $od =  $_GET['od'];
        $do =  $_GET['do'];

    // echo '</br>'.'srednia: '.$srednia;
    // echo '</br>'.'od: '.$od;
    // echo '</br>'.'do: '.$do;
    echo '</br>';
    
    } else {
        if(isset($_POST["wczytaj"])){
            $sql= "SELECT * FROM  TABLE (DZIENNIK_LZ.DAJ_DANE_UCZNIOW_LZ(:p_rodzaj_sredniej, :p_srednia_od, :p_srednia_do))";
            $wys = oci_parse($conn, $sql);

            $srednia =  $_POST["p_rodzaj_sredniej"];
            $od =  $_POST["p_srednia_od"];
            $do =  $_POST["p_srednia_do"];

            oci_bind_by_name($wys, ":p_rodzaj_sredniej", $srednia);
            oci_bind_by_name($wys, ":p_srednia_od", $od);
            oci_bind_by_name($wys, ":p_srednia_do", $do);
            $execute = oci_execute($wys); 
        }else{
            //$sql= "SELECT * FROM DZIENNIK_LZ.DAJ_DANE_UCZNIOW_LZ";
            //echo "wpisz dane i filtruj".'</br>';
        }
        
      //okreslamy ile mamy danych
    $query = "SELECT Count(*) FROM  TABLE (DZIENNIK_LZ.DAJ_DANE_UCZNIOW_LZ(:p_rodzaj_sredniej, :p_srednia_od, :p_srednia_do))";
    $wys = oci_parse($conn, $query);

        oci_bind_by_name($wys, ":p_rodzaj_sredniej", $srednia);
        oci_bind_by_name($wys, ":p_srednia_od", $od);
        oci_bind_by_name($wys, ":p_srednia_do", $do);
        $execute = oci_execute($wys);

    if ($execute) {
        $row = oci_fetch_array($wys, OCI_RETURN_NULLS + OCI_ASSOC);
        if ($row) {
            $result = $row['COUNT(*)'];
            //echo "Wynik zapytania: " . $result."</br>";
        } else {
            echo "Brak wyników.";
        }
    } else {
        $error = oci_error($wys);
        echo "Błąd zapytania: " . $error['message'];
    }
        $page_number=1;
    }

?>
<div class='pagination'>
    <?php
    $last_page = ceil($result/$rows_per_page);
    //echo '</br>'.'last page: '.$last_page;
    echo "</br>";

    if($last_page != 1){
        if($page_number > 1){
            $previous = $page_number - 1;
            echo'<a href="index.php?page='.$previous.'&result='.$result.'&srednia='.$srednia.'&od='.$od.'&do='.$do.'"> << </a>';
        }
        for($i=1;$i<=$last_page;$i++){
            echo '<a href="index.php?page='.$i.'&result='.$result.'&srednia='.$srednia.'&od='.$od.'&do='.$do.'">'.$i.'</a>';
                if($i >= $last_page){
                    break;
                }
            }
        if($page_number != $last_page){
            $next = $page_number + 1;
            echo'<a href="index.php?page='.$next.'&result='.$result.'&srednia='.$srednia.'&od='.$od.'&do='.$do.'"> >> </a>';
        }
    }

    if($page_number < 1){
        $page_number = 1;
    } else if($page_number > $last_page){
        $page_number = $last_page;
    }

    //displays to the user the total number of results and the page numbers
    echo "</br></br> Search Results (<b>$result</b>)";
    echo "</br> Page <b>$page_number</b> of <b>$last_page</b></br></br>";
    ?>
</div>

<?php
$startRow = ($page_number - 1) * $rows_per_page+1;
$endRow = $page_number * $rows_per_page;

// echo "numer pierwszego wyswietlanego rekordu: ".$startRow."</br>";
// echo "numer ostatniego wyswietlanego rekordu: ".$endRow;

$query1 = "SELECT * FROM (
    SELECT t.*, ROW_NUMBER() OVER (ORDER BY id) rnum
    FROM TABLE (DZIENNIK_LZ.DAJ_DANE_UCZNIOW_LZ(:p_rodzaj_sredniej, :p_srednia_od, :p_srednia_do)) t
  )
  WHERE rnum BETWEEN :startRow AND :endRow";
$wys1 = oci_parse($conn, $query1);

    oci_bind_by_name($wys1, ":p_rodzaj_sredniej", $srednia);
    oci_bind_by_name($wys1, ":p_srednia_od", $od);
    oci_bind_by_name($wys1, ":p_srednia_do", $do);
    oci_bind_by_name($wys1, ":startRow", $startRow);
    oci_bind_by_name($wys1, ":endRow", $endRow);

//echo '</br>'.'</br>'.$query1.'</br>'.'</br>';
    
    $execute=oci_execute($wys1);
  
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
    <th>Średnia arytmetyczna</th>     
    <th>Średnia geometryczna</th> 
    <th>Średnia harmoniczna</th>
    <th></th>
    <th></th>
    </tr>";
    while ($row = oci_fetch_array($wys1)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['IMIE'] . "</td>";
        echo "<td>" . $row['NAZWISKO'] . "</td>";
        echo "<td>" . $row['OCENA_POL'] . "</td>";
        echo "<td>" . $row['OCENA_MAT'] . "</td>";
        echo "<td>" . $row['OCENA_ANG'] . "</td>";
        echo "<td>" . $row['OCENA_INF'] . "</td>";
        echo "<td>" . $row['OCENA_FIZ'] . "</td>";
        echo "<td>" . $row['SRED_ART'] . "</td>";
        echo "<td>" . $row['SRED_GEO'] . "</td>";
        echo "<td>" . $row['SRED_HAR'] . "</td>";
        
        echo "<td>"."<a href='usun.php?id={$row['ID']}'>Usuń</a> "."</td>";
      
        echo "<td>"."<a href='edytuj.php?id={$row['ID']}'>Edytuj</a> "."</td>";
        echo "</tr>";
    }
echo "</table>";

    ?>
</body>
</html>