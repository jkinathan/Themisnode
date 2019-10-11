@extends('layouts.master')

@section('content')
<div class="card-box">
    

            <table class="table" id="billing">
                <thead>
                  <th>#</th>  <th>Title</th> <th>Body</th> <th>From</th> <th>To</th> <th>Users</th> <th>Action</th>
                </thead>

                <tbody>
                    @foreach($events as $event)
                      <tr>
                          <td>{{$event->id}}</td>
                          <td>{{$event->title}}</td>
                          <td>{{$event->description}}</td>
                          <td>{{$event->start}}</td>
                          <td>{{$event->end}}</td>

                          <td>
                              @foreach($event->eventuser as $users)
                                {{$users->user->name}},  
                              @endforeach
                          </td>
                          <td>
                             <form action="/matter_event/{{ $event->id }}" method="POST">
                                    {{method_field('DELETE')}}
                                    {{ csrf_field() }}
                                       <a href="{{route('matter_event.edit',$event->id)}}" class="btn btn-info">Add Users</a>
                                    <input type="submit" class="btn btn-danger" value="Delete"/>
                                </form>
                            
                        </td>
                          
                      </tr>


                
                    @endforeach
                </tbody>
            </table>           
        </div>
@endsection