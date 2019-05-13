<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userId'])){
    sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userId = $_SESSION['userId'];

$friendId = $_POST['friendId'];
$date = $_POST['date'];
$memoryName = $_POST['memoryName'];



$stmt = $db->prepare('INSERT INTO friends_memories VALUES (:friendId, :memoryDate, :memoryName) ');
$stmt->bindValue(':friendId', $friendId);
$stmt->bindValue(':memoryDate', $date);
$stmt->bindValue(':memoryName', $memoryName);

$stmt->execute();
sendResponse( 1, __LINE__, "success!" );


function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }
  