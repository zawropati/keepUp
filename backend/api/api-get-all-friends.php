<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$userID = $_SESSION['userID'];


$stmt = $db->prepare('SELECT first_name, last_name, image_url FROM friends WHERE user_fk=:userID');
$stmt->bindValue(':userID', $userID);
$stmt->execute();
$friends = $stmt->fetchAll();

sendResponse(1, __LINE__, json_encode($friends));
//**************************************************
function sendResponse($bStatus, $iLineNumber, $message){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'"}';
  exit;
}
