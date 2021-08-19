<?php 
  session_start();
  require_once("conn.php"); //引入連線的PHP
  require_once("utils.php");

  // 改用token判別，誰登入。
   /*
    1. 從 cookie 裡面讀取 PHPSESSID(token)
    2. 從檔案裡面讀取 session id 的內容
    3. 放到 $_SESSION
  */
  $username = NULL;
  $user = NULL;
  //如果不是空的
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username); //抓某USERNAME的所有資料
  }

  $page = 1;
  //如果有帶頁碼，就從網址列拿
  if(!empty($_GET['page'])){
    $page = intval($_GET['page']);//轉數字，下面分頁才會處理正確。
  }
  $items_per_page = 5; //limit
  $offset = ($page - 1) * $items_per_page;
  
  //顯示留言 改(先把=1的拿出來再left join)
  $stmt = $conn->prepare(
    'select '.
      'C.id as id, C.content as content, '.
      'C.created_at as created_at, U.nickname as nickname, U.username as username '.
    'from stephy_comments as C '.   
    'left join stephy_users as U on C.username = U.username '.
    'where C.is_deleted IS NULL '.
    'order by C.id desc '.
    'limit ? offset ?'
  );
  $stmt->bind_param('ii', $items_per_page, $offset);
  $result = $stmt->execute(); //執行
   //顯示留言
  // $result = $conn->query("select * from comments order by id desc");
  if(!$result){
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();//拿結果...給下面的row用
  
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
    <div>
      <?php if (!$username) {?>
        <a class="board__btn" href="register.php">註冊</a>
        <a class="board__btn" href="login.php">登入</a>
      <?php } else {?>   
          <?php if (isAdmin($user)) { ?>   
            <a class="board__btn" href="board-Back-End/backstage.php">後台</a> 
          <?php } ?>           
        <a class="board__btn" href="logout.php">登出</a>
        <span class="board__btn update-nickname">編輯暱稱</span>           
        <form class="hide board__nickname-form board__new-comment-form" method="POST" action="update_user.php">
        <div class="board__nickname">
          <span>新的暱稱:</span>
          <input type="text" name="nickname" />
        </div>
          <input class="board__submit-btn" type="submit" />
        </form>
        <h3>你好! <?php echo escape($user['nickname']); ?></h3>
      <?php }?>
    </div>
      <h1 class="board__title">Comments</h1>
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
      
    <form class="board__new-comment-form" method="POST" action="handle_add_comment.php">          
      <textarea name="content" rows="5"></textarea>
      <?php if ($username && !hasPermission($user, 'create', NULL)) {?>
        <h3>你已被停權</h3>
      <?php } else if ($username) { ?> 
        <input class="board__submit-btn" type="submit" />
      <?php } else { ?>
        <h3>請登入發布留言</h3>
      <?php } ?>
    </form>
    <div class="board__hr"></div>

    <!-- 每一則留言都是一個card，card又分左邊頭像；右邊留言區塊。 -->
    <section>
      <?php while($row = $result->fetch_assoc()){ ?>
      <!-- 一則留言 -->
      <div class="card">
        <div class="card__avatar"></div>
        <div class="card__body">
          <div class="card__info">
            <span class="card__author"> 
              <?php echo escape($row['nickname']); ?>
              (@<?php echo escape($row['username']); ?>)
            </span>                                         
            <span class="card__time"> 
              <?php echo escape($row['created_at']); ?>
            </span>
            <!-- 要只能編輯自己的留言 -->
            <!-- $row['username'] 是發這個留言的人，$username 是自己這個登入者的username -->
            
            <?php if (hasPermission($user, 'update', $row)) {?>
              <a href="update_comment.php?id=<?php echo $row['id']?>">編輯</a>
              <a href="delete_comment.php?id=<?php echo $row['id']?>">刪除</a>         
            <?php } ?>
          </div>
          <p class="card__content"><?php echo escape($row['content']) ;?></p>
        </div>
      </div>
        <?php } ?>
    </section>
      <div class="board__hr"></div>
      <?php
        //顯示留言 改(先把=1的拿出來再left join)
        $stmt = $conn->prepare(
          'select count(id) as count from stephy_comments where is_deleted IS NULL'
        );
        $result = $stmt->execute(); //這邊只有執行，下一行才是拿結果
    
        $result = $stmt->get_result();//拿結果...給下面的row用      
        $row = $result->fetch_assoc();
        $count = $row['count'];
        $total_page = ceil($count / $items_per_page)
      ?>
      <div class="page_info">
        <span>總共有 <?php echo $count ?> 筆留言，頁數：</span>
        <span><?php echo $page ?> / <?php echo $total_page ?></span>
      </div>
      <div class="paginator">
        <!-- 不是第一頁的話 -->
        <?php  if($page != 1) { ?>
          <a href="index.php?page=1">首頁</a>
          <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
        <?php } ?>
        <!-- 不是最後一頁的話 -->
        <?php  if($page != $total_page) { ?>
          <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
          <a href="index.php?page=<?php echo $total_page ?>">最後一頁</a>
        <?php } ?>
      </div>
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
