<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}


//$json = file_get_contents('php://input');

$userID = $_SESSION['userID'];
/// $data = $_POST['data'];


$body = file_get_contents("php://input");
$jData = json_decode($body);
//sendResponse(1, __LINE__, 'Successfully updated the friends data in the database', $body);

//VALIDATE FIRST NAME
$friendID = $jData->id;
$firstName = $jData->firstName;
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
$lastName = $jData->lastName;
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
$email = $jData->email;
// if(!empty($email)){
//   sendResponse(0, __LINE__, 'Email field is empty');
// }

// if( !filter_var($email, FILTER_VALIDATE_EMAIL)){
//   sendResponse(0, __LINE__, 'Email address is not a valid address');
// }

//BIRTHDAY
$birthday = $jData->birthday;
// if(empty($birthday)){
//   sendResponse(0, __LINE__, 'Email field is empty');
// }

//ADDRESS
$address = $jData->address;

//PHONE NUMBER/S
$phoneNumber = $jData->phoneNumber;

//IMAGE_URL ?

//WORKPLACE
$workplace = $jData->workplace;

//CATEGORY
$category = $jData->category;


  // $stmt = $db->prepare('SELECT * FROM friends WHERE id = :friendID');
  // $stmt->bindValue(':friendID', $friendID);

  $stmt = $db->prepare('UPDATE friends SET first_name=:firstName, 
  last_name=:lastName, category_fk=:category, birthdate=:birthday, phone=:phoneNumber, 
  workplace=:workplace, email=:email, address=:friendAddress WHERE id = :friendID');
  //  $stmt->bindValue(':userID', $userID);
  $stmt->bindValue(':friendID', $friendID);
  $stmt->bindValue(':category', $category);
  $stmt->bindValue(':firstName', $firstName);
  $stmt->bindValue(':lastName', $lastName);
  $stmt->bindValue(':birthday', $birthday);
  $stmt->bindValue(':phoneNumber', $phoneNumber);
  $stmt->bindValue(':workplace', $workplace);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':friendAddress', $address);

  $stmt->execute();


//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
