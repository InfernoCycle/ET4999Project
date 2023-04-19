<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
  <header class="header_cont">
    <h1 class="header_title">Insert Restaurant Name Here</h1>
  </header>

  <nav class="nav_cont">
      <a href="../index.php">Home</a>
      <a href="#">Link 2</a>
      <a href="./pages/reserve.php">Reserve</a>
      <a href="#">Link 4</a>
  </nav>
    <form id="reserve_form" action="http://localhost/LearnPHP/index.php" method="GET">
      <fieldset style="border:none;">
        <legend style="padding:10px; font-weight: bolder; font-size:25px">Reservation</legend>
        <label>First Name:</label>
        <input type="text" name="fn" required="true">

        <p class="space"></p>
        
        <label>Last Name:</label>
        <input type="text" name="ln" required="true">
        
        <p class="space"></p>

        <label>Choose Date:</label>
        <input id="datepicker" type="text" name="date" readonly>

        <p class="space"></p>
        
        <label>Choose Time: </label>
        <input class="start_time timepicker" type="text" name="time" readonly>

        <p class="space"></p>

        <input type="submit" value="Submit">
      </fieldset>
      
    </form>
  <script src="./jquery_funcs.js"></script>
</body>
</html>