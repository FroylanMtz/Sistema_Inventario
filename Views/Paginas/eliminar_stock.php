<?php

    # Agregar Productos ---------------------
    # ---- 100% ----
    # -------------------------------------
    //Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo que cominican a la vista con el controlador
    $controlador = new Controlador();    

    // Si se presionó el botón de guardar datos
    if (isset($_POST["guardar"])) {
        // Se llama al método del controlador para preparar los datos        
        //echo $_SESSION["usuario"];

        $controlador->agregarStockController(-1);        
        //echo date("h:i");
    }

    
?>

<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-minus"></i>
            </div>
            <div class="d-inline-block">
                <h5> Eliminar Stock </h5>
                <span> Stock </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">  <!-- href que redireciona al listado de productos -->
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="#"> Eliminar Stock </a>
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
                    <center> <h4 class="sub-title">Complete todos los datos</h4> <center>

                    <!-- FORM PARA ELIMINAR CIERTA CANTIDAD DE STOCK DE UN PRODUCTO -->
                    <form method="POST">
                        
                        <!-- Se obtiene el id del producto a modificar stock -->
                        <input type="hidden" name="id" value="<?php echo($_GET["id"]) ?>">

                        <!-- Referencia -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Referencia </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">                                    
                                    <input type="text" class="form-control" name="referencia" required placeholder="Referencia">
                                </div>
                            </div>
                        </div>

                      
                        <!-- Cantidad a stock a eliminar -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-2 col-form-label"> Stock </label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="input-group">                                    
                                    <input type="number" class="form-control" name="stock" required placeholder="Ingresar cantidad">
                                </div>
                            </div>
                        </div>                       
                        
                        <!-- Botón para enviar los datos del form -->
                        <div class="card-footer">
                            <center> <input type="submit" class="btn btn-danger input-lg" name="guardar" value="Guardar Datos" /> </center>
                        </div>

                    </form>
                    <!-- FIN FORM PARA ELIMINAR CIERTA CANTIDAD DE STOCK DE UN PRODUCTO -->
                </div>
                <!-- Basic group add-ons end -->
            </div>

        </div>
</div>