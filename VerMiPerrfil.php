<?php require_once('Connections/Gaceta.php');?>
<?php
@session_start();
if($_SESSION['Correo'] == null){
echo '<script type="text/javascript">
alert("Usted No Esta Loggeado");
window.location.assign("index.php");
</script>';
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_user_array = "-1";
if (isset($_SESSION['Correo'])) {
  $colname_user_array = $_SESSION['Correo'];
}
mysql_select_db($database_Gaceta, $Gaceta);
$query_user_array = sprintf("SELECT * FROM v_Perfil WHERE Correo = %s", GetSQLValueString($colname_user_array, "text"));
$user_array = mysql_query($query_user_array, $Gaceta) or die(mysql_error());
$row_user_array = mysql_fetch_assoc($user_array);
$totalRows_user_array = mysql_num_rows($user_array);
$_SESSION['idUsuario']=$row_user_array['idUsuario'];

$colname_publicaciones_hechas = "-1";
if (isset($_SESSION['idUsuario'])) {
  $colname_publicaciones_hechas = $_SESSION['idUsuario'];
}
mysql_select_db($database_Gaceta, $Gaceta);
$query_publicaciones_hechas = sprintf("SELECT * FROM tb_Blog WHERE idUsuario = %s ORDER BY FechaPublicacion DESC", GetSQLValueString($colname_publicaciones_hechas, "int"));
$publicaciones_hechas = mysql_query($query_publicaciones_hechas, $Gaceta) or die(mysql_error());
$row_publicaciones_hechas = mysql_fetch_assoc($publicaciones_hechas);
$totalRows_publicaciones_hechas = mysql_num_rows($publicaciones_hechas);




 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="ANSII" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="shortcut icon" type="image/x-icon" href="images/icono-gaceta.ico">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

    
    <title>ILB Times</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES -->
    <link href="assets/css/prettyPhoto.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
    <style>

	  .button

	  {

	  border: 1px solid #DBE1EB;

	  font-size: 18px;

	  font-family: Arial, Verdana;

	  padding-left: 7px;

	  padding-right: 7px;

	  padding-top: 5px;

	  padding-bottom: 5px;

	  border-radius: 4px;

	  -moz-border-radius: 4px;

	  -webkit-border-radius: 4px;

	  -o-border-radius: 4px;

	  background: #4972B5;

	  background: linear-gradient(left, #4972B5, #74101E);

	  background: -moz-linear-gradient(left, #4972B5, #74101E);

	  background: -webkit-linear-gradient(left, #4972B5, #74101E);

	  background: -o-linear-gradient(left, #4972B5, #74101E);

	  color: #FFFFFF;

	  }

	   

	  .button:hover

	  {

	  background: #FF2323;

	  background: linear-gradient(left, #FF2323, #74101E);

	  background: -moz-linear-gradient(left, #FF2323, #74101E);

	  background: -webkit-linear-gradient(left, #FF2323, #74101E);

	  background: -o-linear-gradient(left, #FF2323, #74101E);

	  color: #FFFFFF;

	  border-color: #FBFFAD;

	  }

	 </style>
    
    
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Comercio Electrónico</a>
            </div>

            <div class="header-right">

              
                <a href="../Splash Screen/index.php" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>


            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <a href="VerMiPerrfil.php"><img src="<?php echo $row_user_array['UrlImagen']; ?>" class="img-thumbnail" alt="Inicia Session" style="width:80px!mportant;height:80px!important;" /></a>

                            <div class="inner-text">ILB Times</div>
                        </div>

                    </li>


                    <li>
                        <a href="Inicio.php"></i>Inicio</a>
                    </li>
                    <li>
                        <a href="#"></i>Academias<span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="Administración-de-Empresas.php"></i>Administración de Empresas</a>
                            </li>
                            <li>
                                <a href="Administración-Industrial.php"></i>Administración Industrial</a>
                            </li>
                             <li>
                                <a href="Contador-Público.php"></i>Contador Público</a>
                            </li>
                             <li>
                                <a href="Ciencias-de-la-Informática.php"></i>Ciencias de la Informática</a>
                            </li>
                             <li>
                                <a href="Derecho.php"></i>Derecho</a>
                            </li>
                            
                                <li>
                                <a href="Economía.php"></i>Economía</a>
                            </li>
                            <li>
                                <a href="Humanidades.php"></i>Humanidades</a>
                            </li>
                            <li>
                                <a href="Idiomas.php"></i>Idiomas</a>
                            </li>
                            <li>
                                <a href="Matemáticas.php"></i>Matemáticas</a>
                            </li>
                            
                           <li>
                                <a href="Negocios-Internacionales.php"></i>Negocios internacionales</a>
                           </li>
                             <li>
                                <a href="Turismo.php"></i>Turismo</a>
                            </li>
                             
                            
                           
                        </ul>
                    </li>
                     <li>
                        <a href="#"></i>Eventos <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="Eventos.php"></i>Calendario</a>
                            </li>
                                                 
                        
                        </ul>
                    </li>
                    <li>
                        <a href="Noticias.php"></i>Noticias </a>
                        
                    </li>
                    <li>
                        <a href="#"></i>Acerca de Nosotros <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                           
                             <li>
                                <a href="Quienes-Somos.php"></i>¿Quiénes Somos? </a>
                            </li>
                             <li>
                                <a href="Contactanos.php"></i>Contactanos</a>
                            </li>
                             
                           
                        </ul>
                    </li>
                    
                    <li>
                        <a href="Blog.php"></i>Blog</a>
                        
                    </li>
                    
                     <li>
                        <a href="Articulos.php"></i>Articulos</a>
                    </li>
                    
                    <li>
                        <a href="Galeria.php"></i>Galería</a>
                    </li>
                    
                  <li>
                        <a class="active-menu" href="Comercio-Electronico.php"></i>Comercio Electrónico</a>
                  </li>
                    
                    <li>
                        <a href="Hall-of-Fame.php"></i>Salón de la Fama</a>
                    </li>
                    
                    <li>
                        <a href="Salón-de-la-Infamia.php"></i>Salón de la Infamia</a>
                    </li>
                    
                    
                   
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line"><?php echo $row_user_array['Nombre']; ?></h1>
                        <h1 class="page-subhead-line"><?php echo $row_user_array['Saludo']; ?></h1>

                    </div>
</div>
                <!-- /. ROW  -->
                <div class="col-md-12">
                  <div class="alert alert-success">
<div align="left" style="width:100%!important;display:inline-block">
<img src="<?php echo $row_user_array['UrlImagen']; ?>" class="img-thumbnail" alt="Inicia Session" style="width:150px!mportant;height:150px!important;" />
<div>
<table>
<tr>
<td>
<h3 align="left" style="text-align:left!important;width:50%">Especialidad</h3></td><td><h3 align="right" style="text-align:right!important;margin-left:50px!important;" class="label-info"><?php echo $row_user_array['Especialidad']; ?></h3></td><td></td><td><h3 style="text-align:left!important;margin-left:50px!important;" >Matricula</h3></td><td><h3 style="text-align:right!important;margin-left:50px!important;" class="label-info"><?php echo $row_user_array['Matricula']; ?></h3></td>
<tr>

<tr>
<td>
<h3 align="left" style="text-align:left!important;width:50%">Correo</h3></td><td><h3 align="right" style="text-align:right!important;margin-left:50px!important;" class="label-info"><?php echo $row_user_array['Correo']; ?></h3></td><td></td><td><h3 style="text-align:left!important;margin-left:50px!important;" >Sexo</h3></td><td><h3 style="text-align:right!important;margin-left:50px!important;" class="label-info"><?php echo $row_user_array['Sexo']; ?></h3></td>
<tr>
</table>
     </div>            

</div>
<div >
<h3 align="left" style="width:40%">Intereses</h3><p align="right" style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_user_array['Intereses']; ?></p>
</div>

<div>
<h3 align="left" style="width:40%">Direccion</h3><p align="right" style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_user_array['Direccion']; ?></p>
</div>
<div>
<h3 align="left" style="width:40%">Publicaciones Hechas</h3>
<p align="right" style="border-top: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;">
<?php
if($totalRows_publicaciones_hechas>0){
	$inicio_tabla='<table class="table-hover" border="5px"><tr><td>Nombre del Blog</td><td>Area de la Publicacion</td><td>fecha publicacion</td><td>ir</td></tr>';
   for($x=1;$x<=$totalRows_publicaciones_hechas;$x++){
	 $fila_tabla='<tr><td>'.$row_publicaciones_hechas['TituloBlog'].'</td><td>'.$row_publicaciones_hechas['Especialidad'].'</td><td>'.$row_publicaciones_hechas['FechaPublicacion'].'</td><td><a href="'.$row_publicaciones_hechas['idBlog'].' class="btn-success" ">Entrar</a></td></tr>';   
   }
   echo $inicio_tabla.$fila_tabla.'</table>';
}else{
	echo '<label class="alert-info">Este Usuario No Tiene Publicaciones</label>';
	}

 ?>
 </p>
</div>

</div>                    
                                
                    
                    
</div>
                    
                    
                            <hr />
                            <ul class="pagination">
<li><a href="#">&laquo;</a></li>
  
  <li><a href="#">&raquo;</a></li>
                    
                    </div>
               

            </div>
            
            <h3>Paginas</h3>
                            <hr />
                            <ul class="pagination">
            
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <div id="footer-sec">
        © 2015 Instituto Leonardo Bravo| Design By : Gero, Gil & Infante</div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
     <!-- PAGE LEVEL SCRIPTS -->
    <script src="assets/js/jquery.prettyPhoto.js"></script>
    <script src="assets/js/jquery.mixitup.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
     <!-- CUSTOM Gallery Call SCRIPTS -->
    <script src="assets/js/galleryCustom.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

    <script type="text/javascript">
	function ventas() {
      $( "#pop_ventas" ).dialog({
        
          modal: true,
    
          buttons: {
                "Enviar": function() {
               
                    $( this ).dialog( "close" );

                    
                },
                "Cerrar": function() {
                    $( this ).dialog( "close" );
                }
            }
      });
    } 

	</script>
</body>
</html>
<?php
mysql_free_result($user_array);

mysql_free_result($publicaciones_hechas);

mysql_free_result($juego_usuario);
?>
