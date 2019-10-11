@extends('layouts.master')

@section('content')
<div class="card-box">

    <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#company_list" role="tab" aria-controls="company_list">Companies</a>
        </li>  

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_company" role="tab" aria-controls="add_company" aria-expanded="true">Add Company</a>
        </li>      
         
    </ul>

    <div class="tab-content">

      <div class="tab-pane active" id="company_list">

        <table class="table" id="table_details">
          <thead>
            <th>#</th> <th>Name</th> <th>Logo</th> <th>Email</th> <th>Phone Number</th> <th>Main Admin</th> <th>Users</th>
          </thead>

          <tbody>
            @foreach($companies as $companies)
              <tr>
                <td>{{$companies->id}}</td>
                <td>{{$companies->name}}</td>
                <td><img src="{{asset('/documents')}}/{{$companies->logo_url}}" width="50px"></td>
                <td>{{$companies->email_address}}</td>
                <td>{{$companies->phone_number}}</td>
                <td>{{$companies->single_user->name}}</td>
                <td>{{$companies->users->count()}}</td>
              </tr>
            @endforeach
          </tbody>          
        </table>
         
      </div>
      
      <div class="tab-pane" id="add_company">
        <form method="POST" action="{{route('company.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6 col-lg-6">

              <p>Company</p>

              <label>Company name *</label>
              <input type="text" name="name" class="form-control">

              <label>Location *</label>
              <input type="text" name="location_address" class="form-control">

              <label>Phone number *</label>
              <input type="text" name="phone_number" class="form-control">

              <label>Email address *</label>
              <input type="email" name="email_address" class="form-control">

              <label>Website url</label>
              <input type="text" name="website_url" class="form-control">

              <label>Logo *</label><br>
              <input type="file" name="logo_url">
              <br><br>
              <button type="submit" class="btn btn-primary">Save</button>
              
            </div>

            <div class="col-md-6 col-lg-6">
              <p>Main Admin</p>
              <label>Name *</label>
              <input type="text" name="admin_name" class="form-control">

              <label>Email *</label>
              <input type="email" name="email" class="form-control">

              <label>Phone number *</label>
              <input type="text" name="phone_number" class="form-control">
              
            </div>
          </div>
        </form>
 
      </div>
    </div>
  </div>
   
@endsection