<?php

//SHOW ERRORS - MOSTRAR ERRORES
function mostrarError($errores, $campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
       echo $alerta = "<div class='alerta alerta-error'>".$errores[$campo]."</div>";
    }
}

// DELETE ERRORS - BORRAR ERRORES
function borrarErrores(){
   $borrado = FALSE;
    
    if(isset($_SESSION['errores']) ){
        $_SESSION['errores'] = NULL;
        $borrado = TRUE;
    }
    
    if(isset($_SESSION['errores-entrada']) ){
        $_SESSION['errores-entrada'] = NULL;
        $borrado = TRUE;
    }
     
    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = NULL;
        $borrado = TRUE;
    }
   
    return $borrado;
}

//CARGAR LAS CATEGORIAS - LOAD CATEGORIES
function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
       $resultado = $categorias; 
    }
    return $resultado;
}

//OBTENER UNA CATEGORIA - LOAD A CATEGORY
function conseguirCategoria($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
       $resultado = mysqli_fetch_assoc($categorias); 
    }
    return $resultado;
}

// CARGAR LOS ULTIMOS ARTICULOS - LOAD LAST ARTICLES
function conseguirEntradas($conexion, $limit = null, $categoria = NULL, $busqueda = NULL){
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
           "INNER JOIN categorias c ON e.categoria_id = c.id ";
           
    
   if (!empty($categoria)){
       $sql .= "WHERE e.categoria_id = $categoria ";
   }
   
   if (!empty($busqueda)){
       $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
   }
   
   $sql .= "ORDER BY e.id DESC ";
    
    if($limit){
        // $sql = $sql." LIMIT 4";
        $sql .= 'LIMIT 4';
    }
    
    $entradas = mysqli_query($conexion, $sql);
    $resultado = array();
    if($entradas && mysqli_num_rows($entradas) >=1){
        $resultado = $entradas;
    }
    return $entradas;
}

//LOAD ARTICLE - CARGAR ARTICULO
function conseguirEntrada($conexion, $id){
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellido) AS usuario FROM entradas e ".
           "INNER JOIN categorias c ON e.categoria_id = c.id ". 
           "INNER JOIN usuarios u ON e.usuario_id = u.id ".
           "WHERE e.id = $id;";
    $entrada = mysqli_query($conexion, $sql);
    $resultado = array();
    if($entrada && mysqli_num_rows($entrada) >= 1){
       $resultado = mysqli_fetch_assoc($entrada); 
    }
    return $resultado;
}

//SEARCH - BUSCAR

