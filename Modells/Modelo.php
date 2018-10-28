<?php

class Modelo
{

    //Una funcion con el parametro $enlacesModel que se recibe a traves del controlador

    public function mostrarPagina($enlace){

            
        //Posible paginas para los administradores
        if( $enlace == "dashboard" || $enlace == "inventario" || $enlace == "categorias" || $enlace == "usuarios" || $enlace=="salir" || $enlace == "agregar_usuario" || $enlace == "editar_usuario" || $enlace == "agregar_categoria" || $enlace == "editar_categoria"){
            //Mostramos el URL concatenado con la variable $enlacesModel
            $pagina = "Views/Paginas/". $enlace .".php";
        }
        //Una vez que action vienen vacio (validnaod en el controlador) enctonces se consulta si la variable $enlacesModel es igual a la cadena index de ser asi se muestre index.php
        else if($enlace == "index"){
            $pagina = "Views/Paginas/Administrador/dashboard.php";
        }
        //Validar una LISTA BLANCA 
        else{
            $pagina = "Views/Paginas/Administrador/dashboard.php";
        }

        
        return $pagina;
    
    }

}