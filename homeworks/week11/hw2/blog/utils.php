<?php
  require_once('conn.php');


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

  
?>