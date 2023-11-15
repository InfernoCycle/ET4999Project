<?php 
  /* check if user reservation is still active. */
  require_once './connect.php';
  require_once '../lib/utilities.php';

  $exists = false;

  if(isset($_POST["fn"])){
    $obj = new sql4();
    $obj->mysql_conn();
    $result = $obj->any("SELECT first_name, last_name, cancel_id FROM users WHERE cancel_id={$_POST["unique_code"]} AND first_name='{$_POST["fn"]}' AND last_name='{$_POST["ln"]}';");
    $obj->close();

    $data = mysqli_fetch_array($result);

    if(is_null($data)){
      $exists = false;
      echo "<h1 style='color:white;'>data came back empty</h1>";
    }else{
      $exists = true;
      echo "<h1 style='color:white;'>" . implode($data) . " " . camel_case($_POST["fn"]) ."</h1>";
    }
    
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Worldly Bites - Reservation Status</title>
  <link rel="stylesheet" href="../index.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="./jquery-3.6.3.min.js"></script>
  <script src="./jquery-ui.js"></script>

  <link rel="stylesheet" href="./jquery.timepicker.min.css"></link>
  <script src="./jquery.timepicker.min.js"></script>
  <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>-->
  
  <!--C:\Users\ecollege\Downloads\jquery-ui-1.13.2.custom\jquery-ui.js-->
</head>
<body>
  <div id="loggedOut">
    <a href="register.html"><button>Register</button></a>
    <a href="loggin.html"><button>Login</button></a>
  </div>
  <div id="loggedIn">
      <h2 style="display:inline-block;" id="username">Null</h2>
      <button onclick="logout(this)">Log-Out</button>
  </div>
  <div class="card">
    <header class="header_cont">
      <h1 class="header_title">Worldly Bites</h1>
    </header>

    <nav class="nav_cont">
        <a href="../index.html">Home</a>
        <a href="./menu.html">Menu</a>
        <a href="./reserve.php">Reserve</a>
        <a href="./about.html">About</a>
    </nav>
    <?php if($exists){?>
    <div id="modal_cont">
      <h2>Registration Status</h2>
    </div>
  <?php }?>
  </div>
    <form id="status_form" action="status.php" method="POST">
      <fieldset id="status_fieldset">
        <legend style="padding:10px; font-weight: bolder; font-size:35px">Reservation Status</legend>
        
        <label>First Name:</label>
        <p class="innerSpace"></p>
        <input type="text" name="fn" required="true">

        <p class="space"></p>
        
        <label>Last Name:</label>
        <p class="innerSpace"></p>
        <input type="text" name="ln" required="true">
        
        <p class="space"></p>

        <label>Confirmation Code:</label>
        <p class="innerSpace"></p>
        <input type="text" maxlength="6" name="unique_code" required="true">
        <p class="innerSpace"><br></p>

        <button name="submit_btn" id="status_submit" type="button" value="Submit">Submit</button>
      </fieldset>
      
    </form>
    <h style="color:white;">
      <?php
      if(isset($_POST["fn"])){
        echo "<h1>Hello " . $_POST["fn"] . " " . $_POST["ln"] . "</h1>";
      }else{
        echo "<h1>nothing submitted yet</h1>";
      }
      //unset($_POST);
      ?>
    </h>
    <footer></footer>
  <script src="./jquery_funcs.js"></script>
  <script src="../index.js"></script>
  <script src="./logOut.js"></script>
</body>
</html>