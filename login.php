<?php


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_videogames";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    die("No hay conexion: ".mysqli_connect_error());
}

$nombre= $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

$query = mysqli_query($conn, "SELECT * FROM  login WHERE usuario = '".$nombre."' and password = '".$pass."'");
$nr = mysqli_num_rows($query);
if($nr == 1){
    //header ("Location: index.html")
    echo "Bienvenid@: " .$nombre;
} else if ($nr == 0){
    echo "No ingreso, usuario incorrecto";
}

$str = file_get_contents('./juegos.json', true);

$json = json_decode($str, true);

print_r($json, true);
?>
