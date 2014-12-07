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
            placeholder: 'Elija un estanque..'
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
            placeholder: 'Elija una medida..'
        });
    });

    $("#dateboxInicial").dxDateBox({
        // Restar 5 días a la fecha actual (xx * 24 * 3600 * 1000))
        value: new Date(new Date() - (7 * 24 * 3600 * 1000))
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
    
    var fecha_inicio = $("#dateboxInicial").dxDateBox("instance").option().value.yyyymmddss();
    var fecha_fin = $("#dateboxFinal").dxDateBox("instance").option().value.yyyymmddss();
    var id_tipomedida = $("#selectBoxMedida").dxSelectBox("instance").option().value.idtipomedida;
    var id_estanque = $("#selectBoxEstanque").dxSelectBox("instance").option().value.idestanque;
    var unidad = $("#selectBoxMedida").dxSelectBox("instance").option().value.unidad;
    var nombre_tipomedida = $("#selectBoxMedida").dxSelectBox("instance").option().value.nombre;
   
    $.getJSON("lectura",{id_estanque:id_estanque , id_tipomedida:id_tipomedida , fecha_inicio:fecha_inicio , fecha_fin:fecha_fin}).success(function (d){
        for (i = 0; i < d.length; i++) {
            d[i].fecha = getDateHourFromString(d[i].fecha);
            d[i].cantidad = parseFloat(d[i].cantidad);
            d[i].nivel_min = parseFloat(d[i].nivel_min);
            d[i].nivel_max = parseFloat(d[i].nivel_max);            
        }        
        dibujarGrafico(d,nombre_tipomedida,unidad);
    });
};


function dibujarGrafico(dataSource,tipo_medida,unidad){
   
    $("#graficoMonitoreo").dxChart({
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
			var graficoAlturaSitio2B = $("#graficoMonitoreo").dxChart("instance");
			graficoAlturaSitio2B.zoomArgument(e.startValue, e.endValue);
                        //graficoMonitoreo.render({ force: true });
		}
    });
};
Date.prototype.yyyymmddss = function () {
    var yyyy = this.getFullYear().toString();
    var mm = (this.getMonth() + 1).toString(); // getMonth() is zero-based
    var dd = this.getDate().toString();
    var HH = this.getHours().toString();
    var min = this.getMinutes().toString();
    var seg = this.getSeconds().toString();
    return yyyy + '-' + (mm[1] ? mm : "0" + mm[0]) + '-' + (dd[1] ? dd : "0" + dd[0]); // padding
};

    $('#tab_graficos').attr("class","active");
    $('#tab_estanques').attr("class","");
    $('#tab_niveles').attr("class","");


</script>
    <body>
        <div class="container"> 
        <h3>Gráficos de Monitoreo</h3>
        <table>
        <tr>
          <td width="8%">Periodo Del: </td>
          <td width="10%"><div id="dateboxInicial"></div></td>
          <td width="2%"></td>
          <td width="3%">Al: </td>
          <td width="10%"><div id="dateboxFinal"></div></td>       
          <td width="2%"></td>
          <td width="7%">Estanque: </td>          
          <td width="17%"><div id="selectBoxEstanque"></div></td>
          <td width="2%"></td>
          <td width="8%">Tipo Medida: </td>
          <td width="17%"><div id="selectBoxMedida"></div></td>
          <td width="2%"></td>
          <td><button class="btn btn-default" type="button" onclick="generarGrafico();">Generar Gráfico</button></td>
        </tr>
      </table>
        
        <br>
        <br>
        <div class="well">
        <div id="graficoMonitoreo" style="height:250px; max-width:1000px; margin: 0 auto"></div>
        <div id="rangeSelectorContainer" style="height:120px;max-width:1000px;margin:0px auto"></div>
        </div>
        </div>
    </body>
</html>
