<?php 
  session_start();
  require_once("conn.php"); //引入連線的PHP
  require_once("utils.php");

  
  $username = NULL;
  $user = NULL;
  //如果不是空的
  if(!empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username); //抓某USERNAME的所有資料
  }
 

  if ($user === NULL || $user['role'] !== 'ADMIN') {
    header('Location: index.php');
    exit;
  }
  
  
  //顯示留言 改(先把=1的拿出來再left join)
  $stmt = $conn->prepare(
    'select * from stephy_users order by id asc'
  );
 
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
  <title>後台管理</title>
  <link rel="stylesheet" href="style.css">
  <style>
    table {
      border-collapse:collapse;
      padding: 5px;
      width: 100%;
      text-align:center;
    }

    th {
      color:blue;
    }

    tr {
      border: 2px solid #283618;
      
    }
   
  </style>

</head>

<body>
			<?php
        //拿出權限
        $stmt2 = $conn->prepare(
					'select role,value from stephy_role'
        );
        $result2 = $stmt2->execute(); //這邊只有執行，下一行才是拿結果
        $result2 = $stmt2->get_result();//拿結果...給下面的row用
        $row2 = $result2->fetch_assoc();//將讀出的資料Key值設定為該欄位的欄位名稱。
        $value = $row2['value'];
				$authority = $row2['role'];      
      ?>
			
</body>
</html>


