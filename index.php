<?php 
    $server = "sql101.epizy.com";
    $username = "epiz_33561916";
    $password = "SNlJj0hLjrq";
    $database = "epiz_33561916_MainDatabase";

    $err = "";
    $conn = null;
    try{
        $conn = mysqli_connect($server, $username, $password, $database);
    }catch (Exception $e){
        $err = $e;
    }
    

    if(!$conn){
        die("Connection Error: " . mysqli_connect_error());
    }
    //$conn->close();
?>

<html>
<body>

Thank You <?php echo $_GET["fn"] . " " . $_GET["ln"]; ?><br>
Your seat has been reserved at <?php echo $_GET["time"]; ?>
 on <?php echo $_GET["date"];?>

 <?php echo $e?>

 <button onclick="home()">HOME</button>

<script>
    function home(){
        window.location.replace("./index.html");
    }
</script>
</body>
</html>