<?php
session_start();

$dbhost = "db";
$dbuser = "root";
$dbpass = "";
$dbname = "db_videogames";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$conn){
    die("No hay conexion: ".mysqli_connect_error());
}

$nombre= $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

$query = mysqli_query($conn, "SELECT * FROM USUARIO WHERE USUARIO = '".$nombre."' and PASSWORD = '".$pass."'");
$nr = mysqli_num_rows($query);
if($nr == 1){
    $user=mysqli_fetch_row($query);
    $_SESSION["user_id"]=$user[0];
    //header ("Location: index.html")
    header('Location: index.php');
} else if ($nr == 0){
    echo "No ingreso, usuario incorrecto";
}
?>
