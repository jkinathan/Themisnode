@extends('layouts.master')

@section('content')
<!--new

-->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script
      src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="https://code.highcharts.com/highcharts.js"></script>
    <title>Themis Charts!</title>
  </head>
  

    <div class="row text-center">

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Clients</p>
                    <h2 class="text-danger"><span data-plugin="counterup">{{$read_clients_count}}</span></h2>
                     
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Matters</p>
                    <h2 class="text-dark"><span data-plugin="counterup">{{$matters_count}}</span> </h2>
                
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Cases</p>
                    <h2 class="text-success"><span data-plugin="counterup">{{$count_CourtBook}}</span></h2>
               
                </div>
            </div>
        </div><!-- end col -->

       

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="card-box widget-box-one">
                <div class="wigdet-one-content">
                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Total Users</p>
                    <h2 class="text-primary"><span data-plugin="counterup">{{$count_users}}</span> </h2>
                    
                </div>
            </div>
        </div><!-- end col -->
    </div>



    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">Matters Stages</h4>

                <div id="maters" style="height: 460px;"></div>
               
         
            </div> <!-- end card -->
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                 <h4 class="header-title m-t-0 m-b-30">Matters per Practice areas</h4>
                 <div id="practice_areas" style="height: 460px;"></div>          

            </div>
        </div>
    </div>

        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h3 class="h3">Add events</h3>
                    </div>
                    <div class="modal-body p-20">
                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                    </div>
                    
                </div>

            </div>
        </div>

    <div class="row">

        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
             <div class="card-box">
                <h4 class="header-title m-t-0 m-b-20">Court cases Stages</h4>
                <div class="inbox-widget nicescroll" id="cases" style="height: 460px;"></div>
            </div>
        </div>

       <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">My events</h4>

                <div id="calendar"></div>

            </div>
        </div>
    </div>
    <?php
    $dbHost = "localhost";
	$dbDatabase = "themis";
	$dbPasswrod = "";
	$dbUser = "root";

    
    $mysqli = mysqli_connect($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
//

$sql = "SELECT * FROM matters WHERE company_id=4";

//$click = mysqli_query($mysqli,$sql);
$result = $mysqli->query($sql);
//$row = mysqli_fetch_assoc($click);
 
  //var_dump($row);
    //exit();
     
//while ($row = mysqli_fetch_array($stages))
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
    $data[] = [(string)$row['status']];
    foreach ($data as $value) {
        # code...

        $values = count($value);
        //$valuer[] = count($values);
        
    }
    print_r ($values);
    
}
//print_r ($data);


?>



<script type="text/javascript">

$(document).ready(function()){
    var record={!! json_encode($stages) !!};
    console.log(record);
    
var options = {
    chart: {
        renderTo: 'container',
        type: 'pie'
    },
    title:{
        text: 'Themis charts'
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
    series: [{
        data: [
            name: 'Mobile users',
            data:[30,20],
            
            ]
    }]
};
/* $.getJSON('data2.php', function(data){
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
      });*/
});
</script>
@endsection