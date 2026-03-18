<?php
include '../createConnection.php'; // Update the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $S_name = $_POST['S_name'];
    $Genre = $_POST['Genre'];
    $Episodes = $_POST['Episodes'];
    $Duration = $_POST['Duration'];
    $ReleaseDate = $_POST['ReleaseDate'];
    $Rate = $_POST['Rate'];
    $Description = $_POST['Description'];

    
    // $file_tmp_path = $_FILES['Image']['tmp_name'];
    // echo $file_tmp_path."<br>";
    $file_name = $_FILES['Image']['name'];
    echo $file_name;
    $file_dest_path = "images/" . $file_name; // Save in 'images' directory
    echo $file_dest_path;

    // Move the uploaded file to the destination
    if ($file_dest_path!=0){
        $image_url = $file_dest_path; // Save this path to the database
    } else {
        echo "<script>
                alert('Failed to upload the file.');
                // window.location.href = '../html/adminHomepage.html';
              </script>";
        exit();
    }

    // Prepare and execute the SQL query
    $sql = $conn->prepare("INSERT INTO Series (S_name, Genre, Episodes, Duration, ReleaseDate, Rate, Image, Description) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("ssiissss", $S_name, $Genre, $Episodes, $Duration, $ReleaseDate, $Rate, $image_url, $Description);

    if ($sql->execute()) {
        echo "<script>
                alert('Review added successfully!');
                window.location.href = 'http://localhost/JotWise/html/adminHomepage.html';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . $sql->error . "');
                window.location.href = '../html/adminHomepage.html';
              </script>";
    }

    $sql->close();
}
?>
