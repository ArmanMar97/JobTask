<?php

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";


//connect function is connecting to mysql server only,if particular database name is given also creating that database then connecting to it.
function connect($dbName = null){
    $conn = @mysqli_connect(HOST,USERNAME,PASSWORD);
    if ($dbName){
        if ($conn){
            $sql = "CREATE DATABASE $dbName";
            $answer = mysqli_query($conn,$sql);
            if ($answer){
                echo "New database was created and connected successfully!";
                $conn = @mysqli_connect(HOST,USERNAME,PASSWORD,$dbName);
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
        if ($conn){
            echo "Connected to mysqli server!";
            echo "<br>";
        }
        else{
            exit('Connection failed! ' . mysqli_connect_errno());
            echo "<br>";
        }
    };
    return $conn;
}


function createTable($dbName = "commentProject",$tableName = "users"){
    $conn =connect($dbName);

    if ($conn){
        $sql = "CREATE TABLE $tableName (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `password` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4";

        $answer = mysqli_query($conn,$sql);
        if ($answer){
            echo "Table created!";
            echo "<br>";
        }
        else{
            "Connection failed! " . mysqli_connect_errno();
        }
    }
    else{
        exit('Connection failed! ' . mysqli_connect_errno());
        echo "<br>";
    }

}

