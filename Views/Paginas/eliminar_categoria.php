<?php 

	#ElIMINAR CATEGORIA -------------------
	#----100%-----
	#-------------------------------------


	// Se declara un objeto del tipo controlador
	$controlador = new Controlador();
	//Valida que se accione el metodo solo si se hace clic en el boton y no cuando se cargue pagina
	if(isset($_POST['eliminar'])) {
		// Se compara que la contraseña coincida con la del usuario en sesión (importante uso de MD5)
	    if(MD5($_POST['contrasena']) == $_SESSION["contrasenaUsuario"]){
	    	// Se llama al método para eliminar usuario
	        $controlador -> eliminarCategoriaController();
	    }else{
	    	echo "<script> alert('Contraseña incorrecta!'); </script>";
	    }
	}

	// Se traen todos los datos de un producto en específico
	$datosCategoria = $controlador->obtenerCategoriaController();

?>



<div class="card page-header p-0" style="background-color: #FFCDCC">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-user"></i>
            </div>
            <div class="d-inline-block">
                <h5> Eliminar categoria: <strong> <?php echo $datosCategoria["nombre"]; ?> </h5>
                <span> Eliminar </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=inventario"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="index.php?action=eliminar_categoria&id=<?php echo($datosCategoria["id"]) ?>"> Eliminar Categoria </a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block">            
            <br>
            <br>
            <center>
            <h5>Para concretar la acción ingrese su contraseña</h5><br>

            <!-- FORM PARA ELIMINAR USUARIOS -->
            <form method="POST">
            	<div class="col-sm-8 col-lg-5">
            		<div class="input-group">
            		<span style="background-color: #DC0500" class="input-group-addon" id="basic-addon2"><i class="fas fa-unlock-alt"></i></span>
            		<input type="password" class="form-control" name="contrasena"  required placeholder="Ingrese su contraseña">             
            		</div>     
            	</div>

                <div class="card-footer">
                    <center> <input style="background-color: #DC0500" onmouseover="this.style.color='#010101'" onmouseout="this.style.color='#FFFDDD'" type="submit" class="btn btn-danger input-lg" value="Eliminar" name="eliminar" /> </center>
                </div>
            </form>
            </center>
           
        </div>
    </div>
</div>