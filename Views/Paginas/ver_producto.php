<?php

    # Ver producto ---------------------
    # ---- 100% ----
    # -------------------------------------
    //Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo 
    // que comunican a la vista con el controlador
    $controlador = new Controlador();


    // Se traen todos los datos del producto con el id traido con GET en un array
    // Se verifica si existe la variable GET
    if(isset($_GET["id"])){
        // Se guarda el array con los datos de la categoria en específico
       $producto = $controlador->obtenerProductoController();
    }

    // Si se presionó el botón de guardar datos
    if (isset($_POST["actualizar"])) {        
        // Se llama al método del controlador para preparar los datos
        $controlador->editarProductoController();
    }    

    // Se obtienen los datos de las categorias para extraer los nombre y mostrarlos en el form
    $categorias = $controlador->datosCategoriasController();



    // Si hay valor por GET (el id del producto es el que se requiere)
    if(isset($_GET["id"])){
        // Se llama al método del controlador para recibir los datos del historial de movimientos de 
        //stock de determinado producto
        $historial = $controlador->obtenerHistorialController();            
    }
?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-ti"></i>
            </div>
            <div class="d-inline-block"> <!-- Se muestra el nombre del producto en la cabecera de la página -->
                <h3> <strong><?php echo($producto["nombre"]) ?></strong></h3>
                <span> Detalles </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title"> <!-- Redirecciona a la lista de productos -->
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="#"> Producto </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<div class="page-body">

        <div class="card">
            
            <div class="card-block">
                <!-- Basic group add-ons start -->
                <center>
                <div class="m-b-20">
                     <h4 class="sub-title"> Datos del producto </h4> 
                        
                        <div class="row">
                            
                            <label class="col-sm-4 col-lg-12 col-form-label"> 
                            
                                <img src="fotosProductos/<?php echo $producto["ruta_img"]; ?>" height="300px" width="300px" />
                            
                            </label>
                            
                        </div>  

                        <!-- id del producto (hidden) -->
                        <input type="hidden" name="id" value="<?= $producto[0]['id'] ?>">
                        
                        <!-- Datos del producto: Código -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Código:</strong> <?php echo $producto["codigo"]; ?></label>                            
                        </div>  
                        
                        <!-- Datos del producto: Categoria -->
                        <div class="row">
                            <?php 
                                // Se obtiene le nombre de la categoria, para no poner el número (id)
                                    $_GET["id"] = $producto["categoria"];
                                    $categoria = $controlador->obtenerCategoriaController();
                             ?>
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Categoria:</strong> <?php echo $categoria["nombre"];?></label>                          
                        </div>
                        
                        <!-- Datos del producto: Precio -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Precio: $ </strong> <?php echo($producto["precio"]) ?></label>                           
                        </div>

                        <!-- Datos del producto: Stock -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Stock:</strong> <?php echo($producto["stock"]) ?></label>                           
                        </div>                                                    
                    
                    
                </div>
                
                <!-- Botones para agregar y eliminar stock -->
                <div class="card-footer">
                    
                     <?php 
                        // Se envia con GET ciertas variables que servirán para ir a las página y realizar 
                     // las acciones correspondientes
                        echo '<a href="index.php?action=agregar_stock&id='.$producto['id'].'" type="button" class="btn btn-success"> Agregar Stock </a> ';

                        echo '<a href="index.php?action=eliminar_stock&id='.$producto['id'].'" type="button" class="btn btn-danger"> Eliminar Stock </a> ';
                      ?>
                        
                </div>

                <!-- Basic group add-ons end -->

                <!-- Tabla con el historial de los productos -->
                <?php echo "<br><h5>Historial del inventario</h5>"; ?>
                <table id="tabla" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <!--Columnas de la cabecera de la tabla-->
                        <th> Fecha </th>
                        <th> Hora </th>
                        <th> Descripción (usuario) </th>
                        <th> Total </th>                        
                        <th> Referencia </th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Ciclo foreach para ver el historial de cambios de stock de un producto
                    // Si no ha habido movimientos no muestra nada para que no salgan errores
                    if($historial){
                        foreach($historial as $historia): // Inicio foreach
                            echo "<tr>";
                            echo "<td>" . $historia["fecha"] . "</td>";
                            echo "<td>" . $historia["nota"] . "</td>";
                            
                            // Obtener el nombre del usuario
                            $_GET["id"] = $historia["usuario"];                            
                            //echo "GET " . $historia["usuario"];
                            $usuario = $controlador->obtenerDatosUsuario();

                            // Si el id de usuario ($historia[id] es null quiere decir que se trajo un array(0))
                            if($usuario)
                                echo "<td>" . $usuario[0]["nombre_usuario"] . " agregó ". $historia["cantidad"] . " producto(s)</td>";
                            else{
                                echo "<td> Un antiguo usuario (Ya no existe) agregó ". $historia["cantidad"] . " producto(s)</td>";
                            }
                            //echo "<td>" . $historia["usuario"] . "</td>";
                            echo "<td>" . $historia["cantidad"] . "</td>";
                            echo "<td>" . $historia["referencia"] . "</td>";
                            echo "</tr>";
                        endforeach; // Termina foreach

                    }
                    ?>
                </tbody>
            </table>
                </center>
            </div>

        </div>
</div>