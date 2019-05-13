<?php
require_once __DIR__.'/connect.php';

// validate name
$firstName = $_POST['firstName'] ?? '';
if( empty($firstName) ){ sendResponse(0, __LINE__);  }
if( strlen($firstName) < 2 ){ sendResponse(0, __LINE__); }
if( strlen($firstName) > 50 ){ sendResponse(0, __LINE__); }

// validate last name
$lastName = $_POST['lastName'] ?? '';
if( empty($lastName) ){ sendResponse(0, __LINE__);  }
if( strlen($lastName) < 2 ){ sendResponse(0, __LINE__); }
if( strlen($lastName) > 50 ){ sendResponse(0, __LINE__); }

// validate email
$email = $_POST['email'] ?? '';
if( empty($email) ){ sendResponse(0, __LINE__);  }
if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){ sendResponse(0, __LINE__);  }

// validate password
$password = $_POST['password'] ?? '';
if( empty($password) ){ sendResponse(0, __LINE__);  }
if( strlen($password) < 4 ){ sendResponse(0, __LINE__); }
if( strlen($password) > 50 ){ sendResponse(0, __LINE__); }
$hashedPassword = password_hash( $password, PASSWORD_DEFAULT );


try{
$stmt = $db->prepare('INSERT INTO users VALUES (null, :firstName, :lastName, :email, :userPassword)');
$stmt->bindValue(':firstName', $firstName);
$stmt->bindValue(':lastName', $lastName);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':userPassword', $hashedPassword);
$stmt->execute();
echo 'works';

}catch( PDOException $e){
    echo $e;
    exit();
  }
  
  function sendResponse( $bStatus, $iLineNumber ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.'}';
    exit;
  }
  