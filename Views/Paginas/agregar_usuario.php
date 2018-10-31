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
                <h5> Agregar usuario </h5>
                <span> Nuevo usuario que administrará el sistema </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="#!"> Nuevo Usuario </a>
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
                    <center> <h4 class="sub-title">Complete todos los datos del usuario</h4> <center>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Nombre (s)</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Apellido (s)</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                                    <input type="text" class="form-control" name="apellido" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Nombre de usuario</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="usuario" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Contraseña</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fas fa-unlock-alt"></i></span>
                                    <input type="password" class="form-control" name="contrasena" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Correo</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2">@</span>
                                    <input type="text" class="form-control" name="correo" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label">Foto</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fas fa-image"></i></span>
                                    <input type="file" class="form-control input-lg" name="foto" required />
                                </div>
                            </div>
                        </div>

                        

                        <div class="card-footer">
                            <center> <input type="submit" class="btn btn-primary input-lg" value="Guardar Datos" /> </center>
                        </div>

                    </form>

                </div>
                <!-- Basic group add-ons end -->
            </div>

        </div>
</div>

<?php

if(isset($_POST['nombre']) ){

    $controlador->guardarDatosUsuario();

}


?>