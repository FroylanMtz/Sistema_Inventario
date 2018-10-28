<?php

class Controlador
{

    private $enlace = '';
    private $pagina = '';

    //Llamar a la plantilla
    public function cargarPlantilla()
    {
        session_start();
        //Include se utiliza para invocar el arhivo que contiene el codigo HTML
        
        if( isset($_SESSION['iniciada']) ){
            include 'Views/plantilla.php';
        }else{
            include 'login.php';
        }
        
    }

    //Interacción con el usuario
    public function mostrarPagina()
    {
        //Trabajar con los enlaces de las páginas
        //Validamos si la variable "action" viene vacia, es decir cuando se abre la pagina por primera vez se debe cargar la vista index.php

        if(isset($_GET['action'])){
            //guardar el valor de la variable action en views/modules/navegacion.php en el cual se recibe mediante el metodo get esa variable
            $enlace = $_GET['action'];
        }else{

            $enlace = 'dashboard';
            
        }

        //Mostrar los archivos de los enlaces de cada una de las secciones: inicio, nosotros, etc.
        //Para esto hay que mandar al modelo para que haga dicho proceso y muestre la informacions
        $pagina = Modelo::mostrarPagina($enlace);

        include $pagina;
        
    }


    # INICIO DE SESION -----------------------------------------
        # -------------------------------
    public function iniciarSesion()
    {

        if( isset($_POST['usuario']) && isset( $_POST['contrasena']) )
        {

            $datos = array( 'usuario'      => $_POST['usuario'],
                            'contrasena'  => $_POST['contrasena'] );
            

            $respuesta = Datos::validarUsuario($datos);

           
            if( $respuesta )
            {
                session_start();
                $_SESSION['iniciada'] = true;
                $_SESSION['nombre'] = $respuesta['nombre']. ' ' . $respuesta['apellido'];
                $_SESSION['idUsuario'] = $respuesta['id'];
                $_SESSION['contrasenaUsuario'] = $respuesta['password'];


                header("location:index.php?action=dashboard");
                //echo 'Bienvenido al sistema';
            }else
            {
                echo '<script> alert("Correo o contraseña incorrectos") </script>';
                header("location:index.php");
                //echo 'Correo o contraseña incorrecto';
            }


        }
        
    }



    # USUARIOS ------------------------------------------------
        # ---------------------------------
    //Funcion que trae a todos los alumnos registrados en la dicha tabla para mostrarlos en la pagina de alumnos.php, se muestra ademas un boton para actualizar y eliminar para administrarlos
    public function obtenerDatosUsuarios()
    {
        $datosDeUsuarios = array();
        
        //Esta funcion del modelo no pide la tabla ya que se trata de una union de todas las tres tablas existentes para traer todos los datos completos y entendibles
        $datosDeUsuarios = Datos::traerDatosUsuarios();

        return $datosDeUsuarios;
    }

    //Funcion que trae los datos de UN solo alumno, esto con el fin de actualizarlo en la vista editar_alumno, para saber que usario se va a editar se manda un parametro GET llamado id en el cual va el id del usuario que en este caso es la matricula
    public function obtenerDatosUsuario(){

        $idUsuario = $_GET['id'];

        $datosDeUsuario = array();
        
        //Se manda llamar el metodo del modelo pasandole como parametro la matricula del usuario a traer los datos, de igual forma se hace una union de tablas para obtener la informacion mas entendible, por ello no se pasa el nombre de la tabla como parametro
        $datosDeUsuario = Datos::obtenerDatosDeUsuarioId($idUsuario);

        return $datosDeUsuario;
    }


    //Funcion que se manda llamar al registrar un usuario nuevo a la aplicacion, todos los datos son enviados a traves de un formulario el cual esta funcion cacha con los parametros POST identificandolos con el respectivo nombre de campo de la vista agregar_alumno.php
    public function guardarDatosUsuario(){
        
        //Datos recibidos de la vista, necesarios para identificar al usuario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        $correo = $_POST['correo'];

        //Para saber el nombre de la foto se manda llamar esta funcion
        $nombreArchivo = basename($_FILES['foto']['name']);
        
        //Se concatena al nombre la carpeta en donde se guardaran todas las fotos cargadas por los usuarios
        $directorio = 'fotos/' . $nombreArchivo;

        //Para hacer algunas validaciones y el usuario por ejemplo no pase como foto una archivo pdf se extrae la extencion de la foto
        $extension = pathinfo($directorio , PATHINFO_EXTENSION);

        //Todos los datos obtenidos del formulario son guardados en un objeto para luego ser pasados al modelo en donde serna almacenados en su respectiva tabla
        $datosUsuario = array('nombre' => $nombre,
                            'apellido' => $apellido,
                            'usuario' => $usuario,
                            'contrasena' => $contrasena,
                            'correo' => $correo,
                            'foto' => $usuario.'.'.$extension ); //El nombre de la foto de cada uusario sera el nombre de su usuario, para de esta forma llevar un control y que las fotos no se repiten y se sobreescriban


        //Aqui es donde se hace la validacion de el archivo sea una foto con extensiones de imagenes frecuentes y no un formato .docs o un pdf por ejemplo
        if($extension != 'png' && $extension != 'jpg' && $extension != 'PNG' && $extension != 'JPG'){
            echo '<script> alert("Error al subir el archivo intenta con otro") </sript>';
        }else{

            //Una vez que se ha cargado la imagen a los archivos temporales de php, esta funcion la mueve de ahi y la coloca en la direccion donde se guardaran las fotos ya con el nombre presonalizado por cada usuario, que es su matricula
            move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/'.$usuario . '.' . $extension);

            //Despues de que se ha guardado la imagen en la carpeta, se manda llamar la funcion del modelo en la cual se pasan el objeto con los datos del formulario para ser guardado
            $respuesta = Datos::guardarDatosUsuario($datosUsuario, "usuarios");

            //Se recibe la respuesta del metodo y si esta es exitosa se manda un mensaje de notificacion al cliente y se reenvia al usuario a la lista de todos los usuarios para que vea la insercion del nuevo alumno.
            if($respuesta == "success"){
                echo '<script> 
                            alert("Datos guardados correctamente");
                            window.location.href = "index.php?action=usuarios"; 
                      </script>';
                //header('index.php?action=alumnos');
            }else{
                //En caso de haber un error se queda en la misma pagina y le notifica al ususario
                echo '<script> alert("Error al guardar") </script>';
            }
        }
    }

