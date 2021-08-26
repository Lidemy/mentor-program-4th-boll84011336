
<?php 
  session_start();
  require_once("conn.php"); //引入連線的PHP
  require_once("utils.php");
  require_once("check_permission.php");

  //顯示文章 改(先把=1的拿出來再left join)
  $stmt = $conn->prepare(
    'select '.
      'P.id as id, P.content as content, P.title as title, '.
      'P.created_at as created_at, U.nickname as nickname, U.username as username '.
    'from stephy_posts as P '.   
    'left join stephy_users as U '.
    'on P.username = U.username '.
    'where P.is_deleted = 0 '
  );
  $result = $stmt->execute(); //執行
  if(!$result){
    die('Error' . $conn->error);
  }
  $result = $stmt->get_result();//拿結果...給下面的row用
 
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
      <div class="admin-posts">
        <?php 
          while($row = $result->fetch_assoc()) {
        ?>
          <div class="admin-post">
            <div class="admin-post__title">
              <?php echo escape($row['title']); ?> 
            </div>
            <div class="admin-post__info">
              <div class="admin-post__created-at">
                <?php echo escape($row['created_at']); ?>
              </div>
              <a class="admin-post__btn" href="update_post.php?id=<?php echo escape($row['id']); ?>">
                編輯
              </a>
              <a class="admin-post__btn" href="handle_delete.php?id=<?php echo escape($row['id']); ?>">
                刪除
              </a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>