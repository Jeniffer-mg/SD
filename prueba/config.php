<?php
   define('DB_SERVER', 'localhost:1521');
   define('DB_USERNAME', 'system');
   define('DB_PASSWORD', 'admin123');
   define('DB_DATABASE', 'usuarios');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>