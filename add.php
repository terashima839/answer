<!-- *
アクセスURL:http://localhost/app1/edit.php
* -->
<?php

// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
$dsn = 'mysql:dbname=m_db;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
if(isset($_POST['back']) === true){ // 戻るが押された時
  header('Location:admin.php');
  exit();
}elseif(isset($_POST['issue_text']) === true) { // 追加が押された時
  try{
    $text = $_POST['issue_text'];
    if($text === ''){ 
        $err_msg = '文字を入力してください。';
    }else{
        $sql = 'INSERT INTO issue_tb(issue_text) VALUES (?)';
        $stmt = $dbh->prepare($sql);
        $data[] = $text;
        $stmt->execute($data);

        session_start();
        $_SESSION['msg'] = '追加しました';
        header('Location:admin.php');
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
    <textarea name="issue_text" name="isseu_text" cols="70" rows="6" maxlength="120" placeholder="コメントを入力してください"></textarea><br>

    <input type="submit" class="button" value="追加" name="add">
    <input type="submit" class="button" value="戻る" name="back">
  </form>
  <hr>
<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
