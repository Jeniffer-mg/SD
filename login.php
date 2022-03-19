<?php

echo "get into php file";

$dbhos = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_videogames"

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(!$conn){
    die("No hay conexion: ".mysqli_connect_error());
}

$nombre= $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

$query = mysqli_query($conn, "SELECT * FROM  login WHERE usuario = '".$nombre."' and password = '".$pass."'");
$nr = mysqli_num_rows($query);
echo $nr;
if($nr == 1){
    //header ("Location: index.html")
    echo "Bienvenid@: " .$nombre;
} else if ($nr == 0){
    echo "No ingreso, usuario incorrecto";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>New Page</h1>
</body>
</html>