@extends('layouts.master')

@section('content')
    <div class="card-box">
    	<table class="table" id="case_table">
                <thead>
                 <th>#</th> <th>Opening Date</th> <th>Case number</th><th>Stage</th> 
                </thead>

                <tbody>
                  @foreach($read_courtbook as $court_book)
                    <tr>
                      <td>{{$court_book->id}}</td>
                      <td>{{date('d-m-Y',$court_book->care_openning_date)}}</td>
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
                     </tr>
                  @endforeach
                </tbody>
            </table>

    </div>
@endsection