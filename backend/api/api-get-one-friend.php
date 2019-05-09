<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$userID = $_SESSION['userID'];
$friendID = $_GET['friendID'];

$stmt = $db->prepare('SELECT * FROM friends
JOIN friends_categories ON friends.category_fk = friends_categories.id
JOIN friends_stay_in_touch ON friends.id = friends_stay_in_touch.friend_fk
JOIN friends_stay_in_touch_frequencies ON friends_stay_in_touch.frequency_fk = friends_stay_in_touch_frequencies.id
WHERE friends.id = :ID');

$stmt->bindValue(':ID', $friendID);
$stmt->execute();
$oneFriend = $stmt->fetchAll();

sendResponse(1, __LINE__, json_encode($oneFriend));
//**************************************************
function sendResponse($bStatus, $iLineNumber, $message){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'"}';
  exit;
}
