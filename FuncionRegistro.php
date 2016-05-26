<?php
require_once('../Connections/Gaceta.php');
$Correo=$_POST['Correo'];
$Matricula=$_POST['Matricula'];
$Especialidad=$_POST['Especialidad'];
$Pass=$_POST['Pass'];
$Pass1=$_POST['Pass1'];
$Telefono=$_POST['Telefono'];

//funcion para alta de usuARIOEspecialiad

function Alta_Login($Matricula,$Correo,$Pass,$Pass1,$Especialidad,$Telefono){
    global $ConexGaceta;
       global $Correo;
       global $Pass;
       global $Pass1;
       global $Matricula;
       $Pass1=hash('sha256', $Pass1);
     


  $sql="insert into tb_Loggin(Matricula,Correo,Password,Passwordk,Especialidad,TelefonoM,FechaAlta) values('$Matricula','$Correo','$Pass','$Pass1','$Especialidad',$Telefono,now())";
  
  if($insertar=$ConexGaceta->query($sql)){
    
   echo '<script type="text/javascript">
alert("Registro Existoso");
window.location.assign("login.php");
</script>';

  }


  
}
    

//FUNCION PARA VERIFICAR SI EL ALUMNO EXISTE
   
 function Busca_Alum($Matricula){  

   
       global $ConexGaceta;
       global $Correo;
       global $Pass;
       global $Pass1;
	   global $Especialidad;
	   global $Telefono;
       
       $query_user="select Matricula from tb_PlantelCentro where Matricula='$Matricula'";
       
       
           
    if ($busca_user1=$ConexGaceta->query($query_user) ){
    if ($busca_user1->num_rows > 0 ){
        $busca_user1->close();
        Alta_Login($Matricula,$Correo,$Pass,$Pass1,$Especialidad,$Telefono);


    } else {
        
        
		echo '<script type="text/javascript">
alert("La Matricula '.$Matricula.' no Tiene Acceso a La Comunidad ILB");
</script>';

    }
 
} else {
    echo '<script type="text/javascript">
alert("Error: No fue posible ejecutar'. $ConexGaceta->error.'");
</script>';
    $busca_user1->close();
}



}  



  
  function Busca_log($Matricula){  

   global $Matricula;
       global $ConexGaceta;
       
       $query_user="select Matricula from tb_Loggin where Matricula='$Matricula'";
       
       
           
    if ($busca_user1=$ConexGaceta->query($query_user) ){
    if ($busca_user1->num_rows > 0 ){
 
        while($row = $busca_user1->fetch_array() ){
            echo '<script type="text/javascript">
alert("La Matricula '.$Matricula.' ya fue Registrada en La Comunidad ILB");
</script>';

        $busca_user1->close();
        }
 
        $busca_user1->close();
    } else {
       
        Busca_Alum($Matricula);

    }
 
} else {
    echo '<script type="text/javascript">
alert("Error: No fue posible ejecutar'. $ConexGaceta->error.'");
</script>';
    $busca_user1->close();
}
$ConexGaceta->close();
}
Busca_log($Matricula);
?>