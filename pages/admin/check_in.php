<?php 
  require_once "../connect.php";

  $associative_arr = [];
  $obj = new sql4();
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

  $result = $obj->any("SELECT user_id, is_in, first_name, last_name FROM users;");
  $res_array = mysqli_fetch_all($result);
  $count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check-In</title>
  <link rel="stylesheet" href="../../index.css">

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
        <a href="../../index.html">Home</a>
        <a href="../menu.html">Menu</a>
        <a href="../reserve.php">Reserve</a>
        <a href="../about.html">About</a>
    </nav>
  </div>

  <form id="table_in_form" action="status.php" method="POST">
    <fieldset id="status_fieldset">
      <legend style="padding:10px; font-weight: bolder; font-size:35px">Reservation Status</legend>
      <label class="employee_forms_labels">Pre-Registers: </label>
      <br>
      <input list="registrations" id="registrations_input" required/>
      <datalist id="registrations">
        <?php while($count < count($res_array)){ 
          $inner_res = mysqli_fetch_array($obj->any("SELECT reserved_time, reserved_date FROM reservations WHERE user_id={$res_array[$count][0]};"));
          if($inner_res == null){
            $count+=1;
            continue;
          }?>
          <option id=<?=$res_array[$count][0]?> ><?=$res_array[$count][2]." ".$res_array[$count][3]." for ".$inner_res['reserved_date']." at ".$inner_res['reserved_time'];?></option>
          <?php $count+=1;}?>
        <?php $obj->close();?>
      </datalist>
      <p class="space"></p>
      <input class="employee_submits" type="submit"/>
    </fieldset>
  </form>
  
  <form id="table_in_form" action="status.php" method="POST">
    <fieldset id="status_fieldset">
      <legend style="padding:10px; font-weight: bolder; font-size:35px">Walk-In</legend>
      <label class="employee_forms_labels">Tables Available: </label>
      <br>
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
      <input class="employee_submits" type="submit"/>
    </fieldset>
  </form>

  <form id="table_in_form" action="status.php" method="POST">
    <fieldset id="status_fieldset">
      <legend style="padding:10px; font-weight: bolder; font-size:35px">Cancel</legend>
      <label class="employee_forms_labels">Pre-Registers: </label>
      <input class="employee_submits" type="submit"/>
    </fieldset>
  </form>
  <footer></footer>
  <script>
    const minutes = 1;
    const milliseconds = 1000 * (minutes * 60);
    const interval = setInterval(()=>{
      console.log("this is running every 1 minute");
    }, times);
  </script>
</body>
</html>