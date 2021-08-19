<?php
 session_start();
 require_once('conn.php');
 require_once("utils.php");
  //檢查 data有沒有填寫完整，沒有的話在網址加 errCode，再回去index判斷
  if(
    empty($_POST['role'] || $_POST['id']) 
  ) {
    header('Location: backstage.php');
    die('資料不齊全');
  }


  $username = $_SESSION['username'];
  $user = getUserFromUsername($username);
  $id = $_POST['id'];
  $role = $_POST['role'];


  //權限檢查
  if(!$user || $user['role']!=='ADMIN'){
    header('Location: backstage.php');
    exit;
  }

  $sql = "UPDATE stephy_users SET role=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('si', $role, $id);
  
  
  $result = $stmt->execute();
  

  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  // $result = $conn->query($sql);
  if (!$result) {
    die($conn->error);
  }

  header("Location: backstage.php?success=1");//代表你要回傳一個response header
 
?>





