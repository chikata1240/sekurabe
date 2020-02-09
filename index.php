<?php
require('dbconnect.php');

$supers = $db->query('SELECT supermarket FROM kitchen GROUP BY supermarket');

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index_css/index_smart.css">
  <link rel="stylesheet" href="css/index_css/index_tablet.css">
  <link rel="stylesheet" href="css/index_css/index_pc.css">
  <title>スーパーの背えくらべ</title>
</head>

<body>
  <header>
    <p>
      スーパーの背えくらべ
    </p>
  </header>

  <!-- 一覧 -->
  <!-- supermarket 呼び出し  -->
  <?php while ($super = $supers->fetch()) : ?>
    <div class="super_details">
      <div class="super_box">
        <p class="super_name"><?php print($super['supermarket']); ?></p>
      </div>
      <!-- type　呼び出し -->
      <?php if ($super['supermarket'] !== '') : ?>
        <?php
        $types = $db->prepare('SELECT type FROM kitchen WHERE supermarket=? GROUP BY type');
        $types->execute(array(
          $super['supermarket']
        ));
        ?>
        <?php while ($type = $types->fetch()) : ?>
          <div class="super_box">
            <p class="super_type"><?php print($type['type']); ?></p>
          </div>
          <!-- name price呼び出し -->
          <?php if ($type['type'] !== '') : ?>
            <?php
            $products = $db->prepare('SELECT name,TRUNCATE(AVG(price),0) FROM kitchen WHERE supermarket=? AND type=? GROUP BY name');
            $products->execute(array(
              $super['supermarket'],
              $type['type']
            ));
            ?>
            <div class="product_box">
              <?php while ($product = $products->fetch()) : ?>
                <div class="super_box product">
                  <p><?php print($product['name']); ?></p>
                  <p><?php print($product['TRUNCATE(AVG(price),0)']); ?>円</p>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
          <!-- name price呼び出し -->
        <?php endwhile; ?>
      <?php endif; ?>
      <!-- type　呼び出し -->
    </div>
  <?php endwhile; ?>
  <!-- supermarket 呼び出し  -->

  <!-- footer -->
  <footer>

    <div class="flex_box">
      <div>
        <a href="input.php">
          <p>
            入力
          </p>
        </a>
      </div>
      <div>
        <a href="details.php">
          <p>
            履歴
          </p>
        </a>
      </div>
    </div>
  </footer>

</body>

</html>