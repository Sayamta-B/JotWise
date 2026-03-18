<?php
    session_start();
    define('BASE_URL', 'http://localhost/JotWise');

    //to embedded the php code of creating connection with database
    include '../createConnection.php';
    

    if($_SERVER['REQUEST_METHOD']=="POST"){
        $checkPass=NULL;
        $Username=$_POST['UserNameOremail'];
        $Password=$_POST['Password'];
        
        $sql = $conn->prepare("SELECT U_id, Username, Email, Password, Role FROM User WHERE Username=? OR Email=?;");
        $sql->bind_param("ss",$Username,$Username);
        $sql->execute();
        $result=$sql->get_result();

        if($result->num_rows > 0){            
            while($row = $result->fetch_assoc()){
                $_SESSION['U_id']=$row["U_id"];
                $storedPasswordHash = $row["Password"];
                $_SESSION["Username"] = $row["Username"];
                $_SESSION["Email"] = $row["Email"];
                $_SESSION["Role"] = $row["Role"];
            }
            
            // Now compare the user-inputted password with the one from the database
            if (password_verify($Password, $storedPasswordHash)) {
                $_SESSION["loggedin"] = true; //the user is logged in
                if($_SESSION["Role"]=="user"){
                    // Redirect to the user homepage on success
                    header("Location: http://localhost/JotWise/html/userHomepage.php");
                    exit();
                }else{
                    // Redirect to the admin homepage on success
                    header("Location: http://localhost/JotWise/html/adminHomepage.html");
                    exit();
                }
            } else {
                echo"<script>
                    alert ('Incorrect Password!');
                    window.location.href = '" . BASE_URL . "/html/userlogin.html';
                </script>";
                exit();
            }
        }
        else{
            echo"<script>
                alert ('Username or Email not found!');
                window.location.href = '" . BASE_URL . "/html/userlogin.html';
            </script>";
            exit();
        }  
    }
    $conn->close();      
?>