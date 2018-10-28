<?php 
    
    # Listar categorias--------------------
    # ---- 30% ----
    # -------------------------------------

    /**
    * Archivo que contiene una tabla con los datos de las diferentes categorias
    * Cada categoria se puede editar y borrar con los botones correspondientes
    */


    // Se instancia un objeto del tipo controlador
    $controlador = new Controlador();

    // Se obtienen los datos de las diferentes categorias
    // a través del método del controlador
    $datosCategorias = $controlador->datosCategoriasController();    



    // Si se oprimió el botón de eliminar (categoría) se recibe el id con GET
    if(isset($_GET["accion"])){
        if ($_GET["accion"] == "eliminar_categoria") {
            $controlador->eliminarCategoriaController();
        }
    }
 ?>


<div class="card page-header p-0">
    <div class="card-block front-icon-breadcrumb row align-items-end">
        <div class="breadcrumb-header col">
            <div class="big-icon">
                <i class="icofont icofont-home"></i>
            </div>
            <div class="d-inline-block">
                <h5>Categorias</h5>
                <span> Lista de las categorías </span>
            </div>
        </div>
        <div class="col">
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item"><a href="#!">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Categorias</a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<!-- AQUÍ VA LA TABLA DE CATEGORIAS CON LOS BOTONES PARA EDITAR Y BORRAR -->
<div>
    <table border="5px;">
        <thead>
            <th> Nombre </th>
            <th> Descripción </th>
            <th> Agregado </th>
            <th> Editar </th>
            <th> Eliminar </th>
        </thead>
        <tbody>
            <?php 
                // Se imprimen los registros encontrados en el siguiente foreach
                foreach($datosCategorias as $categoria): // Importante los dos puntos :
                    echo "<tr>";                    
                    echo "<td>" . $categoria["nombre"] . "</td>";
                    echo "<td>" . $categoria["descripcion"] . "</td>";
                    echo "<td>" . $categoria["fecha_agregado"] . "</td>";
             ?>

                    <!-- Botones para editar y borrar -->
                    <td><a href="index.php?action=editar_categoria&id=<?php echo($categoria["id"]); ?>"><button>Editar</button></a></td>

                    <td><a href="index.php?action=categorias&accion=eliminar_categoria&id=<?php echo($categoria["id"]); ?>"><button>Borrar</button></a></td>
                    </tr>
            <?php endforeach; // importante el punto y coma ; ?>                    
        </tbody>
    </table>
</div>