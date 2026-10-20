<?php
$team = 'อะไรวะ';
$topic = 'ระบบยืมอุปกรณ์กีฬา';
$problem = 'ปัญหาการยืมปากเปล่าและการติดตามอุปกรณ์ที่ยืมไป';
$members = ['นายภูริทัต ศิริภูธร', 'นายศิวดล มิ่งพฤกษ์', 'นายสรวิศ ปานบุญลือ'];
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title><?php echo $topic; ?></title>
</head>
ป
<body>
  <h1><?php echo $topic; ?></h1>
  <p>ทีม: <?php echo $team; ?></p>
  <p>ปัญหาที่แก้: <?php echo $problem; ?></p>
  <h2>สมาชิก</h2>
  <ul>
    <?php foreach ($members as $m): ?>
      <li><?php echo $m; ?></li>
    <?php endforeach; ?>
  </ul>
  <p>อัปเดตล่าสุด: <?php echo date('d/m/Y H:i'); ?></p>
</body>
</html>
