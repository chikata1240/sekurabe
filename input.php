<?php
require('dbconnect.php');

$supers = $db->query('SELECT supermarket from kitchen GROUP BY supermarket');

if (!empty($_POST)) {
  if ($_POST['name'] !== '' && $_POST['supermarket'] !== '' && $_POST['price'] !== '' && $_POST['type'] !== '') {
    $budget = $db->prepare('INSERT INTO test SET name=?, supermarket=?, price=?, type=? ');
    $budget->execute(array(
      $_POST['name'],
      $_POST['supermarket'],
      $_POST['price'],
      $_POST['type']
    ));
    header('Location:index.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/input_css/input_smart.css">
  <link rel="stylesheet" href="css/input_css/input_tablet.css">
  <link rel="stylesheet" href="css/input_css/input_pc.css">
  <title>入力ページ</title>
</head>

<body>
  <form action="" method="POST">
    <!-- タイトル -->
    <div class="title_box">
      <p>入力</p>
    </div>
    <!-- スーパーの名前 -->
    <div class="supermarkets_box">
      <label for="supermarkets">スーパー</label>
      <br>
      <input name="supermarket" id="supermarkets" type="text" placeholder="例）〇〇スーパー">
      <br>
      <?php if (!empty($supers)) : ?>
        <select name="supermarket" id="supermarkets">
          <option disabled label="スーパーの履歴" selected></option>
          <?php while ($super = $supers->fetch()) : ?>
            <option value="<?php print($super['supermarket']); ?>"><?php print($super['supermarket']); ?></option>
          <?php endwhile; ?>
        </select>
      <?php endif; ?>
    </div>

    <!-- 品物 -->
    <div class="name_box">
      <label for="name">品物</label>
      <br>
      <input name="name" id="name" type="text" placeholder="例）りんご">
    </div>

    <!-- 種別 -->
    <div class="type_box">
      <div class="inline-radio">
        <div><input type="radio" name="type" id="yasai" value="野菜" checked><label for="yasai">野菜</label></div>
        <div><input type="radio" name="type" id="niku" value="肉"><label for="niku">肉</label></div>
        <div><input type="radio" name="type" id="sakana" value="魚"><label for="sakana">魚</label></div>
        <div><input type="radio" name="type" id="nyuseihin" value="乳製品"><label for="nyuseihin">乳製品</label></div>
      </div>
      <div class="inline-radio">
        <div><input type="radio" name="type" id="tyoumi" value="調味料"><label for="tyoumi">調味料</label></div>
        <div><input type="radio" name="type" id="reitou" value="冷凍食品"><label for="reitou">冷凍食品</label></div>
        <div><input type="radio" name="type" id="okashi" value="お菓子"><label for="okashi">お菓子</label></div>
        <div><input type="radio" name="type" id="sonota" value="その他"><label for="sonota">その他</label></div>
      </div>
    </div>

    <!-- 値段 -->
    <div class="price_box">
      <label for="price">値段</label>
      <br>
      <input type="text" name="price" id="price" placeholder="0">
    </div>

    <!-- 送信ボタン -->
    <div class="submit_box">
      <input class="submit" type="submit" value="送信">
    </div>
  </form>

  <footer>
    <p>ホーム</p>
  </footer>
</body>

</html>