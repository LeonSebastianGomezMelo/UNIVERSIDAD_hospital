<?php
session_start();
if (isset($_SESSION['codigo'])) {
    echo '<script> window.location="turno.php"; </script>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['usuario']) && !empty($_POST['contrasena'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
    } else {
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Uniminuto</title>
        </head>
        <body>
        <h2>Bienvenido al Hospital Minuto de Dios</h2>
        <h3>Usuario y/o Contraseña incorrectos</h3>
        <form method="post">
            <a href="index.html"><button type="button">Volver</button></a>
        </form>
        </body>
        </html>
    <?php
        exit();
    }
} else {
    echo '<script> window.location="index.html"; </script>';
    exit();
}
function quitarCaracteres($texto){
    $texto = trim($texto);
    $texto = str_replace("'", null, $texto);
    $texto = str_replace('"', null, $texto);
    $texto = str_replace(chr(13), null, $texto);
    $texto = str_replace(chr(11), null, $texto);
    $texto = str_replace(chr(10), null, $texto);
    $texto = str_replace(chr(39), null, $texto);
    $texto = str_replace(chr(34), null, $texto);
    $texto = preg_replace('/[^A-Za-z0-9ñÑ.#-+*\ ]/i', '', $texto);
    return $texto;
}


$ConexionSQL = new mysqli('localhost', 'user', 'userp4s$', 'hospitalUniminuto');
if ($ConexionSQL->connect_errno) {
    printf("Error en la web consulte con el administrador del sistema");
    echo "<script>console.error('Error: conection: %s\n, $ConexionSQL->connect_error');</script>";
    exit();
} else {
    if (!$ConexionSQL->set_charset("utf8")) {
        printf("Error en la web consulte con el administrador del sistema");
        echo "<script>console.error('Error cargando el conjunto de caracteres utf8: %s\n, $ConexionSQL->error');</script>";
        exit();
    }
}

$clave = "uniminuto";
$cifrado = "Hospitaluniminuto";
$usuario = quitarCaracteres($usuario);
$contrasena = quitarCaracteres($contrasena);
$contrasena = openssl_encrypt($contrasena, 'aes-256-cbc', $clave, 0, $iv);

$ConsultaSQL = "SELECT PKUSU_NCODIGO FROM hospitalUniminuto.tbl_rusuarios WHERE USU_CDOCUMENTO = '$usuario' AND USU_CONTRASENA = '$contrasena';";
if($ResultadoSQL = $ConexionSQL->query($ConsultaSQL)) {
    $CantidadResultados = $ResultadoSQL->num_rows;
    if ($CantidadResultados > 0) {
        if(isset($_SESSION)){
            session_destroy();
        }
        session_start();
        while ($FilaResultado = $ResultadoSQL->fetch_assoc()) {
            $_SESSION['codigo'] = $FilaResultado['PKUSU_NCODIGO'];
            break;
        }
        mysqli_free_result($ResultadoSQL);
        mysqli_close($ConexionSQL);
        echo '<script> window.location="turno.php"; </script>';
        exit();
    } else {
        mysqli_free_result($ResultadoSQL);
        mysqli_close($ConexionSQL);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Uniminuto</title>
        </head>
        <body>
        <h2>Bienvenido al Hospital Minuto de Dios</h2>
        <h3>Usuario y/o Contraseña incorrectos</h3>
        <form method="post">
            <a href="index.html"><button type="button">Volver</button></a>
        </form>
        </body>
        </html>
    <?php
        exit();
    }
}
?>