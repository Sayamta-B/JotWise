<?php
    session_start();
    include "../createConnection.php";

    // Check if the 'id' parameter is set
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        //Delete all tickets of the ride
        $sqlAdd = $conn->prepare("INSERT INTO Favorites (U_id, S_id) VALUES (?,?)");
        $sqlAdd->bind_param("ii", $_SESSION['U_id'], $id);
        if ($sqlAdd->execute()) {
            echo "<script>
                alert('Series added to favorites successfully.');
                window.location.href='serieDetail.php?id=$id';
                </script>";
        }
        else {
            echo "<script>
                alert('Failed to add series to favorites. Please try again.');
        </script>";
        }
    }   
    else {
        echo "<script>alert('Invalid request.');</script>";
    }
?>
