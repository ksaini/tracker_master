type = ['','info','success','warning','danger'];

demo = {
		initPickColor: function(){
			$('.pick-class-label').click(function(){
				var new_class = $(this).attr('new-class');  
				var old_class = $('#display-buttons').attr('data-class');
				var display_div = $('#display-buttons');
				if(display_div.length) {
					var display_buttons = display_div.find('.btn');
					display_buttons.removeClass(old_class);
					display_buttons.addClass(new_class);
					display_div.attr('data-class', new_class);
				}
			});
		},

		initChartist: function(l,s,max){    

			var data = {
					labels: l,
					series: [
					         s
					        ]
			};

			var options = {
					seriesBarDistance: 10,
					high: max,
					axisX: {
						showGrid: false
					},
					
					height: "245px"
			};

			var responsiveOptions = [
			                         ['screen and (max-width: 640px)', {
			                        	 seriesBarDistance: 5,
			                         }]
			                         ];

			Chartist.Bar('#chartActivity', data, options, responsiveOptions);
		},
		
		initChartist1: function(catChartResult){
			var dataPreferences = {
					series: [
					         [25, 30, 20, 25]
					         ]
			};

			var optionsPreferences = {
					donut: true,
					donutWidth: 60,
					startAngle: 0,
					total: 100,
					showLabel: false,
					axisX: {
						showGrid: false
					}
			};
					
			Chartist.Pie('#chartPreferences', {
				labels: [catChartResult.p1,catChartResult.p2,catChartResult.p3,catChartResult.p4],
				series: [catChartResult.p1,catChartResult.p2,catChartResult.p3,catChartResult.p4],
			});   
		},	

		showNotification: function(from, align){
			color = Math.floor((Math.random() * 4) + 1);

			$.notify({
				icon: "pe-7s-gift",
				message: "Welcome to Adobe FrameMaker Team"

			},{
				type: type[color],
				timer: 4000,
				placement: {
					from: from,
					align: align
				}
			});
		}

}

