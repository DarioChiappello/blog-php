<?php

if(isset($_POST)){
    
    //Conexion a base de datos
    require_once 'includes/conexion.php';
    
    //Iniciar sesion
    if(!isset($_SESSION)){
        session_start();
    }
    
    
    
    
    //Recoger valores del formulario de registro
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : FALSE ;
    $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
    $password = isset($_POST['password']) ? $_POST['password'] : FALSE;
    
    
   
    //Array de errores
    $errores = array();
    
    //Validar los datos antes de guardarlos en la base de datos
    // NOMBRE - NAME (VALIDATE)
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = TRUE;
    }else {
        $nombre_validado = FALSE;
        $errores['nombre'] = "El nombre no es valido";
    }
    
    // APELLIDO - LAST NAME (VALIDATE)
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
        $apellido_validado = TRUE;
    }else {
        $apellido_validado = FALSE;
        $errores['apellido'] = "El apellido no es valido";
    }
    
    // EMAIL (VALIDATE)
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = TRUE;
    }else {
        $email_validado = FALSE;
        $errores['email'] = "El email no es valido";
    }
    
    //PASSWORD (VALIDATE)
    if(!empty($password)){
        $password_validado = TRUE;
    }else {
        $password_validado = FALSE;
        $errores['password'] = "La contraseña no es valida";
    }
    
    $guardar_usuario = FALSE;
    // Validar que el array de errores este vacio. El array de errores tiene que ser igual a 0 para ser correcta la validaciion
    if(count($errores) == 0){
        $guardar_usuario = TRUE;
        
        //Cifrar la contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        
        
        //Insertar usuario en la base de datos en su tabla correspondiente
        $sql = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellido', '$email', '$password_segura', CURDATE());";
        $save = mysqli_query($db, $sql);
        
        /*mysqli_error($db);
        die();*/
        
        if ($save){
            $_SESSION['completado'] = 'El registro se ha completado con éxito';
        } else {
            $_SESSION['errores']['general'] = "Fallo al efectuar el registro";
        }
        
        
        
    }else{
        $_SESSION['errores'] = $errores;
        
    }
}
// redirect to index.php
header('Location: index.php');

//password_verify($password, $password_segura); verifica el hash de la contraseña

 //Si quisiera que acepte comillas en el registro en el metodo POST podría
    /*
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre'])  : FALSE;
    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db,$_POST['apellido']) : FALSE ;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : FALSE;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : FALSE;
    */

