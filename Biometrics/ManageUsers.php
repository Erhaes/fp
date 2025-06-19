<?php
session_start();

// Cek apakah admin sudah login. Jika belum, redirect ke halaman login.
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php?error=unauthorized');
    exit; 
}

include 'header.php'; 
?>

<main class="container-fluid">
    <h3 class="text-center mt-3 mb-4">Manajemen Pengguna</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Formulir Pengguna</strong>
                </div>
                <div class="card-body">
                    <div id="alert" class="alert alert-success" style="display:none;"></div>
                    <form>
                        <fieldset>
                            <legend class="h6"><span class="badge badge-secondary">1</span> Tambah Fingerprint</legend>
                            <div class="form-group">
                                <label for="fingerid">ID Sidik Jari (1-127)</label>
                                <input type="number" name="fingerid" id="fingerid" class="form-control" placeholder="Masukkan ID Sidik Jari...">
                                <button type="button" name="fingerid_add" class="btn btn-primary btn-block mt-2 fingerid_add">Tambahkan ID untuk Pindai</button>
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset>
                            <legend class="h6"><span class="badge badge-secondary">2</span> Informasi Pengguna</legend>
                            <div class="form-group">
                                <label for="name">Nama Pengguna</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Lengkap...">
                            </div>
                            <div class="form-group">
                                <label for="number">Serial Number</label>
                                <input type="text" name="number" id="number" class="form-control" placeholder="Nomor Seri/Induk...">
                            </div>
                             <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Alamat Email...">
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset>
                            <legend class="h6"><span class="badge badge-secondary">3</span> Info Tambahan</legend>
                            <div class="form-group">
                                <label for="timein">Waktu Masuk Default</label>
                                <input type="time" name="timein" id="timein" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input gender" type="radio" name="gender" value="Female">
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input gender" type="radio" name="gender" value="Male" checked="checked">
                                    <label class="form-check-label">Male</label>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <div class="btn-group d-flex" role="group">
                           <button type="button" name="user_add" class="btn btn-success w-100 user_add">Tambah</button>
                           <button type="button" name="user_upd" class="btn btn-warning w-100 user_upd">Update</button>
                           <button type="button" name="user_rmo" class="btn btn-danger w-100 user_rmo">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Tabel Pengguna</strong>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Finger ID</th>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>S.No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Masuk</th>
                                </tr>
                            </thead>
                            <tbody id="manage_users">
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="js/manage_users.js"></script>
<script>
  $(document).ready(function(){
      $.ajax({
        url: "manage_users_up.php"
      }).done(function(data) {
        $('#manage_users').html(data);
      });
    setInterval(function(){
      $.ajax({
        url: "manage_users_up.php"
        }).done(function(data) {
        $('#manage_users').html(data);
      });
    }, 5000);
  });
</script>
</body>
</html>