<?php

const HOST = "localhost";
const USERNAME = "root";
const PASSWORD = "";

//connect function is connecting to mysql server only if no parameter is given,otherwise function is creating that database then connecting to it.
function connect($dbName = null){
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD);
    if ($dbName){
        if ($conn){
            $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
            $answer = mysqli_query($conn,$sql);
            if ($answer){
                if (!isset($_SESSION['connectedToDb'])){
                    echo "New database was created and connected successfully!";
                }
                $conn = @mysqli_connect(HOST,USERNAME,PASSWORD,$dbName);
            }
            else{
                echo "Error creating database " . mysqli_errno();
            }
        }
        else{
            mysqli_close($conn);
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
            mysqli_close($conn);
            echo "<br>";
        }
    };
    return $conn;
}

//createTable function is creating 'users' table in 'commentProject' database by default,if no parameter is given.
//1 parameter is database name,second parameter is table name.
function createUsersTable($dbName = "commentProject",$tableName = "users"){
    $conn = connect($dbName);

    if ($conn){
        $sql = "CREATE TABLE if not exists $tableName (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `password` varchar(255) DEFAULT NULL,
  `isblocked` boolean DEFAULT 0,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`)
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

function createCommentsTable($dbName = "commentProject",$tableName = "comments"){
    $conn = connect($dbName);

    if ($conn){
        $sql = "CREATE TABLE if not exists $tableName (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `authorId` int(20) DEFAULT NULL,
  `authorName` varchar(255) DEFAULT NULL,
  `authorEmail` varchar(255) DEFAULT NULL,
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

