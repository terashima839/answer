<!-- *
アクセスURL:http://localhost/app1/count.php
* -->
<?php
  session_start();
  $text = $_SESSION['text']; // 質問一覧
  $count = $_SESSION['count']; // keyカウント用
  $array_num = $_SESSION['numbers']; // ランダム配列用
  $array_text = $_SESSION['answers']; // ランダムテキスト用

  $count_time = (isset($_GET['count_time']) === true) ? $_GET['count_time']: '';
  $count_max  = (isset($_GET['count_max']) === true) ? $_GET['count_max']: '';

// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
// ボタンが押された時の処理
  if($_SERVER["REQUEST_METHOD"] === "POST"){ // POSTが送信された時
      if(isset($_POST['back']) === true){
        header('Location:index.php');
        exit();
      }elseif(isset($_POST['skip']) === true){
        $msg1 = 'スキップしたよ';
      }else{
        $msg1 = 'エラーっぽいね';
    }
  }else{ // POSTが送信されなかった時
    $msg1 = 'スキップすることもできるよ';
  }
// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
// 画面更新時の処理
  if (isset($_SESSION['num'])) {
    // 2回目以降
      if($_SESSION['num'] <= $count_max-1){ // 最大値-1して微調整
        $_SESSION['num']++; // 質問数用
        $_SESSION['count']++; // keyカウント用
        
      }elseif($_SESSION['num'] > $count_max-1){
        header('Location: end.php');
        exit();
      }
  } else { // 1回目
      $_SESSION['num'] = 1;
      $_SESSION['count'] = 0;
      // ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
      // 質問の取得
      $dsn = 'mysql:dbname=m_db;host=localhost;charset=utf8';
      $user = 'root';
      $password = 'root';
      $dbh = new PDO($dsn,$user,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql = 'SELECT * FROM issue_tb';
      $stmt = $dbh->prepare($sql);
      $stmt->execute();

      foreach($stmt as $row){
        $text[] = $row['issue_text'];
      }
      $_SESSION['text'] = &$text; // 配列をセッションにコピー

      $numbers = range(0, count($text)-1);
      shuffle($numbers);


      foreach($numbers as $number){
          $array_num[] = $number;
      }

      $_SESSION['numbers'] = &$array_num; // 配列をセッションにコピー
    
  }
// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
// 表示
  $num = $_SESSION['num']; // 1
  $count = $_SESSION['count']; // 0
  // $array_num = $_SESSION['numbers'];

  $msg2 = '問' . $num;
  $msg3 = $text[$array_num[$count]];



// ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
// 質問を$arrayに格納
  $array_text[] = $msg3;
  $_SESSION['answers'] = $array_text;

  // $array_count[] = $count_time; ///////////
  // $_SESSION['times'] = $array_time; ///////////

?>
<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>面接Answer</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="shortcut icon" href="./img/favicon.ico">
  <meta charset="UTF-8" http-equiv='refresh' content='<?php echo $count_time ?>' url=''/> <!-- 画面更新 -->
  <script src="main.js" defer></script>

</head>
<body>
  <hr>
  <?php
    echo '<p>質問は' . $count_max .'問、' . $count_time . '秒毎に次の質問へ</p>';
    echo '<p>' . $msg1 . '</p>'; //データ送信処理
    echo '<hr>';
    echo '<p>' . $msg2 . '</p>'; // カウント、質問表示
    echo '<br><p>' . $msg3 . '</p><br>'; // カウント、質問表示
  ?>
  
  <br>
  <form method="post" action="">
    <input type="submit" class="button" name="back" value="  戻る  ">
    <input type="submit" class="button" name="skip" value="スキップ">
  </form>

  <br><div id="timer" class="timer">0 <sub> sec</sub></div> <!-- カウントアップの表示 -->

  <?php
    // echo '質問結果を格納 $array<br>';
    // var_dump($array);
    // echo '<br><br>';
    // echo 'ランダム変数を格納 $array_num<br>';
    // var_dump($array_num);
    // echo '<br><br>';
    // echo '全ての質問 $text<br>';
    // var_dump($text);
  ?>
  <hr>

<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
