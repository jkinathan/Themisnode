@extends('layouts.master')

@section('content')
<div class="card-box">
    
    <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-expanded="true">Add User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile">View users</a>
        </li>              
    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="home1">

            <h2>Add new User</h2>

            <form method="POST" action="{{route('user.store')}}">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control">

                        <label>Email *</label>
                        <input type="text" name="email" class="form-control">

                        <label>Address *</label>
                        <input type="text" name="address" class="form-control">

                        <label>Phone number *</label>
                        <input type="text" name="phone_number" class="form-control">

                        <br>
                        <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save</button>
                    </div>

                    <div class="col-md-6">                 
                        

                         
                    </div>
                </div>
            </form>
           
        </div>


        <div class="tab-pane" id="profile1">
            <table class="table" id="users_list">
                <thead>
                  <th>#</th>  <th>Name</th> <th>Email</th> <th>Phone number</th> <th>Address</th> <th>Status</th>
                </thead>

                <tbody>
                    @foreach($read_users as $user)
                      <tr>
                          <td>{{$user->id}}</td>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->phone_number}}</td>
                          <td>{{$user->address}}</td>
                          <td>
                              @if($user->status == 1)
                               <a href="{{route('user.show',$user->id)}}" title="Click to block user"> <span class="btn btn-success">Active</span> </a>
                                @elseif($user->status == 0)
                                <a href="{{route('user.show',$user->id)}}" title="Click to grant user access"><span class=" btn btn-danger">Blocked</span></a>
                              @endif  
                          </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
@endsection