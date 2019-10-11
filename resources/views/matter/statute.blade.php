@extends('layouts.master')
@section('content')
<div class="card-box">

  <!-- <div class="row"> -->
  	<center>
  		<img src="{{asset('documents')}}/{{Auth::user()->company->logo_url}}" width="200">
  		<br>
  		<span>
  			Address:{{Auth::user()->company->location_address}}<br>
 	  		Phone Number:	{{Auth::user()->company->phone_number}}, Email: {{Auth::user()->company->email_address}} <br> Website: {{Auth::user()->company->website_url}}
  		</span>
  	</center> 	 
<!-- </div> -->

<br><br><br>
 
	<div class="row">

		
		

	<div>
		<h3> <legend>Matters</legend></h3><br><hr>
	</div><br>    
        <div class="container">
        <ol>
		  @foreach($read_Client->matter as $save_Matter)
				<li>
				  <legend><u><b>{{$save_Matter->name}}</b></u></legend>

				     <div class="row">
		                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
		                    <table class="table table-hover table-striped" id="tabledetails">

		                        <tr><td>Start date</td> <td><b>{{date('d-m-Y',$save_Matter->start_date)}}</b></td></tr>
		                        <tr><td>Client</td> <td><b>{{$save_Matter->client->name}}</b></td></tr>
		                        	                        
		                        

		                        <tr><td><strong>Statutory Limit</strong></td> <td><b>{{$save_Matter->statutery_limitation}}</b></td></tr>
		                        <tr><td>Status</td> <td><span class="btn btn-success">{{$save_Matter->status}}</span></td></tr>
		                         
		                        <tr><td>Practice area</td> <td>
		                            @foreach($save_Matter->practicearea as $practice_area)
		                              {{$practice_area->name}}; 
		                            @endforeach
		                        </td> </tr>
		                    </table>
		                    
		                    
		                </div>
		               
			               
			            </table> 


			</li>
		@endforeach
	</ol>
	</div>
</div>
@endsection

@section('styles')
	<style type="text/css">
		@media print{
			.card-box{
				float: none !important; 
				overflow: none;
			}
		}
	</style>
@endsection
