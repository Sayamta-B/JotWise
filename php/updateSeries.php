<?php
session_start();
include "../createConnection.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $S_id=$_POST['S_id'];
    $S_name=$_POST['S_name'];
    $Genre=$_POST['Genre'];
    $Episodes=$_POST['Episodes'];
    $Duration=$_POST['Duration'];
    $ReleaseDate=$_POST['ReleaseDate'];
    $Rate=$_POST['Rate'];
    $Description=$_POST['Description'];

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

    $sqlUpdate = $conn->prepare("Update series SET S_name=?, Genre=?, Episodes=?, Duration=?, ReleaseDate=?, Rate=?, Image=?, Description=? WHERE S_id=?;");
    $sqlUpdate->bind_param("ssiisssss", $S_name, $Genre, $Episodes, $Duration, $ReleaseDate, $Rate, $image_url, $Description, $S_id);
        if ($sqlUpdate->execute()) {
            echo "<script>
                    alert ('Series updated successfully!!');
                    window.location.href = 'viewSeries.php';
                  </script>";
            exit();
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }

    $conn->close();
?>