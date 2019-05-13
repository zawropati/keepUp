<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userId'])){
    sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userId = $_SESSION['userId'];

$friendId = $_POST['friendId'];



$stayInTouchFrequency = $_POST['stayFrequecy'] ?? '';
$stayInTouchDate = time();


$stmt = $db->prepare('INSERT INTO friends_stay_in_touch VALUES (:friendId, :stayFrequency, null)');
$stmt->bindValue(':friendId', $friendId);
$stmt->bindValue(':stayFrequency', $stayInTouchFrequency);

$stmt->execute();
sendResponse( 1, __LINE__, "success!" );


function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }
  
  
  
  