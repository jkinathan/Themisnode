@extends('layouts.master')
@section('content')
 	<div class="card-box">
 		<h4>{{$tasks->name}}</h4>
        <span>{{$tasks->description}}</span><br>
        <span>From: {{$tasks->start_time}}  To: {{$tasks->end_time}}</span><br>
         @if($tasks->status==0)
          <span class="text-warning">Pending</span>

          @else

          <span class="text-success">Completed</span>

        @endif
        <br>
        <legend>People involved</legend>
         @foreach($tasks->users as $user)
            <span class="text-success"> {{$user->name}} {{$user->phone_number}}</span>, 
         @endforeach

         <br>
          @if($tasks->status==0)
            <a class="text-danger" href="{{route('party.show',$tasks->id)}}">Mark as complete</a>
        @endif
	</div>
@endsection