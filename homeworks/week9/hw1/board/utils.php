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
      return $row; //username, id, nickname 
  }

  function escape($str){
    return htmlspecialchars($str, ENT_QUOTES);
  }
  
?>




