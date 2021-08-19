<?php
  session_start();
  require_once('conn.php');

  //檢查 data有沒有填寫完整，沒有的話在網址加 errCode，再回去index判斷
  if(empty($_POST['nickname']) || empty($_POST['username']) ||empty($_POST['password']) ){
    header('Location: register.php?errCode=1');
    die('資料不齊全');
  }
  // 如果有 value 就取出
  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  //$password = $_POST['password'];
  //存hash 的 password
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

  $sql = "insert into stephy_users(nickname, username, password) values(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $nickname, $username, $password);
  $result = $stmt->execute();

  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  //$result = $conn->query($sql);
  if (!$result) {
    $code = $conn->errno;
    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    }
    die($conn->error);
  }
  
  $_SESSION['username'] = $username;//把撈的USERNAME存到SESSION 維持登入狀態
  header("Location: index.php");//代表你要回傳一個response header
  
?>





