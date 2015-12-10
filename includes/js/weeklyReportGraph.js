// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['bar']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);
    function drawChart()
    {
      // Create the weekly report graph
      var jsonData = $.ajax(
        {
          url: "../includes/functions/weeklyreport.php",
          dataType:"json",
          async: false
        }).responseText;

        var options =
        {
          title: 'Number of issues over the last 7 days',
          width:800,
          height:500,
          hAxis: {
            title: 'Date issue was created',
            format: 'MMM d, y'


          },
          vAxis: {
            title: 'Number of issues',
            format: 'none'
          }
        };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.charts.Bar(document.getElementById('weekly-report'));
      chart.draw(data, options);
    }
