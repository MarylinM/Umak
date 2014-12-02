<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Niveles Fisicoquimicos</title>

</head>

<script type="text/javascript">
    function mostrar_modal(nombre,id_estanque,temperatura_min,temperatura_max,oxigeno_min,oxigeno_max,amoniaco_min,amoniaco_max,ph_min,ph_max){
        //El nodo recibido es SPAN
        //alert(nombre+preciokilo);
        $('#myModal').modal({
                show: true 
            });
        
       $('#myModalLabel').text(nombre);
       
       document.modal.id_estanque.value = id_estanque;
       document.modal.temperatura_min.value = temperatura_min;
       document.modal.temperatura_max.value = temperatura_max;
       document.modal.oxigeno_min.value = oxigeno_min;
       document.modal.oxigeno_max.value = oxigeno_max;
       document.modal.amoniaco_min.value = amoniaco_min;
       document.modal.amoniaco_max.value = amoniaco_max;
       document.modal.ph_min.value = ph_min;
       document.modal.ph_max.value = ph_max;
       

       document.modal.action = "modificar_niveles";

    };
    $(function(){

    });
    
    
</script>

<body>

<div>
	<h1>Niveles Fisicoquimicos</h1>	
</div>
<table  class="table table-hover">
  <tr>
    <th rowspan="2">Estanques</th>
    <th rowspan="2">Tipo</th>
    <th colspan="2">Oxigeno</th>
    <th colspan="2">Temperatura</th>
    <th colspan="2">Ph</th>
    <th colspan="2">Amoniaco</th>
    <th rowspan="2">Modificar</th>
  </tr>
  <tr>
    <td>Min</td>
    <td>Max</td>
    <td>Mix</td>
    <td>Max</td>
    <td>Mix</td>
    <td>Max</td>
    <td>Mix</td>
    <td>Max</td>
  </tr>
  
  <?php foreach($niveles as $row) { ?>
    <tr class="success">            
            <td><?php echo $row->nombre_estanque ?></td>
            <td><?php echo $row->tipo_estanque ?></td>
            <td><?php echo $row->oxigeno_min ?></td>
            <td><?php echo $row->oxigeno_max ?></td>
            <td><?php echo $row->temperatura_min ?></td>
            <td><?php echo $row->temperatura_max ?></td>
            <td><?php echo $row->ph_min ?></td>
            <td><?php echo $row->ph_max ?></td>
            <td><?php echo $row->amoniaco_min ?></td>
            <td><?php echo $row->amoniaco_max ?></td>
            <td><span type="button" onclick="mostrar_modal('<?php echo $row->nombre_estanque ?>','<?php echo $row->id_estanque ?>',' <?php echo $row->temperatura_min ?>','<?php echo $row->temperatura_max ?>','<?php echo $row->oxigeno_min ?>',' <?php echo $row->oxigeno_max ?>','<?php echo $row->amoniaco_min ?>',' <?php echo $row->amoniaco_max ?>',' <?php echo $row->ph_min ?>',' <?php echo $row->ph_max ?>');" class="btn btn-default">Modificar</span></td>

    </tr>
   <?php } ?>
  
</table>
 
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
        <div class="modal-body" name='precio_fruta'>
            
            
            <form action="" method="post" name="modal">
            <input type="hidden" name="id_estanque">
           <table class="table">
            <tr>
              <td></td>
              <td>Minimo</td>
              <td>Maximo</td>
            </tr>
            <tr>
              <td>Temperatura</td>
              <td><input type = 'text' name='temperatura_min'></td>
              <td><input type = 'text' name='temperatura_max'></td>
            </tr>
            <tr>
              <td>Oxigeno</td>
              <td><input type = 'text' name='oxigeno_min'></td>
              <td><input type = 'text' name='oxigeno_max'></td>
            </tr>
            <tr>
              <td>Ph</td>
              <td><input type = 'text' name='ph_min'></td>
              <td><input type = 'text' name='ph_max'></td>
            </tr>
            <tr>
              <td>Amoniaco</td>
              <td><input type = 'text' name='amoniaco_min'></td>
              <td><input type = 'text' name='amoniaco_max'></td>
            </tr>
          </table>

            <br>  
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type='submit' class="btn btn-primary" name="guardar">Guardar Cambios</button>
            </div>
            </form>
            
        </div>
      </div>
      
        
    </div>
  </div>
</div>