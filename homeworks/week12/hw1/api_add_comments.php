<?php
 require_once('conn.php');

 header('Content-type:application/json;charset=utf-8');//加header
 //header('Access-Control-Allow-Origin : *');

  //判斷有沒有傳東西進來
  if (
    empty($_POST['content']) ||
    empty($_POST['nickname']) ||
    empty($_POST['site_key']) 
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
  $nickname = $_POST['nickname'];
  $site_key = $_POST['site_key'];
  $content = $_POST['content'];

  $sql = "insert into stephy_discussions(site_key, nickname, content) values(?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $site_key, $nickname, $content);
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
  //拿到的東西是一個物件，在用json_encode把它變成json字串之後輸出出去
  $json = array(
    "ok" => true,
    "message" => "Success!"
  );

  $response = json_encode($json);  
  echo $response; 
?>





