
<?php require_once 'conexion.php'; ?>
<?php require_once 'helpers.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Game Blog by Darío Chiappello</title>
        <link rel="stylesheet" type="text/css" href="./assets/style.css">
    </head>
    <body>
        <!-- Header -->
        <header id="cabecera">
            <!-- Logo -->
            <div id="logo">
                <a href="index.php">
                    VideoGame Forum
                </a>
            </div>
            <!-- Menu -->
            
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">Incio</a>
                    </li>
                    <?php $categorias = conseguirCategorias($db);
                        if(!empty($categorias)):
                            while($categoria = mysqli_fetch_assoc($categorias)): ?>
                        <li>
                        <a href="categoria.php?id=<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
                        </li>
                    <?php 
                        
                        endwhile;
                        endif;
                        
                     ?>
                    <li>
                        <a href="index.php">Sobre mí</a>
                    </li>
                    <li>
                        <a href="index.php">Contacto</a>
                    </li>
                </ul>
            </nav>  
            <div class="clearfix"></div>
        </header>
        
        <!-- Content -->
        <div id="contenedor">
