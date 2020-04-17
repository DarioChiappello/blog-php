<?php
//ACTUALIZAR USUARIO -UPDATE USER
if(isset($_POST)){
    
    //Conexion a base de datos
    require_once 'includes/conexion.php';
    
    
    
    
    
    
    //Recoger valores del formulario de actualizacion
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : FALSE;
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : FALSE ;
    $email = isset($_POST['email']) ? trim($_POST['email']) : FALSE;
    
    
    
   
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
    
   
    
    $guardar_usuario = FALSE;
    // Validar que el array de errores este vacio. El array de errores tiene que ser igual a 0 para ser correcta la validaciion
    if(count($errores) == 0){
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = TRUE;
        
        //COMPROBAR SI EL EMAIL YA EXISTE
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email';";
        $isset_email = mysqli_query($db, $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){
  
        
        //Actualizar usuario en la base de datos en su tabla correspondiente
        $sql = "UPDATE usuarios SET ".
               "nombre = '$nombre', ".
               "apellido = '$apellido', ".
               "email = '$email' ".
               "WHERE id = ".$usuario['id'];
        $save = mysqli_query($db, $sql);
        
    
        
        if ($save){
            $_SESSION['usuario']['nombre'] = $nombre;
            $_SESSION['usuario']['apellido'] = $apellido;
            $_SESSION['usuario']['email'] = $email;
            
            $_SESSION['completado'] = 'Los datos se han actualizado con éxito';
        } else {
            $_SESSION['errores']['general'] = "Fallo al efectuar la actualización";
        }
      }else{
          $_SESSION['errores']['general'] = "El usuario ya existe";
      }
        
        
    }else{
        $_SESSION['errores'] = $errores;
        
    }
}
// redirect to 
header('Location: mis-datos.php');