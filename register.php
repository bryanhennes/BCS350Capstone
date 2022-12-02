<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//retrieve mysql login data



//add data to database
function addUser($userName, $firstName, $lastName, $email, $date, $password){
    require_once 'login.php';

//create connection
    $conn = new mysqli($hn, $un, $pw, $db);
    //check connection
    if($conn->connect_error){
        die("Fatal Error");

    }

    echo $password;
    if($stmt = $conn->prepare("INSERT INTO Users (username, firstname, lastname, email, joindate, passwd) VALUES (?, ?, ?, ?, ?, ?)")){
        $stmt->bind_param('ssssss', $userName, $firstName, $lastName, $email, $date, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        echo 'User added!';
    }
    else {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
        echo 'User not added!';
    }

   
    //$conn->close();
}



?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
<style> 

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
       
        <div id="feedback-form">
  <h2 class="header">Register</h2>
  <div>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required></input>
      <input type="text" name="firstname" placeholder="First Name" required></input>
      <input type="text" name="lastname" placeholder="Last Name" required></input>
      <input type="text" name="email" placeholder="Email" required></input>
      <input type="text" name="password" placeholder="Password" required></input>
      <input type="submit" value="Create Account" id="registerBtn" name="registerBtn"/><br>
    </form>
  </div>
  <input type="button" onclick="location.href='loginMain.php';" value="Back to Login" />
</div>
    

        <?php
        if(isset($_POST['registerBtn'])){
            $un = $_POST['username'];
            $fn = $_POST['firstname'];
            $ln = $_POST['lastname'];
            $em = $_POST['email'];
            $hashedPw = password_hash($_POST['password'], PASSWORD_DEFAULT); //hash password
            $joinDate = date("Y/m/d");
            addUser($un, $fn, $ln, $em, $joinDate, $hashedPw);
        } 

      

        
        ?>
        <script src="" async defer></script>
    </body>
</html>