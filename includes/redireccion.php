<?php

if(!isset($_SESSION)){
    session_start();
}

//INCIAR SESION
if(!isset($_SESSION['usuario'])){
    header('Location: index.php');
}
