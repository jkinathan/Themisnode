@extends('layouts.master')

@section('content')
  <div class="card-box">
    <table class="table table-hover table-striped" id="billing">
        <thead>
          <th>#</th>  <th>Created at</th> <th>Object code</th> <th>Object name</th> <th>Ip address</th> <th>Users code</th> <th>User email</th> <th>User name</th> <th>Object decription</th>
        </thead>

        <tbody>
          @foreach($logs as $log)
           <tr>
            <td>{{$log->id}}</td> <td>{{$log->created_at}}</td> <td>{{$log->object_code}}</td><td>{{$log->object_name}}</td><td>{{$log->ip_address}}</td><td>{{$log->user_code}}</td><td>{{$log->user_email}}</td><td>{{$log->user_name}}</td><td>{{$log->object_decription}}</td>
           </tr>
          @endforeach                   
        </tbody>
    </table>           
  </div>
@endsection