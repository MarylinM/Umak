<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="bootstrap/js/jquery-1.11.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <title>Niveles Fisicoquimicos</title>
    
</head>
<body>

<div>
	<h1>Estanques</h1>	
</div>
<table  class="table table-hover">
  <tr>
    <th>Nombre</th>
    <th>Tipo</th>    
  </tr>
  
  
  <?php foreach($estanques as $row) { ?>
    <tr class="success">            
            <td><?php echo $row->nombre ?></td>
            <td><?php echo $row->tipo ?></td>
    </tr>
   <?php } ?>
  
</table>
 
</body>
</html>