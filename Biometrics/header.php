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
        /* Styling untuk notifikasi Toast */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }
    </style>
</head>
<body>

<div aria-live="polite" aria-atomic="true" class="toast-container">
    <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <strong class="mr-auto" id="toast-title"></strong>
            <small>Baru saja</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="toast-body">
        </div>
    </div>
</div>


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

<script>
$(document).ready(function() {
    let lastLogId = 0;

    // 1. Dapatkan ID log terakhir saat halaman dimuat
    $.get('get_last_log_id.php', function(data) {
        lastLogId = parseInt(data) || 0;
    });

    // 2. Cek log baru setiap 5 detik
    setInterval(function() {
        $.ajax({
            url: 'check_new_log.php',
            type: 'GET',
            data: { last_id: lastLogId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Update ID terakhir yang diketahui
                    lastLogId = parseInt(response.new_id);
                    
                    // Siapkan dan tampilkan notifikasi
                    let action_icon = response.action === 'Login' ? '<i class="fa fa-sign-in text-success"></i>' : '<i class="fa fa-sign-out text-danger"></i>';
                    
                    $('#toast-title').html(action_icon + ' Aktivitas Baru: ' + response.action);
                    $('#toast-body').text(response.username + ' berhasil melakukan ' + response.action.toLowerCase() + ' pada pukul ' + response.time + '.');
                    
                    $('#notificationToast').toast('show');
                }
            },
            error: function() {
                // Diamkan jika ada error, untuk menghindari console spam
            }
        });
    }, 5000); 
});
</script>