    //Funcion que permite editar los datos de un alumno pasandole los datos por medio de un formualrio, esta funcion es muy parecida a la de arriba a diferencia que manda a otra funcion al modelo la cual sirve para actualizar los datos de un respectivo alumno
    public function editarDatosUsuario(){

        
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $contrasena = $_POST['contrasena'];
        $correo = $_POST['correo'];
        
        $nombreArchivo = basename($_FILES['foto']['name']);
        
        $directorio = 'fotos/' . $nombreArchivo;

        $extension = pathinfo($directorio , PATHINFO_EXTENSION);
        

        //Tambien se compara si el usuario solo quiere actualizar los datos o tambien la foto de perfil, en caso de que solo quiera editar los datos y quiera conservar la foto entra en el if de acontinuacion para almacenar el nombre de la misma foto que tenia previamente
        if($nombreArchivo == "" ){
            $foto = $_POST['fotoActual'];
        }else{
            
            if($extension != 'png' && $extension != 'jpg' && $extension != 'PNG' && $extension != 'JPG'){
                echo '<script> alert("Error al subir el archivo intenta con otro") </sript>';
                
                $foto = $_POST['fotoActual'];

            }else{

                //En caso de que el usuario haya querido ademas de actualizar sus datos en tipo texto, tambien editar la foto, entra aesta parte del if en donde crea una nueva foto, o sobreescibe la existente y la almacena en la variable foto la cual sera almacenada con los datos realizado.

                move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/'.$usuario . '.' . $extension);

                $foto = $usuario . '.' . $extension;

            }
        }

        //Se finaliza de crear los datos, ya con la  foto nueva o en caso de que haya elegido una nueva
        $datosUsuario = array('nombre' => $nombre,
                            'apellido' => $apellido,
                            'contrasena' => $contrasena,
                            'correo' => $correo,
                            'foto' => $foto );
        
        //Se manda ese objeto con los datos al modelo para que los almacenen en la tabla pasada por parametro aqui abajo
        $respuesta = Datos::editarDatosUsuario($datosUsuario, $_GET['id']);
        
        //El metodo responde con un success o un error y se realiza las notificaciones pertinentes al usuario
        if($respuesta == "success"){
            
            echo '<script> 
                    alert("Datos editados correctamente");
                    window.location.href = "index.php?action=usuarios"; 
                  </script>';
            
        }else{
            echo '<script> alert("Error al editar") </script>';
        }

    }

    // Método para eliminar usuario
    public function eliminarUsuario(){
        $usuario_id = $_GET['id'];
        
        $respuesta = Datos::eliminarDatosUsuario($usuario_id, "usuarios");

        //Se notifca al usuario como se realizo en los metodos pasados y si se borro exitosamente lo redirecciona a la pagina principal en donde estan listados todos los usuarios
        if($respuesta == "success"){
            echo '<script> 
                    alert("Usuario eliminado");
                    window.location.href = "index.php?action=usuarios";
                  </script>';
        }else{
            echo '<script> alert("Error al eliminar") </script>';
        }

    }



    # CATEGORIAS ----------------------------------------------
        # ----------------------------------
    // Método para mandar los datos del form al modelo y recibir su respuesta
    public function agregarCategoriaController(){
        // Se guardan en una variable los datos de del form con POST
        $categoria = $_POST["categoria"];
        $descripcion $_POST["descripcion"];

        // Se guarda el resultado que traiga el método del modelo
        $respuestaController = Datos::agregarCategoriaModel($categoria, $descripcion);

        // Se verifica si se realizó con éxito el agregar la categoria.
        if($respuestaController){
            echo '<script> 
                    alert("Categoria agregada con éxito");
                    window.location.href("index.php?action=categorias");
                 </script>';
        }else{
            echo "<script> Error -> No se agregó la categoria </script>";
        }
    }

}

?>