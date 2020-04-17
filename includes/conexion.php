<?php
//CONEXION A BASE DE DATOS - CONNECT SQL
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'blog_master';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");


// Iniciar la sesion
if(!isset($_SESSION)){
    session_start();
}
