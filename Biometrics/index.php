<?php include 'header.php'; ?>

<main class="container">
    <div class="card">
        <div class="card-header text-center">
            <h3>Daftar Pengguna Terdaftar</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID | Nama</th>
                            <th>Serial Number</th>
                            <th>Gender</th>
                            <th>Fingerprint ID</th>
                            <th>Tanggal Registrasi</th>
                            <th>Waktu Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //Connect to database
                        require 'connectDB.php';

                        $sql = "SELECT * FROM users WHERE NOT username='' ORDER BY id DESC";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo '<tr><td colspan="6" class="text-center text-danger">SQL Error</td></tr>';
                        } else {
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            if (mysqli_num_rows($resultl) > 0) {
                                while ($row = mysqli_fetch_assoc($resultl)) {
                        ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?> | <?php echo htmlspecialchars($row['username']); ?></td>
                                        <td><?php echo htmlspecialchars($row['serialnumber']); ?></td>
                                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                        <td><?php echo htmlspecialchars($row['fingerprint_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['user_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['time_in']); ?></td>
                                    </tr>
                        <?php
                                }
                            } else {
                                echo '<tr><td colspan="6" class="text-center">Tidak ada pengguna ditemukan.</td></tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="js/jquery-2.2.3.min.js"></script>
<script>
  $(window).on("load resize ", function() {
    var scrollWidth = $('.table-responsive').width() - $('.table-responsive table').width();
    $('.thead-dark').css({'padding-right':scrollWidth});
}).resize();
</script>
</body>
</html>