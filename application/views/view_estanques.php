<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">    
    <title>Estamques</title>    
</head>

<script type="text/javascript">
    function mostrar_modal(){

        $('#myModal').modal({
                show: true 
            });
        
       $('#myModalLabel').text("Agregar Nuevo Estanque");
       document.modal.nombre_estanque.value = "";
       document.modal.action = "agregar_estanque";

    };
    $(function(){
        $(".dropdown-menu li a").click(function(){
        var selText = $(this).text();
        document.modal.tipo_estanque.value = selText;
        $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');  
        });

    }); 
    
    $('#tab_graficos').attr("class","");
    $('#tab_estanques').attr("class","active");
    $('#tab_niveles').attr("class","");
    
</script>
    <body>
    <div class="container"> 
    <div>
        <table>
        <tr>
          <th width="90%"><h3>Estanques</h3></th>
          <th align="right"><button  type="button" onclick="mostrar_modal();" class="btn btn-default">Agregar Estanque</button></th>
        </tr>
      </table>
             
    </div>
    <table  class="table table-hover">
      <tr>
        <th>Nombre</th>
        <th>Tipo</th>    
      </tr>


      <?php foreach($estanques as $row) { ?>
        <tr>            
                <td><?php echo $row->nombre ?></td>
                <td><?php echo $row->tipo ?></td>
        </tr>
       <?php } ?>

    </table>

    </div>
    </body>
</html>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
          <form action="" method="post" name="modal">
             <input type="hidden" name="tipo_estanque">
             <div align="center">
                <table style="border-spacing:20px; border-collapse: separate;">
                <tr>
                  <td width="50%">Nombre:</td>
                  <td width="50%"><input class="form-control"  type = 'text' name='nombre_estanque'></td>
                </tr>

                <tr >
                  <td width="50%">Tipo:</td>
                  <td width="50%"><div class="btn-group"> <a class="btn btn-default dropdown-toggle btn-select2" data-toggle="dropdown">Seleccione Tipo</a>
                    <ul class="dropdown-menu">
                    <li><a href="#">Crianza</a></li>
                    <li><a href="#">Engorda</a></li>
                    <li><a href="#">Otro</a></li>                
                    </ul>
                     </div></td>
                </tr>
              </table>
            </div>
            <br>  
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type='submit' class="btn btn-primary" name="guardar">Agregar</button>
            </div>
            </form>
        
      </div>
    </div>
  </div>
</div>