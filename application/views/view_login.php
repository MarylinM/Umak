<html>
    <head>
        <meta charset="utf-8">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="bootstrap/js/jquery-1.11.1.min.js"></script></script>
        <script src="bootstrap/js/bootstrap.min.js" ></script>           
        <title>
           Login
        </title>
    </head> 
    <body>
        <div align="center">
            <h1>Umak</h1>
            <table>                
                <td ><img src="imagenes/agua.jpg" WIDTH=340 HEIGHT=160> </td>
                <td> <img src="imagenes/camaron.png" WIDTH=60 HEIGHT=40> </td>              
            </table> 
        </div>
        <div class="well"  style="max-width: 400px; margin: 0 auto 10px;">
      
    
                <h1 align="center">Indentificación</h1>	
        
        <br>        
      <form action="validar_login" method="post">
      <div class="form-group">
        <label>Usuario</label>
        <input type="text" class="form-control" name="usuario" placeholder="Ingrese su usuario...">
      </div>
      <div class="form-group">
        <label>Clave</label>
        <input type="password" class="form-control" name="clave" placeholder="Ingrese su clave...">
      </div>
        <div align="center">
             <button type="submit" class="btn btn-default">Iniciar sesion</button>
        </div>
       <?= validation_errors('<div id="error">','</div>')?>
      </form>
        </div>
        
    </body> 
</html>


       