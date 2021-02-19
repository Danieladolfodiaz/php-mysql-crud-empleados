<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD-EMPLEADOS-PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .navbar {
    background-color: #00000d;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<nav class="navbar navbar-default">
  <div class="navbar-header">
    <img src="imagenes/php.png" alt="" height="80" width="80">
    <img src="imagenes/mysql.png" alt="" height="80" width="80">
    <img src="imagenes/javascript.png" alt="" height="70" width="80">
    <img src="imagenes/html.png" alt="" height="80" width="80">
    <img src="imagenes/css.png" alt="" height="80" width="80">

  </div>

  <div class="collapse navbar-collapse navbar-ex1-collapse">

  </div>
</nav>

  </div>

</nav>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Todos los Empleados: </h2>
                        <a href="create.php" class="btn btn-success pull-right">Agregar nuevo empleado</a>
                    </div>
                    <?php
                    // Incluir archivo config.php
                    require_once "config.php";

                    // Intento de seleccionar la ejecución de consultas
                    $sql = "SELECT * FROM employees";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Nombre</th>";
                                        echo "<th>Dirección</th>";
                                        echo "<th>Sueldo</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['salary'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?id=". $row['id'] ."' title='Ver' data-toggle='tooltip'><span class='glyphicon glyphicon-book'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Actualizar' data-toggle='tooltip'><span class='glyphicon glyphicon-wrench'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Borrar' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Libera memoria al hacer la consulta
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No se encuentra a nadie.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Finaliza conexion
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
