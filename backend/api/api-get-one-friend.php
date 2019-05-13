<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userId'])){
    sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userId = $_SESSION['userId'];
$friendId = $_GET['friendId'];


$stmt = $db->prepare('SELECT * FROM friends 
LEFT JOIN friends_categories ON friends_categories.id = friends.category_fk 
JOIN friends_stay_in_touch ON friends.id = friends_stay_in_touch.friend_fk 
JOIN friends_stay_in_touch_frequencies ON friends_stay_in_touch.frequency_fk = friends_stay_in_touch_frequencies.id
WHERE friends.id = :friend_id' );
$stmt->bindValue(':friend_id', $friendId);
$stmt->execute();
$oneFriend = $stmt->fetchAll();

$jOneFriend = json_encode($oneFriend);
sendResponse( 1, __LINE__, $jOneFriend );

function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }