<?php 

  require './connect.php';
  $obj = new sql4();

  /*$obj->mysql_conn();
  //printf(mysqli_num_rows($obj->get_available_tables()));
  $obj->close();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Worldly Bites - Reservation Page</title>
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
      <a style="background-color: black;" href="./reserve.html">Reserve</a>
      <a href="./about.html">About</a>
  </nav>
    <form id="reserve_form" action="./confirmed.php" method="GET">
      <fieldset>
        <legend style="padding:10px; font-weight: bolder; font-size:35px">Reservation</legend>
        <label>First Name:</label>
        <p class="innerSpace"></p>
        <input type="text" name="fn" required="true">

        <p class="space"></p>
        
        <label>Last Name:</label>
        <p class="innerSpace"></p>
        <input type="text" name="ln" required="true">
        
        <p class="space"></p>

        <label>Email:</label>
        <p class="innerSpace"></p>
        <input type="text" name="email" required="true">

        <p class="space"></p>

        <label>Choose Date:</label>
        <p class="innerSpace"></p>
        <input onchange="valid_date(this)" id="datepicker" type="text" name="date" readonly>

        <p class="space"></p>
        
        <label>Choose Time: </label>
        <p class="innerSpace"></p>
        <input class="start_time timepicker" type="text" name="time" readonly>

        <p class="space"></p>

        <label>Choose Table: </label>
        <p class="innerSpace"></p>
        <select>
          
        </select>

        <p class="space"></p>

        <button onclick="submission(this)" type="button" value="Submit">Submit</button>
      </fieldset>
      
    </form>
    <footer></footer>
  </div>
  <script src="./jquery_funcs.js"></script>
  <script src="../index.js"></script>
  <script src="./logOut.js"></script>
</body>
</html>