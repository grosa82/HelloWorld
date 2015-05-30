<?php session_start(); 
    ini_set('display_errors','On'); 
    ini_set('error_reporting','E_ALL | E_STRICT'); 
    error_reporting(E_ALL);
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Assignment</title>
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">CS 313 BYUI</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">About Me</a></li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Assignments <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <?php include "menu.php" ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div role="main" class="container">
        <div class="page-header">
        </div>