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
$precio_juego= rtrim($precio_juego, "$");
$sql = "INSERT INTO COMPRA(ID_USUARIO, ID_JUEGO, NOMBRE, DESCRIPCION, VALOR) VALUES ";
$sql .= "($id_usuario, $id_juego, '$nombre_juego', '$descripcion_juego', $precio_juego)";
$result = mysqli_query($conn, $sql);
if($result) {
    echo "<h3>Compra exitosa</h3>";
    $sql = "SELECT * FROM COMPRA WHERE ID_USUARIO = $id_usuario;";
    $result = mysqli_query($conn, $sql);
    echo "<table border='1'>";
    echo "<tr>
    <th>NOMBRE</th>
    <th>DESCRIPCION</th>
    <th>VALOR</th>
  </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['NOMBRE']}</td>";
        echo "<td>{$row['DESCRIPCION']}</td>";
        echo "<td>{$row['VALOR']}</td>";
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "error comprando".mysqli_error($conn);
}

?>