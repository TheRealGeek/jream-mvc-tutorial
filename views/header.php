<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css">
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
</head>

<body>
    <!-- <?php Session::init(); //this breaks it for some reason. Leaving it out //Nevermind, it's fixed in the class.sessions.php by adding an '@' to the session_start of the init() function?> -->
    <div id="header">
        <!-- Header -->
        <br>
        <a href="<?php echo URL; ?>index"> Home </a>
        <a href="<?php echo URL; ?>help"> Help </a>
        <?php if (Session::get('loggedIn') == true) : ?>
            <a href="<?php echo URL; ?>dashboard/logout"> Logout</a>
        <?php else : ?>
            <a href="<?php echo URL; ?>login"> Login</a>
        <?php endif; ?>
    </div>

    <!-- <script>
                console.log('Header file is loading fine')
            </script> -->
    <div id="content">