@extends('layouts.master')

@section('content')
<div class="card-box">
	 <table class="table" id="matters">
                <thead>
                 <th>Client Name</th> <th>Matter</th> <th>Number</th> <th>Start date</th> <th>Matter Stage</th>
                 
                </thead>

                <tbody>
                    @foreach($matter_practice_area as $matter_pa)
                    <?php $matter = App\Matter::find($matter_pa->matter_id); ?>
                      <tr>
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
                        
                      </tr>
                    @endforeach
                </tbody>
              </table>
</div>
@endsection