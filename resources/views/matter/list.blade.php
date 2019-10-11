@extends('layouts.master')

@section('content')
 <div class="card-box">

    <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="profile">Add new matter</a>
        </li>  

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="home" aria-expanded="true">Matters</a>
        </li> 
        
        <!-- N.E <li class="nav-item">
          <a class="nav-link" id="home-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="home" aria-expanded="true">Add Time Spent</a>
      </li> -->                  
    </ul>
 

     <div class="tab-content">
        <div class="tab-pane active" id="home1">

            <form method="POST" action="{{route('matter.store')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        <label>Matter Name</label>
                        <input type="text" name="name" class="form-control">

                        <label>Matter number</label>
                        <input type="text" name="matter_number" class="form-control">

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
                        <input type="date" name="start_date" class="form-control">

                        <label>Statutory limitation</label>
                        <input type="date" name="statutery_limitation" class="form-control">
                        <br>
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea><br>
                        <button class="btn btn-primary" type="submit">Save</button>
                  <!--new-->
                    <form action="/matters" method="POST">
                      @csrf
                  <button class="btn btn-success" type="submit"> Save and Add New</strong></button>
                  
                  </form>
              
                  <!--endNew-->
                </div>

                <div class="col-md-6">
                    <label>Practice area</label>
                    <select class="multi-select" name="practice_area[]" multiple="multiple" id="fsg_service_id_community">
                        <option></option>
                        @foreach($read_PracticeArea as $practicearea)
                          <option value="{{$practicearea->id}}">{{$practicearea->name}}</option>
                          <?php
                            
                          ?>
                        @endforeach
                    </select>

                    

                    <label>Advocates Involved</label>
                    <select class="multi-select" name="users[]" multiple="multiple" id="my_multi_select3">
                        <option></option>
                        @foreach(App\User::all()->where('company_id',Auth::user()->company_id) as $users)
                          <option value="{{$users->id}}">{{$users->name}}</option>
                        @endforeach
                    </select>

                    <label>Any files?</label><br>
                    <input type="file" name="documents[]" multiple="multiple">
                    
                </div>
            </div>
           </form>

        </div>

         <div class="tab-pane" id="profile1">

            <form method="POST" action="{{url('change_matter_stage')}}">
                @csrf

             <table class="table" id="matters">
                <thead>
                  <th>Date</th>  <th>Client Name</th> <th>Matter</th> <th>Number</th> <th>Start date</th> <th>Matter Stage</th>
                 <th></th><th>Change stage</th>
                </thead>

                <tbody>
                    @foreach($matters as $matter)
                      <tr>
                        <td>{{$matter->created_at}}</td>
                        <td><a href="{{route('client.show',$matter->client->id)}}">{{$matter->client->name}}</a></td>
                        <td><a href="/matter_details/{{$matter->id}}">{{$matter->name}}</a></td>
                        <td><a href="/matter_details/{{$matter->id}}">{{$matter->matter_number}}</a></td>
                        <td>{{date('d-m-Y',$matter->start_date)}}</td>
                        <td>
                            @if($matter->status=="Start")
                              <span class="btn btn-danger">{{$matter->status}}</span>

                              @elseif($matter->status=="process")

                              <span class="btn btn-warning">{{$matter->status}}</span>

                               @elseif($matter->status=="done")

                              <span class="btn btn-success">{{$matter->status}}</span>


                            @endif

                        </td>
                        <td>
                            @if($matter->status=="done")

                               @else
                                <a href="{{route('matter.edit',$matter->id)}}" class="btn btn-primary">Edit</a>
                            @endif 
                        </td>
                        <td>
                            <input type="checkbox" name="matter[]" value="{{$matter->id}}">
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              <br>
            <label>Stage</label>
            <select class="form-control" name="stage">
                <option></option>
                <option value="Start">Start</option>
                <option value="process">Under process</option>
                <option value="done">Done</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary">Change Matter stage</button>
          </form>

        </div>
        <div class="tab-pane" id="profile2">
          <form action="/matter_time" method="POST">
            {{ csrf_field() }}
                 <div class="row">
                            <div class="col-md-6">
                                
                                <label>Matter Name</label>
                                
                                <select class="form-control inputstl" name="mattername">
                                      @foreach($matters as $matter)
                                  <option value="{{$matter->name}}">{{$matter->name}}</option>
                                    @endforeach
                                </select>
                                <br>
                                
                            <!--<input type="text" name="mattername" class="form-control">
                            --> <label>Date </label>
                                <input type="date" name="date" placeholder="YYYY-MM-DD" class="form-control">
                                <label>Time in hours</label>
                                <input class="form-control inputstl" type="number" name="timeinhours" placeholder="Time in hours">
            
                                <br>
                                <form method="POST" action="/matter_time">
                                  @csrf
                                <input class="btn btn-success" name="submit" type="submit" value="Save"/>
                                </form>
                              </div>
                 </div>
            </form>

      </div>
    </div>
</div>
   
@endsection

