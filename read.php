<?php
// Compruebe la existencia del parámetro id antes de procesar más
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluir archivo config.php
    require_once "config.php";

    // Preparar una instrucción SELECT
    $sql = "SELECT * FROM employees WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        // Enlazar variables a la instrucción preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Establecer parametros
        $param_id = trim($_GET["id"]);

        // Intentar ejecutar la instrucción preparada
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                /* Obtenga la fila de resultados como una matriz asociativa. Desde el conjunto de resultados
                contiene sólo una fila, no necesitamos usar durante el bucle */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Recuperar valor de campo individual
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // URL no contiene el parámetro id. Redirigir a la página de error
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Finaliza instruccion
    mysqli_stmt_close($stmt);

    // Finaliza conexion
    mysqli_close($link);
} else{
    // URL no contiene el parámetro id. Redirigir a la página de error
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Ver Empleado</h1>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sueldo</label>
                        <p class="form-control-static"><?php echo $row["salary"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Volver</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
