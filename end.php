<!-- *
アクセスURL:http://localhost/app1/end.php
* -->
<?php
  session_start();
  $array_text = (isset($_SESSION['answers']) === true) ? $_SESSION['answers']: '';

  if ($array_text === '') { // 空欄だったらトップへ
    header('Location: index.php');
    exit();
  }


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
  <p>お疲れ様でした！</p>
  <p>今回の質問はこれ！</p>
  <?php
    $num = 1;
    echo '<table border=1 align="center" ><tr>';
    echo '<th>問</th><th>内容</th></tr>';
    foreach($array_text as $val){
      echo '<tr><td>' . $num++ . '</td>';
      echo '<td align="left">' . $val . '</td></tr>';
    }
    echo '</table>';

    // foreach($array_time as $t){ ///////////
    //   echo '<tr><td>' . $num++ . '</td>'; ///////////
    //   echo '<td>' . $t . '</td></tr>'; ///////////
    // } ///////////

    session_destroy(); // sessionの破棄
  ?>
  <br>
  <p>苦手なところをもう一度振り返ってみよう！</p><br>
  <form action="index.php">
    <input type="submit" class="button" value="もう一度"><br><br>
  </form>
<hr>

<!-- ＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊ -->
</body>
</html>
