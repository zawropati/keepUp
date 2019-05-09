<?php
//To allow access from everywhere
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

try{
  $sUserName = 'root';
  $sPassword = '';
  $sConnection = "mysql:host=localhost; dbname=friendsapp; charset=utf8mb4";

  $aOptions = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );
}catch( PDOException $e){
echo '{"status":0,"message":"cannot connect to database"}';
exit();
}
