<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$userID = $_SESSION['userID'];

$friendID = $_GET['friendID'];

$stmt = $db->prepare('SELECT * FROM friends_memories WHERE friend_fk=:friendID');
$stmt->bindValue(':friendID', $friendID);
$stmt->execute();
$memories = $stmt->fetchAll();

sendResponse(1, __LINE__,'These are the friedn memories', json_encode($memories));
//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
