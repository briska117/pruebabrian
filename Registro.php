<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ILB Times</title>
    	<script src="js/Validaciones.js" type="text/javascript"></script>
    <script src="js/FuncionesAjax.js" type="text/javascript"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>  

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="assets/img/Titulo.png" />
            </div>
        </div>
         <div class="row ">
               
           <div class="form-group-lg" >
                           
                            <div class="panel-body" style="margin-top:5ss0px!important;" >
           
                            
                   
             <form  name="registro_form" action="regis.php" class="form-group"  >
               <table align="center">
                 <tr valign="baseline">
                   <td nowrap align="right">Matricula:</td>
                   <td><input type="text" name="matricula" value="" id="matricula" size="32" class="form-control"></td>
                 </tr>
                 <tr valign="baseline">
                   <td nowrap align="right">Correo:</td>
                   <td><input type="text" name="correo" value="" size="32" id="correo" class="form-control"></td>
                 </tr>
                 <tr valign="baseline">
                   <td nowrap align="right">Especialidad:</td>
                   <td><select name="especialidad" class="form-control" id="especialidad">
                     <option value="INFORMATICA" >INFORMATICA</option>
                     <option value="CONTABILIDAD" >CONTABILIDAD</option>
                     <option value="NEGOCIOS INTERNACIONALES" >NEGOCIOS INTERNACIONALES</option>
                     <option value="TURISMO">TURISMO</option>
                     <option value="ADMINISTRACION" >ADMINISTRACION</option>
                     <option value="DERECHO" >DERECHO</option>
                   </select></td>
                 </tr>
                 <tr valign="baseline">
                   <td nowrap align="right">Password:</td>
                   <td><input type="password" name="pass" value="" class="form-control"  id="pass" size="32"></td>
                 </tr>
                 <tr valign="baseline">
                   <td nowrap align="right">Confirma Password:</td>
                   <td><input type="password" name="pass1" value="" size="32" id="pass1" class="form-control"></td>
                 </tr>
                 <tr valign="baseline">
                   <td nowrap align="right">Telefono:</td>
                   <td><input name="telefono" type="text" class="form-control" id="telefono" value="" size="32" onkeypress="return numero(event)"></td>
                 </tr>
                 <tr valign="baseline">
                   <td nowrap align="right">&nbsp;</td>
                   <td></td>
                 </tr>
               </table>
             </form>
              <input type="button" value="Registrar" class="btn btn-primary " onclick="validar()" style="margin-left:500px!important;">
              </div>
             <p>&nbsp;</p>
           </div>
                           
      </div>
                
                
</div>
    </div>
    <div id="resultado"></div>

</body>
<script type="text/javascript" src="js/Validaciones.js"  ></script>
</html>
���