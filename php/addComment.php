<?php
include '../createConnection.php';
session_start();

// Check if the user is logged in (assuming you have a login system)
if (!isset($_SESSION['U_id'])) {
    echo "<script>alert('You must be logged in to leave a comment.'); 
    window.location.href='../html/userlogin.html';</script>";
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the comment text and series_id from the form
    $CommentText = $_POST['CommentText'];
    $S_id = $_POST['S_id'];
    $U_id = $_SESSION['U_id']; // Assuming user ID is stored in session

    // Prepare and execute the SQL query to insert the comment into the database
    $stmt = $conn->prepare("INSERT INTO Comments (U_id, S_id, CommentText) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $U_id, $S_id, $CommentText);

    if ($stmt->execute()) {
        echo "<script>alert('Comment added successfully.'); window.location.href='serieDetail.php?id=$S_id';</script>";
    } else {
        echo "<script>alert('Error adding comment. Please try again later.'); window.location.href='serieDetail.php';</script>";
    }

    $stmt->close();
}
?>
