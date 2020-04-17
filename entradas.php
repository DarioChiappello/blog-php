<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/sidebar.php'; ?>

<div id="principal">
    <h1>Todas las entradas</h1>

    <?php
    $entradas = conseguirEntradas($db);
    if (!empty($entradas)):
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
    endif;
    ?>



    <div id="ver-todas">
        <a href="entradas.php">Ver todos los artículos</a>
    </div>
</div>


<?php
require_once 'includes/footer.php';