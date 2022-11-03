<?php

//retrieve mysql login data
require_once 'login.php';

//create connection
$conn = new mysqli($hn, $un, $pw, $db);

//check connection
if($conn->connect_error){
    die("Fatal Error");

}

printf('Connected successfully.<br />');


//create users table, username to be primary key
$users_table = "CREATE TABLE IF NOT EXISTS Users  (
    username VARCHAR(30) PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL, 
    lastname VARCHAR(30) NOT NULL, 
    email VARCHAR(50) NOT NULL,
    joindate DATE NOT NULL,
    passwd VARCHAR(50) NOT NULL
    )";

$result_users = $conn->query($users_table);



if(!$result_users){
    echo "error creating users table";
}
else{
    echo "Users table created successfully";
}

//create games table, auto_incerement id to be primary key
$games_table = "CREATE TABLE IF NOT EXISTS Games  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_name VARCHAR(30) NOT NULL, 
    publisher VARCHAR(30) NOT NULL, 
    developer VARCHAR(50) NOT NULL,
    release_date DATE NOT NULL
    )";

$result_games = $conn->query($games_table);



if(!$result_games){
    echo "error creating games table";
}
else{
    echo "Games table created successfully";
}

//test adding user
$insert_user = "INSERT INTO Users VALUES ('bryan', 'bryan', 'hennes', 'bhens@gmail.com', '2022-10-31', 'password')";
$result_insert_user = $conn->query($insert_user);

if(!$result_insert_user){
    echo "error adding user";
}
else{
    echo "User added";
}

//test adding game
$insert_game = "INSERT INTO Games VALUES (default, 'Call of Duty: Modern Warfare 2', 'Infinty Ward', 'Infinity Ward', '2022-10-28')";
$result_insert_game = $conn->query($insert_game);

if(!$result_insert_game){
    echo "error adding game";
}
else{
    echo "Game added";
}


//close connection
$conn->close();


?>