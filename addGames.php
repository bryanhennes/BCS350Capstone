<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//retrieve mysql login data

require_once 'login.php';

//create connection
$conn = new mysqli($hn, $un, $pw, $db);
    //check connection
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



//add data to database
function addGame($name, $publisher, $developer, $date, $connection){

    if($stmt = $connection->prepare("INSERT INTO games (game_name, publisher, developer, release_date) VALUES (?, ?, ?, ?)")){
        $stmt->bind_param('ssss', $name, $publisher, $developer, $date);
        $stmt->execute();
        $result = $stmt->get_result();
        echo '<script>alert("Game Added!")</script>';
    }
    else {
        $error = $connection->errno . ' ' . $connection->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
        echo '<script>alert("Issue Adding Game!")</script>';
    }

   
    $connection->close();
}
?>

<script>
function validate(form) {
  //validate each field value
  fail = validateGameName(form.gamename.value)
  fail += validatePublisher(form.publisher.value)
  fail += validateDeveloper(form.developer.value)
  fail += validateDate(form.releasedate.value)

  if (fail == ""){
    return true //if no error, return true
  }
  else { 
    alert(fail); 
    return false //if any error, show errors and return false
  } 
}

//validate game name was entered
function validateGameName(field) {
  return (field == "") ? "No Game Name was entered.\n" : ""
}

//validate publisher name was entered
function validatePublisher(field) {
  return (field == "") ? "No Publisher was entered.\n" : ""
}

//validate developer name was entered
function validateDeveloper(field) {
  return (field == "") ? "No Developer was entered.\n" : ""
}

//validate release date was entered
function validateDate(field){
  return (field == "") ? "No Release Date was entered.\n" : ""
}



</script>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<style> 
html {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  background: rgb(63,94,251);
  background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);
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
  <h2 class="header">Add a Game</h2>
  <div>
    <form method="post" onSubmit="return validate(this)">
      <input type="text" name="gamename" placeholder="Game Name" required></input>
      <input type="text" name="publisher" placeholder="Publisher" required></input>
      <input type="text" name="developer" placeholder="Developer" required></input>
      <label for="releasedate">Release Date:</label>
      <input type="date" id="releasedate" name="releasedate" min="1950-01-01" max="2025-12-31" required></input>
      <input type="submit" value="Add Game" id="addGameBtn" name="addGameBtn"/><br>
    </form>
  </div>
  <input type="button" onclick="location.href='index.php';" value="Main Menu" />
</div>
    

        <?php
        if(isset($_POST['addGameBtn'])){
          //sanitize user input before submitting to database
            $nm = sanitizeEntitiesInput(sanitizeInput($_POST['gamename'], $conn), $conn);
            $pub = sanitizeEntitiesInput(sanitizeInput($_POST['publisher'], $conn), $conn);
            $dev = sanitizeEntitiesInput(sanitizeInput($_POST['developer'], $conn), $conn);
            $reldate = $_POST['releasedate'];
            addGame($nm, $pub, $dev, $reldate, $conn);
        }
      

      

        
        ?>
        <script src="" async defer></script>
    </body>
</html>