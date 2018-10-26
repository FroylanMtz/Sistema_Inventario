<?php

//Clase que se conecta ala base de datos pasandole los datos de la especifica conexion 
//Vemos que esta conexion es atraves de un PDO para brindar mayor robustez y trabajar con el paradigma orientado a objetos
class Conexion{

    public function conectar(){
        $pdo = new PDO("mysql:host=localhost;dbname=sistema_inventario", "root", "");
        return $pdo;
    }

}