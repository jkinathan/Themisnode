@extends('layouts.master')

@section('content')
<div class="card-box">

        <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#add_case" role="tab" aria-controls="home" aria-expanded="true">Add conversations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#case" role="tab" aria-controls="profile">conversations</a>
                </li>

                      
            </ul>


     <div class="tab-content">
        <div class="tab-pane" id="case">
          <ol class="navigation-menu">
            @foreach($readCommunication as $communication)
            <div class="card-box">
                <li style="margin: 10px;">
                  <h4>{{$communication->message_title}}</h4>
                  <h5>{{$communication->matter->name}} ({{$communication->matter->matter_number}})</h5>
                  <span>From: {{$communication->name_of_person}}</span><br>
                  <span>{{$communication->message_body}}</span><br>
                  <span class="text-success">Media: {{$communication->media_used}}</span><br>
                  <span>Date: {{$communication->date_of_message}}</span><br>
                  
                  @foreach($communication->document as $files)
                    <a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a> 
                  @endforeach

                  
                </li>
              </div>
             @endforeach
          </ol>

            

        </div>

        <div class="tab-pane active" id="add_case">

          <form method="POST" action="{{route('communication.store')}}" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-md-12">
                          @csrf

                          <label>Title</label>
                          <input type="text" name="message_title" class="form-control">

                          <label>Choose related matter</label>
                          <select class="form-control select2" name="matter_id">
                              @foreach($matters as $matter)
                                  <option value="{{$matter->id}}">{{$matter->name}}</option>
                               @endforeach
                          </select>  

                          <label>Name of person you talked to</label>
                          <input type="text" name="name_of_person" class="form-control">

                          <label>Date of communication</label>
                          <input type="date" name="date_of_message" class="form-control">

                          <label>Media used</label>
                          <input type="text" name="media_used" class="form-control">

                          <label>Description</label>
                          <textarea class="form-control" name="message_body"></textarea>

                          <label>Any files?</label><br>
                          <input type="file" name="documents[]" multiple="multiple">
                          <br><br>
                          <button class="btn btn-primary" type="submit">Save</button>
                      </div>                       
                  </div>
                </form>
              </div>
            </div>
          </div>
 
@endsection