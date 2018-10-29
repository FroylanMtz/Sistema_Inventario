<?php

    # Editar Productos ---------------------
    # ---- 100% ----
    # -------------------------------------
    //Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo que cominican a la vista con el controlador
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



    // Si se oprimio el boton de agregar o eliminar stock
    if(isset($_POST["agregar"])){

    }
?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-ti"></i>
            </div>
            <div class="d-inline-block">
                <h3> <strong><?php echo($producto["nombre"]) ?></strong></h3>
                <span> Detalles </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=dashboard"> Inicio </a>
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


                        <input type="hidden" name="id" value="<?= $producto[0]['id'] ?>">
                        
                        <div class="row">
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Código:</strong> <?php echo $producto["codigo"]; ?></label>
                            
                        </div>  
                        

                        <div class="row">
                            <?php 
                                // Se obtiene le nombre de la categoria, para no poner el número (id)
                                    $_GET["id"] = $producto["categoria"];
                                    $categoria = $controlador->obtenerCategoriaController();
                             ?>
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Categoria:</strong> <?php echo $categoria[0]["nombre"];?></label>                          
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Precio:</strong> <?php echo($producto["precio"]) ?></label>                           
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-12 col-form-label"> <strong>Stock:</strong> <?php echo($producto["stock"]) ?></label>                           
                        </div>                                                    
                    
                    
                </div>
                
                <!-- Botones para agregar y eliminar stock -->
                <div class="card-footer">
                
                     <?php 
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
                        <th> Descripción </th>
                        <th> Total </th>                        
                        <th> Referencia </th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //La tabla es llenada dinamicamente creando una nueva fila por cada registro en la tabla, toda la ifnormacion que aqui se despliega se trajo desde el controler con el metodo anteriormente definido

                        // Si no hay productos no muestran datos (y así no marca error)
                        //if($productos){
                            
                        //}                        
                    ?>
                </tbody>
            </table>
                </center>
            </div>

        </div>
</div>