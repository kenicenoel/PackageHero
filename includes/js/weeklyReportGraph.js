// Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});

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
          title:'Number of recent issues for the last 7 days',
          width:800,
          // height:300,
          pointSize:4,
          legend: { position: "none" },
          hAxis:
          {
            title: "Last 7 days",
            fontSize:10

          },
          vAxis:
          {
            title: "Number of issues",


            // logscale:"true"
          }
        };


      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.LineChart(document.getElementById('weekly-report'));
      chart.draw(data, options);
    }
