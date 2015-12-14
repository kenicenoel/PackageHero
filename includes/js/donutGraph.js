// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // This together with setting the width to 100% makes the chart responsive
    $(window).resize(function()
    {
      drawChart();
    });

    function drawChart()
    {
      // Create the weekly report graph
      var jsonData = $.ajax(
        {
          url: "../includes/functions/donutgraph.php",
          dataType:"json",
          async: false
        }).responseText;

        var options =
        {
          // title:'Number of available and hidden issues',
          width:"100%",
          // height:300,
          pieHole:0.2,
          pieSliceText:'value',
          fontSize:15,
          legend: { position: "left" },
          colors:['#04e035', '#e93131']
        };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('summary-graph'));
      chart.draw(data, options);
    }
