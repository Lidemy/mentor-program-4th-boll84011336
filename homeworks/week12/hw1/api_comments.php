<?php
 require_once('conn.php');

 header('Content-type:application/json;charset=utf-8');//加header
 //header('Access-Control-Allow-Origin : *');

  //判斷有沒有傳東西進來
  if (  
    empty($_GET['site_key']) 
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please input missing fields"
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  
  //有傳東西進來的話，把東西拿進來，新增到DB裡面
  $site_key = $_GET['site_key'];
 

  $sql = "select id, nickname, content, created_at 
  from stephy_discussions where site_key = ? " . 
  (empty($_GET['before']) ? "" :"and id < ? ") .
  "order by id desc limit 5";
  

  $stmt = $conn->prepare($sql);
  if (empty($_GET['before'])) {
    $stmt->bind_param('s', $site_key);
  } else {
    $stmt->bind_param('si', $site_key, $_GET['before']);
  }
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
  $discussions = array();
  while($row = $result->fetch_assoc()) {
    array_push($discussions, array( 
      "id"=>$row["id"],    
      "nickname" => $row["nickname"],
      "content" => $row["content"],
      "created_at" => $row["created_at"],
    ));
  }

  //拿到的東西是一個物件，在用json_encode把它變成json字串之後輸出出去
  $json = array(
    "ok" => true,
    "discussions" => $discussions
  );

  $response = json_encode($json);  
  echo $response; 
?>





