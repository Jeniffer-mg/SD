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

$id_usuario = $_SESSION['user_id'];
$id_juego = $_POST["ID_JUEGO"];
$nombre_juego = $_POST["NOMBRE"];
$descripcion_juego = $_POST["DESCRIPCION"];
$precio_juego = $_POST["VALOR"];
echo "id usuario: ".$id_usuario;
$sql = "INSERT INTO COMPRA(ID_USUARIO, ID_JUEGO, NOMBRE, DESCRIPCION, VALOR) VALUES ";
$sql .= "($id_usuario, $id_juego, '$nombre_juego', '$descripcion_juego', $precio_juego);"
$result = mysqli_query($conn, $sql);
if($result) {
    echo "Compra exitosa";
} else {
    echo "error comprando".mysqli_error($conn);
}

?>