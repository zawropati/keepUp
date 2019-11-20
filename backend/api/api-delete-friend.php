<?php
require_once __DIR__.'/connect.php';
session_start();
if( !isset ($_SESSION['userID']) ){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$userID = $_SESSION['userID'];
$friendID = $_POST['friendID'];
if( empty($friendID) ){
  sendResponse(0, __LINE__, 'Friend ID is missing, we couldnt delete friend.');
}
try{
  $stmt = $db->prepare('DELETE FROM friends WHERE id=:friendID AND user_fk=:userID ');
  $stmt->bindValue(':userID', $userID);
  $stmt->bindValue(':friendID', $friendID);
  $stmt->execute();
  if( $stmt->rowCount() == 0 ){
    sendResponse(1, __LINE__, 'Sorry the friend couldnt be deleted');
  }
  sendResponse(1, __LINE__, 'Successfully deleted friend from the database');
}catch(PDOException $ex){
  echo $ex;
}
//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}