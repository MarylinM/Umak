<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta charset="utf-8">
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="bootstrap/js/jquery-1.11.1.min.js"></script></script>
        <script src="bootstrap/js/bootstrap.min.js" ></script>   
    </head>

    <header>
        <table>
            <tr>
            <th style="max-width: 400px; width: 400px; margin: 0 auto 10px;"> <img src="imagenes/camaron.png" WIDTH=80 HEIGHT=60></th>
            <th style="max-width: 400px; margin: 0 auto 10px;">
            <h1>Bienvenido</h1>
            <h2>Centro de Administración</h2></th>         
          </tr></table>
    
        
        <div class="navbar navbar-default">             
        <div id="navo" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav">  
            <li id="tab_graficos"><a href="graficos">Graficos</a></li>           
            <li id="tab_niveles"> <a href="niveles">Niveles</a></li>
            <li id="tab_estanques"><a href="estanques">Estanques</a></li>            
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a>usuario: <?php echo $privilegio ?></a></li>
            <li><a href="logout">Cerrar sesion</a></li>
          </ul>

        
      </div>
    </div>
    </header>
</html>
