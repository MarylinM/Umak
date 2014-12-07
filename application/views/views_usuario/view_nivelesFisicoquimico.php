<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Niveles Fisicoquimicos</title>

</head>

<script type="text/javascript">
    $('#tab_graficos').attr("class","");
    $('#tab_estanques').attr("class","");
    $('#tab_niveles').attr("class","active");
    
</script>

<body>
<div class="container"> 
<div>
	<h3>Niveles Fisicoquímicos</h3>	
</div>
<table  class="table">
  <tr>
    <th rowspan="2">Estanques</th>
    <th rowspan="2">Tipo</th>
    <th colspan="2">Temperatura</th>
    <th colspan="2">Oxigeno</th>    
    <th colspan="2">Ph</th>
    <th colspan="2">Amoniaco</th>
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
    <tr>            
            <td><?php echo $row->nombre_estanque ?></td>
            <td><?php echo $row->tipo_estanque ?></td>
            <td><?php echo $row->temperatura_min ?></td>
            <td><?php echo $row->temperatura_max ?></td>
            <td><?php echo $row->oxigeno_min ?></td>
            <td><?php echo $row->oxigeno_max ?></td>            
            <td><?php echo $row->ph_min ?></td>
            <td><?php echo $row->ph_max ?></td>
            <td><?php echo $row->amoniaco_min ?></td>
            <td><?php echo $row->amoniaco_max ?></td>
    </tr>
   <?php } ?>
  
</table>
</div>
</body>
</html>

