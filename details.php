<?php
require('dbconnect.php');

if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
  $page = $_REQUEST['page'];
} else {
  $page = 1;
}

$start = 10 * ($page - 1);

$details = $db->prepare('SELECT * FROM kitchen ORDER BY time DESC LIMIT ?, 10');
$details->bindParam(1, $start, PDO::PARAM_INT);
$details->execute();

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

    <!-- ページネーション -->
    <div class="page_box">
      <!-- 前ページ -->
      <?php if ($page >= 2) : ?>
        <a href="details.php?page=<?php print($page - 1); ?>"><?php print($page - 1); ?>ページ目へ</a>
      <?php endif; ?>
      |
      <!-- 次ページ -->
      <?php
      $counts = $db->query('SELECT COUNT(*) as cnt FROM kitchen');
      $count = $counts->fetch();
      $max_page = ceil($count['cnt'] / 10);
      if ($page < $max_page) :
      ?>
        <a href="details.php?page=<?php print($page + 1); ?>"><?php print($page + 1); ?>ページ目へ</a>
      <?php endif; ?>
    </div>
  </div>

  <!-- フッター -->
  <footer>
    <a href="index.php">
      <p>ホーム</p>
    </a>
  </footer>

</body>

</html>