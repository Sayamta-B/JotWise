<?php 
        include '../createConnection.php';

        // Query to fetch ride details
        $sql = "SELECT * FROM Series ORDER BY S_id desc LIMIT 5 ";
        $result = $conn->query($sql);

        // Check if the result contains rows
        if ($result && $result->num_rows > 0) {
            // Loop through the results
            echo "<h1>Top 5 series</h1>
                    <div class='container'>";
                    while ($row = $result->fetch_assoc()) {  
                        $S_id= $row['S_id'];              
                        echo "<a href='../php/serieDetail.php?id=$S_id'>
                            <div class='cards'>
                                <p>";
                                    if (!empty($row['Image'])) {
                                        echo "<img class='view' src='http://localhost/JotWise/" . htmlspecialchars($row['Image']) . "'><br>";
                                    } else {
                                        echo "No image available";
                                    }                                                                    
                                echo"</p>
                                <h3>{$row['S_name']}</h3>
                                <p>Rate - {$row['Rate']}</p>
                            </div>";
                    }
                echo "</div></a>";
                } else {
                    echo "<p>No series found in the database.</p>";
                } 
                $conn->close();
?>