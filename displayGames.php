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
        <thead>
            <tr>
                <th>Game</th>
                <th>Publisher</th>
                <th>Developer</th>
                <th>Release Date</th>
            </tr>
        </thead>
    <?php
        while($rows=$result->fetch_assoc())
        {
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
        }?>
</table>
<?php
}

$conn->close();

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

input[type=button] {
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

h1 {
    text-align: center;
    color: linear-gradient(to right, #207cca 0%,#9f58a3 100%);
    font-size: xx-large;
    font-family: 'Gill Sans', 'Gill Sans MT',
    ' Calibri', 'Trebuchet MS', 'sans-serif';
}
</style>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1>Games</h1>

        <?php displayGames($games_sql, $result_games); ?>
        <input type="button" onclick="location.href='index.php';" value="Main Menu" />
        
        <script src="" async defer></script>
    </body>
</html>