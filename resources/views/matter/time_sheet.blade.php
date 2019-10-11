@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<div class="card-box">

  <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#add_case" role="tab" aria-controls="home" aria-expanded="true">Time Sheet</a>
          </li>
                         
      </ul>
  <div class="tab-pane active" id="add_case">
  <form action="/matter/time/create" method="POST">
    {{ csrf_field() }}
    <div class="panel panel-default">
            <div class="panel-body"><strong>TimeSheet</strong></div>
          </div>
          <div class="row">
              @if (Request::isMethod('GET'))
                <div class="col-md-3">
                    <label>Report</label>
               
          <select class="form-control" name="mattername">
            
              @foreach($matterss as $matter)
                <option value="{{$matter->name}}">{{$matter->name}}</option>
              @endforeach
          </select>
                </div>
                        <div class="col-md-3">
          <label>Date From</label>
        <input type="date" name="from" placeholder="YYYY-MM-DD" class="form-control">
                        </div> 
                        <div class="col-md-3">
                                <label>Date To</label>
                              <input type="date" name="to" placeholder="YYYY-MM-DD" class="form-control">
                                              </div>  
                                                             
          </div>
          <br>
          <input class="btn btn-success" type="submit" value="Submit"/>
              
         </form> 
          <hr>
     @endif
                    
                    
                    @if (Request::isMethod('POST'))
                    
                    <div class="container">
                      <strong>DETAILS</strong>
                    <table class="table table-bordered table-striped" style="border: 2px solid #ddd !important">
                      {{-- <tr>
                        <th>Activity</th>
                        <td>
                            @foreach ($timesheetAct as $activity)
                            <td>{{ $activity->activity }}</td>
                            <td></td>
                            @endforeach
                        </td>
                        <th>Activity</th>
                        </tr>
                      <tr> --}}
                      <th>{{$mattersname}} </th>
                      <td>
                          @foreach ($read_mattertime as $item)
                            <td>{{Carbon\Carbon::parse($item->date)->format('D d M Y')}}
                              <br><b>Activity:</b>{{ $item->activity }}
                            </td>
                          <td></td>
                          @endforeach
                      </td>
                      <th>Totals</th>
                      </tr>
                      <tr>
                        <th>TimeinHours:</th>
                        <td>
                            @foreach ($read_mattertime as $item)
                            <td>{{$a[]=$item->timeinhours}}
                            
                            </td>
                            <td></td>
                            @endforeach
                        </td>;           
                        <th>Total:
                          <?php 
                            
                            $vart = array($a);
                            $varta = array_sum($a);
                            ?>
                        {{$varta}} Hours
                      </th>
                      </tr>
                      <tr><th>Totals:</th>
                      <td>
                      
                      </td>
                      @foreach ($read_mattertime as $item)
                            <td>{{$a[]=$item->timeinhours}}
                            
                            </td>
                            <td></td>
                      @endforeach
                      </tr>
                    </table>
                    </div>  
                    
                    
                        
                    
                    @else
                  
                    @endif
                  </tr>
                  <tr><td><br><br></td></tr>
                  
  </tbody>
    
              
</div>
                    </div>
</html>

@endsection