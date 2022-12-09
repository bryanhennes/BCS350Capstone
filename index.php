
<?php
session_start();
//if not logged in go to login page
if(isset($_SESSION['username'])==null){
    session_unset();
    session_destroy();
    header("Location: loginMain.php");
}

if(isset($_POST['logoutBtn'])){
  logout();
}

//if logout is clicked bring user back to login page
function logout(){
  session_unset();
  session_destroy();
  header("Location: loginMain.php");
}


?>

<!DOCTYPE html>

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

h1 {
  text-align: center;
  margin-bottom: 30px;
  font-family: sans-serif;
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
    <h1>Steam Video Game Database</h1>
    <div id="form">
  <h2 class="header">Welcome, <?php echo $_SESSION['username'];?></h2>
  <div>
    <form method="post">
    <input type="button" onclick="location.href='displayGames.php';" value="Show Games" />
    <input type="button" onclick="location.href='addGames.php';" value="Add Game" />
    <input type="button" onclick="location.href='deleteGames.php';" value="Delete Game" />
    <input type="button" onclick="location.href='searchGames.php';" value="Search" />
    <input type="submit" id="logoutBtn" name="logoutBtn" value="Log Out" />
    </form>
  </div>
</div>
    

        
        <script src="" async defer></script>
    </body>
</html>