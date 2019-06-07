<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type=" text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
       
    <?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo '<script type="text/javascript" src="' . URL . 'views/' . $js . '"></script>'; //not working, not reading the file for some reason
        }
    }
    ?>
</head>

<body>
    <?php Session::init(); ?>
    <div id="header">
        <!-- Header -->
        <br>
        <?php if (Session::get('loggedIn') == false) : ?>
            <a href="<?php echo URL; ?>index"> Index </a>
            <a href="<?php echo URL; ?>help"> Help </a>
        <?php endif; ?>

        <?php if (Session::get('loggedIn') == true) : ?>
            <a href="<?php echo URL; ?>dashboard"> Dashboard </a>

            <?php if (Session::get('role') == 'owner') : ?>
                <a href="<?php echo URL; ?>user"> Users </a>
            <?php endif; ?>

            <a href="<?php echo URL; ?>dashboard/logout"> Logout</a>
        <?php else : ?>
            <a href="<?php echo URL; ?>login"> Login</a>
        <?php endif; ?>
    </div>

    <!-- <script>
                        console.log('Header file is loading fine')
                    </script> -->
    <div id="content">