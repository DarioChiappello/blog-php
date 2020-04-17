<?php
//Login

//Iniciar la sesion y la conexion db
require_once 'includes/conexion.php';

//Recoger los datos del formulario
if(isset($_POST)){
    
    //Borrar la sesion error antiguo
    if(isset($_SESSION['error_login'])){
                unset($_SESSION['error_login']);
            }
    //Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    //Consulta db para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);
    
    if($login && mysqli_num_rows($login) == 1){
        //Comprobar la contraseña 
        $usuario = mysqli_fetch_assoc($login);
        
        $verify = password_verify($password, $usuario['password']);
        
        if($verify){
            // Utilizar sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;
            
            
        }else{
            // Si algo falla crear una sesion con el fallo
            $_SESSION['error_login'] = "Login incorrecto";
        }
        
    }else{
        //Mensaje de error
        $_SESSION['error_login'] = "Login incorrecto";
    }
    
    
   
    
}



//Redirigir al index.php
header('Location: index.php');








