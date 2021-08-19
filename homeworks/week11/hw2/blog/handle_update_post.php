<?php
 session_start();
 require_once('conn.php');
 require_once("utils.php");
 require_once("check_permission.php");

 $page = $_POST['page'];

  //檢查 data有沒有填寫完整，沒有的話在網址加 errCode，再回去index判斷
  if(
    empty($_GET['id']) ||
    empty($_GET['content']) ||
    empty($_GET['title'])
  ) {
    header('Location: ' . $page);//導回上一頁
    die('資料不齊全');
  }
  // 如果有 value 就取出，_POST指的是表單送出之後抓到的那個東西，去存到$變數內
  // $nickname = $_POST['nickname'];

  //因為用GET帶進來的，所以用GET拿ID
  $id = $_POST['id'];
  $content = $_POST['content'];
  $title = $_POST['title'];

  $sql = "update stephy_posts set title=?, content=? where id=?";

  $stmt = $conn->prepare($sql); 
  $stmt->bind_param('ssi', $title, $content, $id);
  
  $result = $stmt->execute();
  if (!$result) {
    die($conn->error);
  }

  header('Location: ' . $page);//導回上一頁
 
?>





