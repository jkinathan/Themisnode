@extends('layouts.master')

@section('content')
<div class="card-box">
 

        <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#add_case" role="tab" aria-controls="home" aria-expanded="true">Add new Case</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#case" role="tab" aria-controls="profile">Cases</a>
                </li>

                      
            </ul>


     <div class="tab-content">
        <div class="tab-pane" id="case">

            <form method="POST" action="/change_case_stage">
              @csrf
              <table class="table" id="case_table">
                <thead>
                 <th>#</th> <th>Date created</th> <th>Opening Date</th> <th>Title</th> <th>Case number</th><th>Stage</th> <th></th><th>Change stage</th>
                </thead>

                <tbody>
                  @foreach($read_CourtBook as $court_book)
                    <tr>
                      <td>{{$court_book->id}}</td>
                      <td>{{$court_book->created_at}}</td>
                      <td>{{date('d-m-Y',$court_book->care_openning_date)}}</td>
                      <td>{{$court_book->alias_name}}</td>
                      <td>
                        <a href="{{route('court_book.show',$court_book->id)}}">{{$court_book->case_number}}</a>
                      </td>
                 
                      <td>
                        <?php $record = App\CourtBook::find($court_book->id); ?>                         
                               
                        @if($record->stage == "Start")
                          <span class="btn btn-dark">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Arrest")
                          <span class="btn btn-dark">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Bail")
                          <span class="btn btn-info">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Arraignment")
                          <span class="btn btn-pink">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Pre-Trial Hearing")
                          <span class="btn btn-primary">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Pre-Trial Motions")
                          <span class="btn btn-purple">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Trial")
                          <span class="btn btn-info">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Sentencing")
                          <span class="btn btn-danger">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Appeal")
                          <span class="btn btn-success">{{$record->stage}}</span>
                        @endif

                        @if($record->stage == "Closed")
                          <span class="btn btn-success">{{$record->stage}}</span>
                        @endif                      
                      
                      </td>
                      
                      <td>
                        <a href="{{route('court_book.edit',$court_book->id)}}" class="btn btn-primary">Edit</a>
                      </td>

                      <td>
                        <input type="checkbox" name="case[]" value="{{$court_book->id}}">
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
            <br>
             <label>Case stage</label>
              <select class="form-control select2" name="case_stage">
                <option></option>
                <option value="Start">Start</option>
                <option value="Arrest">Arrest</option>
                <option value="Bail">Bail</option>
                <option value="Arraignment">Arraignment</option>
                <option value="Pre-Trial Hearing">Pre-Trial Hearing</option>
                <option value="Pre-Trial Motions">Pre-Trial Motions</option>
                <option value="Trial">Trial</option>
                <option value="Sentencing">Sentencing</option>
                <option value="Appeal">Appeal</option>
                <option value="Closed">Closed</option>
              </select> 
              <br><br>
              <button class="btn btn-primary">Change case stage</button>  
          </form>

        </div>

        <div class="tab-pane active" id="add_case">
          <form method="POST" action="{{route('court_book.store')}}" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-12">
                      @csrf
                      <label>Choose matter</label>
                      <select class="form-control select2" name="matter_id">
                          @foreach($matters as $matter)
                              <option value="{{$matter->id}}">{{$matter->name}}</option>
                           @endforeach
                      </select>

                      <label>Case title</label>
                      <input type="text" name="alias_name" class="form-control">

                      <label>Case Number</label>
                      <input type="text" name="case_number" class="form-control">

                      <label>Case type</label>                          
                      <select name="case_type_id" class="form-control">
                        <option></option>
                        @foreach(App\CaseType::all() as $casetypes)
                          <option value="{{$casetypes->id}}">{{$casetypes->name}}</option>
                        @endforeach
                      </select>
                 
                      <label>Case description</label>
                      <textarea class="form-control" name="alias_description"></textarea>
                      <label>Case opennig date</label>
                      <input type="date" name="care_openning_date" class="form-control">
                      <label>Any case files</label><br>
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