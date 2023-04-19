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
    <header class="header_cont">
        <h1 class="header_title">Insert Restaurant Name Here</h1>
    </header>

    <nav class="nav_cont">
        <a href="./index.php">Home</a>
        <a href="#">Menu</a>
        <a href="./pages/reserve.php">Reservation</a>
        <a href="#">About</a>
    </nav>

    <a class="slide_link" href="#"><div class="slide_cont">
        <div class="slide_img">
            <div class="img_cont">
                
                <img src="./img/CaesarSalad.jpg"/>
            </div>
            <div class="food_descript">
                <h3>Caesar Salad</h3>
                <p>Salad that comes with shredded chicken breast, tomatoes
                    and a sprinkle of our homemade paremssan cheese.
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
    </div></a>

    <div class="main_cont">
        <p class="descr_para">Welcome to <i>Insert Restaurant Name Here</i>, where we serve the best food
        a person can get. We range from sandwiches, and salads to seafoods and more! </p>
        

        <p class="descr_para register_p">You can view our menu by clicking down below <br> <button class="pageLink"><a href="#">Menu</a></button> <br> or <br> Reserve a seat now <br> <button class="pageLink"><a href="./pages/reserve.html">Reserve</a></button> </p>
    </div>

    <div class="open_info">
        <p>Open 8:45 A.M. to 11:30 P.M. <br> 
            Monday - Saturday 
        </p>
        <p>
            Open 11:00 A.M. to 8:30 P.M. <br>
            Sunday
        </p>
    </div>

    <p id="testrun"></p>

    <footer>
        <div>
            <p>Contact us: 123-456-7890</p>
            <p>Email: <a href="#">someMail@email.com</a></p>
        </div>
    </footer>
    <script src="./index.js"></script>
</body>
</html>