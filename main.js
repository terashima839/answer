

// タイマー機能
count = 0; //カウントの初期値
timerID = setInterval('countup()',1000); //1秒毎にcountup()を呼び出し

function countup() {
  count++;
  timer.innerHTML= count + '<sub> sec</sub>';
}
