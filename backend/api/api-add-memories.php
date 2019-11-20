<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$body = file_get_contents("php://input");
$jData = json_decode($body); 

//echo json_encode($jData->note);

$friendID = $jData->friendID;


$date = $jData->date;
$name =$jData->name;
if($name == null){
  sendResponse(0, __LINE__, 'Title cannot be null');

}
try{

  $stmt = $db->prepare('INSERT INTO friends_memories VALUES(null, :friendID, :memoryDate, :memoryName)');

  $stmt->bindValue(':memoryDate', $date);
  $stmt->bindValue(':memoryName', $name);
  $stmt->bindValue(':friendID', $friendID);

  $stmt->execute();


  if($stmt->rowCount() == 0){
      echo 'Sorry the memories couldnt be added';
      exit;
  }

  sendResponse(1, __LINE__, 'Successfully added memory to the database');

}catch(PDOException $ex){
  echo $ex;
}

//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
