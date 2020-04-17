
<!--Crear articulos-->
<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
    <h1>Crear nuevo artículo</h1>
    <p>Añada un nuevo artículo al sitio para que los usuarios lo lean.</p>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" />
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'titulo'): '';?>
        
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'descripcion'): '';?>
        
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php 
            $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
            while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?=$categoria['id']?>">
                       <?=$categoria['nombre']?>
                </option>
            <?php
            endwhile;
            endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'categoria'): '';?>
        
        <input type="submit" value="Guardar" />
    </form>
    <?php borrarErrores(); ?>
    
</div>


<?php
require_once 'includes/footer.php';
