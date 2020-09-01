<?php   
    include("includes/config.php");
    include("includes/classes/Artist.php");
    include("includes/classes/Album.php");
    //session_destroy(); //for logout

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    } else {
        header("Location: register.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico">
    <title>Spotify Clone</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="mainContainer">
        <div id="topContainer">
            <?php include("includes/navbarContainer.php")?>
                <div id="mainViewContainer">
                    <div id="mainContent">