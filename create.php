<?php
// Incluir archivo config.php
require_once "config.php";

// Define valores y incia sin valor
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validando nombre
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Por favor ingrese el nombre del empleado.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Por favor ingrese un nombre válido.";
    } else{
        $name = $input_name;
    }

    // Validando direccion
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una dirección.";
    } else{
        $address = $input_address;
    }

    // Validando salario
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Por favor ingrese el monto del salario del empleado.";
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Por favor ingrese un valor correcto y positivo.";
    } else{
        $salary = $input_salary;
    }

    // Comprueba los errores de entrada antes de insertarlos en la base de datos
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Preparar una instrucción de INSERT
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Enlazar variables a la instrucción preparada como parámetros
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

            // Establece parametros
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            // Intento de ejecutar la instrucción preparada
            if(mysqli_stmt_execute($stmt)){
                // Registros creados correctamente. Redirección a la página de destino
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Finaliza instrucción
        mysqli_stmt_close($stmt);
    }

    // Finaliza conexion
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Agregar Empleado</title>
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
                        <h2>Agregar Empleado</h2>
                    </div>
                    <p>Favor diligenciar el siguiente formulario, para agregar el empleado.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Dirección</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>Sueldo</label>
                            <input type="text" name="salary" class="form-control" value="<?php echo $salary; ?>">
                            <span class="help-block"><?php echo $salary_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
