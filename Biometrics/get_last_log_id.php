<?php
require 'connectDB.php';

$sql = "SELECT id FROM users_logs ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo $row['id'];
} else {
    echo 0;
}

mysqli_close($conn);
?>