<?php require_once 'includes/redireccion.php';?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
        // Pasa el id por la url
        $entrada_actual = conseguirEntrada($db, $_GET['id']);
        if(!isset($entrada_actual['id'])){
            header("Location: index.php");
        }
 ?>

<div id="principal">
    <h1>Editar artículo</h1>
    <p>Modifique el contenido del artículo <?=$entrada_actual['titulo']?> que desee.</p>
    <br>
    <form action="guardar-entrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>" />
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'titulo'): '';?>
        
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" ><?=$entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores-entrada']) ? mostrarError($_SESSION['errores-entrada'], 'descripcion'): '';?>
        
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php 
            $categorias = conseguirCategorias($db);
            if(!empty($categorias)):
            while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
            <option value="<?=$categoria['id']?>" <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
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

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>








<?php
require_once 'includes/footer.php';?>