<?php
require_once "login.php";
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error){
  die("Fatal Error");

}

if(isset($_POST['username'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  //$sql = "SELECT * FROM users WHERE username ='$username' AND passwd='$password'";
  $sql = "SELECT * FROM users WHERE username ='$username'";
  $result = $conn->query($sql);

  if (mysqli_num_rows($result)>0){
    session_start();
    $row=$result->fetch_assoc();
    if(password_verify($password, $row['passwd'])){
      $_SESSION['username'] = $row['username'];
      header("Location: index.php");
    }
  }

  else{
    echo "Incorrect username or password";
    echo $password;
  }
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

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

