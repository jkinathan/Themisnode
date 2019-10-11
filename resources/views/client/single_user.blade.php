@extends('layouts.master')
@section('content')

<div class="card-box">
	<div class="row">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<table class="table table-hover table-striped" id="clients">
				<tr>
					<td>Client number </td><td><b>{{$read_Client->client_number}}</b></td>
				</tr>

				<tr>
					<td>Client Type: </td><td><b>{{$read_Client->client_type}}</b></td>
				</tr>

				<tr>
					<td>Address: </td><td><b>{{$read_Client->address}}</b></td>
				</tr>

				<tr>
					<td>Phone Number: </td><td><b>{{$read_Client->phone_number}}</b></td>
				</tr>
				<tr>
					<td>Secondary Phone Number: </td><td><b>{{$read_Client->phone_number_2}}</b></td>
				</tr>
				<tr>
					<td>Contact person: </td><td><b>@if($read_Client->client_type == "individual" ) Self @else {{$read_Client->contact_person}} @endif</b></td>
				</tr>

				<tr>
					<td>Email: </td><td><b>{{$read_Client->email}}</b></td>
				</tr>

				<tr>
					<td>Reffered by: </td><td><b>{{$read_Client->reffered_by}} ( {{$read_Client->referred_by_name}} {{$read_Client->referred_by_phone}})</b></td>
				</tr>

				<tr>
					<td>Date registered: </td><td><b>{{date('d-m-Y',$read_Client->date_registered)}}</b></td>
				</tr>

				<tr>
					<td>Created By: </td><td><b>{{$read_Client->user->name}}</b></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<div class="card-box">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<table class="table table-hover table-striped" id="clients">
				<tr>
				<th>Matters</th><th>Start Date of Matters</th>
			</tr>
			<tr>
				<td>
						
						@foreach($read_Client->matter as $matter)
                            <tr>
								<td>{{$matter->name}}</td><td>{{date('d-m-Y',$matter->start_date)}}
							</tr>
                        @endforeach
				</td>
			</tr>
			</table>
			</div>
			</div>
		</div>
	</div>
</div>
@endsection