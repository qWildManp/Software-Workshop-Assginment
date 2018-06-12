<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="LOGO.png">

    <title>DDL Cake Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/signin.css" rel="stylesheet">
    <link href="bootstrap/carousel.css" rel="stylesheet">
</head>

<body class="text-center">
<?php
session_start();

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <img src="LOGOwhite.png" width="30" height="30">
        <a class="navbar-brand" href="homepage.php">DDL Cake Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userpage.php"> Order </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login_bs.php"> Login </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login_admin.php"> Admin </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="contact.php">About</a>
                </li>
            </ul>
            <p class="text-white form-inline my-2 my-md-0 ">
            </p>
        </div>
    </div>
</nav>
<div class="container marketing">

    <p class="display-3">Developers Details:</p>
    <div class="row">
        <div class="col-lg-5">
            <img class="rounded-circle"
                 src="pics/harry.jpeg"
                 alt="Generic placeholder image" width="140" height="140">
            <h2>Harry</h2><br>
            <p>m730026028</p>
            <p>Tel.15919208549</p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-1"></div>
        <div class="col-lg-5">
            <img class="rounded-circle"
                 src="pics/johnathan.jpeg"
                 alt="Generic placeholder image" width="140" height="140">
            <h2>Johnathan</h2><br>
            <p>m730026032</p>
            <p>Tel.15016118957</p>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->
</div>
<footer class="container py-1 fixed-bottom">
    <div class="row">
        <div class="col-12 col-md">
            <img src="DDL.png" width="60" height="60">
            <small class="d-block mb-3 text-muted">&copy; DDL Cake Shop</small>
        </div>

        <div class="col-6 col-md">
            <h5>DDL Cake Shop</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="homepage.php">Home</a></li>
                <li><a class="text-muted" href="login_bs.php">Log In</a></li>
                <li><a class="text-muted" href="login_admin.php">Admin</a></li>
                <li><a class="text-muted" href="contact.php">About Us</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>Other shops</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="https://www.21cake.com/">21 cake</a></li>
                <li><a class="text-muted" href="http://www.mcake.com/">Mcake</a></li>
                <li><a class="text-muted" href="http://www.roseonly.com.cn/">Roseonly</a></li>
                <li><a class="text-muted" href="https://www.swarovski.com/">Swarovski</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5>About</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="contact.php">Contact Us</a></li>
                <li><a class="text-muted" href="http://uic.edu.hk/cn/">UIC Homepage</a></li>
                <li><a class="text-muted" href="https://www.uiccst.com/">UIC CST</a></li>
                <li><a class="text-muted" href="https://uichcc.com/">UIC HCC</a></li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="bootstrap/jquery-slim.min.js"><\/script>')</script>
<script src="bootstrap/popper.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>
