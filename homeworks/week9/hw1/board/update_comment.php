<?php 
  session_start();
  require_once("conn.php"); //引入連線的PHP
  require_once("utils.php");

  $id = $_GET['id'];
 
  $username = NULL;
  $user = NULL;
  //如果不是空的
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username); //抓某USERNAME的所有資料
  }
  
  //顯示留言 改
  $stmt = $conn->prepare(
    'select * from stephy_comments where id = ?'
  );
  $stmt->bind_param("i",$id);
  $result = $stmt->execute(); //執行
   //顯示留言
  // $result = $conn->query("select * from comments order by id desc");
  if(!$result){
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();//拿結果...給下面的row用
  $row = $result->fetch_assoc();
  
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header class="warning">
    <strong>注意!本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
  </header>
  <main class="board">
      <h1 class="board__title">編輯留言</h1>
      <?php
        if (!empty($_GET['errCode'])) {
          $code = $_GET['errCode'];
          $msg = 'Error';
          if ($code === '1') {
            $msg = '資料不齊全';
          }
          echo '<h2 class="error">錯誤：' . $msg . '</h2>';
        }
      ?>
     
        <form class="board__new-comment-form" method="POST" action="handle_update_comment.php">
          <textarea name="content" rows="5">
            <?php echo $row['content']
            ?>
          </textarea>
          <!-- 這行是為了要把ID帶到handle_update_comment 而寫的 -->
          <input type="hidden" name='id' value="<?php echo $row['id']?>"/>
          <input class="board__submit-btn" type="submit" />
        </form>
   
  </main>
  <script>
      var btn = document.querySelector('.update-nickname')
    btn.addEventListener('click', function(){
      var form = document.querySelector('.board__nickname-form')
      form.classList.toggle('hide')
    })
  </script>
</body>
</html>

<?php
  while($row = $result->fetch_assoc()){    
  } 
?>

<!-- <script>alert(1)</script> -->