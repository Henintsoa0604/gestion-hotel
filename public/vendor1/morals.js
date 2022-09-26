( function ( $ ) {

	var charts = {
		init: function () {
			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';

			this.ajaxGetPostMonthlyData();

		},

		ajaxGetPostMonthlyData: function () {
			var urlPath =  'http://localhost:8000/charts-morales';
			var request = $.ajax( {
				method: 'GET',
				url: urlPath 
		} );

			request.done( function ( response ) {
			
				charts.createCompletedJobsChart( response );
			});
		},

		/**
		 * Created the Completed Jobs Chart
		 */
		createCompletedJobsChart: function ( response ) {

			var ctx = document.getElementById("chartMorales");
			var myLineChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: response.months, // The response got from the ajax request containing all month names in the database
					datasets: [{
						label: "Total",
						backgroundColor: "#4e73df",
						hoverBackgroundColor: "#4e73df",
						borderColor: "#4e73df",
						data: response.post_count_data // The response got from the ajax request containing data for the completed jobs in the corresponding months
					}],
				},
				options: {
					layout: {
						padding: {
						  left: 10,
						  right: 25,
						  top: 25,
						  bottom: 0
						}
					  },
					scales: {
						xAxes: [{
							time: {
								unit: 'date'
							},
							gridLines: {
								display: false,
								drawBorder: false
							},
							ticks: {
								maxTicksLimit: 7
							},
							 maxBarThickness: 25,
						}],
						yAxes: [{
							ticks: {
                                beginAtZero:true, // The response got from the ajax request containing max limit for y axis
								maxTicksLimit: 5,
								padding: 10,
								
							},
							gridLines: {
								color: "rgb(234, 236, 244)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [2],
								zeroLineBorderDash: [2]
							}
						}],
					},
					legend: {
						display: true
					},
					tooltips: {
						titleMarginBottom: 10,
						titleFontColor: '#6e707e',
						titleFontSize: 14,
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						caretPadding: 10,
						
						}
				}
			});
		}
	};

	charts.init();

} )( jQuery );