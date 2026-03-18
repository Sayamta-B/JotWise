<?php
    //to embbed the php code of creating connection with database
    include '../createConnection.php';

    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        //Getting values from the form with POST method
        $Username=$_POST['Username'];
        $Email=$_POST['Email'];
        $Password=$_POST['CreatePassword'];
        $Role=$_POST['Role'];


        $sqlCheck = $conn->prepare("SELECT Username FROM User WHERE Username = ?");
        $sqlCheck->bind_param("s", $Username);
        $sqlCheck->execute();
        $result = $sqlCheck->get_result();

        // Check email existence
        if ($result->num_rows > 0) {
            echo "<script>
                        alert('Username already exists');
                        window.location.href = 'http://localhost/JotWise/html/registerUser.html';
                    </script>";
            exit();
        }

        // Check if an admin already exists if the role is 'admin'
        if ($Role === 'admin') {
            $sqlCheckAdmin = "SELECT COUNT(*) AS AdminCount FROM User WHERE Role = 'admin'";
            $resultAdmin = $conn->query($sqlCheckAdmin);
            $rowAdmin = $resultAdmin->fetch_assoc();

            if ($rowAdmin['AdminCount'] > 0) {
                echo "<script>
                        alert('Admin already exists. Only one admin is allowed.');
                        window.location.href = 'http://localhost/JotWise/html/registerUser.html';
                    </script>";
                exit();
            }
        }

        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

        //Inserting values into the database table 'Admin'
        $sql=$conn->prepare("INSERT INTO User(Username, Email, Password, Role) VALUES (?,?,?,?);");
        $sql->bind_param("ssss", $Username, $Email, $hashedPassword, $Role);
        //Check if SQL code sucessful
        if($sql->execute()===TRUE){     
            header("Location: http://localhost/JotWise/html/userlogin.html");
            exit();
            //to redirect to another page and
            //send the variable in key-value pair, where '?' represents beginning of query string
            //'key' is the variable available in redirected page through get method
        }
        else{
            echo "Something went wrong.";
        }
    }
?>