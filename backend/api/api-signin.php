<?php
require_once __DIR__.'/connect.php';

$email = $_POST['email'] ?? '';
if( empty($email) ){ sendResponse(0, __LINE__, "email is empty.");  }

$stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
$stmt->bindValue(':email', $email);
$stmt->execute();
$user = $stmt->fetchAll();

if ( empty($user) ){ sendResponse(0, __LINE__, "User doesnt't exists");  }

$password = $_POST['password'] ?? '';
if( empty($password) ){ sendResponse(0, __LINE__, "Password is empty");  }
if( strlen($password) < 4 ){ sendResponse(0, __LINE__, "Password has to be more than 4 characters"); }
if( strlen($password) > 50 ){ sendResponse(0, __LINE__, "Passwrod has to be less than 50 characters"); }

if ( !password_verify( $password, $user[0]->password )){  
    sendResponse( 0, __LINE__, "Wrong credentials, try log in again." );
};

$userId = $user[0]->id; 
session_start();
$_SESSION['userId'] = $userId;
echo $userId;

sendResponse( 1, __LINE__, "Success! You are logged in." );

function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }