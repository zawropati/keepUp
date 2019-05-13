<?php
require_once __DIR__.'/connect.php';

session_start();

if( !isset ($_SESSION['userId'])){
    sendResponse(0, __LINE__, 'You must login to use this api.');
}

$userId = $_SESSION['userId'];
$friendId = $_POST['friendId'];



$stmt = $db->prepare('SELECT * FROM friends WHERE id = :friendId');
$stmt->bindValue(':friendId', $friendId);
$stmt->execute();
$friend = $stmt->fetchAll();

if ( empty($friend) ){ sendResponse(0, __LINE__, "Friend doesnt't exists");  }

echo json_encode($friend);







// // validate name
// $firstName = $_POST['firstName'] ?? '';
// // if( empty($firstName) ){ sendResponse(0, __LINE__);  }
// // if( strlen($firstName) < 2 ){ sendResponse(0, __LINE__); }
// // if( strlen($firstName) > 50 ){ sendResponse(0, __LINE__); }

// // validate last name
// $lastName = $_POST['lastName'] ?? '';
// // if( empty($lastName) ){ sendResponse(0, __LINE__);  }
// // if( strlen($lastName) < 2 ){ sendResponse(0, __LINE__); }
// // if( strlen($lastName) > 50 ){ sendResponse(0, __LINE__); }

// // validate email
// $email = $_POST['email'] ?? '';
// // if( !empty($email) ){ 
// //     if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){ sendResponse(0, __LINE__);  }
// // }

// $birthdate = $_POST['birthdate'] ?? '';
// $address = $_POST['address'] ?? '';
// $phoneNumber = $_POST['phoneNumber'] ?? '';

// //image url

// $imageUrl = $_POST['imageUrl'] ?? '';
// $workplace = $_POST['workplace'] ?? '';
// $category = $_POST['category'] ?? '';



// $stmt = $db->prepare('INSERT INTO friends VALUES (null, :userId, :firstName, :lastName, :category, :birthdate, 
// :phoneNumber, :imageUrl, :workplace, :email, :friendAddress, "")');
// $stmt->bindValue(':userId', $userId);
// $stmt->bindValue(':firstName', $firstName);
// $stmt->bindValue(':lastName', $lastName);
// $stmt->bindValue(':category', $category);
// $stmt->bindValue(':birthdate', $birthdate);
// $stmt->bindValue(':phoneNumber', $phoneNumber);
// $stmt->bindValue(':imageUrl', $imageUrl);
// $stmt->bindValue(':workplace', $workplace);
// $stmt->bindValue(':email', $email);
// $stmt->bindValue(':friendAddress', $address);

// $stmt->execute();

// sendResponse( 1, __LINE__, "added" );

function sendResponse( $bStatus, $iLineNumber, $sMessage ){
    echo '{"status":'.$bStatus.', "code":'.$iLineNumber.', "message":"'.$sMessage.'"}';
    exit;
  }