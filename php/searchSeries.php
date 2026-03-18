<?php
    include '../createConnection.php';
    echo "<link rel='stylesheet' href='http://localhost/JotWise/CSS/mainHomepage.css'>";

    // Handle search query
    $searchTerm = "";
    $results = [];

    if (isset($_POST['searchTerm'])) {
        $searchTerm = $_POST['searchTerm'];

        // Prepare and execute the search query
        $sqlSearch = $conn->prepare("
            SELECT * 
            FROM Series 
            WHERE S_name LIKE ? OR FIND_IN_SET(?, Genre)
        ");
        $likeTerm = "%" . $searchTerm . "%";
        $sqlSearch->bind_param("ss", $likeTerm, $searchTerm);
        $sqlSearch->execute();
        $result = $sqlSearch->get_result();

        echo "<div class='header'>
                    <h1>JotWise</h1>
                </div>";
        // Check if results exist
        if ($result->num_rows > 0) {
            // Loop through the results
            echo "
            <h1>Results Found for '".$searchTerm."'</h1><br/><br/>
            <div class='container'>";
            while ($row = $result->fetch_assoc()) {  
                $S_id = $row['S_id'];              
                echo "
                <a href='serieDetail.php?id=$S_id'>
                    <div class='cards'>
                        <p>";
                        if (!empty($row['Image'])) {
                            echo "<img class='view' src='http://localhost/JotWise/" . htmlspecialchars($row['Image']) . "'><br>";
                        } else {
                            echo "No image available";
                        }
                        echo "</p>
                        <h3>" . htmlspecialchars($row['S_name']) . "</h3>
                        <p>Rate - " . htmlspecialchars($row['Rate']) . "</p>
                    </div>
                </a>";
            }
            echo "</div>";
        } else {
            echo "<h1>No Result matched.</h1>";
        }

        $sqlSearch->close();
    } else {
        echo "Search term not set.";
    }
?>
