<?php
session_start();
require 'connectDB.php';

$seldate = '';

if (isset($_POST['log_date'])) {
    if (!empty($_POST['date_sel'])) {
        $_SESSION['seldate'] = $_POST['date_sel'];
    } else {
        $_SESSION['seldate'] = date("Y-m-d");
    }
}

if (isset($_POST['select_date']) && $_POST['select_date'] == 1) {
    $_SESSION['seldate'] = date("Y-m-d");
    $seldate = $_SESSION['seldate'];
} else {
    $seldate = $_SESSION['seldate'] ?? date("Y-m-d");
}

$sql = "SELECT * FROM users_logs WHERE checkindate=? ORDER BY id DESC";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<tr><td colspan="7" class="text-center text-danger">SQL Error</td></tr>';
} else {
    mysqli_stmt_bind_param($result, "s", $seldate);
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    if (mysqli_num_rows($resultl) > 0) {
        while ($row = mysqli_fetch_assoc($resultl)) {
?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['serialnumber']); ?></td>
                <td><?php echo htmlspecialchars($row['fingerprint_id']); ?></td>
                <td><?php echo htmlspecialchars($row['checkindate']); ?></td>
                <td><?php echo htmlspecialchars($row['timein']); ?></td>
                <td><?php echo htmlspecialchars($row['timeout']); ?></td>
            </tr>
<?php
        }
    } else {
        echo '<tr><td colspan="7" class="text-center">Tidak ada log untuk tanggal yang dipilih.</td></tr>';
    }
}
?>