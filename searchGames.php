<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//retrieve mysql login data
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error){
    die("Fatal Error");

}

//search database for keyword inputted by user
function search($connection, $keyword, $searchBy){

    //if user is searching by game name
    if($searchBy == 'gamename'){
        $searchQuery = "SELECT * FROM games WHERE game_name='".$keyword."';";
    }
    else if($searchBy == 'publisher'){
        $searchQuery = "SELECT * FROM games WHERE publisher='".$keyword."';";
    }
    else if($searchBy == 'developer'){
        $searchQuery = "SELECT * FROM games WHERE developer='".$keyword."';";
    }
    else {
        $searchQuery = "SELECT * FROM games WHERE release_date='".$keyword."';";
    }
    $result = $connection->query($searchQuery);

    //if query returns no results
    if (mysqli_num_rows($result)==0) { 
        ?>
        <h1> No results found for: <?php echo $searchBy.': "'.$keyword.'"'; ?></h1> <?php
        return;
    }
    //else display results in table form
    ?>
    <h1> Results for: <?php echo $searchBy.': "'.$keyword.'"'; ?> </h1>
    <table>
    <tr>
        <th>Game</th>
        <th>Publisher</th>
        <th>Developer</th>
        <th>Release Date</th>
    </tr>
    <?php
        while($rows=$result->fetch_assoc())
        {
    ?>
    <tr>
        <td><?php echo $rows['game_name'];?></td>
        <td><?php echo $rows['publisher'];?></td>
        <td><?php echo $rows['developer'];?></td>
        <td><?php echo $rows['release_date'];?></td>
    </tr>
    <?php
        }?>
</table>
<?php

}

//$conn->close();


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<style> 

table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
            background: linear-gradient(to right, #207cca 0%,#9f58a3 100%);
        }
 
        h1 {
            text-align: center;
            color: linear-gradient(to right, #207cca 0%,#9f58a3 100%);
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background: linear-gradient(to right, #207cca 0%,#9f58a3 100%);
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }

#feedback-form {
  width: 280px;
  margin: 0 auto;
  background-color: #fcfcfc;
  padding: 20px 50px 40px;
  box-shadow: 1px 4px 10px 1px #aaa;
  font-family: sans-serif;
}

#feedback-form * {
    box-sizing: border-box;
}

#feedback-form h2{
  text-align: center;
  margin-bottom: 30px;
}

#feedback-form input {
  margin-bottom: 15px;
}

#feedback-form input[type=text] {
  display: block;
  height: 32px;
  padding: 6px 16px;
  width: 100%;
  border: none;
  background-color: #f3f3f3;
}

#feedback-form label {
  color: #777;
  font-size: 0.8em;
}

#feedback-form input[type=checkbox] {
  float: left;
}

#feedback-form input:not(:checked) + #feedback-phone {
  height: 0;
  padding-top: 0;
  padding-bottom: 0;
}

#feedback-form #feedback-phone {
  transition: .3s;
}

#feedback-form input[type=submit] {
  display: block;
  margin: 20px auto 0;
  width: 150px;
  height: 40px;
  border-radius: 25px;
  border: none;
  color: #eee;
  font-weight: 700;
  box-shadow: 1px 4px 10px 1px #aaa;
  cursor: pointer;
  
  background: #207cca; /* Old browsers */
  background: -moz-linear-gradient(left, #207cca 0%, #9f58a3 100%); /* FF3.6-15 */
  background: -webkit-linear-gradient(left, #207cca 0%,#9f58a3 100%); /* Chrome10-25,Safari5.1-6 */
  background: linear-gradient(to right, #207cca 0%,#9f58a3 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#207cca', endColorstr='#9f58a3',GradientType=1 ); /* IE6-9 */
}

#feedback-form input[type=button] {
  display: block;
  margin: 20px auto 0;
  width: 150px;
  height: 40px;
  border-radius: 25px;
  border: none;
  color: #eee;
  font-weight: 700;
  box-shadow: 1px 4px 10px 1px #aaa;
  cursor: pointer;
  
  background: #207cca; /* Old browsers */
  background: -moz-linear-gradient(left, #207cca 0%, #9f58a3 100%); /* FF3.6-15 */
  background: -webkit-linear-gradient(left, #207cca 0%,#9f58a3 100%); /* Chrome10-25,Safari5.1-6 */
  background: linear-gradient(to right, #207cca 0%,#9f58a3 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#207cca', endColorstr='#9f58a3',GradientType=1 ); /* IE6-9 */
}




</style>
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
        <!--<div class="form">
        <form method="post">
           Game Name: <input type="text" id="name" name="gamename" required /><br>
           Publisher: <input type="text" name="publisher" required /><br>
            Developer: <input type="text" name="developer" required /><br>
            Release Date: <input type="text" name="releasedate" required /><br>
            <input type="submit" value="Add Game" name="addGameBtn"/><br>
            

        </form>-->
        <div id="feedback-form">
  <h2 class="header">Search for a Game</h2>
  <div>
    <form method="post">
    <label for="options">Search by:</label>

        <select name="options" id="options">
            <option value="gamename">Game Name</option>
            <option value="publisher">Publisher</option>
            <option value="developer">Developer</option>
            <option value="releasedate">Release Date</option>
        </select>
      <input type="text" name="searchField" placeholder="Keyword" required></input>
      <!--
      <input type="text" name="publisher" placeholder="Publisher" required></input>
      <input type="text" name="developer" placeholder="Developer" required></input>
      <input type="text" name="releasedate" placeholder="Release Date" required></input> -->
      <input type="submit" value="Search" id="searchBtn" name="searchBtn"/><br>
    </form>
  </div>
  <input type="button" onclick="location.href='mainMenu.php';" value="Main Menu" />
</div>
    

        <?php
        //selection from dropdown
        if(isset($_POST['searchBtn'])){
            $selectOption = $_POST['options']; //get field user is searching in
            $searchTerm = $conn->real_escape_string($_POST['searchField']); //get keyword user is searching for
            search($conn, $searchTerm, $selectOption); //search
    
        } 

      

        
        ?>
        <script src="" async defer></script>
    </body>
</html>