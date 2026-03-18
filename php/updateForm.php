<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JotWise</title>
    <script src="../js/adminPage.js"></script>
    <link rel="stylesheet" href="http://localhost/JotWise/CSS/adminPage.css">

    <?php
        session_start();
        include '../createConnection.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql=$conn->prepare("SELECT * FROM series WHERE S_id=?");
            $sql->bind_param("i", $id);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "Series not found!";
                exit();
            }
        }
        else{
            echo "Series not found";
        }
    ?>
</head>
<body>
<div class="header">
        <h1>JotWise</h1>
        <input type="button" class="button" value="Log Out" onclick="window.location.href = '../php/logOut.php';">
    </div>
    <div class="secondHeader">
        <div class="nav">
            <a href="../html/adminHomepage.html">Add Shows</p>
            <a href="viewSeries.php">View Shows</p>
            <a href="viewUser.php">View Users</a>
        </div>
    </div>

    <div class="box">
        <form method="POST" action="../php/updateSeries.php" enctype="multipart/form-data" onsubmit="return validate()">
            <h1 class="title">Update Series Review</h1>

            <input type="hidden" id="S_id" name="S_id" value="<?php echo htmlspecialchars($row['S_id'])?>">

                <div class="formLine">
                    <label>Series Name:</label>
                    <input type="text" name="S_name" id="S_name" value="<?php echo htmlspecialchars($row['S_name'])?>">
                </div>

                <div class="formLine">
                    <label>Genre:</label>
                    <input type="text" name="Genre" id="Genre" value="<?php echo htmlspecialchars($row['Genre'])?>">
                </div>

                <div class="formLine">
                    <label>No. of Episodes:</label>
                    <input type="number" name="Episodes" id="Episodes" value="<?php echo htmlspecialchars($row['Episodes'])?>">
                </div>

                <div class="formLine">
                    <label>Duration per Episode(in minutes):</label>
                    <input type="text" name="Duration" id="Duration" value="<?php echo htmlspecialchars($row['Duration'])?>">
                </div>

                <div class="formLine">
                    <label>Release Date:</label>
                    <input type="text" name="ReleaseDate" id="ReleaseDate" value="<?php echo htmlspecialchars($row['ReleaseDate'])?>">
                </div>

                <div class="formLine">
                    <label>Rate this series(?/10):</label>
                    <input type="float" name="Rate" id="Rate" value="<?php echo htmlspecialchars($row['Rate'])?>">
                </div>

                <div class="formLine">
                    <label>Series Image:</label>
                    <input type="file" name="Image" id="Image" required>
                </div>
                 
                <div class="formLine">
                    <label>Series Description:</label>
                    <textarea name="Description" id="Description" ><?php echo htmlspecialchars($row['Description'])?></textarea>
                </div><br/>

                <input type="submit" value="UPDATE" class="button">
        </form>
    </div>

</body>
</html>