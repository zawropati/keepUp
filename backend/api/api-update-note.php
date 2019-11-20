<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userId'])){
    sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userId = $_SESSION['userId'];

$friendId = $_POST['friendId'];
$note = $_POST['note'];



$stmt = $db->prepare('UPDATE friends SET friends.note = :note WHERE friends.id = :friendId');
$stmt->bindValue(':friendId', $friendId);
$stmt->bindValue(':note', $note);

$stmt->execute();
sendResponse( 1, __LINE__, "success!" );


function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }
  
  
  