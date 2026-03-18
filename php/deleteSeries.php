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
            //Delete the series
            $sqldel = $conn->prepare("DELETE FROM Series WHERE S_id = ?");
            $sqldel->bind_param("i", $id);
            if ($sqldel->execute()) {
                echo "<script>
                    alert('Series deleted successfully.');
                    window.location.href='viewSeries.php';
                    </script>";
            }
            else {
                echo "<script>
                    alert('Failed to delete series. Please try again.');
           </script>";
           }
        }   
        else {
            echo "<script>alert('Invalid request.');</script>";
        }
    ?>
</body>
</html>
