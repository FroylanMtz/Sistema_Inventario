<?php
	
	#Eliminar USUARIOS -------------------
	#----70%-----
	#-------------------------------------
	
	// Se declara un objeto del tipo controlador
	$controlador = new Controlador();
	//Valida que se accione el metodo solo si se hace clic en el boton y no cuando se cargue pagina
	if(isset($_GET['accion'])) {
	    if( $_GET['accion'] == "eliminar"){
	    	// Se llama al método para eliminar usuario
	        $controlador -> eliminarUsuario();
	    }
	}


	//Se instancia a un objeto de l clase controlador para que se manden llamar todos los metodo que cominican a la vista con el controlador

	$datosUsuario = $controlador->obtenerDatosUsuario();
?>



<div class="card page-header p-0" style="background-color: #FFCDCC">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="ti-user"></i>
            </div>
            <div class="d-inline-block">
                <h5> Eliminar usuario: <strong> <?php echo $datosUsuario[0]["nombre_usuario"]; ?> </strong> </h5>
                <span> Eliminar </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="index.php?action=dashboard"> Inicio </a>
                </li>
                <li class="breadcrumb-item"><a href="index.php?action=eliminar_usuario&id=<?php echo($datosUsuario[0]["id"]) ?>"> Eliminar Usuario </a>
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

            <form method="POST">
            	<div class="col-sm-8 col-lg-5">
            		<div class="input-group">
            		<span style="background-color: #DC0500" class="input-group-addon" id="basic-addon2"><i class="fas fa-unlock-alt"></i></span>
            		<input type="password" class="form-control" name="contrasena"  required placeholder="Ingrese su contraseña">             
            		</div>     
            	</div>

                <div class="card-footer">
                    <center> <input style="background-color: #DC0500" onmouseover="this.style.color='#010101'" onmouseout="this.style.color='#FFFDDD'" type="submit" class="btn btn-danger input-lg" value="Eliminar" /> </center>
                </div>
            </form>
            </center>
           
        </div>
    </div>
</div>