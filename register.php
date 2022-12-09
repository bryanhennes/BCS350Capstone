<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if(session_id() == ''){ 
  session_start();
}

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


//add data to database
function addUser($userName, $firstName, $lastName, $email, $date, $password, $connection){
 
    $checkSql = "SELECT * FROM users WHERE username ='$userName'";
    $checkResult = $connection->query($checkSql);

    //check if username already exists
    if (mysqli_num_rows($checkResult)>0){
      echo '<script>alert("Username already taken. Please choose another one.")</script>';

    }
    else if($stmt = $connection->prepare("INSERT INTO Users (username, firstname, lastname, email, joindate, passwd) VALUES (?, ?, ?, ?, ?, ?)")){
        $stmt->bind_param('ssssss', htmlentities($connection->real_escape_string($userName)), htmlentities($connection->real_escape_string($firstName)), $lastName, $email, $date, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        header("Location: index.php");
        echo '<script>alert("User created! Please login.")</script>';
        ?>
        <script>
          window.location = 'http://localhost/BCS350Capstone/index.php'; //go to home page main menu when logged in to newly created account
        </script>
        
        <?php
        $connection->close();
    }
    else {
        $error = $connection->errno . ' ' . $connection->error;
        echo $error;
        echo 'User not added!';
    }
  }

 

  

  //$conn->close();

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<script>
function validate(form) {
  //validate each field value
  fail = validateForename(form.firstname.value)
  fail += validateSurname(form.lastname.value)
  fail += validateUsername(form.username.value)
  fail += validatePassword(form.password.value)
  fail += validateEmail(form.email.value) 
  fail += validatePasswordsMatch(form.confirmpassword.value, form.password.value)
  if (fail == ""){
    return true //if no error, return true
  }
  else { 
    alert(fail); 
    return false //if any error, show errors and return false
  } 
}

//validate first name
function validateForename(field) {
  return (field == "") ? "No Forename was entered.\n" : ""
}

//validate last name
function validateSurname(field) {
  return (field == "") ? "No Surname was entered.\n" : ""
}


function validateUsername(field) {
  if (field == "")
    return "No Username was entered.\n"
  else if (field.length < 5)
    return "Usernames must be at least 5 characters.\n"
  else if (/[^a-zA-Z0-9_-]/.test(field)) //if a character not in the list is found
    return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
  return ""
}

function validatePassword(field){

  if (field == "") 
    return "No Password was entered.\n"
  else if (field.length < 6)
    return "Passwords must be at least 6 characters.\n"
  else if (! /[a-z]/.test(field) || //if there is no character in the list of a to z
    ! /[A-Z]/.test(field) || //if there is no character in the list of A to Z
    ! /[0-9]/.test(field)) //if there is no character in the list of 0-9
    return "Passwords require one each of a-z, A-Z and 0-9.\n"
  return ""
}

function validateEmail(field) {

  if (field == "") 
    return "No Email was entered.\n"
  else if (!((field.indexOf(".") > 0) &&
    (field.indexOf("@") > 0)) ||
    /[^a-zA-Z0-9.@_-]/.test(field))
    return "The Email address is invalid.\n"
  return ""
}

//check that confirm password field matches original password field
function validatePasswordsMatch(field, pass) {
  if (field == "") 
    return "Passwords must match.\n"
  else if(field != pass) 
    return "Passwords must match.\n"
  else return ""

}







</script>



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

#form input[type=password] {
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
  <h2 class="header">Register</h2>
  <div>
    <form method="post" id="regForm" onSubmit="return validate(this)">
      <input type="text" id="username" name="username" placeholder="Username" required></input>
      <input type="text" id="firstname" name="firstname" placeholder="First Name" required></input>
      <input type="text" id="lastname" name="lastname" placeholder="Last Name" required></input>
      <input type="text" id="email" name="email" placeholder="Email" required></input>
      <input type="password" id="password" name="password" placeholder="Password" required></input>
      <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required></input>
      <input type="submit" value="Create Account" id="registerBtn" name="registerBtn"/><br>
    </form>
  </div>
  <input type="button" onclick="location.href='loginMain.php';" value="Back to Login" />
</div>

           
    

        <?php
        if(isset($_POST['registerBtn'])){
          ?>   
            <?php
            //sanitize user input before submitting to database
            $un = sanitizeEntitiesInput(sanitizeInput($_POST['username'], $conn), $conn);
            $fn = sanitizeEntitiesInput(sanitizeInput($_POST['firstname'], $conn), $conn);
            $ln = sanitizeEntitiesInput(sanitizeInput($_POST['lastname'], $conn), $conn);
            $em = sanitizeEntitiesInput(sanitizeInput($_POST['email'], $conn), $conn);
            $pw = sanitizeEntitiesInput(sanitizeInput($_POST['password'], $conn), $conn);
            $hashedPw = password_hash($pw, PASSWORD_DEFAULT); //hash password
            $joinDate = date("Y/m/d");

            addUser($un, $fn, $ln, $em, $joinDate, $hashedPw, $conn);
              ?>
         

    
            
            <?php
        } 

        ?>
    

      

        
        

        

        <script src="" async defer></script>
    </body>
</html>