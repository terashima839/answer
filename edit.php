<!-- *
アクセスURL:http://localhost/app1/edit.php
* -->
<?php

$issue_id = $_GET['issue_id'];
$err_msg = '';


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
}elseif(isset($_POST['issue_text']) === true) { // 編集が押された時
  try{
    $text = $_POST['issue_text'];
    if($text === ''){ 
        $err_msg = '文字を入力してください。';
    }else{
        $sql2 = 'UPDATE issue_tb SET issue_text=? WHERE issue_id=?';
        $stmt2 = $dbh->prepare($sql2); // パラメータを付けて実行待ち
        $data2[] = $text;
        $data2[] = $issue_id;
        
        $stmt2->execute($data2); // ?に変数を代入して実行
        session_start();
        $_SESSION['msg'] = '編集が完了しました';
        header("Location: admin.php");
        exit();
    }
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
  <p class="err_msg"><?php echo $err_msg ?></p>
  <form method="POST" action="">
    <textarea name="issue_text" name="isseu_text" cols="70" rows="6" maxlength="120"><?php echo $text ?></textarea><br>
    <input type="submit" class="button" value="修正">
    <input type="submit" class="button" value="戻る" name="back">
  </form>



  <?php


  ?>


  <hr>
<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
