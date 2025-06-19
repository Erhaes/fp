<?php
require 'connectDB.php';

header('Content-Type: application/json');

$last_id = isset($_GET['last_id']) ? (int)$_GET['last_id'] : 0;

$response = ['status' => 'none'];

// Query untuk mendapatkan log terbaru setelah ID terakhir yang diketahui
$sql = "SELECT id, username, timein, timeout, checkindate FROM users_logs WHERE id > ? ORDER BY id ASC LIMIT 1";
$result = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($result, $sql)) {
    mysqli_stmt_bind_param($result, "i", $last_id);
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);

    if ($row = mysqli_fetch_assoc($resultl)) {
        $action = "Login";
        $time = $row['timein'];

        // Cek apakah ini aktivitas logout (jika timeout tidak default/kosong)
        if ($row['timeout'] !== '00:00:00' && !empty($row['timeout'])) {
            $action = "Logout";
            $time = $row['timeout'];
        }

        $response = [
            'status'   => 'success',
            'new_id'   => $row['id'],
            'username' => htmlspecialchars($row['username']),
            'action'   => $action,
            'time'     => $time,
            'date'     => $row['checkindate']
        ];
    }
}

echo json_encode($response);
mysqli_close($conn);
?>