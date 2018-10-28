<?php
require_once('conexion.php');

class Datos extends Conexion{


    # USUARIOS -------------------------------------------
        # ---------------
    //Funcion que compara si existe el usuario que intenta logearse, pasandole los datos a traves de un objeto y ademas el nombre de la tabla,
    //Asi como se convierte a la contraseña con la funcion MD5 para que se compare correctamente con la almacenada en la base de datos
    public function validarUsuario($datos){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND password = md5(?)");

        $stmt->bindParam(1, $datos['usuario'], PDO::PARAM_STR);
        $stmt->bindParam(2, $datos['contrasena'], PDO::PARAM_STR);

        $stmt->execute();

        $r = array();

        $r = $stmt->fetch(PDO::FETCH_ASSOC);

        return $r;

    }

    //Funcion que almacena todos los datos de un alumno en su respectiva tabla, tabmien pasada por parametro (el nombre)
    public function guardarDatosUsuario($datosUsuario, $tabla){

        //Se prepara el query con el comando INSERT -> DE INSERTAR 
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellido, nombre_usuario, password, correo, fecha_registro, ruta_imagen) VALUES(:nombre, :apellido, :nombre_usuario, MD5(:contrasena), :correo, NOW() , :foto) ");
        
        //Se colocan todos sus parametros especificados, y se relacionan con los datos pasdaos por parametro a esta funcion desde el controladro en modo de array asociativo
        //Asi como se especifica como deben ser tratados (tipo de dato)
        $stmt->bindParam(":nombre", $datosUsuario["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datosUsuario["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_usuario", $datosUsuario["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosUsuario["contrasena"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosUsuario["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datosUsuario["foto"], PDO::PARAM_STR);

        //print_r($datosAlumno);

        //Se ejecuta dicha insercion y se notifica al controlador para que este le notifique a las vistas necesarias
        if($stmt->execute()){
            //$stmt->close();
            return "success";
        }else{
            //$stmt->close();
            return "error";
        }

    }

    //Funcion que se usa para editar un cierto registro de la tabla alumnos, Este de giual forma tiene dos parametros, uno para especificar los datos en una arreglo asociativo y otro para indicar el nombre de la tabla donde se editaran dichos datos
    public function editarDatosUsuario($datosUsuario, $idUsusario){

        //Se prepara el query con el comando UPDATE -> DE EDITAR, O ACTUALIZAR
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, password = MD5(?), correo = ?, ruta_imagen = ? WHERE id = ?");
        
        //Se relacionan todos los parametros con los pasados en el arreglo asociativo desde el controlador
        $stmt->bindParam(1, $datosUsuario['nombre'] );
        $stmt->bindParam(2, $datosUsuario['apellido'] );
        $stmt->bindParam(3, $datosUsuario['contrasena'] );
        $stmt->bindParam(4, $datosUsuario['correo'] );
        $stmt->bindParam(5, $datosUsuario['foto'] );
        $stmt->bindParam(6, $idUsusario );
        
        print_r($datosUsuario);
        echo ' id Usuario: ' . $idUsusario;

        //Y son ejecutados y notificados al controlador para que este les notifique a las vistas para que den un mensaje amigable al usuario
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }

    }

    //Funcion que trae todos los registros de la tabla alumnos para mostrarlos,
    //Como todas las tablas pertenecientes a esta base de datos estan relacionados, se ocupo de una union de las mismas, para de esta forma mandar todo como si fuera una unica tabla con la informacion necesaria por la tabla principal que es de alumnos, por ejemplo digamos que se relacion la tabla alumnos con la re tutores, pero solo es por un id, para poder ver el nombre del tutor es necesario esta union
    public function traerDatosUsuarios(){

        //Es la union de las tablas alumnos, carreras y tutores
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios");

        $stmt->execute();

        $r = array();

        //Se guardan todos los datos en el arreglo antes creado
        $r = $stmt->FetchAll();
        
        //SE retornan al controlador para luego ser aventadas a la vista xD
        return $r;

    }

    public function eliminarDatosUsuario($usuario_id, $tabla){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :usuario_id ");

        $stmt->bindParam(":usuario_id", $usuario_id , PDO::PARAM_INT);

        //Le informa al controlador si se realizao con exito o no dicha transaccion
        if($stmt->execute() ){
            return "success";
        }else{
            return "error";
        }

    }

    public function obtenerDatosDeUsuarioId($usuario_id){

        //Se prepara el query
       $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id = :usuario_id");

        //Se pasan los parametros de ese query
        $stmt->bindParam(":usuario_id", $usuario_id , PDO::PARAM_INT);

        //se ejecuta
        $stmt->execute();

        $r = array();

        //Se trane todos los ddatos
        $r = $stmt->FetchAll();
        
        //y finalmente se pasan al controlador para ponerlos en la vista en donde se hace la edicion de dicho registro
        return $r;
    }



    #CATEGORIAS ------------------------------------------
        #------------------------------
    // Método para agregar una categoria
    public function agregarCategoriaModel($categoria, $descripcion, $fecha){
        // Consulta sql
        $sql = "INSERT INTO categorias (nombre,descripcion,fecha_agregado) VALUES(?,?,?)";

        // Se prepara la consulta con la sentencia sql como parámetro
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta pasandole un array con los valores traidos de la función
        // Si se realizó con éxito la consulta devuelve true, false en caso contrario
        if($stmt->execute([$categoria,$descripcion,$fecha])) { return true; }
        else { return false; }
    }


}