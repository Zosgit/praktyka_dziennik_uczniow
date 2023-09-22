<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Logowanie</title>
  <style>
    body { 
      align-items: stretch;
			font: 100% normal Arial, Helvetica, sans-serif; 
			background: linear-gradient(to top right, #85C1E9 , #EBF5FB );
      height: calc(100vh);
 		}
    
    #panel {
      width: 400px; 
      margin: 0 auto; 
      padding: 15px 0 0;
      background: #fff;
      font: 16px;
      /* -webkit-box-shadow: 0 0 2px silver; 
      -moz-box-shadow: 0 0 2px silver;  */
      /* box-shadow: 0 0 2px silver; */
      box-shadow: 10px 10px 5px #D6EAF8;
      border-radius: 10px;
    }
    form {
      margin: 0;
    }
    h2{
      text-align: center;
      font: 26px;
      font-weight: bold;
    }
    label {
      display:flex;
      width: 260px;
      padding: 10px 20px;
      color: #696969;
      font-size: 16px;
      text-shadow: 0 0 1px silver;
    }
    #username, #password {
      display: block;
      width: 360px; 
      margin: 0 auto;
      padding: 10px 5px;
      border: 1px solid silver;
      outline: 5px solid #ebebeb;
      font-size: 22px;
      -webkit-border-radius: 5px; 
      -moz-border-radius: 5px; 
      border-radius: 5px;
    }
    #username:focus, #password:focus {
      outline: 5px solid #dbeffa  ;
    }
    /* .check {
      display: inline;
      float: none;
      font-size: 11px;
      padding: 5px;
    } */
    .button{
      width: 200px;
      height: 50px;
      font-size: 18px;
      padding: 5px 13px;
      border: 1px solid #D6EAF8;
      color: #2C3E50;
      text-shadow: 0 0 1px black;
      background: #AED6F1 ;
      position: relative;
      left: 110px;
      -webkit-border-radius: 5px; 
      -moz-border-radius: 5px; 
      border-radius: 5px;
      cursor: pointer;
      
    }
    .button span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }
    .button span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }
    .button:hover span {
      padding-right: 25px;
    }
    .button:hover span:after {
      opacity: 1;
      right: 0;
    }
  </style>

</head> 
<body>

  <div id="panel">
  <h2>Zaloguj się</h2>
    <form action="zaloguj.php" method="post"> 
      <label for="username">Nazwa użytkownika:</label>
      <input type="text" id="username" name="username">
      <br/>
      <!-- <span class="error">* <?php echo $userErr;?></span> -->
      <br/> 
      <label for="password">Hasło:</label>
      <input type="password" id="password" name="password">
      <br/>
      <!-- <span class="error">* <?php echo $passErr;?></span> -->
      <br/>
      <br/>
        <button class="button "type="submit"><span>Zaloguj </span></button>
      <br/>
      <br/>
      
    </form>
  </div>  
</body>
</html>