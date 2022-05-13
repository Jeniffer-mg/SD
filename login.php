<?php
session_start();

$dbhost = "db";
$dbuser = "root";
$dbpass = "";
$dbname = "db_videogames";

try {
    if(!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
        throw new Exception('No es posible conectarse a la base de datos');
    }
    
    $nombre= $_POST["txtusuario"];
    $pass = $_POST["txtpassword"];
    
    $query = mysqli_query($conn, "SELECT * FROM USUARIO_BLACKLIST WHERE USUARIO = '$nombre'");
    $nr = mysqli_num_rows($query);
    if($nr != 0) {
        echo "Por favor intente después";
    } else {
        try {
            $query = mysqli_query($conn, "SELECT * FROM USUARIO WHERE USUARIO = '".$nombre."' and PASSWORD = '".$pass."'");
            $nr = mysqli_num_rows($query);
            $log = "";
            if($nr != 0) {
                $user=mysqli_fetch_row($query);
                $_SESSION["user_id"]=$user[0];
                //header ("Location: index.html")
                $log = date("Y-m-d H:i:s")." - Inicio de sesion. Id usuario: $user[0]\n";
                $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $log);
                header('Location: index.php');
            } else if ($nr == 0){
                $query = mysqli_query($conn, "SELECT * FROM USUARIO WHERE USUARIO = '".$nombre."'");
                $nr = mysqli_num_rows($query);
                if($nr != 0) {
                    $map_users_attemps = array();
                    $user=mysqli_fetch_array($query);
                    $pista = substr($user['PASSWORD'], 0, 3);
                    echo('pista: ' .$pista);
                    $attempts = 0;
                    if (isset($_SESSION["user_attempt"])) {
                        $map_users_attemps = $_SESSION["user_attempt"];
                    }
                    if(isset($map_users_attemps[$nombre])) {
                        $attempts = $map_users_attemps[$nombre];
                    }
                    $attempts++;
                    if($attempts > 2) {
                        $sql = "INSERT INTO USUARIO_BLACKLIST(USUARIO) VALUES ('$nombre')";
                        $result = mysqli_query($conn, $sql);
                        $attempts = 0;
                    }
                    $map_users_attemps[$nombre] = $attempts;
                    echo "intentos: $attempts";
                    $_SESSION["user_attempt"] = $map_users_attemps;
                }
                $log = date("Y-m-d H:i:s")." - Falla inicio de sesion. Nombre: $nombre password: $pass\n";
                $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
                fwrite($myfile, $log);
                echo "No ingreso, usuario incorrecto";
            }
        } catch (mysqli_sql_exception $err) {
            echo "Error en la base de datos 2";
        }
        
    }
    
} catch (mysqli_sql_exception $th) {
    $log = date("Y-m-d H:i:s")." - Error en la conexión con la base de datos. base de datos 1\n";
    $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
    fwrite($myfile, $log);
    echo('Lo sentimos, estamos teniendo fallos, por favor, vuelva a intentar más tarde.');
}catch(Exception $falla){
    $log = date("Y-m-d H:i:s")." - Error en la conexión. base de datos 1\n";
    $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
    fwrite($myfile, $log);
}

?>
