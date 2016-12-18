/*!
* Module Dashboard
* Kumpulan javascript module Dashboard
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Charts JS
* @see https://github.com/nitinegoro/spa-and-beauty
*/

jQuery(function($) {


	// date Range
	$('.input-daterange').datepicker({
		autoclose:true,
		format: 'yyyy-mm-dd',
	});

	// get values query string
	var from_date = $('input[name="from"]').val();
	var end_date = $('input[name="end"]').val();

	// Get Income Data
    $.ajax({
        type: 'GET',
        url: base_url + '/main/linechart?from=' + from_date + '&end=' + end_date,
        success: function(chart_data) 
        {
			Morris.Line({
				  element: 'sales-stats',
				  data: chart_data,
				  xkey: 'period',
				  ykeys: ['income','tax'],
				  labels: ['Income', 'Tax']
			});  
        }
    });

			
	var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});

	function drawPieChart(placeholder, data, position) {
	 	$.plot(placeholder, data, {
			series: {
				pie: {
					show: true,
					tilt:0.8,
					highlight: {
									opacity: 0.25
					},
					stroke: {
						color: '#fff',
						width: 2
					},
					startAngle: 2
				}
			},
			legend: {
				show: true,
				position: position || "ne", 
				labelBoxBorderColor: null,
				margin:[-30,15]
			},
			grid: {
				hoverable: true,
				clickable: true
			}
		})
	}

	// Get Pencentage Favoirites
    $.ajax({
        type: 'GET',
        url: base_url + '/main/piechart?from=' + from_date + '&end=' + end_date,
        success: function(pie_data) 
        {
			drawPieChart(placeholder, pie_data);  
			placeholder.data('chart', pie_data);
        }
    });

	placeholder.data('draw', drawPieChart);
			
	//pie chart tooltip example
	var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
	var previousPoint = null;
	placeholder.on('plothover', function (event, pos, item) {
		if(item) {
			if (previousPoint != item.seriesIndex) {
				previousPoint = item.seriesIndex;
				var tip = item.series['label'] + " : " + item.series['percent']+'%';
				$tooltip.show().children(0).text(tip);
			}
			$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
		} else {
			$tooltip.hide();
			previousPoint = null;
		}
	});
});
