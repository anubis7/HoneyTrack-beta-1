// JavaScript Document


function callAjax(params){	
	$.ajax({
		url:"AjaxController.php",			
		data:params,
		type : 'POST',
		success: function(data){			
			$("#div_datos").html(data); 
			$( "#divResult" ).dialog("open");
			 
		}
		});
	return false;
}
	
function downloadAttack(){
	document.getElementById("formulario").action="downloadattack.php";
	document.getElementById("formulario").submit();
}
var map;
function callAjaxLocAttacks(params){
	$.ajax({
		url:"AjaxController.php",			
		data:params,
		type : 'POST',
		async: false,
		success: function(data){			
			var datos=$.parseJSON(data);	
			for(var i=0;i<datos.length;i++){
				 var marker = new google.maps.Marker({
	                    position: new google.maps.LatLng(datos[i][0], datos[i][1]),
	                    map: map,
	                    title: datos[i][3]+" | "+datos[i][2],
	                });	
				 var infowindow = new google.maps.InfoWindow({
			            content: datos[i][3]+" | "+datos[i][2]
			        });
				 google.maps.event.addListener(marker, 'click', function() {
			          infowindow.open(map,marker);
			        });  
			}	
			$("#divResultMap").show();			
			$( "#divResultMap" ).dialog("open");
			
		}
		});
	return false;
	
	
}

function init_dialog(div){
    $( "#"+div).dialog({
        autoOpen: false,
        width : 800,
        height : 800,        
      });
}

function initialize() 
{     
    var latlng = new google.maps.LatLng(13.48,9);
    var myOptions = {
      zoom: 3,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
   map = new google.maps.Map(document.getElementById("map_canvas"),  myOptions);
}

function callAjaxStatistics(params){
	  $.ajax({
	   url:"AjaxController.php",   
	   data:params,
	   type : 'POST',
	   async: false,
	   success: function(data){  
	    var datos=$.parseJSON(data);   
	    if(undefined!=datos[0]){
	    $('#resultKippo1').highcharts({
	        chart: {
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false,
	            type: 'pie'
	        },
	        title: {
	            text: 'Usarios y Passwords'
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
	                    style: {
	                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                    }
	                }
	            }
	        },
	       series :datos[0]
	    });
	    }
	    if(undefined!=datos[1]){
	    var arrayResult={
	    'data' : datos[1]['data'],
	    'name':datos[1]['name'],
	    'dataLabels':{
	             enabled: true,
	             rotation: -90,
	             color: '#FFFFFF',
	             align: 'right',
	             format: '{point.y:.1f}', // one decimal
	             y: 10, // 10 pixels down from the top
	             style: {
	                 fontSize: '13px',
	                 fontFamily: 'Verdana, sans-serif'
	             },
	         }}
	    
	    $('#resultKippo2').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Ataque por paises'
	        },
	        xAxis: {
	            type: 'category',
	            labels: {
	                rotation: -45,
	                style: {
	                    fontSize: '13px',
	                    fontFamily: 'Verdana, sans-serif'
	                }
	            }
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Ataques'
	            }
	        },
	        legend: {
	            enabled: false
	        },
	        tooltip: {
	            pointFormat: '<b>{point.y:.1f}</b>'
	        },
	        series: [arrayResult]
	        });
	    }
	    $("#divResultStatisticKippo").dialog("open");
	   }
	});
	  
	 }
	 
	 
 function callAjaxStatisticsDio(params){
	  $.ajax({
	   url:"AjaxController.php",   
   data:params,
   type : 'POST',
   async: false,
   success: function(data){  
    var datos=$.parseJSON(data);   
    $('#resultDio1').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Numero de ataques por puertos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
       series :datos
    });
    $("#divResultStatisticDio").dialog("open");
    }
});
  
 }
 
 function callAjaxStatisticsGlas(params){
	    $.ajax({
	     url:"AjaxController.php",   
	     data:params,
	     type : 'POST',
	     async: false,
	     success: function(data){
	      var datos=$.parseJSON(data);   
	      $('#resultGlas1').highcharts({
	          chart: {
	              plotBackgroundColor: null,
	              plotBorderWidth: null,
	              plotShadow: false,
	              type: 'pie'
	          },
	          title: {
	              text: 'URLs Atacadas'
	          },
	          tooltip: {
	              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	          },
	          plotOptions: {
	              pie: {
	                  allowPointSelect: true,
	                  cursor: 'pointer',
	                  dataLabels: {
	                      enabled: true,
	                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
	                      style: {
	                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
	                      }
	                  }
	              }
	          },
	         series :datos
	      });
	      $("#divResultStatisticGlas").dialog("open");
	      }
	  });
}