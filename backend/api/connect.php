<?php

try{
  $sUserName = 'root';
  $sPassword = '';
  $sConnection = "mysql:host=localhost; dbname=friendsapp; charset=utf8mb4";

  $aOptions = array(
    // PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //commented out because of transaction
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  );
  $db = new PDO( $sConnection, $sUserName, $sPassword, $aOptions );
}catch( PDOException $e){
echo '{"status":0,"message":"cannot connect to database"}';
exit();
}
