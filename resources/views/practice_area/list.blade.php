@extends('layouts.master')

@section('content')
<div class="card-box">
 


        <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-expanded="true">Add Practice area</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile">View Practice area</a>
            </li>              
        </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="home1">
            <form method="POST" action="{{route('practice_area.store')}}">
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

            <table class="table" id="practice_area">
                <thead>
                  <th>#</th>  <th>Name</th> <th>Number of Matters</th> <th></th>
                </thead>

                <tbody>
                    @foreach($read_PracticeArea as $practicearea)
                      <tr>
                          <td>{{$practicearea->id}}</td>
                          <td>{{$practicearea->name}}</td>
                          <td>{{\DB::table('matter_practice_area')->where('practiceareas_id',$practicearea->id)->count()}}</td>
                          <td><a href="{{route('practice_area.show',$practicearea->id)}}">Show matters</a></td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
           
        </div>
    </div>
</div>
 <!-- <a href="{{route('client.index')}}" class="">view client</a> -->
        
               
@endsection