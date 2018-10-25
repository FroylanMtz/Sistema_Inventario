<?php

class Controlador
{

    private $enlace = '';
    private $pagina = '';

    //Llamar a la plantilla
    public function cargarPlantilla()
    {
        //session_start();
        //Include se utiliza para invocar el arhivo que contiene el codigo HTML
        
        //if( isset($_SESSION['iniciada']) ){
            include 'Views/plantilla.php';
        //}else{
            //include 'login.php';
        //}
        
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
}

?>