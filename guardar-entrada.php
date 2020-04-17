<?php
// GUARDAR ARTICULO

if(isset($_POST)){
    //Conexion a base de datos
    require_once 'includes/conexion.php';
    
    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : FALSE;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : FALSE;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : FALSE;
    $usuario = $_SESSION['usuario']['id'];
    
    //Validacion
    //Array de errores
    $errores = array();
    
    //Validar los datos antes de guardarlos en la base de datos
    // ARTICLE - ARTICULO)
    if(empty($titulo)){
        $errores['titulo'] = 'El título no es valido';
    }
       
    if(empty($descripcion)){
        $errores['descripcion'] = 'La descripción no es valida';
    }
        
    if(empty($categoria) && !is_numeric($categoria)){
        $errores['categoria'] = 'La categoría no es valida';
    }
    
    if(COUNT($errores) == 0){
        
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];
            $sql = "UPDATE entradas SET titulo = '$titulo', descripcion = '$descripcion', categoria_id = $categoria".
                   " WHERE id = $entrada_id AND usuario_id = $usuario_id;";
        }else{
            $sql = "INSERT INTO entradas VALUES(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        }
        
        
        $save = mysqli_query($db, $sql);
        
        header("Location: index.php");
    }else{
        $_SESSION['errores-entrada'] = $errores;
        
        if(isset($_GET['editar'])){
            header("Location: editar-entrada.php?id=".$_GET['editar']);
        }else{
            header("Location: crear-entradas.php");
        }
        
    }
    
    
}

