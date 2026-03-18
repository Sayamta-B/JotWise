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
            window.location.href = 'logOut.php';
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>JotWise</h1>
        <div class="nav">
            <a href="../html/userHomepage.php">Home</a>
            <a href="allShows.php" class="active">All Shows</a>
            <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                        echo "<a href='yourFavorite.php'>Your Favorite</a>";
                    }
                ?>
        </div>
        <div class="rightSide">
            <div>
                <input type="search" name="search" placeholder="Search">
                <input type="button" id="search" name="search" value="Search">
            </div>
            <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                    echo "<input type='button' class='button' value='Log Out' onclick='logout()'>";
                }else{
                    echo "<input type='button' class='button' value='Login' onclick='login()'>";
                }
            ?>
        </div>
    </div>
<?php 
        include '../createConnection.php';

        // Query to fetch ride details
        $sql = "SELECT * FROM Series";
        $result = $conn->query($sql);

        // Check if the result contains rows
        if ($result && $result->num_rows > 0) {
            // Loop through the results
            echo "<div class='container'>";
                    while ($row = $result->fetch_assoc()) {  
                        $S_id= $row['S_id'];              
                        echo "<a href='../php/serieDetail.php?id=$S_id'>
                            <div class='cards'>
                                <p>";
                                    if (!empty($row['Image'])) {
                                        echo "<img class='view' src='http://localhost/JotWise/" . htmlspecialchars($row['Image']) . "'><br>";
                                    } else {
                                        echo "No image available";
                                    }                                                                    
                                echo"</p>
                                <h3>{$row['S_name']}</h3>
                                <p>Rate - {$row['Rate']}</p>
                            </div>";
                    }
                echo "</div></a>";
                } else {
                    echo "<p>No series found in the database.</p>";
                } 
                $conn->close();
?>
</body>
</html>
