<?php

    # Editar categoria--------------------
    # ---- 100% ----
    # -------------------------------------


    //Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo que cominican a la vista con el controlador
    $controlador = new Controlador();


    // Se traen todos los datos de la categoria con el id traido con GET en un array
    // Se verifica si existe la variable GET
    if(isset($_GET["id"])){
        // Se guarda el array con los datos de la categoria en específico
       $categoria = $controlador->obtenerCategoriaController();
    }


    // Si se oprimió el botón de actualizar datos
    if(isset($_POST['actualizar']) ){
        // Se llama al método del controlador
        $controlador->editarCategoriaController();
    }

?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-plus"></i>
            </div>
            <div class="d-inline-block">
                <h5> Editar categoria </h5>
                <span> Actualizar </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="#"> Editar Categoria </a>
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
                    <center> <h4 class="sub-title">Complete todos los datos de la categoria</h4> <center>

                    <form method="POST" enctype="multipart/form-data">

                        <!-- id (hidden)-->
                        <input type="hidden" name="id" value="<?php echo($categoria["id"]); ?>">

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Nombre </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name="categoria" required placeholder="Nombre de la categoria" value="<?php echo($categoria["nombre"]); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Descripción </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name="descripcion" required placeholder="Descripción" value="<?php echo($categoria["descripcion"]); ?>">
                                </div>
                            </div>
                        </div>

                       
                        

                        <div class="card-footer">
                            <center> <input type="submit" class="btn btn-primary input-lg" name="actualizar" value="Actualizar Datos" /> </center>
                        </div>

                    </form>

                </div>
                <!-- Basic group add-ons end -->
            </div>

        </div>
</div>