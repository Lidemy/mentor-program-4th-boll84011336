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
    header('Location: ../index.php');
    exit;
  }

  
  
  
  $stmt = $conn->prepare(
    'select * from stephy_users order by id asc'
  );
 
  $result = $stmt->execute(); //執行  
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
  <header class="warning">
    <strong>注意!本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
    </strong>
  </header>
  <main class="board">   
      
      <h1 class="board__title">權限管理</h1>
      <div class="board__hr"></div>
      <?php
        if (!empty($_GET['success'])) {
          $success = $_GET['success'];
          $msg = '更新成功';
          if ($success === '1') {
            echo '<script>alert("'.$msg.'")</script>';
          }          
        }
      ?>
      


      <!-- 每一則留言都是一個card，card又分左邊頭像；右邊留言區塊。 -->
      <?php
        //拿出權限
        $stmt2 = $conn->prepare(
					'select role,value from stephy_role'
        );
        $result2 = $stmt2->execute(); //這邊只有執行，下一行才是拿結果
        $result2 = $stmt2->get_result();//拿結果...給下面的row用
        //role的資料處理，把取出來的資料放到array給下面foreach用
        $arr = [];   
        while($row2 = $result2->fetch_assoc()){
          $arr[] = array($row2['role'], $row2['value']);                      
        } 
        
      ?>
      <section>
        <table border="2">
          <tr>
            <th>id</th>
            <th>role</th>
            <th>nickname</th>
            <th>username</th>
            <th>調整身份</th>
          </tr>
        <?php
          while($row = $result->fetch_assoc()){     
        ?>
        <form method="POST" action="handle_update_role.php"> 
          <tr>
            <td><?php echo escape($row['id']); ?></td>
            <td><?php echo escape($row['role']); ?></td>
            <td><?php echo escape($row['nickname']); ?></td>
            <td><?php echo escape($row['username']); ?></td>
            <td><select name="role">
                <option value="0">權限變更</option>
                 <?php                        
                  echo "<!-- start -->";
                   //"<option value='".   $v.  "'>" .$v.  "</option>" 雙引號是一包，中間放變數
                    foreach ($arr as $value) {
                      if ($row['role'] === $value[0]){
                        echo "<option value='".$value[0]."' selected>".$value[0]."</option>";
                      } else {
                        echo "<option value='".$value[0]."'>".$value[0]."</option>";	
                      }                           
                    }	                   
                  echo "<!-- end -->";
                  ?>		
                </select>
                <input type="hidden" name="id" value="<?php echo escape($row['id']);?>">              
                <button type="submit" class="update_role" >儲存</button>
            </td>
          </tr>
        </form>         
        <?php } ?>
        </table>
      </section>
    
   
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