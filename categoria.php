<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php
        // Pasa el id por la url
        $categoria_actual = conseguirCategoria($db, $_GET['id']);
        if(!isset($categoria_actual['id'])){
            header("Location: index.php");
        }
 ?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
    
    
    <h1>Artículos de <?=$categoria_actual['nombre'] ?></h1>

    <?php
    $entradas = conseguirEntradas($db, null, $_GET['id']);
    if (!empty($entradas) && mysqli_num_rows($entradas) >= 1):
        while ($entrada = mysqli_fetch_assoc($entradas)):
            ?>    
            <article class="entrada">
                <a href="entrada.php?id=<?=$entrada['id']?>">
                    <h2><?= $entrada['titulo'] ?></h2>
                    <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
                    <p>
                        <?= substr($entrada['descripcion'], 0, 180) . "..." ?>
                    </p>
                </a>
            </article>
            <?php
        endwhile;
    else: 
    ?>

    <div class="alerta">No hay entradas en esta categoría</div>
    
    <?php endif; ?>

    <div id="ver-todas">
        <a href="entradas.php">Ver todos los artículos</a>
    </div>
</div>


<?php
require_once 'includes/footer.php';

