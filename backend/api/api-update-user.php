<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userID'])){
  sendResponse(0, __LINE__, 'You must login to use this api.');
}


$userID = $_SESSION['userID'];
/// $data = $_POST['data'];


$body = file_get_contents("php://input");
$jData = json_decode($body);

//VALIDATE FIRST NAME
$firstName = $jData->firstName;
if(empty($firstName)){
  sendResponse(0, __LINE__, 'Name filed is empty');
}

// if( strlen($firstName) < 2){
//   sendResponse(0, __LINE__, 'Name has to be min 2 characters');
// }

// if( strlen($firstName) > 20){
//   sendResponse(0, __LINE__, 'Name has to be max 20 characters');
// }

//VALIDATE LAST NAME
$lastName = $jData->lastName;
if(empty($lastName)){
  sendResponse(0, __LINE__, 'Last name filed is empty');
}

// if( strlen($lastName) < 2){
//   sendResponse(0, __LINE__, 'Last name has to be min 2 characters');
// }

// if( strlen($lastName) > 50){
//   sendResponse(0, __LINE__, 'Last name has to be max 20 characters');
// }

//VALIDATE EMAIL
$email = $jData->email;
if(empty($email)){
  sendResponse(0, __LINE__, 'Email field is empty');
}

if( !filter_var($email, FILTER_VALIDATE_EMAIL)){
  sendResponse(0, __LINE__, 'Email address is not a valid address');
}

//BIRTHDAY
$password = $jData->password;
if(empty($password)){
    sendResponse(0, __LINE__, 'Password field is empty');
}
$hashedPassword = password_hash($password, 1);

  // $stmt = $db->prepare('SELECT * FROM friends WHERE id = :friendID');
  // $stmt->bindValue(':friendID', $friendID);
try
{  $stmt = $db->prepare('UPDATE users SET first_name=:firstName, 
  last_name=:lastName, email=:email, password=:userPassword WHERE id = :userID');
  //  $stmt->bindValue(':userID', $userID);
  $stmt->bindValue(':userID', $userID);
  $stmt->bindValue(':firstName', $firstName);
  $stmt->bindValue(':lastName', $lastName);
  $stmt->bindValue(':email', $email);
  $stmt->bindValue(':userPassword', $hashedPassword);

  $stmt->execute();
  sendResponse(1, __LINE__, 'Successfully updated the user data in the database', $body);

}
catch(PDOException $ex){
    echo $ex;
  }
//**************************************************
function sendResponse($bStatus, $iLineNumber, $message, $data='{}'){
  echo '{"status": '.$bStatus.', "code": '.$iLineNumber.', "message":"'.$message.'", "data":'.$data.'}';
  exit;
}
