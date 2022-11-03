<?php

//retrieve mysql login data
require_once 'login.php';

//create connection
$conn = new mysqli($hn, $un, $pw, $db);
$users_sql = " SELECT * FROM users";
$result_users = $conn->query($users_sql);

//check connection
if($conn->connect_error){
    die("Fatal Error");

}

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
        <h1>Users</h1>

        <?php displayUsers($users_sql, $result_users); ?>
        
        <script src="" async defer></script>
    </body>
</html>