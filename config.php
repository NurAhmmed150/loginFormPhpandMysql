<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'mark');
define('DB_PASSWORD', '5555');
define('DB_NAME', 'registeform');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME );

if(!$conn){
     echo "DB NOT CONNECT";
   }

?>
