<?php
require_once "login.php";
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error){
  die("Fatal Error");

}

if(isset($_POST['username'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username ='$username'";
  $result = $conn->query($sql);

  if (mysqli_num_rows($result)>0){
    session_start();
    $row=$result->fetch_assoc();
    if(password_verify($password, $row['passwd'])){
      $_SESSION['username'] = $row['username'];
      header("Location: index.php");
    }
    else{
      $message = "Incorrect username or password";
      alert_user($message);
    }
  }
  else {
    $message = "Username does not exist!";
    alert_user($message);
  }

  
}

function alert_user($message) {
      // Display the alert box 
  echo "<script>alert('$message');</script>";
}

$conn->close();

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
      

    input {
      padding: 5px 14px;
    }

    input[type=submit]{
      background: -webkit-linear-gradient(left, #207cca 0%,#9f58a3 100%);

    }

    #wrapper {
      width: 280px;
      margin: 0 auto;
      background-color: #f0f0f2;
      padding: 20px 50px 40px;
      box-shadow: 1px 4px 10px 1px #aaa;
      font-family: sans-serif;
    }

        
    </style>
</head>
<body>
    <div id="wrapper">
        <h2>Login</h2>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>
</html>

