<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./index.css">
    <script src="C:/Users/ecollege/Downloads/jquery-3.6.3.min.js"></script>
</head>
<body>
    <div class="card">
        
         <nav class="nav_cont">
            <a href="./index.html">Home</a>
            <a href="#">Menu</a>
            <a href="./pages/reserve.html">Reservation</a>
            <a href="#">About</a>
        </nav>
        
        <h1 class="header_title">Insert Restaurant Name Here</h1>

        <!--
        <header class="header_cont">
            <h1 class="header_title">Insert Restaurant Name Here</h1>
        </header>-->

       
        <div class="main_cont">
            <p class="descr_para">Welcome to <i>Insert Restaurant Name Here</i>, where every dish is a masterpiece waiting to be savored! </p>
            

            <p class="descr_para register_p">You can view our menu by clicking down below 
                <br> <button class="pageLink"><a href="#">Menu</a></button> 
                <br> or <br> Reserve a seat now <br> 
                <button class="pageLink"><a href="./pages/reserve.html">Reserve</a>
                </button> 
            </p>
        </div>

    <!--

        <a class="slide_link" href="#">
            <div class="slide_cont">
                <div class="slide_img">
                    <div class="img_cont">
                        <img src="./img/CaesarSalad2.jpg"/>
                    </div>
                    <div class="food_descript">
                        <h3>Caesar Salad</h3>
                        <p>A Caesar salad, with its perfect combination of fresh crisp lettuce, savory meat, juicy tomatoes, boiled eggs, and your preferred dressing, creates a harmonious balance of flavors and textures that is simply irresistible.
                        </p>
                    </div>
                    <div class="captions">See Menu</div>
                </div>

                <div class="slide_img">
                    <div class="img_cont">
                        <img src="./img/GrinderSandwich.jpg"/>
                    </div>
                    <div class="food_descript">
                        <h3>Grinder Sandwich</h3>
                        <p>
                            Try our world famous grinder sandwiches. They come with Turkey, 
                            Ham, Salami, Swiss Cheese, Mayo, and your choice of sides.
                        </p>
                    </div>
                    <div class="captions">See Menu</div>
                </div>

                <div class="slide_img">
                    <div class="img_cont">
                        <img src="./img/FriedFlounder.jpg"/>
                    </div>
                    <div class="food_descript">
                        <h3>Fried Flounder</h3>
                        <p>
                            Freshly caught flounder fried in canola oil and 
                            hand made beer-batter that we change daily for the 
                            best tasting fish in town.
                        </p>
                    </div>
                    <div class="captions">See Menu</div>
                </div>
                
                <div class="slide_img">
                    <div class="img_cont">
                        <img src="./img/CremeBrulee.jpg"/>
                    </div>
                    <div class="food_descript">
                        <h3>Creme Brulee</h3>
                        <p>
                            Dessert made with custard or pudding (you choose) and sugar sprinkled on top
                            and torched for a hardened sweeten treat that anyone will enjoy. First time 
                            customers get one free.
                        </p>
                    </div>
                    <div class="captions">See Menu</div>
                </div>
            </div>
        </a>
    -->
        

        <div class="open_info">
            <h1>Open Hours</h1>
            <p>Monday - Saturday: 8:45 A.M. to 11:30 P.M. <br> 
               Sunday: 11:00 A.M. to 8:30 P.M. 
            </p>
        </div>

        <p id="testrun"></p>

        <footer>
            <div class="footer_button">
                <button class="button">Contact Us!</button>
                <button class="button" onclick="window.location.href='https://www.google.com/maps/place/Manoogian+Hall/@42.3549683,-83.0718281,19.44z/data=!4m14!1m7!3m6!1s0x8824d2bc9d42d843:0xb688968949df5e4e!2sWayne+State+University!8m2!3d42.3591388!4d-83.0665462!16zL20vMDFzMF9m!3m5!1s0x8824d2a5cd24ebe1:0x861678bbe7303c7!8m2!3d42.3546479!4d-83.0730604!16s%2Fg%2F11b635xj6v';">Our Location</button>
                <button class="button">Email</button>
            </div>
        </footer>

        
        
        <script src="./index.js"></script>
    </div>
</body>

</html>