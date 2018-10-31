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
?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-reload"></i>
            </div>
            <div class="d-inline-block">
                <h5> Editar producto </h5>
                <span> Editar </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="#"> Editar Producto </a>
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
                <div class="m-b-20">
                    <center> <h4 class="sub-title">Complete todos los datos del producto</h4> <center>

                    <form method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="fotoActual" value="<?= $producto['ruta_img'] ?>">

                        <input type="hidden" name="id" value="<?= $producto['id'] ?>">

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Código </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">                                    
                                    <input type="text" class="form-control" name="codigo" required value="<?php echo($producto["codigo"]) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Producto </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">                                    
                                    <input type="text" class="form-control" name="producto" required placeholder="Nombre del producto" value="<?php echo($producto["nombre"]) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Categoria </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">    
                                    <?php 
                                    // Se obtiene le nombre de la categoria, para no poner el número (id)
                                        $_GET["id"] = $producto["categoria"];
                                        $categoria = $controlador->obtenerCategoriaController();
                                     ?>                                
                                    <select name="categoria" class="form-control">
                                        <option>
                                            <?php                                                                 
                                            echo $categoria["nombre"];
                                            ?>
                                        </option>
                                        <?php 
                                            // Ciclo que trae todas las categorias
                                            foreach ($categorias as $categoria) {
                                                echo "<option>";                                                
                                                echo $categoria["nombre"];
                                                echo "</option>";
                                            }
                                         ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Precio </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">                                    
                                    <input type="text" class="form-control" name="precio" required placeholder="Precio del producto" value="<?php echo($producto["precio"]) ?>">
                                </div>
                            </div>
                        </div>

                        <!-- No se edita el stock desde aquí
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Stock </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">                                    
                                    <input type="number" disabled class="form-control" name="stock" required placeholder="Stock inicial" value="<?php echo($producto["stock"]) ?>">
                                </div>
                            </div>
                        </div>
                        -->

                        
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Imagen</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control input-lg" name="foto" value="<?php echo($producto["ruta_img"]) ?>" />
                                </div>
                            </div>
                        </div>
                        
                        

                        <div class="card-footer">
                            <center> <input type="submit" class="btn btn-primary input-lg" name="actualizar" value="Guardar Datos" /> </center>
                        </div>

                    </form>

                </div>
                <!-- Basic group add-ons end -->
            </div>

        </div>
</div>