<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/JotWise/CSS/adminPage.css">
    <title>JotWise - Series</title>
    <script>
        function confirmDelete(S_id) {
            const confirmAction = confirm("Are you sure you want to delete Series ID " + S_id + "?");
            if (confirmAction) {
                window.location.href = 'deleteSeries.php?id=' + S_id;
            }
        }
    </script>
</head>
<body>
<div class="header">
        <h1>JotWise</h1>
        <input type="button" class="button" value="Log Out" onclick="window.location.href = '../php/logOut.php';">
    </div>
    <div class="secondHeader">
        <div class="nav">
            <a href="../html/adminHomepage.html">Add Shows</a>
            <a href="viewSeries.php" class="active">View Shows</a>
            <a href="viewUser.php">View Users</a>
        </div>
    </div>
    <div class="box">
        <?php 
        include '../createConnection.php';

        // Query to fetch all series
        $sql = "SELECT * FROM Series";
        $result = $conn->query($sql);

        // Check if any series exists
        if ($result && $result->num_rows > 0) {
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>";

            // Loop through each series
            while ($row = $result->fetch_assoc()) {                
                echo "<tr>
                        <td>";
                            if (!empty($row['Image'])) {
                                // Dynamically encode and display the image
                                echo "<img class='view' src='http://localhost/JotWise/" . htmlspecialchars($row['Image']) . "'><br>";
                            } else {
                                echo "No image available";
                            }
                echo "</td>
                      <td>{$row['S_name']}</td>
                      <td>
                        Genre: {$row['Genre']}<br>
                        Episodes: {$row['Episodes']}<br>
                        Duration: {$row['Duration']}<br>
                        Release Date: {$row['ReleaseDate']}<br>
                        Rate: {$row['Rate']}
                      </td>
                      <td><textarea style='height:200px; background:white;'>{$row['Description']}</textarea></td>
                      <td>
                        <a href='updateForm.php?id={$row['S_id']}'>Update</a> | 
                        <a href='#' onclick='confirmDelete(\"{$row['S_id']}\")'>Delete</a>
                      </td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No series found in the database.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
