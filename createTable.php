<?php

include 'createConnection.php';

//create table for User
$sql="CREATE TABLE User (
        U_id INT(10) PRIMARY KEY AUTO_INCREMENT,
        Username VARCHAR(100) UNIQUE NOT NULL,
        Email VARCHAR(100) UNIQUE NOT NULL,
        Password VARCHAR(100) NOT NULL,
        Role ENUM('user', 'admin') DEFAULT 'user' -- Role defines if user is admin or regular user
);";

//create table for Series
$sql.="CREATE TABLE Series (
        S_id INT(10) AUTO_INCREMENT PRIMARY KEY,
        S_name VARCHAR(100) NOT NULL,       -- Series name
        Genre VARCHAR(200),                 -- Series genre
        Duration VARCHAR(200),              -- Total duration
        Episodes INT(10),                   -- Number of episodes
        ReleaseDate DATE,                   -- Release date (use DATE type)
        Rate FLOAT(3, 2),                   -- Rating, e.g., 4.5 (FLOAT with precision)
        Image VARCHAR(2090),                -- Series image
        Description TEXT                    -- Description of the series 
);";

//create table for comments
$sql.="CREATE TABLE Comments (
        C_id INT PRIMARY KEY AUTO_INCREMENT, -- Unique ID for each comment
        U_id INT(10) NOT NULL,                    -- Reference to User table
        S_id INT(10) NOT NULL,                    -- Reference to Series table
        CommentText TEXT NOT NULL,                -- Text of the comment
        CommentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (U_id) REFERENCES User(U_id) ON DELETE CASCADE,
        FOREIGN KEY (S_id) REFERENCES Series(S_id) ON DELETE CASCADE
);";

//create table for favorite
$sql.="CREATE TABLE Favorites (
        F_id INT PRIMARY KEY AUTO_INCREMENT, -- Unique ID for each favorite entry
        U_id INT(10) NOT NULL,               -- Reference to User table
        S_id INT(10) NOT NULL,               -- Reference to Series table
        AddedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (U_id) REFERENCES User(U_id) ON DELETE CASCADE,
        FOREIGN KEY (S_id) REFERENCES Series(S_id) ON DELETE CASCADE,
        UNIQUE (U_id, S_id)                  -- Prevent duplicate favorites for the same user and series
);";


if($conn->multi_query($sql)){
    echo "Table Created Sucessfully";
}
else{
    echo "Error creating tables: " . $conn->error;
}
?>