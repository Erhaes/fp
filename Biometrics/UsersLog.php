<?php include 'header.php'; ?>

<main class="container">
    <div class="card">
        <div class="card-header text-center">
            <h3>Log Aktivitas Pengguna Harian</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <form method="POST" action="Export_Excel.php" class="form-inline justify-content-center">
                    <input type="date" name="date_sel" id="date_sel" class="form-control mb-2 mr-sm-2">
                    <button type="button" name="user_log" id="user_log" class="btn btn-info mb-2 mr-sm-2">Pilih Tanggal</button>
                    <input type="submit" name="To_Excel" value="Export ke Excel" class="btn btn-success mb-2">
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Serial Number</th>
                            <th>Fingerprint ID</th>
                            <th>Tanggal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                        </tr>
                    </thead>
                    <tbody id="userslog">
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script src="js/user_log.js"></script>
<script>
  $(document).ready(function() {
    // Initial load for today's date
    $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
            'select_date': 1
        }
    }).done(function(data) {
        $('#userslog').html(data);
    });

    // Set interval to refresh data
    setInterval(function() {
        // We check if a date is selected, if not, it will use the session date which is updated by the initial load or by the 'Select Date' button click
        var date_sel = $('#date_sel').val(); 
        $.ajax({
            url: "user_log_up.php",
            type: 'POST',
            data: {
                'select_date': date_sel ? 0 : 1, // if date is selected, use it, else use current date from session
                'date_sel': date_sel
            }
        }).done(function(data) {
            $('#userslog').html(data);
        });
    }, 5000);
  });
</script>
</body>
</html>