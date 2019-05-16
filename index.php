<!-- *
アクセスURL:http://localhost/app1/index.php
* -->
<?php
session_start();
session_destroy(); // sessionの破棄
?>

<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8"/>
  <title>面接Answer</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="shortcut icon" href="./img/favicon.ico">

</head>
<body>
  <hr>
  <div class="top">
    <h1>面接Checker</h1>
    <p>面接を制するものは</p>
    <p>就活を制する</p>
    <!-- <p>by　？？？</p> -->
    <hr>
  </div>
  <div class="middle">
    <form method="GET" action="count.php">
    <p>回答時間は？
      <select name="count_time">
        <option value="5">5秒</option>
        <option value="30">30秒</option>
        <option value="60">60秒</option>
        <option value="90">90秒</option>
        <option value="120">120秒</option>
        <option value="150">150秒</option>
        <option value="180">180秒</option>
      </select></p>

      <p>質問回数は？　
      <select name="count_max">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
      </select></p>

      <input type="submit" class="button" value="レッツトライ！">
    </form>
  </div>
  <hr>


 
<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
