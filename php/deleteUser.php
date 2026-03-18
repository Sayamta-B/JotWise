<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JotWise</title>
</head>
<body>
    <?php
        session_start();
        include "../createConnection.php";

        // Check if the 'id' parameter is set
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //Delete all tickets of the ride
            $sqldel = $conn->prepare("DELETE FROM User WHERE U_id = ?");
            $sqldel->bind_param("i", $id);
            if ($sqldel->execute()) {
                echo "<script>
                    alert('User deleted successfully.');
                    window.location.href='viewUser.php';
                    </script>";
            }
            else {
                echo "<script>
                    alert('Failed to delete user. Please try again.');
           </script>";
           }
        }   
        else {
            echo "<script>alert('Invalid request.');</script>";
        }
    ?>
</body>
</html>
