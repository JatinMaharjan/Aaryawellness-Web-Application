<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "aaryawellness2";

foreach ($db as $key => $value){
    define(strtoupper($key), $value);
}

// $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// if($connection){
//     echo"i am connected to the database";
// }

$connection = mysqli_connect('localhost','root','','aaryawellness2');

if($connection){
    
    echo "i am connected";
}

?>