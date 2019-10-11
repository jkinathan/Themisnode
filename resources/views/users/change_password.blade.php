@extends('layouts.master')

@section('content')
    <div class="card-box">
        <form method="POST" action="{{url('/change_password')}}">
            <div class="row">
                <div class="col-md-6">
                    @csrf
                    <label>New password</label>
                    <input type="password" name="password" class="form-control">

                    <label>Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    
                    <br>
                    <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save</button>
                </div>                   
            </div>
        </form>
    </div>     
@endsection