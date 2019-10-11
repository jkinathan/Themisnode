@extends('layouts.master')

@section('content')

	<div class="card-box">
	  <table class="table table-striped table-hover">	
		<h3>{{$read_courtbookFollowup->title}}</h3>
		<tr>
			<td><span>Hearing Date</span></td> <td><strong>{{$read_courtbookFollowup->hearing_date}}</strong></td>
		</tr>

		<tr>
			<td>Place of Hearing</td>  <td> <strong>{{$read_courtbookFollowup->place_of_hearing}}</strong> </td>
		</tr>

		<tr>
			<td> Presiding Judge name </td>  <td><strong> {{$read_courtbookFollowup->presiding_judge_name}}<strong> </td>
		</tr>

		<tr>
			<td> Court clerk name </td>  <td><strong> {{$read_courtbookFollowup->court_clerk_name}}</strong> </td>
		</tr>

		<tr>
			<td>Court clerk Phone number </td>  <td> <strong> {{$read_courtbookFollowup->court_clerk_phonenumber}} </strong></td>
		</tr>

		<tr>
			<td> Next hearing date </td>  <td> <strong>{{$read_courtbookFollowup->next_hearing_date}}</strong> </td>
		</tr>

		<tr>
			<td> Next hearing place </td>  <td><strong> {{$read_courtbookFollowup->next_hearing_place}}</strong> </td>
		</tr> 
	</table>

	 
	 
		<p>{{$read_courtbookFollowup->notes}}</p>
		<br>

		<h4>Documents</h4>

	  	@foreach($read_courtbookFollowup->document as $files)
            <a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a>@endforeach
    	<br>
    	<span>Recorded by {{$read_courtbookFollowup->user->name}}</span>
	</div>   
@endsection

@section('styles')
  <style type="text/css">
    .card-box{
      border-style: solid;
      border-color: #990E2C;
      border-width: 5px 5px 5px 5px;
      border-radius: 7px;

   }
  </style>
@endsection