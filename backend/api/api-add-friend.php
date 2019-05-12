<?php

require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}
$userID = $_SESSION['userID'];

//VALIDATE FIRST NAME
$firstName = $_POST['firstName'] ?? '';
// if(empty($firstName)){
//   sendResponse(0, __LINE__, 'Name filed is empty');
// }

// if( strlen($firstName) < 2){
//   sendResponse(0, __LINE__, 'Name has to be min 2 characters');
// }

// if( strlen($firstName) > 20){
//   sendResponse(0, __LINE__, 'Name has to be max 20 characters');
// }

//VALIDATE LAST NAME
$lastName = $_POST['lastName'] ?? '';
// if(!empty($lastName)){
//   sendResponse(0, __LINE__, 'Last name filed is empty');
// }

// if( strlen($lastName) < 2){
//   sendResponse(0, __LINE__, 'Last name has to be min 2 characters');
// }

// if( strlen($lastName) > 50){
//   sendResponse(0, __LINE__, 'Last name has to be max 20 characters');
// }

//VALIDATE EMAIL
$email = $_POST['email'] ?? '';
// if(!empty($email)){
//   sendResponse(0, __LINE__, 'Email field is empty');
// }

// if( !filter_var($email, FILTER_VALIDATE_EMAIL)){
//   sendResponse(0, __LINE__, 'Email address is not a valid address');
// }

//BIRTHDAY
$birthday = $_POST['birthday'] ?? '';
// if(empty($birthday)){
//   sendResponse(0, __LINE__, 'Email field is empty');
// }

//ADDRESS
$address = $_POST['address'] ?? '';

//PHONE NUMBER/S
$phoneNumber = $_POST['phoneNumber'] ?? '';

//IMAGE_URL ?
$imageURL = $_POST['imageURL'] ?? '';

//WORKPLACE
$workplace = $_POST['workplace'] ?? '';

//CATEGORY
$category = $_POST['category'];

$db->beginTransaction();
  $stmt = $db->prepare('INSERT INTO friends VALUES(null, :userID, :category, :firstName, :lastName, :birthday, :imageURL, :phoneNumber, :workplace, :email, :friendAddress, "" )');
  $stmt->bindValue(':userID', $userID);
  $stmt->bindValue(':category', $category);
  $stmt->bindValue(':firstName', $firstName);
  $stmt->bindValue(':lastName', $lastName);
  $stmt->bindValue(':birthday', $birthday);
  $stmt->bindValue(':imageURL', $imageURL);
  $stmt->bindValue(':phoneNumber', $phoneNumber);
  $stmt->bindValue(':workplace', $workplace);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':friendAddress', $address);

  if(  !$stmt->execute() ){
    sendResponse(1, __LINE__, 'Couldnt add user to the database');
    $db->rollBack();
    exit;
  }

  $friendId = $db->lastInsertId();
  $stmt = $db->prepare('INSERT INTO friends_stay_in_touch VALUES(:friendID, 5, null)');
  $stmt->bindValue(':friendID', $friendId);
  if(  !$stmt->execute() ){
    sendResponse(1, __LINE__, 'Couldnt add user to the database 2');
    $db->rollBack();
    exit;
  }

  $db->commit();

  sendResponse(1, __LINE__, 'Successfully added the friend to the database');

//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
