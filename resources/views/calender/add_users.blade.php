@extends('layouts.master')

@section('content')
  <div class="card-box">
    <form method="POST" action="{{route('event_user.store')}}">
      @csrf

      <input type="hidden" name="matterevent_id" value="{{$event->id}}"> 
        <table class="table" id="billing">
          <thead>
            <th>#</th>  <th>Name</th> <th>Email</th> <th>Phone</th> <th>Action</th>
          </thead>

          <tbody>
              @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone_number}}</td>                          
                    <td>
                      <input type="checkbox" name="user[]" multiple="multiple" value="{{$user->id}}">
                    </td>                          
                </tr>                
              @endforeach
          </tbody>
      </table> 

      <button type="submit" class="btn btn-info">Save</button>
    </form>          
  </div>    
@endsection