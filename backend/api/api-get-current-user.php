<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userID = $_SESSION['userID'];

sendResponse(1, __LINE__, 'User currently signed in', $userID);
//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='""'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
