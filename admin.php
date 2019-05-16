<!-- *
アクセスURL:http://localhost/app1/admin.php
* -->
<?php
session_start();

if(isset($_SESSION['msg'])){
  $msg = $_SESSION['msg'];
  $_SESSION['msg'] = '';
}

$issue_id = (isset($_GET['issue_id']) === true) ? $_GET['issue_id']: '';

// form時の処理
if(isset($_GET['edit']) === true){ 
  header('Location:edit.php?issue_id='.$issue_id);
  exit();
}elseif(isset($_GET['delete']) === true){
  header('Location:delete.php?issue_id='.$issue_id);
  exit();
}elseif(isset($_GET['add']) === true){
  header('Location:add.php');
  exit();
}


$dsn = 'mysql:dbname=m_db;host=localhost;charset=utf8';
$user = 'root';
$password = 'root';
$dbh = new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT * FROM issue_tb';
$stmt = $dbh->prepare($sql);
$stmt->execute();

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
      $num = 0;
      foreach($row as $key){
          if($num === 0){ // checkedをつける為の処理
            echo '<label><input type="radio" name="issue_id" checked="checked" value="'. $row[$num]['issue_id'] .'">' . $row[$num]['issue_text'] . '</label>';
            echo '<br>';
            $num++;
          }else{
            echo '<label><input type="radio" name="issue_id" value="'. $row[$num]['issue_id'] .'">' . $row[$num]['issue_text'] . '</label>';
            echo '<br>';
            $num++;
          }
      }
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
