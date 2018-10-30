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

    // Método para obtener los datos de las categorias
    public function datosCategoriasModel(){
        // Se guarda en una variable la consulta sql
        $sql = "SELECT * FROM categorias";

        // Se manda la consulta como parámetro al método prepare
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta
        $stmt->execute();

        // Se guarda el array asociativo de la consulta en una variable
        $respuestaModel = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si el array no está está vacío devuelve el array, caso contrario devulve false
        if($respuestaModel){ return $respuestaModel; }
        else { return false; }
    }

    // Método para eliminar una categoría
    public function eliminarCategoriaModel($id){
        // Consulta sql
        $sql = "DELETE FROM categorias WHERE id=?";

        // Se pasa la consulta como parámetro del método prepare
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta, si se ejecuta con éxito se devuelve true, caso contrario false
        if($stmt->execute([$id])){ return true; }
        else { return false; }
    }

    // Método para obtener los datos de una categoría dado el id
    public function obtenerCategoriaModel($id){
        // Consulta sql
        $sql = "SELECT * FROM categorias WHERE id=?";

        // Se pasa la consulta como parámetro del método prepare
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta, pasándole como parámetro el id
        $stmt->execute([$id]);

        // Se almacena en un array lo que trajo la consulta
        $respuestaModel = $stmt->fetchAll();

        // Si el array asociativo trae datos se retorna ese array, caso contrario false.
        if($respuestaModel) { return $respuestaModel; }
        else { return false; }
    }

    // Método para editar los datos de una categoria
    // se pasan como parámetro el nombre, descripción y id de la categoria
    public function editarCategoriaModel($categoria, $descripcion, $id){
        // Consulta sql
        $sql = "UPDATE categorias SET nombre=?,descripcion=? WHERE id=?";

        // Se pasa la consulta como parámetro del método prepare
        $stmt = Conexion::conectar()->prepare($sql);

        // si se ejecuta con éxito devuelve true, caso contrario false
        if($stmt->execute([$categoria,$descripcion,$id])){ return true; }
        else { return false; }
    }




    # PRODUCTOS ------------------------------------------
        # -----------------------
    // Método para obtener todos los productos
    public function obtenerProductosModel(){
        // Consulta sql
        $sql = "SELECT * FROM productos";

        // Se prepara la consulta
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta
        $stmt->execute();

        // Se almacena en un array asociativo los registros encontrados
        $respuestaModel = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si el array no está vacío retorna el array, sino devuelve false.
        if($respuestaModel){             
            return $respuestaModel; 
        }
        else { return false; }
    }


    // Método para guardar el producto
    public function guardarProductoModel($datosProducto){

        //OBTENER EL ID DE LA CATEGORIA
        $sql = "SELECT id FROM categorias WHERE nombre=?";
        $stmt_id = Conexion::conectar()->prepare($sql);
        $stmt_id->execute([$datosProducto["categoria"]]);
        $id = $stmt_id->fetch();        

        //Se prepara el query con el comando INSERT -> DE INSERTAR 
        $stmt = Conexion::conectar()->prepare("INSERT INTO productos(codigo,nombre,fecha_agregado,precio,stock,categoria,ruta_img) VALUES(:codigo,:nombre,:fecha_agregado,:precio,:stock,:categoria,:ruta_img)");
        
        //Se colocan todos sus parametros especificados, y se relacionan con los datos pasdaos por parametro a esta funcion desde el controladro en modo de array asociativo
        //Asi como se especifica como deben ser tratados (tipo de dato)
        $stmt->bindParam(":codigo", $datosProducto["codigo"] , PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datosProducto["producto"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_agregado", date("Y-m-d"), PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datosProducto["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datosProducto["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":categoria", $id[0], PDO::PARAM_STR);
        $stmt->bindParam(":ruta_img", $datosProducto["foto"], PDO::PARAM_STR);

        //print_r($datosAlumno);

        //Se ejecuta dicha insercion y se notifica al controlador para que este le notifique a las vistas necesarias
        if($stmt->execute()){
            //$stmt->close();
            return true;
        }else{
            //$stmt->close();
            return "error";
        }
    }


    //Funcion que se usa para editar un cierto registro de la tabla alumnos, Este de giual forma tiene dos parametros, uno para especificar los datos en una arreglo asociativo y otro para indicar el nombre de la tabla donde se editaran dichos datos
    public function editarProductoModel($datosProducto, $idProducto){

        //Obtener el id de la categoria
        $sql = "SELECT id FROM categorias WHERE nombre=?";
        $stmt_id = Conexion::conectar()->prepare($sql);
        $stmt_id->execute([$datosProducto["categoria"]]);

        $categoria = $stmt_id->fetch();        

        //Se prepara el query con el comando UPDATE -> DE EDITAR, O ACTUALIZAR
        $stmt = Conexion::conectar()->prepare("UPDATE productos SET codigo = ?, nombre = ?, precio = ?, stock = ?, categoria = ? WHERE id = ?");
        
        $id = 5;
        $nombre = "el nombre";
        //Se relacionan todos los parametros con los pasados en el arreglo asociativo desde el controlador
        $stmt->bindParam(1, $datosProducto['codigo'] );
        $stmt->bindParam(2, $datosProducto['producto']); // Se queda nulo
        $stmt->bindParam(3, $datosProducto['precio'] );
        $stmt->bindParam(4, $datosProducto['stock'] );
        $stmt->bindParam(5, $categoria[0] );
        //$stmt->bindParam(6, $datosProducto['foto'] );
        $stmt->bindParam(6, $idProducto );
                
        

        //Y son ejecutados y notificados al controlador para que este les notifique a las vistas para que den un mensaje amigable al usuario
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
    }


    // Método para eliminar un producto
    public function eliminarProductoModel($id){
        // Consulta sql
        $sql = "DELETE FROM productos WHERE id=?";

        // Se pasa la consulta como parámetro del método prepare
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta, si se ejecuta con éxito se devuelve true, caso contrario false
        if($stmt->execute([$id])){ return true; }
        else { return false; }
    }

    // Método para obtener los datos de un producto específico y enviar un array asociatvo al controlador
    public function obtenerProductoModel($idProducto){
        // Consulta sql
        $sql = "SELECT * FROM productos WHERE id=?";

        // Se prepara la consulta
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta, se pasa como parámetro el id del producto
        $stmt->execute([$idProducto]);

        // Se guarda el array
        $respuestaModel = $stmt->fetch();

        // Si el array es vacío devuelve false, sino retorna el array
        if($respuestaModel) { return $respuestaModel; }
        else { return false; }
    }


    // Método para agregar stock a las diferentes tablas que los manejen
    public function agregarStockModel($idProducto,$usuario,$fecha,$hora,$referencia,$stock){

        # OBTENER EL STOCK DE UN PRODUCTO EN ESPECÍFICO -----------------------------
        $sql = "SELECT stock FROM productos WHERE id=?";
        $stmt_id = Conexion::conectar()->prepare($sql);
        // Se ejecuta, se pasa como parámetro el id del producto
        $stmt_id->execute([$idProducto]);
        // En la variable se almacena el array donde viene el stock actual
        $stock_actual = $stmt_id->fetch();        

        // Se hace un casteo a las variables ya que están como strings
        $stock_actual[0] = (int)$stock_actual[0];
        $stock = (int)$stock;
        // Se suman el stock actual y el nuevo
        $stock_total = $stock_actual[0]+$stock;



        #SE ACTUALIZA EL STOCK DEL PRODUCTO (TABLA PRODUCTOS) -----------------------
        // Consulta para actualizar el stock del producto (stock_total)
        $sql_actualizar = "UPDATE productos SET stock=? WHERE id=?";
        // Se prepara la consulta
        $stmt_actualizar = Conexion::conectar()->prepare($sql_actualizar);
        // Se ejecuta, se pasan los parámetros del id del producto y el stock nuevo
        $stmt_actualizar->execute([$stock_total,$idProducto]);



        # SE INSERTAN LOS DATOS EN LA TABLA HISTORIALES -----------------------------
        $sql_t = "INSERT INTO historiales (producto,usuario,fecha,nota,referencia,cantidad) VALUES(?,?,?,?,?,?)";
        $stmt = Conexion::conectar()->prepare($sql_t);

        // Se ejecuta la consulta, si todo va bien retorna true
        if($stmt->execute([$idProducto,$usuario,$fecha,$hora,$referencia,$stock])){
            return true;
        }else{
            return false;
        }
    }


    public function obtenerHistorialModel($idProducto){
        // Consulta sql
        $sql = "SELECT * FROM historiales WHERE producto=?";

        // Se pasa la consulta como parámetro del método prepare
        $stmt = Conexion::conectar()->prepare($sql);

        // Se ejecuta la consulta, se pasa como parámetro el argumento de la función
        $stmt->execute([$idProducto]);

        // Se almacena el resultado (array asociativo)
        $respuestaModel = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Si el array no es vacío retorna dicho array, sino retorna false.
        if($respuestaModel) { return $respuestaModel; }
        else { return false; }
    }
}