<?php
require('dbconnect.php');

$details = $db->query('SELECT * FROM kitchen ORDER BY time DESC')

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/details_css/details_smart.css">
  <link rel="stylesheet" href="css/details_css/details_tablet.css">
  <link rel="stylesheet" href="css/details_css/details_pc.css">
  <title>履歴ページ</title>
</head>

<body>

  <!-- 詳細画面 -->
  <div class="detail_box">
    <?php while ($detail = $details->fetch()) : ?>
      <div class="detail_file">
        <p><?php print($detail['Supermarket']); ?></p>
        <p>
          <a href="delete.php?id=<?php print(htmlspecialchars($detail['id'])); ?>">
            <span>
              削除
            </span>
          </a>
        </p>
      </div>
      <div class="detail_file">
        <p><?php print($detail['name']); ?></p>
        <p><?php print($detail['price']); ?>円</p>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- フッター -->
  <footer>
    <a href="index.php">
      <p>ホーム</p>
    </a>
  </footer>

</body>

</html>