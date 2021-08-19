
<?php 
   session_start();
   require_once("conn.php"); //引入連線的PHP
   require_once("utils.php");
   require_once("check_permission.php");

   $id = intval($_GET['id']);

   $stmt = $conn->prepare(
    'select '.
      'P.id as id, P.content as content, P.title as title, '.
      'P.created_at as created_at, U.nickname as nickname, U.username as username '.
    'from stephy_posts as P '.   
    'left join stephy_users as U '.
    'on P.username = U.username '.
    'where P.id = ? '
  );

  $stmt->bind_param('i', $id);
  $result = $stmt->execute(); //執行
  if(!$result){
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();//拿結果...給下面的row用
  $row = $result->fetch_assoc();//一筆資料

?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <?php include_once('header.php') ?>
  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
      <div class="edit-post">
        <form action="handle_update_post.php" method="POST">
          <div class="edit-post__title">
            編輯文章：
          </div>
          <div class="edit-post__input-wrapper">
            <input name="title" class="edit-post__input" placeholder="請輸入文章標題" 
            value="<?php echo escape($row['title']); ?>"/>
          </div>
          <div class="edit-post__input-wrapper">
            <textarea name="content" rows="20" class="edit-post__content">
              <?php echo escape($row['content']); ?>
            </textarea>
          </div>
          <div class="edit-post__btn-wrapper">
              <input type="submit" class="edit-post__btn" value="送出"/>
          </div>
          <input type="hidden" name="id" value="<?php echo escape($row['id']); ?>"/>
          <input type="hidden" name="page" value="<?php echo $_SERVER['HTTP_REFERER']; ?>"/>
        </form>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>