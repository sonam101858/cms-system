<?php


$server = 'localhost';
$user = 'root';
$password = '';
$db = 'cms4.2.1';
$connectingDB = new PDO("mysql:host=$server; dbname=$db", $user,$password);
// if($connectingDB){
//     echo "connection successfully";
// }
// else{
//     echo "no";
// }
