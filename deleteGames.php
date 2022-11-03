<?php

//retrieve mysql login data
require_once 'login.php';

//create connection
$conn = new mysqli($hn, $un, $pw, $db);
$sql = " SELECT * FROM games";
$result = $conn->query($sql);


//check connection
if($conn->connect_error){
    die("Fatal Error");

}

function deleteGame($connection, $id){
    $deleteQuery = "DELETE FROM games WHERE id='".$id."';";
    $result = $connection->query($deleteQuery);
}

//function to display games data
function displayGames($connection, $sql, $result) {
    ?>
    <form method="post">
    <table>
    <tr>
        <th></th>
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
        <td><?php echo "<input type='checkbox' name='check[]' value='{$rows["id"]}'>";?><?php echo $rows['id'];?></td>
        <td><?php echo $rows['game_name'];?></td>
        <td><?php echo $rows['publisher'];?></td>
        <td><?php echo $rows['developer'];?></td>
        <td><?php echo $rows['release_date'];?></td>
    </tr>
    <?php
        }?>
</table>
<input type="submit" value="Delete Selected" name="deleteBtn"/>
    </form>
<?php
}


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
        <h1>Games</h1>

      
    <form method="post">
    <table>
    <tr>
        <th></th>
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
        <td><?php echo "<input type='checkbox' name='check[]' value='{$rows["id"]}'>";?><?php echo $rows['id'];?></td>
        <td><?php echo $rows['game_name'];?></td>
        <td><?php echo $rows['publisher'];?></td>
        <td><?php echo $rows['developer'];?></td>
        <td><?php echo $rows['release_date'];?></td>
    </tr>
    <?php
        }?>
</table>
<input type="submit" value="Delete Selected" name="deleteBtn"/>
    </form>
<?php

        if(isset($_POST['deleteBtn'])){
            if(!empty($_POST['check'])) {    
                foreach($_POST['check'] as $value){
                    deleteGame($conn, $value);
                }
            }
        }

        //*need to reload table after deleting to show updated table
        
        ?>

    

        
        <script src="" async defer></script>
    </body>
</html>