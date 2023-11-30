<?php 

  require './connect.php';

  //to hide an input field set to 'false'.
  $show_firstName = true;
  $show_lastName = true;
  $show_email = true;
  $show_date = true;
  $show_time = true;
  $show_tables = true;

  session_start();

  $obj = new sql4();
  $associative_arr = [];
  $obj->mysql_conn();
  $results = $obj->get_available_tables();
  //mysqli_fetch_array($obj->get_available_tables())
  for($i = 0; $i < mysqli_num_rows($results); $i++){
    if(!mysqli_data_seek($results, $i)){
      continue;
    }

    if(!($row = mysqli_fetch_assoc($results))){
      continue;
    }

    $associative_arr += array($row["table_size"] => $row["available"]);
  }
  
  $obj->close();
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
  <div class="card">
  <header class="header_cont">
    <h1 class="header_title">United Tastes</h1>
  </header>

  <nav class="nav_cont">
      <a href="../index.html">Home</a>
      <a href="./menu.html">Menu</a>
      <a style="background-color: black;" href="./reserve.html">Reserve</a>
      <a href="./about.html">About</a>
  </nav>
  <!-- Form area below
  our default html input format is: 
  <label></label>
  <p class="innerSpace"></p> 
  <input type="<choose a type>" name="<choose a name>" required="<true or false>">
  -->

    <form id="reserve_form" action="./confirmed.php" method="GET">
      <fieldset>
        <legend style="padding:10px; font-weight: bolder; font-size:35px">Reservation</legend>
        
        <?php if($show_firstName) {?>
        <label>First Name:</label>
        <p class="innerSpace"></p>
        <input type="text" name="fn" required="true">

        <p class="space"></p>
        <?php }?>

        <?php if($show_lastName) {?>
        <label>Last Name:</label>
        <p class="innerSpace"></p>
        <input type="text" name="ln" required="true">
        
        <p class="space"></p>
        <?php }?>

        <?php if($show_email) {?>
        <label>Email:</label>
        <p class="innerSpace"></p>
        <input type="text" name="email" required="true">

        <p class="space"></p>
        <?php }?>

        <?php if($show_date) {?>
        <label>Choose Date:</label>
        <p class="innerSpace"></p>
        <input onchange="valid_date(this)" id="datepicker" type="text" name="date" readonly>

        <p class="space"></p>
        <?php }?>

        <?php if($show_time) {?>
        <label>Choose Time: </label>
        <p class="innerSpace"></p>
        <input class="start_time timepicker" type="text" name="time" readonly>

        <p class="space"></p>
        <?php }?>

        <?php if($show_tables) {?>
        <label>Choose Table: </label>
        <p class="innerSpace"></p>
        <select name="table">
          <?php 
            foreach($associative_arr as $key => $value){
          ?>
            <?php if($value > 0){ ?>
              <option value="<?=$key . ', Available: ' . $value?>">           
                  <?=$key . ', Available: ' . $value?>
              </option>
            <?php }else{?>
              <option disabled value="<?=$key . ' is Unavailable'?>">
                <?=$key . ' is Unavailable'?>
              </option>
            <?php }?>
          <?php }?>
        </select>
        <p class="space"></p>
        <?php }?>

        <button onclick="submission(this)" type="button" value="Submit">Submit</button>
        <p class="space"></p>

        <a style="color:white;" href="./status.php"><b>Already have a reservation? Check Now</b></a>
      </fieldset>
      
    </form>
    <footer></footer>
  </div>

  <script src="./jquery_funcs.js"></script>
  <?php 
    if(isset($_SESSION["invalid_entry"])){
  ?>
    <script>
      const error = document.getElementsByClassName("space")[6];
      error.textContent = "The entered email is currently being used";
    </script>
  <?php
  session_unset();
  session_destroy();
    }else{
      session_unset();
      session_destroy();
    }
  ?>
  <script src="../index.js"></script>
  <script src="./logOut.js"></script>
</body>
</html>