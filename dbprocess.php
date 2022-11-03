<?php

//retrieve mysql login data
require_once 'login.php';

//create connection
$conn = new mysqli($hn, $un, $pw, $db);
$games_sql = " SELECT * FROM games";
$result_games = $conn->query($games_sql);

$users_sql = " SELECT * FROM users";
$result_users = $conn->query($users_sql);

//check connection
if($conn->connect_error){
    die("Fatal Error");

}

//function to display games data
function displayGames($sql, $result) {
    ?>
    <table>
    <tr>
        <th>Id</th>
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
        <td><?php echo $rows['id'];?></td>
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

?>

<?php
//function to display users data
function displayUsers($sql, $result) {
    ?>
    <table>
    <tr>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Join Date</th>
        <th>Password</th>
    </tr>
    <?php
        while($rows=$result->fetch_assoc())
        {
    ?>
    <tr>
        <td><?php echo $rows['username'];?></td>
        <td><?php echo $rows['firstname'];?></td>
        <td><?php echo $rows['lastname'];?></td>
        <td><?php echo $rows['email'];?></td>
        <td><?php echo $rows['joindate'];?></td>
        <td><?php echo $rows['passwd'];?></td>
    </tr>
    <?php
        }?>
</table>
<?php
}
?>

<?php
//function to add game to database
function addGame($sql, $result) {
    $insert_user = "INSERT INTO Users VALUES ('bryan', 'bryan', 'hennes', 'bhens@gmail.com', '2022-10-31', 'password')";
    $result_insert_user = $conn->query($insert_user);

}
?>



<?php
//close sql connection
$conn->close();

?>



<!DOCTYPE html>

<html>

<style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
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
    </style>
<!DOCTYPE html>
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

        <?php 

        //if show games button is clicked on main menu page, display games from database
        if(isset($_POST['gamesBtn'])){
            displayGames($games_sql, $result_games);
        }

        //if show users button is clicked on main menu page, display users from database
        if(isset($_POST['usersBtn'])){
            displayUsers($users_sql, $result_users);
        }
      
        ?>
        
        <script src="" async defer></script>
    </body>
</html>