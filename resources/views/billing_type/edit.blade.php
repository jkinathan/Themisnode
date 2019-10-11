@extends('layouts.master')
@section('content')
    <div class="card-box">
        <div class="tab-content">
            <div class="tab-pane active" id="home1">
                {{Form::model($read_BillingType,['method'=>'PATCH', 'action'=>['BillingTypeController@update',$read_BillingType->id]])}}
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        <label>Client Name</label>
                        <input type="text" name="name" value="{{$read_BillingType->name}}" class="form-control">

                        <br>
                        <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save</button>
                    </div>                  
                </div>
            {{Form::close()}}
           
        </div>
    </div>
</div>        
@endsection