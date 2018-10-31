<?php
//Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo que cominican a la vista con el controlador
$controlador = new Controlador();

?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-plus"></i>
            </div>
            <div class="d-inline-block">
                <h5> Agregar categoria </h5>
                <span> Nueva categoria </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title"> <!-- Se redirecciona al inventario -->
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="#"> Nueva Categoria </a>
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

                        <!-- Nombre -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Nombre </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name="categoria" required placeholder="Nombre de la categoria">
                                </div>
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Descripción </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name="descripcion" required placeholder="Descripción">
                                </div>
                            </div>
                        </div>

                       
                        
                        <!-- Botón para accionar el form y guardar los datos -->
                        <div class="card-footer">
                            <center> <input type="submit" class="btn btn-primary input-lg" name="guardar" value="Guardar Datos" /> </center>
                        </div>

                    </form>

                </div>
                <!-- Basic group add-ons end -->
            </div>

        </div>
</div>

<?php

// Si el botón de guardar fue presionado
if(isset($_POST['guardar']) ){
    // Se llama al método del controlador para preparas los datos del form y enviarlos al modelo
    $controlador->agregarCategoriaController();

}


?>