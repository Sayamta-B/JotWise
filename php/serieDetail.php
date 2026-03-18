<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/JotWise/CSS/mainHomePage.css">
    <title>JotWise - Series</title>
    <script>
        function login(){
            window.location.href = '../html/userlogin.html';
        }
    </script>
</head>
<body>
    <div class="header">
            <h1>JotWise</h1>
            <div class="nav">
                <a href="../html/userHomepage.php">Home</a>
                <a href="../php/allShows.php">All Shows</a>
                <?php
                    session_start();
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                        echo "<a href='../php/yourFavorite.php'>Your Favorite</a>";
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
                        echo " ";
                    }else{
                        echo "<input type='button' class='button' value='Login' onclick='login()'>";
                    }
                ?>
            </div>
        </div>
        <?php
            include '../createConnection.php';

            if (isset($_GET['id'])) {
                $id = (int) $_GET['id']; // Cast to integer to prevent SQL injection risks

                // Prepare and execute the SQL query
                $sqlDetail = $conn->prepare("SELECT * FROM series WHERE S_id = ?");
                $sqlDetail->bind_param("i", $id);
                $sqlDetail->execute();

                // Fetch the result
                $result = $sqlDetail->get_result();

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<table  cellpadding=20px>
                                <tr style='height:160px;'>
                                    <td rowspan=2>";
                                        if (!empty($row['Image'])) {
                                            // Dynamically encode and display the image
                                            echo "<img style='width:300px;' class='view' src='http://localhost/JotWise/" . htmlspecialchars($row['Image']) . "'><br>";
                                        } else {
                                            echo "No image available";
                                        }
                                        echo "</td>
                                            <td colspan=2 style='width: 1020px;'>
                                                <p class='title'>" . htmlspecialchars($row['S_name']) . "</h3>
                                                
                                            </td>
                                </tr>
                                <tr>
                                        <td colspan=2>
                                            <p>" . htmlspecialchars($row['Description']) . "</p>
                                        </td>
                                </tr>
                                <tr>
                                        <td>";
                                                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                                                    echo "<input type='button' onclick='window.location.href=\"addToFavorite.php?id=$id\";' value='Add to Favorite' style='margin-left:80px; padding: 20px;'>";                                                
                                                }else{
                                                    echo " ";
                                                }
                                    echo "</td>
                                        <td style='width: 90px;'>
                                            <b>Genre</b> <br>
                                            <b>Episodes</b> <br>
                                            <b>Duration</b> <br>
                                            <b>Release Date</b> <br>
                                            <b>Rate</b> 
                                        </td>
                                        <td>:". $row['Genre'] ."<br>
                                            :". $row['Episodes'] ."<br>
                                            :". $row['Duration'] ."<br>
                                            :". $row['ReleaseDate'] ."<br>
                                            :". $row['Rate'] ."
                                        </td>
                                </tr>
                        </table>";
                    }
                } else {
                    echo "<p>Series not found.</p>";
                }
                $sqlDetail->close();
            } else {
                echo "<script>alert('Couldn't get the series information.');</script>";
            }
            ?>
    <div class="comment">
        <h1>Comments</h1>
        <div class="add-comment-form" style="margin:20px">
        <form action="addComment.php" method="POST">
            <textarea name="CommentText" rows="5" cols="170px" placeholder="Write your comment here..." required></textarea><br>
            <input type="hidden" name="S_id" value="<?php echo $id; ?>">
            <input type="submit" value="Post Comment">
        </form>
    </div>
    <br/>
        <?php
            include 'viewComment.php';  
            $conn->close();  
        ?>
</body>
</html>