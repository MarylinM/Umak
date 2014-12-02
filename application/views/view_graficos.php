<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Graficos</title>
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/globalize.min.js"></script>
        <script src="scripts/dx.chartjs.js"></script>
	<script src="scripts/dx.webappjs.js"></script>
        <link rel="stylesheet" type="text/css" href="scripts/dx.common.css" />
        <link rel="stylesheet" type="text/css" href="scripts/dx.light.css" />
    </head>
    
<script type="text/javascript">
$(function () {
      
    $.getJSON("obtenerEstanques").success(function (data){
        for (var i = 0; i < data.length; i++) {
            selectBoxDataSourceEstanque.store().insert(data[i]);
        }
        selectBoxDataSourceEstanque.load();
        $("#selectBoxEstanque").dxSelectBox({
            dataSource: selectBoxDataSourceEstanque,
            displayExpr: 'nombre',
            placeholder: 'Seleccion un estanque..'
        });
    });
    $.getJSON("obtenerTipomedidas").success(function (data){
        for (var i = 0; i < data.length; i++) {
            selectBoxDataSourceTipomedida.store().insert(data[i]);
        }
        selectBoxDataSourceTipomedida.load();
        $("#selectBoxMedida").dxSelectBox({
            dataSource: selectBoxDataSourceTipomedida,
            displayExpr: 'nombre',
            placeholder: 'Seleccion una medida..'
        });
    });

    $("#dateboxInicial").dxDateBox({
        // Restar 5 días a la fecha actual
        value: new Date(new Date() - (30 * 24 * 3600 * 1000))
    });
    $("#dateboxFinal").dxDateBox({
        //fecha actual
        value: new Date()
    }); 
 }); 
//se crea objeto datasource para selecbtBoxEstanque
var selectBoxDataSourceEstanque = new DevExpress.data.DataSource([]);
var selectBoxDataSourceTipomedida = new DevExpress.data.DataSource([]);
var dataSource = new Array();

function generarGrafico(){
    cargarDatos();
};

function getDateHourFromString(fecha) {
    var valores = fecha.split(" ", 3);
    var DatosFecha = valores[0].split("-", 3);
    var DatosHora = valores[1].split(":", 3);
    var mm = parseInt(DatosFecha[1]) - 1;
    var dd = parseInt(DatosFecha[2]);
    var yy = parseInt(DatosFecha[0]);
    var HH = parseInt(DatosHora[0]);
    var min = parseInt(DatosHora[1]);
    var seg = parseInt(DatosHora[2]);
    return new Date(yy, mm, dd, HH, min, seg);
}

function cargarDatos(){
    $.getJSON("prueba").success(function (d){
        for (i = 0; i < d.length; i++) {
            d[i].fecha = getDateHourFromString(d[i].fecha);
            d[i].cantidad = parseFloat(d[i].cantidad);
            d[i].nivel_min = parseFloat(d[i].nivel_min);
            d[i].nivel_max = parseFloat(d[i].nivel_max);            
        }        
        dibujarGrafico(d,"Temperatura","°C");
    });
};
function dibujarGrafico(dataSource,tipo_medida,unidad){
    $("#graficoAlturaSitio2B").dxChart({
	dataSource: dataSource,
	commonSeriesSettings: {
            argumentField: 'fecha'            
        },	
	crosshair: {
		enabled: true
	},	
	series: [{
			name: tipo_medida,
			type: 'spline',
			argumentField: 'fecha',
			valueField: 'cantidad'
                        
		}, {
			name: 'Min',
                        color: 'blue',
			type: 'spline',
			argumentField: 'fecha',
			valueField: 'nivel_min',
                        point:{visible: false}
		}, {
			name: 'Max',
                        color: 'red',
			type: 'spline',
			argumentField: 'fecha',
			valueField: 'nivel_max',
                        point:{visible: false}
		}],
	tooltip: {
            enabled: true,
            shared: true,
            argumentFormat: 'monthAndDay',
            customizeTooltip: function (points) {
		return {
                    text: points.argumentText + '\n' + points.valueText
                };
            }
        },
		
	valueAxis: {
            title: tipo_medida+","+unidad,
            label: {
                customizeText: function () {
                    return this.value + " "+unidad;
                }
            },
            visible: true
        },
	pointSelectionMode: 'single'		
	});
/* RANGE SELECTOR */	
    $("#rangeSelectorContainer").dxRangeSelector({
        dataSource: dataSource,
        chart: {
            series: [{
		argumentField: 'fecha',
                valueField: 'cantidad'
            }]
        },
        scale: {
            marker: { visible: false },
            label: { format: 'monthAndDay' },
            minorTickInterval: 'day'
        },
		behavior: {
			callSelectedRangeChanged: "onMoving",
			snapToTicks: false
		},
		selectedRangeChanged: function (e) {
			var graficoAlturaSitio2B = $("#graficoAlturaSitio2B").dxChart("instance");
			graficoAlturaSitio2B.zoomArgument(e.startValue, e.endValue);
		}
    });
};


</script>
    <body>
        <?php
        // put your code here
        ?>
        <h1>Graficos</h1>
        <table>
        <tr>
          <td>Periodo Del:</td>
          <td><div id="dateboxInicial"></div></td>
          <td>Al:</td>
          <td><div id="dateboxFinal"></div></td>
        </tr>
        <tr>
          <td>Estanque</td>
          <td><div id="selectBoxEstanque"></div></td>
          <td>Tipo Medida</td>
          <td><div id="selectBoxMedida"></div></td>
        </tr>
      </table>
        
        <button type="button" onclick="generarGrafico();">Generar Grafico</button>
        
        <br>
        <br>
        
        <div id="graficoAlturaSitio2B" style="height:250px; max-width:1000px; margin: 0 auto"></div>
        <div id="rangeSelectorContainer" style="height:120px;max-width:1000px;margin:0px auto"></div>
    </body>
</html>
