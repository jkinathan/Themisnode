@extends('layouts.master')

@section('content')
<div class="card-box">
        <form method="POST" action="{{route('opposite_advocates.store')}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <label>Name</label>
                    <input type="text" name="name" class="form-control">

                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control">

                    <label>Address</label>
                    <input type="text" name="address" class="form-control"> 

                    <input type="hidden" name="courtbook_id" value="{{$read_CourtBook->id}}">

                    <br>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>
       </form>
   </div>
   
@endsection