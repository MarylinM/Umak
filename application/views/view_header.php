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
                <td width="40%"> <img src="imagenes/camaron.png" WIDTH=150 HEIGHT=70></td>
                <td>
                <h1>Bienvenido</h1>
                <h2>Centro de Monitoreo</h2>
                </td>         
           </tr>
        </table>
    
        
        <div class="navbar navbar-default">             
        <div id="navo" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav">  
            <li id="tab_graficos"><a href="graficos">Gráficos</a></li>           
            <li id="tab_niveles"> <a href="niveles">Niveles</a></li>
            <li id="tab_estanques"><a href="estanques">Estanques</a></li>            
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $privilegio ?></a></li>
            <li><a href="logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesion</a></li>
          </ul>        
      </div>
    </div>
    </header>
</html>
