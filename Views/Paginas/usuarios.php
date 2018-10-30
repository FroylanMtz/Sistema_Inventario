<?php
//Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo que cominican a la vista con el controlador
$controlador = new Controlador();

$datosUsuario = $controlador->obtenerDatosUsuarios();

?>


<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-user"></i>
            </div>
            <div class="d-inline-block">
                <h5> Usuarios </h5>
                <span> Listado de los usuarios registrados </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=dashboard"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="index.php?action=usuarios"> Lista de usuarios </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block">
            
            <table id="tabla" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <!--Columnas de la cabecera de la tabla-->
                        <th>Id</th>
                        <th>Nombre (s)</th>
                        <th>Apellido (s)</th>
                        <th>Usuario</th>                        
                        <th>Correo</th>
                        <th>Registro</th>
                        <th>Foto</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //La tabla es llenada dinamicamente creando una nueva fila por cada registro en la tabla, toda la ifnormacion que aqui se despliega se trajo desde el controler con el metodo anteriormente definido
                        for($i=0; $i < count($datosUsuario); $i++ ){
                            echo '<tr>';
                                echo '<td>'. $datosUsuario[$i]['id'] .'</td>';
                                echo '<td>'. $datosUsuario[$i]['nombre'] .'</td>';
                                echo '<td>'. $datosUsuario[$i]['apellido'] .'</td>';
                                echo '<td>'. $datosUsuario[$i]['nombre_usuario'] .'</td>';
                                echo '<td>'. $datosUsuario[$i]['correo'] .'</td>';
                                echo '<td>'. $datosUsuario[$i]['fecha_registro'] .'</td>';
                                echo '<td> <img src="fotos/'. $datosUsuario[$i]['ruta_imagen'] .'" height="50px" width="50px"> </td>';
                                //Estos dos de abajo son los botones, se puede observar que estan listos para redirigir el flujo de la app a una pagina que se ellama editar y eliminar, teniendo un parametro el cual es la matricula del alumno a administrar

                                echo '<td> <a href="index.php?action=editar_usuario&id='.$datosUsuario[$i]['id'].'" type="button" class="btn btn-warning"> <i class="fas fa-edit"></i> </a> </td>';
                                
                                echo '<td>  <a href="index.php?action=usuarios&accion=eliminar_usuario&id='.$datosUsuario[$i]['id'].'" type="button"  class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </a> </td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

//Valida que se accion el metodo solo si se hace clic en el boton y no cuando se cargue pagina
if(isset($_GET['accion'])) {
    if( $_GET['accion'] == "eliminar_usuario"){
        $controlador -> eliminarUsuario();
    }
}

?>