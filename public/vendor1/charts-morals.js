( function ( $ ) {

	var charts = {
		init: function () {
			// -- Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#292b2c';

			this.ajaxGetPostMonthlyData();

		},

		ajaxGetPostMonthlyData: function () {
			var urlPath =  'http://localhost:8000/pie-charts';
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

			var ctx = document.getElementById("chartMoral");
			var myLineChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ['personne morale','personne physique','administrateur','utilisateur'], // The response got from the ajax request containing all month names in the database
					datasets: [{
						label: "Sessions",
						backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', 'orange'],
						hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', 'orange'],
						data: [response.sommeM,response.sommeP,response.admins,response.users] // The response got from the ajax request containing data for the completed jobs in the corresponding months
					}],
				},
				options: {
					maintainAspectRatio: false,
					tooltips: {
					  backgroundColor: "rgb(255,255,255)",
					  bodyFontColor: "#858796",
					  borderColor: '#dddfeb',
					  borderWidth: 1,
					  xPadding: 15,
					  yPadding: 15,
					  displayColors: false,
					  caretPadding: 10,
					},
					legend: {
					  display: false
					},
					cutoutPercentage: 80,
				  },
			});
		}
	};

	charts.init();

} )( jQuery );