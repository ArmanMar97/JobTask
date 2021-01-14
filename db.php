<?php

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";

function checkConnection($conn){
    if ($conn){
        return true;
    }
    else{
        return false;
    }
}

//connect function is connecting to mysql server only,if particular database name is given also creating that database then connecting to it.
function connect($dbName = null){
    if ($dbName){
        $conn = @mysqli_connect(HOST,USERNAME,PASSWORD);
        if ($conn){
            $sql = "CREATE DATABASE $dbName";
            $answer = mysqli_query($conn,$sql);
            if ($answer){
                echo "New database was created and connected successfully!";
            }
            else{
                echo "Error creating database " . mysqli_errno();
            }
        }
        else{
            exit('Connection failed! ' . mysqli_connect_errno());
            echo "<br>";
        }
    }
    else{
        $conn = @mysqli_connect(HOST,USERNAME,PASSWORD);
        if ($conn){
            echo "Connected to mysqli server!";
            echo "<br>";
        }
        else{
            exit('Connection failed! ' . mysqli_connect_errno());
            echo "<br>";
        }
    };
}


function createTable($dbName = "commentProject",$tableName = "users"){
    $conn = connect($dbName);

    $sql = "CREATE TABLE $tableName (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
}



