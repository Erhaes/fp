<?php
  //Connect to database
  require 'connectDB.php';

  $sql = "SELECT * FROM users WHERE del_fingerid=0 ORDER BY id DESC";
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
                <td>
                    <?php if ($row['fingerprint_select'] == 1): ?>
                        <span class="badge badge-success">Selected</span>
                    <?php else: ?>
                         <?php echo htmlspecialchars($row['fingerprint_id']); ?>
                    <?php endif; ?>
                    <button type="button" class="btn btn-sm btn-outline-primary float-right select_btn" id="<?php echo $row['fingerprint_id']; ?>" title="select this UID">Pilih</button>
                </td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td><?php echo htmlspecialchars($row['serialnumber']); ?></td>
                <td><?php echo htmlspecialchars($row['user_date']); ?></td>
                <td><?php echo htmlspecialchars($row['time_in']); ?></td>
              </tr>
<?php
          }
      } else {
          echo '<tr><td colspan="6" class="text-center">Tidak ada data pengguna.</td></tr>';
      }
  }
?>