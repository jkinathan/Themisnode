@extends('layouts.master')
@section('content')
	<div class="card-box">
		    <form method="POST" action="{{route('alert.store')}}">
            @csrf
            <label>Choose date range</label>
            <br>
            From: <input type="date" class="form-control" name="from" >
              &nbsp;
            To: <input type="date" class="form-control" name="to" >
              &nbsp;                     
              <br>
          <button class="btn btn-primary">Generate</button>
       </form>
	</div>
@endsection