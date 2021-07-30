<?php
 session_start();
 require_once('conn.php');
 require_once('utils.php');

  //檢查 data有沒有填寫完整，沒有的話在網址加 errCode，再回去index判斷
  if(empty($_POST['username']) ||empty($_POST['password']) ){
    header('Location: login.php?errCode=1');
    die('資料不齊全');
  }
  // 如果有 value 就取出
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql ="select * from stephy_users where username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $result = $stmt->execute();

  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  //$result = $conn->query($sql);
  if (!$result) {  
    die($conn->error);
  }

  $result = $stmt->get_result(); //把結果拿回來給下面的row用

  //num_rows代表有沒有資料。 0 是false, 1 是true，如果有資料1 ，就登入成功
  //看有沒有抓到帳號，沒有就直接導回登入失敗
  if($result->num_rows === 0){
    header("Location: login.php?errCode=2");
    exit();
  } 
  //有查到使用者
  $row = $result->fetch_assoc(); //這個row是select出來的users資料
  
  if(password_verify ($password, $row['password'])){
    //登入成功
     /*
      1. 產生 session id (token)
      2. 把 username 寫入檔案
      3. set-cookie: session-id
    */
    $_SESSION['username'] = $username; //把撈的USERNAME存到SESSION 維持登入狀態
    header("Location: index.php");   
  }else {
    header("Location: login.php?errCode=2");//代表你要回傳一個response header   
  }

  
  
 
?>





