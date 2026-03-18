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

            $sql=$conn->prepare("SELECT * FROM user WHERE U_id=?");
            $sql->bind_param("i", $id);
            $sql->execute();
            $result = $sql->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "User not found!";
                exit();
            }
        }
        else{
            echo "User not found";
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
        <form method="POST" action="../php/updateUser.php" enctype="multipart/form-data" onsubmit="return validate()">
            <h1 class="title">Update User</h1>
                <input type="hidden" id="U_id" name="U_id" value="<?php echo htmlspecialchars($row['U_id'])?>">

                <div class="formLine">
                    <label>Username:</label>
                    <input type="text" name="Username" id="Username" value="<?php echo htmlspecialchars($row['Username'])?>">
                </div>

                <div class="formLine">
                    <label>Email:</label>
                    <input type="text" name="Email" id="Email" value="<?php echo htmlspecialchars($row['Email'])?>">
                </div><br/>

                <input type="submit" value="UPDATE" class="button">
        </form>
    </div>

</body>
</html>