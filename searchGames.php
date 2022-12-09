<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//retrieve mysql login data
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error){
    die("Fatal Error");

}

//sanitize user input
function sanitizeEntitiesInput($input, $connection){
  return htmlentities(sanitizeInput($input, $connection));
}

function sanitizeInput($input, $connection){
  return $connection->real_escape_string($input);
}

//use this function to see if there are any possible results from search query
function checkResults($connection, $searchBy, $keyword){

  if($searchBy == 'gamename'){
    $category = 'game_name';
    $sql = "SELECT game_name FROM games";
  }
  else if($searchBy == 'publisher'){
    $category = 'publisher';
    $sql = "SELECT publisher FROM games";
  }
  else if($searchBy == 'developer'){
    $category = 'developer';
    $sql = "SELECT developer FROM games";
  }
  else{
    $category = 'release_date';
    $sql = "SELECT release_date FROM games";
  }
  $result = $connection->query($sql);


  $pattern = "/$keyword/i";
  $counter = 0;
        while($rows=$result->fetch_assoc())
        {
          if(preg_match($pattern, $rows[$category]) == 0){
            
            $rows++;
          }
          else{
            $counter++;
          }

        }

  return $counter;
  $connection->close();
}

function keywordToSearchBy($connection, $searchBy, $explosion){
  $newKeyword = "";
  if($searchBy == 'gamename'){
    $category = 'game_name';
    $sql = "SELECT game_name FROM games";
  }
  else if($searchBy == 'publisher'){
    $category = 'publisher';
    $sql = "SELECT publisher FROM games";
  }
  else if($searchBy == 'developer'){
    $category = 'developer';
    $sql = "SELECT developer FROM games";
  }
  else{
    $category = 'release_date';
    $sql = "SELECT release_date FROM games";
  }
  $result = $connection->query($sql);

  //foreach($explosion as $keyword){
  for($i =0; $i<sizeof($explosion);$i++){
    $keyword = $explosion[$i];
    $pattern = "/$keyword/i";
    $counter = 0;
          while($rows=$result->fetch_assoc())
          {
            if(preg_match($pattern, $rows[$category]) == 0){
              
              $rows++;
            }
            else{
              $newKeyword = $keyword;
            }

          }
  }
  return $newKeyword;
  $connection->close();
}



//search database for keyword inputted by user
function search($connection, $keyword, $searchBy){

    //regular expression pattern to query similar terms from database
    $pattern = "/$keyword/i";
      
    $searchQuery = "SELECT * FROM games";

    //if user is searching by game name
    if($searchBy == 'gamename'){
      $category = "game_name";
    }
    else if($searchBy == 'publisher'){
      $category = "publisher";
    }
    else if($searchBy == 'developer'){
      $category = "developer";
    }
    else {
      $category = "release_date";
    }
    $result = $connection->query($searchQuery);

    //if query returns no results
    if(checkResults($connection, $searchBy, $keyword) == 0){
        ?>
        <h1> No results found for: <?php echo $searchBy.': "'.$keyword.'"'; ?></h1> <?php
        return;
    }
    //else display results in table form
    ?>
    <h1> Results for: <?php echo $searchBy.': "'.$keyword.'"'; ?> </h1>
    <table>
      <thead>
        <tr>
            <th>Game</th>
            <th>Publisher</th>
            <th>Developer</th>
            <th>Release Date</th>
        </tr>
    </thead>
    <?php
        //$counter = 0;
        while($rows=$result->fetch_assoc())
        {
          if(preg_match($pattern, $rows[$category]) == 0){ 
            $rows++;
          }
          else{ //$counter++;
    ?>
    <tbody>
      <tr>
          <td><?php echo $rows['game_name'];?></td>
          <td><?php echo $rows['publisher'];?></td>
          <td><?php echo $rows['developer'];?></td>
          <td><?php echo $rows['release_date'];?></td>
      </tr>
    </tbody>
    <?php
          }
        } 
        ?>
</table>
<?php
$connection->close();
}

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<style> 
html {
  background: rgb(63,94,251);
  background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
}

table {
    border-collapse: collapse;
    margin: 0 auto;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

table thead tr {
    background-color: #2b519e;
    color: #ffffff;
    text-align: left;
}

table th,
table td {
    padding: 12px 15px;
}

table tbody tr {
    border-bottom: 1px solid #dddddd;
    background: #f3f3f3;
}


table tbody tr:last-of-type {
    border-bottom: 2px solid #2b519e;
}

table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
h1 {
    text-align: center;
    color: linear-gradient(to right, #207cca 0%,#9f58a3 100%);
    font-size: xx-large;
    font-family: 'Gill Sans', 'Gill Sans MT',
    ' Calibri', 'Trebuchet MS', 'sans-serif';
}


#form {
  width: 280px;
  margin: 0 auto;
  background-color: #fcfcfc;
  padding: 20px 50px 40px;
  box-shadow: 1px 4px 10px 1px #aaa;
  font-family: sans-serif;
}

#form * {
    box-sizing: border-box;
}

#form h2{
  text-align: center;
  margin-bottom: 30px;
}

#form input {
  margin-bottom: 15px;
}

#form input[type=text] {
  display: block;
  height: 32px;
  padding: 6px 16px;
  width: 100%;
  border: none;
  background-color: #f3f3f3;
}

#form label {
  color: #777;
  font-size: 0.8em;
}

#form input[type=checkbox] {
  float: left;
}

#form input[type=submit] {
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

#form input[type=button] {
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
  <div id="form">
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
      <input type="submit" value="Search" id="searchBtn" name="searchBtn"/><br>
    </form>
  </div>
  <input type="button" onclick="location.href='index.php';" value="Main Menu" />
</div>
    

        <?php
        //selection from dropdown
        if(isset($_POST['searchBtn'])){
            $selectOption = $_POST['options']; //get field user is searching in
            $searchTerm = sanitizeEntitiesInput(sanitizeInput($_POST['searchField'], $conn), $conn); //get keyword user is searching for
            //$searchTerm = $conn->real_escape_string($_POST['searchField']);
            search($conn, $searchTerm, $selectOption); //search

        } 

      

        
        ?>
        <script src="" async defer></script>
    </body>
</html>