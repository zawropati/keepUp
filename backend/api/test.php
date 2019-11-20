<?php

require_once __DIR__.'/connect.php';

$name =  $_POST['name'];
try{
$stmt = $db->prepare('INSERT INTO friends VALUES(null, "3", "A", "astName", "categor", "birthday", "phoneNumber", "imageURL", "workplace", "email", "friendAddress", "" )');
$stmt->bindValue(':fName', $name);
$stmt->execute();

echo "user was saved";
}catch(PDOException $ex){
    echo $ex;}