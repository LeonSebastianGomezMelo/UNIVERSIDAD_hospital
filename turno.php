<?php
session_start();
if (isset($_SESSION['codigo'])) {
    $PKUSU_NCODIGO = $_SESSION['codigo'];
} else {
    echo '<script> window.location="index.html"; </script>';
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

$ConsultaSQL = "SELECT USU_CNOMBRE, USU_CAPELLIDO, USU_CESPECIALIDAD FROM hospitalUniminuto.tbl_rusuarios WHERE PKUSU_NCODIGO = '$PKUSU_NCODIGO';";
if($ResultadoSQL = $ConexionSQL->query($ConsultaSQL)) {
    $CantidadResultados = $ResultadoSQL->num_rows;
    if ($CantidadResultados > 0) {
        while ($FilaResultado = $ResultadoSQL->fetch_assoc()) {
            $USU_CNOMBRE = $FilaResultado['USU_CNOMBRE'];
            $USU_CAPELLIDO = $FilaResultado['USU_CAPELLIDO'];
            $USU_CESPECIALIDAD = $FilaResultado['USU_CESPECIALIDAD'];
            break;
        }
    } else {
        printf("Error en la web consulte con el administrador del sistema");
        echo "<script>console.error('No existen registros para el usuario indicado');</script>";
        exit();
    }
}


$tipoIngreso = 'ninguno';
$ConsultaSQL = "SELECT REG_CINGRESO, REG_CSALIDA FROM hospitalUniminuto.tbl_registro_personal WHERE FKUSU_NCODIGO = '$PKUSU_NCODIGO' AND REG_CSALIDA LIKE CONCAT('%', CURDATE(), '%');";
if($ResultadoSQL = $ConexionSQL->query($ConsultaSQL)) {
    $CantidadResultados = $ResultadoSQL->num_rows;
    if ($CantidadResultados > 0) {
        while ($FilaResultado = $ResultadoSQL->fetch_assoc()) {
            $REG_CINGRESO = $FilaResultado['REG_CINGRESO'];
            $REG_CSALIDA = $FilaResultado['REG_CSALIDA'];
            break;
        }
        $tipoIngreso = 'salida';
    } else {
        $ConsultaSQL = "SELECT REG_CINGRESO FROM hospitalUniminuto.tbl_registro_personal WHERE FKUSU_NCODIGO = '$PKUSU_NCODIGO' AND REG_CINGRESO LIKE CONCAT('%', CURDATE(), '%');";
        if($ResultadoSQL = $ConexionSQL->query($ConsultaSQL)) {
            $CantidadResultados = $ResultadoSQL->num_rows;
            if ($CantidadResultados > 0) {
                while ($FilaResultado = $ResultadoSQL->fetch_assoc()) {
                    $REG_CINGRESO = $FilaResultado['REG_CINGRESO'];
                    break;
                }
                $tipoIngreso = 'ingreso';
            } else {
                $tipoIngreso = 'ninguno';
            }
        }
    }
}

$_SESSION['tipoIngreso'] = $tipoIngreso;
mysqli_free_result($ResultadoSQL);
mysqli_close($ConexionSQL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uniminuto Turno</title>
</head>
<body>

<h2>Registro de Entrada y Salida</h2>
<form method="post" action="procesar.php">
    <label>Nombre: <?php echo $USU_CNOMBRE; ?> <?php echo $USU_CAPELLIDO; ?></label><br>
    <label >Especialidad: <?php echo $USU_CESPECIALIDAD; ?></label><br><br>
    <?php
    if ($tipoIngreso = 'ninguno'){
        echo '<h2>No has marcado Ingreso!</h2><br><br>
        <label for="hora_ingreso">Hora de Ingreso:</label><br>
        <input disabled type="time" id="hora_ingreso" name="hora_ingreso"><br><br>
    
        <input type="submit" value="Marcar ingreso"><br><br>';
    } elseif ($tipoIngreso = 'ingreso'){
        echo '<h2>Deseas marcar Salida?</h2><br><br>
        <label for="hora_ingreso">Hora de Ingreso:</label><br>
        <input disabled type="time" id="hora_ingreso" name="hora_ingreso"><br><br>
       
        <label for="hora_salida">Hora de Salida:</label><br>
        <input disabled type="time" id="hora_salida" name="hora_salida"><br><br>
    
        <input type="submit" value="Marcar Salida"><br><br>';
    } else {
        echo '<h2>Ya has marcado jornada por el dia de hoy</h2><br><br>
        <label for="hora_ingreso">Hora de Ingreso:</label><br>
        <input disabled type="time" id="hora_ingreso" name="hora_ingreso"><br><br>
       
        <label for="hora_salida">Hora de Salida:</label><br>
        <input disabled type="time" id="hora_salida" name="hora_salida"><br><br>
    
        <input type="submit" value="Salir"><br><br>';
    }
    exit();
    ?>
</form>

</body>
</html>
