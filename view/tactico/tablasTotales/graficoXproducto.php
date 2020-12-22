<?php 
	require '../../../controller/tactico_controller.php';
	$emp = new tacticoControll();
	$empa = new tacticoControll();
	$reporteGxProductoff = $empa->get_report_GananciaXproducto($_REQUEST['dato']);
?>
<div class="card card-body">
	<canvas id="GraficoPP" width="400" height="400"></canvas>
</div>

<script>

var ctx= document.getElementById("GraficoPP").getContext("2d");
        var GraficoPP= new Chart(ctx,{
            type:"bar",
            data:{
                labels:["Hola1","Hola1","Hola1"],
                datasets:[{
                        label:'Num ventas',
                        data:[10,9,15],
                        backgroundColor:[
                            'rgb(66, 134, 244,0.5)',
                            'rgb(74, 135, 72,0.5)',
                            'rgb(229, 89, 50,0.5)'
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
		removeData(GraficoPP);
		addData(GraficoPP);
		

			function addData(chart) {
				const datoss = [];
				const cantidad = [];
				<?php foreach ($reporteGxProductoff as $itmPrfo):?>
						datoss.push('<?= $itmPrfo["fecha"];?>');
				<?php endforeach;?>
				<?php foreach ($reporteGxProductoff as $itmPrfo):?>
						cantidad.push('<?= $itmPrfo["Vendida"];?>');
				<?php endforeach;?>
				chart.data.datasets[0].data = cantidad;
				chart.data.labels = datoss;
				chart.update();
			}

			function removeData(chart) {
				chart.data.labels.pop();
				chart.data.datasets.forEach((dataset) => {
					dataset.data.pop();
				});
				chart.update();
			}
</script>