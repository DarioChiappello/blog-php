<!-- SEARCH - BUSCAR -->
<?php
        if(!isset($_POST['busqueda'])){
            header("Location: index.php");
        }


// Pasa el id por la url
        
        
 ?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
    
    
    <h1>Búsqueda: <?=$_POST['busqueda'] ?></h1>

    <?php
    $entradas = conseguirEntradas($db, NULL, NULL, $_POST['busqueda']);
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