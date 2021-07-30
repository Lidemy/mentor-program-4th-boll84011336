<?php
 session_start();
 require_once('conn.php');
 require_once("utils.php");
  //檢查 data有沒有填寫完整，沒有的話在網址加 errCode，再回去index判斷
  if(
    empty($_GET['id']) 
  ) {
    header('Location: index.php?errCode=1');
    die('資料不齊全');
  }
  // 如果有 value 就取出，_POST指的是表單送出之後抓到的那個東西，去存到$變數內
  // $nickname = $_POST['nickname'];

  //因為用GET帶進來的，所以用GET拿ID
  $id = $_GET['id'];
  $username = $_SESSION['username'];


  $sql = "update stephy_comments set is_deleted=1 where id=? and username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is', $id ,$username);
  $result = $stmt->execute();
  

  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  // $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  header("Location: index.php");//代表你要回傳一個response header
 
?>





