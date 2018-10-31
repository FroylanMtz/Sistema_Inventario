<?php 
    
    # Listar categorias--------------------
    # ---- 100% ----
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
                <li class="breadcrumb-item"><a href="index.php?action=inventario">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Categorias</a>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>

<!-- AQUÍ VA LA TABLA DE CATEGORIAS CON LOS BOTONES PARA EDITAR Y BORRAR -->
<div class="page-body">
    <div class="card">
        <div class="card-block">
          <table id="tabla" class="table table-bordered table-striped">
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
                        <td><a type="button" class="btn btn-warning" href="index.php?action=editar_categoria&id=<?php echo($categoria["id"]); ?>"><i class="fas fa-edit"></i> </a></td>

                        <td><a type="button" class="btn btn-danger" href="index.php?action=eliminar_categoria&id=<?php echo($categoria["id"]); ?>"> <i class="fas fa-trash-alt" ></i> </a></td>
                    <?php echo "</td>"; ?>
                <?php endforeach; // importante el punto y coma ; ?>                    
            </tbody>
          </table>  
        </div>        
    </div>    
</div>