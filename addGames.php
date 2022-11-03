<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//retrieve mysql login data



//add data to database
function addGame($name, $publisher, $developer, $date){
    require_once 'login.php';

//create connection
    $conn = new mysqli($hn, $un, $pw, $db);
    //check connection
    if($conn->connect_error){
        die("Fatal Error");

    }

    if($stmt = $conn->prepare("INSERT INTO games (game_name, publisher, developer, release_date) VALUES (?, ?, ?, ?)")){
        $stmt->bind_param('ssss', $name, $publisher, $developer, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        echo 'Game added!';
    }
    else {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
        echo 'Game not added!';
    }

   
    $conn->close();
}



?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <form method="post">
           Game Name: <input type="text" name="gamename" />
           Publisher: <input type="text" name="publisher"/>
            Developer: <input type="text" name="developer"/>
            Release Date: <input type="text" name="releasedate"/>
            <input type="submit" value="Add Game" name="addGameBtn"/>

        </form>

        <?php
        if(isset($_POST['addGameBtn'])){
            $nm = $_POST['gamename'];
            $pub = $_POST['publisher'];
            $dev = $_POST['developer'];
            $reldate = $_POST['releasedate'];
            addGame($nm, $pub, $dev, $reldate);
        }



        ?>
        <script src="" async defer></script>
    </body>
</html>