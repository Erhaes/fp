<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biometric Attendance</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #187881 !important;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        main {
            padding-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">
        <i class="fa fa-cogs"></i> Biometric Attendance
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa fa-users"></i> Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="UsersLog.php"><i class="fa fa-book"></i> Users Log</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ManageUsers.php"><i class="fa fa-user-plus"></i> Manage Users</a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>