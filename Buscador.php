<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editorial USCO-buscar</title>
    <style>
    body p{
        color: red;
        font-size: 30px;
    }
    </style>
</head>
<body>
        <form method="POST" action="" onSubmit="return validarForm(this)">
 
                <input type="text" placeholder="Buscar usuario" name="palabra" id="palabra">
             
                <input type="submit" value="Buscar" name="buscar" id="buscar">
             
            </form>

             <p id="parrafo"></p>
<script type="text/javascript">
    function validarForm(formulario) 
    {
        if(formulario.palabra.value.length==0) 
        { //¿Tiene 0 caracteres?
            htm=document.getElementById("parrafo");
               htm.innerHTML=("Debe llenar el campo primero");//Mostramos el mensaje
            return false; 
         } //devolvemos el foco  
         return true; //Si ha llegado hasta aquí, es que todo es correcto 
     }   
</script>


<?php
if(isset($_POST["buscar"])) 
{   
   
   // el resultado de la búsqueda lo encapsularemos en un tabla 
  echo '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
       <tr>
            <!--creamos los títulos de nuestras dos columnas de nuestra tabla -->
            <td width="100" align="center"><strong>Nombre</strong></td>
            <td width="100" align="center"><strong>Apellidos</strong></td>
       </tr> ';
    
       //obtenemos la información introducida anteriormente desde nuestro buscador PHP
       $buscar = $_POST["palabra"];
       $db_host="localhost";
        $db_nombre="usuarios";
        $db_usuario="root";
        $db_contra="";

$conexion=mysqli_connect($db_host,$db_usuario,$db_contra);
if (mysqli_connect_errno()){
echo "fallo al conectar con la base de datos";
exit();
}
       /* ahora ejecutamos nuestra sentencia SQL, lo que hemos vamos a hacer es usar el 
       comando like para comprobar si existe alguna coincidencia de la cadena insertada 
       en nuestro campo del formulario con nuestros datos almacenados en nuestra base de 
       datos, la cadena insertada en el buscador se almacenará en la variable $buscar */
 
       /* hemos usado también la sentencia or para indicarle que queremos que nos encuentre
       las coincidencias en alguno de los campos de nuestra tabla (apellidos o nombre), 
       si hubiéramos puesto un and solo nos devolvería el resultado del filtro en el 
       caso de cumplirse las dos condiciones */
        $name="";

      
       mysqli_select_db($conexion, $db_nombre) or die ("no se encuantra la BBDD");
       mysqli_set_charset($conexion, "utf8");
       $consulta="SELECT * FROM user WHERE nombre like '%$buscar%' or apellido like '%$buscar%'";
       $resultado=mysqli_query($conexion,$consulta);
       while(($fila=mysqli_fetch_row($resultado))==true) 
       {
           $name=$fila[0];
           $apellido=$fila[1];

          echo " <tr>
               <!--mostramos el nombre y apellido de las tuplas que han coincidido con la 
               cadena insertada en nuestro formulario-->
               <td class='estilo-tabla' align='center'>$name</td>
               <td class='estilo-tabla' align='center'>$apellido</td>
           </tr> ";
           
       } //fin blucle
       echo "</table>";
       if(strcmp($name,"")==true){
        echo "<p>No se encontraron resultados</p>";
    }

   
    mysqli_close($conexion);
    
} // fin if 
?>

</body>
</html>

       




