<?php
require_once "../models/usuario.php";
session_start();
//variable para guardar el objeto usuario
$usuario= null;
if(isset($_SESSION['perfil']))
{
    $usuario=unserialize($_SESSION['perfil']);
}
//variable para indicar que el email está vacío 
$emailEmpty = null;
if ($_REQUEST['emailEmpty'] ?? false) {
    $emailEmpty = "<p class='error'>El email no puede estar vacío</p>";
}

//variable para indicar que el email tiene formato incorrecto
$emailFormat = null;
if ($_REQUEST['emailFormat'] ?? false) {
    $emailFormat = "<p class='error'>El formato del email no es válido</p>";
}

//variable para indicar que el valor no puede estar vacío
$valorEmpty=null;
if($_REQUEST['valorEmpty'] ?? false){
    $valorEmpty="<p class='error'> el valor no puede estar vacío</p>";
}
//variable para indicar que el email está repetido
$emailRepeated = null;
if ($_REQUEST['emailRepeated'] ?? false) {
    $emailRepeated = "<p class='error'>El email ya existe</p>";
}

//variables para indicar que la contraseña está vacia
$passwordEmpty=null;
if($_REQUEST['passwordEmpty'] ?? false){
    $passwordEmpty="<p class='error'>La contraseña no puede estar vacía</p>";
}

$password2Empty=null;
if($_REQUEST['passwordEmpty2'] ?? false){
    $passwordEmpty2="<p class='error'>La contraseña no puede estar vacía</p>";
}

//variable para indicar que la contraseña no tiene el formato correcto
$passwordFormat=null;
if($_REQUEST['passwordFormat'] ?? false){
    $passwordFormat="<p class='error'>La contraseña debe ser mayor a 7 carácteres, tener al menos un numero y una mayúscula</p>";
}

//variable para indicar que las contraseñas no coinciden
$passwordNotRepeated=null;
if($_REQUEST['passwordNotRepeated'] ?? false){
    $passwordNotRepeated="<p class='error'>Las contraseñas no coinciden</p>";
}

//variable para indicar que la contraseña es incorrecta
$passwordIncorrect=null;
if($_REQUEST['passwordIncorrect'] ?? false){
    $passwordIncorrect="<p class='error'>Contraseña incorrecta</p>";
}

//variable para indicar que el nombre está vacío
$nombreEmpty = null;
if ($_REQUEST['nombreEmpty'] ?? false) {
    $nombreEmpty = "<p class='error'>El nombre no puede estar vacío</p>";
}

//variable para indicar que el apellido está vacío
$apellidoEmpty = null;
if ($_REQUEST['apellidoEmpty'] ?? false) {
    $apellidoEmpty = "<p class='error'>El apellido no puede estar vacío</p>";
}

//variable para indicar que el nickname está vacío
$nicknameEmpty = null;
if ($_REQUEST['nicknameEmpty'] ?? false) {
    $nicknameEmpty = "<p class='error'>El nickname no puede estar vacío</p>";
}

//variable para indicar que el nickname está repetido
$nicknameRepeated = null;
if ($_REQUEST['nicknameRepeated'] ?? false) {
    $nicknameRepeated = "<p class='error'>El nickname ya está en uso o no es válido</p>";
}

//variable para indicar que el loggeo ha sido incorrecto
$errorLog = null;
if ($_REQUEST['errorLog'] ?? false) {
    $errorLog = "<p class='error'>Error iniciando sesión, contraseña o email erróneos</p>";
}

//variable para indicar que el actualizado de usuario ha fallado
$errorUpdate=null;
if($_REQUEST['errorUpdate'] ?? false){
    $errorUpdate="<p class='error'>Error actualizando perfil</p>";
}

//variable para indicar que el actualizado de contraseña ha fallado
$errorPassword=null;
if($_REQUEST['errorPassword'] ?? false){
    $errorPassword="<p class='error'>Error actualizando contraseña</p>";
}

//variable para indicar que la contraseña se ha cambiado correctamente
$passwordChanged=null;
if($_REQUEST['passwordChanged'] ?? false)
{
    $passwordChanged="<p class='confirm'>La contraseña se ha cambiado correctamente</p>";
}
//variable para indicar que el usuario ya esta iniciado   
$errorLogged = null;
if ($_REQUEST['errorLogged'] ?? false) {
    $errorLogged = "<p class='error'>Usuario ya iniciado</p>";
}

//variable para indicar que el valor debe ser numérico si se busca por karma
$valorInt = null;
if ($_REQUEST['valorInt'] ?? false) {
    $valorInt = "<p class='error'>El valor debe ser numérico si se busca por karma</p>";
}
//variable para indicar que el usuario debe iniciar sesión primero
$notLogged=null;
if($_REQUEST['notLogged'] ?? false){
    $notLogged="<p class='error'>Debes iniciar sesión primero!</p>";
}
//variable para indicar que el id del evento está vacio
$idEventoEmpty=null;
if($_REQUEST['idEventoEmpty'] ?? false){
    $idEventoEmpty="<p class='error'>El id está vacío o no existe</p>";
}
?>
