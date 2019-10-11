@extends('layouts.master')

@section('content')
<div class="card-box">
       <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-expanded="true">Add new billing type</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile">View Billing types</a>
            </li>              
        </ul>



    <div class="tab-content">
        <div class="tab-pane active" id="home1">
            <form method="POST" action="{{route('billing_type.store')}}">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">

                        <br>
                        <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save</button>
                    </div>

                    <div class="col-md-6">
                    
                        

                         
                    </div>
                </div>
            </form>
           
        </div>


        <div class="tab-pane" id="profile1">

            <table class="table" id="billing">
                <thead>
                  <th>#</th>  <th>Name</th> <th></th>
                </thead>

                <tbody>
                    @foreach($raed_BillingType as $billingtypes)
                      <tr>
                          <td>{{$billingtypes->id}}</td>
                          <td>{{$billingtypes->name}}</td>
                          <td><a href="{{route('billing_type.edit',$billingtypes->id)}}">Edit</a></td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
         
               
@endsection