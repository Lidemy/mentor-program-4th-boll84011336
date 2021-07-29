<?php
 session_start();
 require_once('conn.php');
 require_once("utils.php");
  //檢查 data有沒有填寫完整，沒有的話在網址加 errCode，再回去index判斷
  if(empty($_POST['content']) ){
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }
  // 如果有 value 就取出，_POST指的是表單送出之後抓到的那個東西，去存到$變數內
  // $nickname = $_POST['nickname'];


  $username = $_SESSION['username'];
  
  $content = $_POST['content'];

  $sql = "insert into stephy_comments(username, content) values(?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $content);
  $result = $stmt->execute();


  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  // $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");//代表你要回傳一個response header
 
?>





