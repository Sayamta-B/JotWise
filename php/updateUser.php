<?php
session_start();
include "../createConnection.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $U_id=$_POST['U_id'];
    $Username=$_POST['Username'];
    $Email=$_POST['Email'];

    $sqlUpdate = $conn->prepare("Update user SET Username=?, Email=? WHERE U_id=?;");
    $sqlUpdate->bind_param("ssi", $Username, $Email, $U_id);
        if ($sqlUpdate->execute()) {
            echo "<script>
                    alert ('User updated successfully!!');
                    window.location.href = 'updateUserForm.php?id=$U_id';
                  </script>";
            exit();
        } else {
            echo "Error updating user: " . $conn->error;
        }
    }

    $conn->close();
?>