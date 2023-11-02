<?php 
  /* check if user reservation is still active. */
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
  </div>
    <form id="reserve_form" action="./confirmed.php" method="GET">
      <fieldset>
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
        <input type="text" name="email" required="true">
        <p class="innerSpace"><br></p>

        <button onclick="submission(this)" type="button" value="Submit">Submit</button>
      </fieldset>
      
    </form>
    <footer></footer>
  <script src="./jquery_funcs.js"></script>
  <script src="../index.js"></script>
  <script src="./logOut.js"></script>
</body>
</html>