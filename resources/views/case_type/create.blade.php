@extends('layouts.master')

@section('content')
        <div class="card-box">
            <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-expanded="true">Add Case types</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile">View Case types</a>
                </li>              
            </ul>
       
 
            <div class="tab-content">
                <div class="tab-pane" id="home1">
                    <form method="POST" action="{{route('case_types.store')}}">
                        <div class="row">
                            <div class="col-md-6">
                                @csrf
                                <label>Case types Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">                               
                                <br>
                                <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save</button>
                            </div>                         
                        </div>
                    </form>
                   
                </div>


                <div class="tab-pane active" id="profile1">
                    <table class="table table-hover table-striped" id="clients">
                        <thead>
                           <th>#</th> <th>Name</th>  <th>Number of Cases</th> <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($case_types as $case_type)
                                <tr>
                                  <td>{{$case_type->id}}</td>
                                  <td>{{$case_type->name}}</td>
                                  <td>{{App\CourtBook::all()->where('case_type_id',$case_type->id)->count()}}</td>                           
                                  <td>
                                    <a href="{{route('case_types.show',$case_type->id)}}">Show cases</a>
                                  </td>                           
                                </tr>
                            @endforeach
                        </tbody>
                    </table>                   
                </div>
            </div>
        </div>
    @endsection