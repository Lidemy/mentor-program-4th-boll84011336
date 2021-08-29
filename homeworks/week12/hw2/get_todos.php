<?php
 require_once('conn.php');

 header('Content-type:application/json;charset=utf-8');//加header
 //header('Access-Control-Allow-Origin : *');

  //判斷有沒有傳東西進來
  if (  
    empty($_GET['id']) 
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please add id in url"
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  
  //有傳東西進來的話，把id轉數字
  $id = intval($_GET['id']); 
 

  $sql = "select id, content from stephy_todos where id = ? ";
  

  $stmt = $conn->prepare($sql); 
  $stmt->bind_param('i', $id);
  $result = $stmt->execute();
  
  //判斷sql有沒有成功。(從conn裡面去執行這個query，把結果放到result)
  if (!$result) {
    $json = array(
      "ok" => false,
      "message" => $conn->error
    );
  
    $response = json_encode($json);  
    echo $response;
    die();
  }

  $result = $stmt->get_result();  
  $row = $result->fetch_assoc(); 

  //注意:這邊存的data 是一整排的todo，所以會是一列的資料而不是一條一條，所以不用用陣列包，用這樣的方式取row就好
  $json = array(
    "ok" => true,
    "data" => array(
      "id"=> $row["id"],  
      "content" => $row["content"] 
    )    
  );

  //拿到的東西是一個物件，在用json_encode把它變成json字串之後輸出出去
  $response = json_encode($json);  
  echo $response; 
?>





