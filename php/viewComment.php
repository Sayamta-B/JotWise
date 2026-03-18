<?php
    include '../createConnection.php'; 

    if (isset($id)) {
       
        // Prepare and execute the query
        $sqlComment = $conn->prepare("
            SELECT *
            FROM User AS U
            JOIN Comments AS C ON U.U_id=C.U_id
            JOIN Series AS S ON C.S_id=S.S_id
            WHERE C.S_id = ?
        ");
        $sqlComment->bind_param("i", $id);
        $sqlComment->execute();
        $result = $sqlComment->get_result();
        
        // Display the comments
        echo "<div class='comments-section'>";
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<h3>" . htmlspecialchars($row['Username']) . " :</h3>";
                echo "<p>" . htmlspecialchars($row['CommentText']) . "</p>";
                echo "<small>Posted on: " . htmlspecialchars($row['CommentDate']) . "</small>";
                echo "</div>";
            }
        }
        echo "</div>";

        $sqlComment->close();
    }
?>
