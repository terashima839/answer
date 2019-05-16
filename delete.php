<!-- *
アクセスURL:http://localhost/app1/edit.php
* -->
<?php

$issue_id = $_GET['issue_id'];
$msg = '';


// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
$dsn = 'mysql:dbname=m_db;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM issue_tb WHERE issue_id=?';
$stmt = $dbh->prepare($sql);
$data[] = $issue_id;
$stmt->execute($data);

foreach($stmt as $row){
  $text = $row['issue_text'];
}
// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
if(isset($_POST['back']) === true){ // 戻るが押された時
  header('Location:admin.php');
  exit();
}elseif(isset($_POST['delete']) === true) { // 削除が押された時
  try{
    $sql2 = 'DELETE FROM issue_tb WHERE issue_id=?';
    $stmt2 = $dbh->prepare($sql2); // パラメータを付けて実行待ち
    $data2[] = $issue_id;
    
    $stmt2->execute($data2); // ?に変数を代入して実行
    session_start();
    $_SESSION['msg'] = '削除しました';
    header('Location:admin.php');
    exit();
  
  }catch (Exception $e){
    echo 'ただいま障害により大変ご迷惑をおかけしております。<br>';
    exit($e -> getMessage());
  }
}

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
  <form method="POST" action="">
    <p><?php echo $text ?></p>
    <input type="submit" class="button" value="削除" name="delete">
    <input type="submit" class="button" value="戻る" name="back">
  </form>



  <?php


  ?>


  <hr>
<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
