<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userId'])){
    sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userId = $_SESSION['userId'];

//echo $userId;

$stmt = $db->prepare('SELECT id, first_name, last_name, image_url FROM friends WHERE user_fk = :user_fk');
$stmt->bindValue(':user_fk', $userId);
$stmt->execute();
$friends = $stmt->fetchAll();

$jFriends =  json_encode($friends);

sendResponse( 1, __LINE__, $jFriends );

function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }