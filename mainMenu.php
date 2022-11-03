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
            

    <!--<form method="post" action="dbprocess.php">
        <input type="submit" name="gamesBtn"
                class="button" value="Show Games" />
          
        <input type="submit" name="usersBtn"
                class="button" value="Show Users" />
    </form> -->
    <input type="button" onclick="location.href='displayGames.php';" value="Show Games" />
    <input type="button" onclick="location.href='displayUsers.php';" value="Show Users" />
    <input type="button" onclick="location.href='addGames.php';" value="Add Game" />
    <input type="button" onclick="location.href='deleteGames.php';" value="Delete Game" />
    <input type="button" onclick="location.href='searchGames.php';" value="Search" />

        
        <script src="" async defer></script>
    </body>
</html>