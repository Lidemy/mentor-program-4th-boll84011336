<?php
  require_once('conn.php');
  //製造token亂數 16碼。 .= 是把右邊的東西加回左邊
  function generateToken() {
    $s = '';
    for($i=1; $i<=16; $i++) {
      $s .= chr(rand(65,90));
    }
    return $s;
  }

  function getUserFromUsername($username) {
    global $conn;
    $sql = sprintf(
      "select * from stephy_users where username='%s'",
      $username
    );
    $result = $conn->query($sql); // 抓出來是一個 username或一張表
    $row = $result->fetch_assoc(); //ｒｏｗ就是ｍｙｓｑｌ，ｑｕｅｒｙ完的東西，它會去抓第一筆。
    return $row; //username, id, nickname ,role
  }

  //防止XSS攻擊
  function escape($str) {
    return htmlspecialchars($str, ENT_QUOTES);
  }

  //$action: update, delete, create
  function hasPermission($user, $action, $comment) {
    //等於的話就return true，然後前面跑這段的時候才會執行。     
    if ($user == NULL) { 
      return false; 
    }
    //print_r($user["role"]);
    if ($user["role"] === "ADMIN") {
      return true;
    }
    //return 留言的留言者 = 登入的留言者。
    if ($user["role"] === "NORMAL") {
      if ($action === 'create') return true;//新增用
      return $comment["username"] === $user["username"];//判斷更新用  	
    }

    //return 沒有 create權限
    if ($user["role"] === "BANNED") {
      if ($action === 'update') return $comment["username"] === $user["username"];
      //return $action !== 'create'; //結果是true 或 false
    }	    
  }
  
  function isAdmin($user) {
    if ($user["role"] === "ADMIN") {
      return true;
    }
  }
?>