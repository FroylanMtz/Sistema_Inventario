<?php 
    
    # Inventario (Listar productos) ---------------------
    # ---- 90% ----
    # -------------------------------------

    /**
    * Inventario de Todos los productos, con opción de ver, editar y eliminar
    */


    // Se declara un objeto del tipo controlador
    $controlador = new Controlador();

    // Se traen todos los datos de los productos y se guardan en una variable (array)
    $productos = $controlador->obtenerProductosController();


    // Si se oprimió el botón de eliminar (producto) se recibe el id con GET
    if(isset($_GET["accion"])){
        if ($_GET["accion"] == "eliminar_producto") {
            $controlador->eliminarProductoController();
        }
    }
    

 ?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="icofont icofont-home"></i>
            </div>
            <div class="d-inline-block">
                <?php 
                    if ($productos == false) {
                        echo "<h5>Inventario (No hay productos)</h5>";
                    }
                 ?>
                <span> Productos </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="#!">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Inventario</a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>



<!-- DIV CON LA TABLA DE LOS DIFERENTES PRODUCTOS -->
<div class="page-body">
    <div class="card">
        <div class="card-block">
            
            <table id="tabla" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <!--Columnas de la cabecera de la tabla-->
                        <th> Código </th>
                        <th> Producto </th>
                        <th> Categoria </th>
                        <th> Precio </th>                        
                        <th> Stock </th>
                        
                        <th>Detalles</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //La tabla es llenada dinamicamente creando una nueva fila por cada registro en la tabla, toda la ifnormacion que aqui se despliega se trajo desde el controler con el metodo anteriormente definido

                        // Si no hay productos no muestran datos (y así no marca error)
                        if($productos){
                            foreach($productos as $producto): // Inicio foreach
                                echo '<tr>';
                                    echo '<td>'. $producto['codigo'] .'</td>';
                                    echo '<td>'. $producto['nombre'] .'</td>';
                                    // Se obtienen los datos de la categoria para mostrarla en la lista
                                    $_GET["id"] = $producto["categoria"];
                                    $categoria = $controlador->obtenerCategoriaController();
                                    echo '<td>'. $categoria[0]['nombre'] .'</td>';
                                    echo '<td>'. $producto['precio'] .'</td>';
                                    echo '<td>'. $producto['stock'] .'</td>';
                                    
                                    
                                    //Estos dos de abajo son los botones, se puede observar que estan listos para redirigir el flujo de la app a una pagina que se ellama ver, editar y eliminar, teniendo un parametro el cual es el id del producto

                                    echo '<td> <a href="index.php?action=ver_producto&id='.$producto['id'].'" type="button" class="btn btn-warning"> <i class="fas fa-edit"></i> </a> </td>';

                                    echo '<td> <a href="index.php?action=editar_producto&id='.$producto['id'].'" type="button" class="btn btn-warning"> <i class="fas fa-edit"></i> </a> </td>';
                                    
                                    echo '<td>  <a href="index.php?action=inventario&accion=eliminar_producto&id='.$producto['id'].'" type="button"  class="btn btn-danger"> <i class="fas fa-trash-alt"></i>  </a> </td>';
                                echo '</tr>';
                            endforeach; // Fin foreach
                        }                        
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

