@extends('layouts.master')

@section('content')

	<div class="card-box">
		<h3>{{$read_MatterFollowup->title}}</h3>
		<span>Date: {{date('d-m-Y',$read_MatterFollowup->date_created)}}</span>
		<br><br>
		<span>
			{{$read_MatterFollowup->description}}
		</span>
		<br>

	  	@foreach($read_MatterFollowup->document as $files)
	  	    <a href="/getDownload/{{$files->file_url}}">Here</a>
      		<a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a><br>
    	@endforeach 
    	<br>
    	<span>Recorded by {{$read_MatterFollowup->user->name}}</span>
	 
	</div>   
@endsection