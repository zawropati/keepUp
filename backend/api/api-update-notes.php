<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}

$note = $_POST['note'];
$friendID = $_POST['friendID'];

try{

  $stmt = $db->prepare(' UPDATE friends SET friends.note = :note WHERE friends.id = :friendID ');

  $stmt->bindValue(':note', $note);
  $stmt->bindValue(':friendID', $friendID);

  $stmt->execute();


  if($stmt->rowCount() == 0){
      echo 'Sorry the notes are not updated';
      exit;
  }

  sendResponse(1, __LINE__, 'Successfully updated the note in the database');

}catch(PDOException $ex){
  echo $ex;
}

//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
