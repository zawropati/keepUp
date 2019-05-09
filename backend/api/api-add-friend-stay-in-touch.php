<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$userID = $_SESSION['userID'];

//FRIENDID
$friendID = $_POST['friendID'];

//STAY-IN-TOUCH
$stayInTouchFrequency = $_POST['stayInTouchFrequency'];

$stmt = $db->prepare('INSERT INTO friends_stay_in_touch VALUES(:friendID, :stayInTouchFrequency, null)');
  $stmt->bindValue(':friendID', $friendID);
  $stmt->bindValue(':stayInTouchFrequency', $stayInTouchFrequency);

  $stmt->execute();

  sendResponse(1, __LINE__, 'Successfully added the frequency of contact to the database');

  //**************************************************
function sendResponse($bStatus, $iLineNumber, $message){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'"}';
  exit;
}
