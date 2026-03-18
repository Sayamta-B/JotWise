<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/adminPage.css">
    <title>JotWise - Series</title>
    <script>
        function confirmDelete(U_id) {
            const confirmAction = confirm("Are you sure you want to delete User ID " + U_id + "?");
            if (confirmAction) {
                window.location.href = 'deleteUser.php?id=' + U_id;
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
            <a href="viewSeries.php">View Shows</a>
            <a href="viewUser.php" class="active">View Users</a>
        </div>
    </div>
    <div class='box'>
        <?php 
        include '../createConnection.php';

        // Query to fetch all series
        $sql = "SELECT * FROM User";
        $result = $conn->query($sql);

        // Check if any series exists
        if ($result && $result->num_rows > 0) {
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>";

            // Loop through each series
            while ($row = $result->fetch_assoc()) {                
                echo "</td>
                      <td>{$row['Username']}</td>
                      <td>
                        {$row['Email']}
                      </td>
                      <td>{$row['Role']}</td>
                      <td>
                        <a href='updateUserForm.php?id={$row['U_id']}'>Update</a> | 
                        <a href='#' onclick='confirmDelete(\"{$row['U_id']}\")'>Delete</a>
                      </td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No user found in the database.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
