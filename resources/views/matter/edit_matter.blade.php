@extends('layouts.master')

@section('content')
<div class="card-box">
    {{Form::model($read_Matter,['files' => true,'method'=>'PATCH', 'action'=>['MatterController@update',$read_Matter->id]])}}

     <div class="row">
                <div class="col-md-6">
                    @csrf
                    <label>Matter Name</label>
                    <input type="text" name="name" value="{{$read_Matter->name}}" class="form-control">

                    <label>Matter number</label>
                    <input type="text" name="matter_number" value="{{$read_Matter->matter_number}}" class="form-control">

                    <label>Client</label>
                    <select class="form-control select2" name="client_id">
                        <option></option>
                        @foreach($read_clients as $clients)
                          <option value="{{$clients->id}}">{{$clients->name}} {{$clients->client_number}}</option>
                        @endforeach                        
                    </select>

                    <label>Originating Lawyer</label>
                    <select class="form-control select2" name="originating_lawyer">
                        <option></option>
                        @foreach(App\User::all()->where('company_id',Auth::user()->company_id) as $users)
                          <option value="{{$users->id}}">{{$users->name}} ({{$users->phone_number}})</option>
                        @endforeach                        
                    </select>
                 
                    <label>Start date</label>
                    <input type="date" name="start_date" value="{{$read_Matter->start_date}}" class="form-control">

                    <label>Statutory limitation</label>
                    <input type="date" name="statutery_limitation" value="{{$read_Matter->statutery_limitation}}" class="form-control">

                    <label>Description</label>
                    <input type="text" name="description" value="{{$read_Matter->description}}" class="form-control">

                    <label>Parties</label>
                    <input type="text" name="parties" value="{{$read_Matter->parties}}" class="form-control">


                    <br>
                    <button class="btn btn-primary" type="submit">Save</button>

                </div>

            <div class="col-md-6">              
                <label>Practice area</label>
                <select class="form-control" name="practice_area[]" multiple="multiple" id="fsg_service_id_community">
                    <option></option>
                    @foreach($read_PracticeArea as $practicearea)
                      <option value="{{$practicearea->id}}">{{$practicearea->name}}</option>
                    @endforeach
                </select>
<br>

                <br>

                <select class="form-control" name="users[]" multiple="multiple" id="my_multi_select3">
                    <option></option>
                    @foreach(App\User::all()->where('company_id',Auth::user()->company_id) as $users)
                      <option value="{{$users->id}}">{{$users->name}}</option>
                    @endforeach
                </select>

                <label>Any files</label><br>
                <input type="file" name="documents[]" multiple="multiple">
                
            </div>
        </div>
        {{Form::close()}}
    </div>
@endsection