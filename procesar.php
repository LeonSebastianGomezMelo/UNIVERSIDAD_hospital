<?php
session_start();
if (isset($_SESSION['codigo'])) {
    $PKUSU_NCODIGO = $_SESSION['codigo'];
} else {
    if (isset($_SESSION)) {
        session_destroy();
    }
    echo '<script> window.location="index.html"; </script>';
    exit();
}

if (isset($_SESSION['codigo2'])) {
    $PKREG_NCODIGO = $_SESSION['codigo2'];
} else {
    if (isset($_SESSION)) {
        session_destroy();
    }
    echo '<script> window.location="index.html"; </script>';
    exit();
}

if (isset($_SESSION['tipoIngreso'])) {
    $tipoIngreso = $_SESSION['tipoIngreso'];
} else {
    if (isset($_SESSION)) {
        session_destroy();
    }
    echo '<script> window.location="index.html"; </script>';
    exit();
}

if (isset($_SESSION)) {
    session_destroy();
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

if ($tipoIngreso == 'ninguno'){
    $InsercionSQL = "INSERT INTO hospitalUniminuto.tbl_registro_personal (FKUSU_NCODIGO) VALUES ($PKUSU_NCODIGO);";
    if ($ResultadoSQL = $ConexionSQL->query($InsercionSQL)) {
        mysqli_close($ConexionSQL);
        echo '<script> window.location="index.html"; </script>';
        exit();
    } else {
        $ErrorSQL = mysqli_error($ConexionSQL);
        printf("Error en la web consulte con el administrador del sistema");
        echo "<script>console.error('Error: sql: %s\n, $ErrorSQL');</script>";
        mysqli_close($ConexionSQL);
        exit();
    }
} elseif ($tipoIngreso == 'ingreso'){
    $ActualizacionSQL = "UPDATE hospitalUniminuto.tbl_registro_personal SET REG_CSALIDA = NOW() WHERE PKREG_NCODIGO = $PKREG_NCODIGO;";
    if ($ResultadoSQL = $ConexionSQL->query($ActualizacionSQL)) {
        mysqli_close($ConexionSQL);
        echo '<script> window.location="index.html"; </script>';
        exit();
    } else {
        $ErrorSQL = mysqli_error($ConexionSQL);
        printf("Error en la web consulte con el administrador del sistema");
        echo "<script>console.error('Error: sql: %s\n, $ErrorSQL');</script>";
        mysqli_close($ConexionSQL);
        exit();
    }
} else {
    mysqli_close($ConexionSQL);
    echo '<script> window.location="index.html"; </script>';
    exit();
}
?>

