@extends('layouts.master')
@section('content')
	<div class="card-box">
    <table class="table table-hover table-striped" id="clients">
        <thead>
           <th>#</th> <th>Name</th> <th>Date</th>  <th>Phone Number</th> <th>Client Number</th> <th>Client Type</th><th></th>
        </thead>

        <tbody>
            @foreach($read_clients as $clients)
              <tr>
                  <td>{{$clients->id}}</td> 
                  <td><a href="{{route('client.show',$clients->id)}}">{{$clients->name}}</a></td>
                  <td>{{date('d-M-Y',$clients->date_registered)}}</td>                
                  <td>{{$clients->phone_number}}</td>
                  <td>{{$clients->client_number}}</td>
                  <td>{{$clients->client_type}}</td>
                  <td>
                    <a href="{{route('event_user.show',$clients->id)}}" class="btn btn-success">Report</a>
                  </td>
              </tr>
            @endforeach
        </tbody>
    </table>
                   
	</div>
@endsection  