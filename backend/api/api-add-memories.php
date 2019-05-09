<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}

$date = $_POST['date'];
$name = $_POST['name'];
$friendID = $_POST['friendID'];

try{

  $stmt = $db->prepare('INSERT INTO friends_memories VALUES(:friendID, :memoryDate, :memoryName)');

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
function sendResponse($bStatus, $iLineNumber, $message){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'"}';
  exit;
}
