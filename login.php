<!-- *
アクセスURL:http://localhost/app1/admin.php
* -->
<?php






?>

<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8"/>
  <title>面接Answer-管理者ページ</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="shortcut icon" href="./img/favicon.ico">

</head>
<body>
  <hr>
  <h1>面接Checker-管理者ページ</h1>
  <hr>

  <main>
  <p><?php echo $msg ?></p>
  <form method="get" align="left">
    <?php

    ?>
    <br>
    <input type="submit" class="button" value="編集" name="edit">
    <input type="submit" class="button" value="削除" name="delete" >
    <input type="submit" class="button" value="追加" name="add">
  </form>
  </main>
  <hr>


<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
