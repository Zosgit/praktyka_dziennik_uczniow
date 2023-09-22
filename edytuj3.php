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
    $ocena_pol = $_POST['edyt_pol'];
    $ocena_mat = $_POST['edyt_mat'];
    $ocena_ang = $_POST['edyt_ang'];
    $ocena_inf = $_POST['edyt_inf'];
    $ocena_fiz = $_POST['edyt_fiz'];

    $sr_art = ($ocena_pol + $ocena_mat + $ocena_ang + $ocena_inf + $ocena_fiz) / 5;
    $sr_geo= ROUND(POW(SQRT($ocena_pol * $ocena_mat * $ocena_ang * $ocena_inf * $ocena_fiz), 0.2), 2);
    $sr_har = ROUND(5 / (1 / $ocena_pol + 1 / $ocena_mat + 1 / $ocena_ang + 1 / $ocena_inf + 1 / $ocena_fiz), 2);

    $strSQL = "UPDATE DZIENNIK_UCZNIOW_LZ SET ";  
    $strSQL .="ocena_pol = '".$ocena_pol."' ";  
    $strSQL .=",ocena_mat = '".$ocena_mat."' ";  
    $strSQL .=",ocena_ang = '".$ocena_ang."' ";  
    $strSQL .=",ocena_inf = '".$ocena_inf."' ";  
    $strSQL .=",ocena_fiz = '".$ocena_fiz."' "; 
    $strSQL .=",sred_art = '".$sr_art."' ";  
    $strSQL .=",sred_geo = '".$sr_geo."' ";  
    $strSQL .=",sred_har = '".$sr_har."' ";  
    $strSQL .="WHERE ID = '".$_GET['id']."' ";  

    $objParse = oci_parse($conn, $strSQL);  
    $objExecute = oci_execute($objParse, OCI_DEFAULT);  

    if($objExecute)  {  
    oci_commit($conn); //*** Commit Transaction ***//  
    echo "</br>"."<h3>Dane zostały zmienione.</h3>";
    echo "<div class='potwierdz'>";
    echo "</br>";
    echo "</br>".'<a href="index.php"> << Powrót</a>';
    echo "</div>";
    }  
    else{  
    oci_rollback($conn); //*** RollBack Transaction ***//  
    $e = oci_error($objParse);  
    echo "Error Save [".$e['message']."]";  
    }  
    oci_close($conn);  
    ?>
</form>
</body>
</html>