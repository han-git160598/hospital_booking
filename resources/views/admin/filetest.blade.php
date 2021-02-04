<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" value="{{ csrf_token() }}">
        <title>Admin</title>
        <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/lte/css/library.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div id="app"></div>
        <canvas id="myChart"></canvas>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/lte/js/library.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script>
$( document ).ready(function() {

      var xValue = 0;
      var yValue = 10;
      var newDataCount = 6;
        $.ajax({
        url: '{{URL::to('/test-total')}}',
        type: 'GET',
        dataType: 'json',
        success: function (response) 
        {}}).done(function (data){
          var data_lables = [];
          var data_data=[];
         data.forEach(function (item) 
         {
            data_lables.push(item.name);
         });
         data.forEach(function (item) 
         {
            data_data.push(item.total);
         });
         console.log(data);
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: data_lables,
                datasets: [{
                    label: 'My First dataset',
                    backgroundColor:[
                     'rgba(255, 99, 132, 0.6)',
                     'rgba(54, 162, 235, 0.6)',
                     'rgba(255, 206, 86, 0.6)',
                     'rgba(75, 192, 192, 0.6)',
                     'rgba(153, 102, 255, 0.6)',
                     'rgba(255, 159, 64, 0.6)',
                     'rgba(255, 99, 132, 0.6)' ],
                     
                  borderWidth:1,
                  borderColor:'#777',
                  hoverBorderWidth:3,
                  hoverBorderColor:'#000',
                  data: data_data
                  
                }]
            },
            // Configuration options go here
            options: {}
           
        }); // chart
 }); //function chart


}); // document ready
   
        </script>
    </body>
</html>