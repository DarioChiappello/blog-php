
<!--Crear categoria-->
<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
    <h1>Crear categorías</h1>
    <p>Añada nuevas categorías al sitio para que los usuarios puedan usarlas al crear sus artículos.</p>
    <br>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoría</label>
        <input type="text" name="nombre" />
        
        <input type="submit" value="Guardar" />
    </form>

    
</div>


<?php
require_once 'includes/footer.php';
