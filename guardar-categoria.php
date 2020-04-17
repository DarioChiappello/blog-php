<?php
// GUARDAR LA CATEGORIA

if(isset($_POST)){
    //Conexion a base de datos
    require_once 'includes/conexion.php';
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : FALSE;
    
    //Array de errores
    $errores = array();
    
    //Validar los datos antes de guardarlos en la base de datos
    // CATEGORY - CATEGORÍA)
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = TRUE;
    }else {
        $nombre_validado = FALSE;
        $errores['nombre'] = "El nombre no es valido";
    }
    
    if(COUNT($errores) == 0){
        $sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
        $save = mysqli_query($db, $sql);
    }
    
    
}

header("Location: index.php");