<?php
 require_once('conn.php');

 header('Content-type:application/json;charset=utf-8');//加header
  //判斷有沒有傳東西進來
  if (
    empty($_POST['content'])
  ) {
    $json = array(
      "stauts" => false,
      "message" => "Please input missing fields"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }
  
  //有傳東西進來的話，把東西拿進來，新增到DB裡面
  $content = $_POST['content'];
 
  $sql = "insert into stephy_todos(content) values(?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $content);
  $result = $stmt->execute();


  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  if (!$result) {
    $json = array(
      "stauts" => false,
      "message" => $conn->error
    );
  
    $response = json_encode($json);  
    echo $response;
    die();
  }
  //拿到的東西是一個物件，在用json_encode把它變成json字串之後輸出出去
  $json = array(
    "stauts" => true,
    "message" => "Success!",
    "id" => $conn->insert_id
  );

  $response = json_encode($json);  
  echo $response; 
?>





