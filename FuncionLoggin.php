<?php
function Inicia_session(){
require_once('../Connections/Gaceta.php');
$Correo=$_POST['Correo'];
$Pass=$_POST['Password'];
$Pass1=hash('sha256', $Pass);
$queryinicio="select Correo, Passwordk, Estatus from tb_Loggin where Correo='$Correo' and Passwordk='$Pass1'";
if($inicio=$ConexGaceta->query($queryinicio)){
if($inicio->num_rows>0){
@session_start();
$rowdatos=$inicio->fetch_assoc();
$_SESSION['Correo']=$rowdatos['Correo'];
$_SESSION['Estatus']=$rowdatos['Estatus'];
$estatus=$rowdatos['Estatus'];
if($estatus==0){
//enviar a formualrios de informacion
echo '<script type="text/javascript">
alert("Loggeado Correctamente");
window.location.assign("../form_informacion.php");
</script>';
}else if ($estatus==1){
//enviar a inicio
echo '<script type="text/javascript">
alert("Loggeado Correctamente");
window.location.assign("../inicio.php");
</script>';
}

}else{

	echo '<script type="text/javascript">
alert("Correo y/o Contraseña Invalidos");
</script>';

}
}
}


   Inicia_session();

?>