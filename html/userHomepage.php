<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JotWise</title>
    <script src="../js/Carousel.js"></script>
    <link rel="stylesheet" href="http://localhost/JotWise/CSS/mainHomepage.css">
    <script>
        function logout(){
            window.location.href = '../php/logOut.php';
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>JotWise</h1>
        <div class="nav">
            <a class="active">Home</a>
            <a href="../php/allShows.php">All Shows</a>
            <a href="../php/yourFavorite.php">Your Favorite</a>
        </div>
        <div class="rightSide">
            <div>
                <form action="../php/searchSeries.php" method="post">
                    <input type="search" name="searchTerm" placeholder="Search">
                    <input type="submit" id="search" name="search" value="Search">
                </form>
            </div>
            <input type="button" class="button" value="Log Out" onclick="logout()">
        </div>
    </div>

    <div class="carousel">
        <div class="list">
            <div class="headerImg active"><img src="../images/jotInfoCarosel.png" alt="Header for Jot Info"></div>
            <div class="headerImg"><img src="../images/KotaFactoryCover.jpg" alt="Header for Packages"></div>
            <div class="headerImg"><img src="../images/FriendsCover.jpg" alt="Header for Rides"></div>
        </div>
        <div class="buttons">
            <button id="prev" onclick="plusSlides(-1)"><</button>
            <button id="next" onclick="plusSlides(1)">></button>
        </div>
        <ul class="dots">
            <!-- <li class="dot">.</li> -->
            <li class="dot active"  onclick="currentSlide(1)"></li>
            <li class="dot" onclick="currentSlide(2)"></li>
            <li class="dot" onclick="currentSlide(3)"></li>
        </div>
    </div>
    
    <?php
        include '../php/topSeriesList.php';
        echo "<br/>";
        include '../php/listSeries.php';
    ?>

</body>
</html>