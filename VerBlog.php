<?php require_once('Connections/Gaceta.php');?>
<?php @session_start();?>
<?php
if($_SESSION['Correo'] == null){
header ("Location: index.php");
}
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
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	$tipo_prod = $_POST["urlImagenArticulo"];
//Guardar imagen
	if(is_uploaded_file($_FILES['urlImagenArticulo']['tmp_name'])) { // verifica haya sido cargado el archivo
		$ruta= "ImagenesPublicaciones/".$_FILES['urlImagenArticulo']['name'];
		move_uploaded_file($_FILES['urlImagenArticulo']['tmp_name'], $ruta);
	}
	$insertSQL = sprintf("INSERT INTO tb_Articulos (idUsuario, urlImagenArticulo, Descricion, InfoEntrega,FechaPublicacion) VALUES (%s, %s, %s, %s,now())",
                       GetSQLValueString($_POST['idUsuario'], "int"),
                       GetSQLValueString($ruta, "text"),
                       GetSQLValueString($_POST['Descricion'], "text"),
                       GetSQLValueString($_POST['InfoEntrega'], "text"));
					   echo $insertSQL;
mysql_select_db($database_Gaceta, $Gaceta);
$Result1 = mysql_query($insertSQL, $Gaceta) or die(mysql_error());
}
$colname_juego_usuario = "-1";
if (isset($_SESSION['Correo'])) {
  $colname_juego_usuario = $_SESSION['Correo'];
}
mysql_select_db($database_Gaceta, $Gaceta);
$query_juego_usuario = sprintf("SELECT * FROM tb_Loggin WHERE Correo = %s", GetSQLValueString($colname_juego_usuario, "text"));
$juego_usuario = mysql_query($query_juego_usuario, $Gaceta) or die(mysql_error());
$row_juego_usuario = mysql_fetch_assoc($juego_usuario);
$totalRows_juego_usuario = mysql_num_rows($juego_usuario);
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
                            <img src="../ILB Time´s/assets/Logo/logoGaceta.png" class="img-thumbnail" />

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
                    
                    
                     <li>
                        <a href="Registro.php"></i>Registro</a>
                    </li>
                    <li>
                        <a href="login.php"></i>Login Page</a>
                    </li>
                </ul>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">REGISTRO DE VENDEDORES</h1>
                        <h1 class="page-subhead-line">Money, Money, Money</h1>

                    </div>
</div>
                <!-- /. ROW  -->
                <div class="col-md-12">
                  <div class="alert alert-success">
                  <div><button class="btn-info" onClick="ventas()">Genera Anuncio</button></div>
<div id="pop_ventas" style="display:none">
  <form method="post" name="form1" action="<?php echo $editFormAction; ?>" enctype="multipart/form-data">
    <table align="center">
      <tr valign="baseline">
        <td nowrap align="right">UrlImagenArticulo:</td>
        <td><input type="file" name="urlImagenArticulo" value="" size="32"></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="top">Descricion:</td>
        <td><textarea name="Descricion" cols="50" rows="5"></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right" valign="top">InfoEntrega:</td>
        <td><textarea name="InfoEntrega" cols="50" rows="5"></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap align="right">&nbsp;</td>
        <td><input type="submit" value="Insertar registro"></td>
      </tr>
    </table>
    <input type="hidden" name="idUsuario" value="<?php echo $row_juego_usuario['idUsuario']; ?>">
    <input type="hidden" name="MM_insert" value="form1">
  </form>
  <p>&nbsp;</p>
<p>&nbsp;</p>
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
mysql_free_result($juego_usuario);
?>
