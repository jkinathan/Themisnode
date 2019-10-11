@extends('layouts.master')

@section('content')
<div class="card-box">
    {{Form::model($save_CourtBook,['files' => true,'method'=>'PATCH', 'action'=>['CourtBookController@update',$save_CourtBook->id]])}}

     <div class="row">
      <div class="col-md-12">
          @csrf

          <label>Choose matter</label>
          <select class="form-control" name="matter_id">
              @foreach($matters as $matter)
                  <option value="{{$matter->id}}">{{$matter->name}}</option>
               @endforeach
          </select>

          <label>Case title</label>
          <input type="text" name="alias_name" value="{{$save_CourtBook->alias_name}}" class="form-control">

          <label>Case Number</label>
          <input type="text" name="case_number" value="{{$save_CourtBook->case_number}}" class="form-control">

          <label>Case opennig date</label>
          <input type="date" name="care_openning_date" value="{{$save_CourtBook->care_openning_date}}" class="form-control">

          <label>Case description</label>
          <input type="text" name="alias_description" class="form-control" value="{{$save_CourtBook->alias_description}}">
 
          <label>Any case files</label><br>
          <input type="file" name="documents[]" multiple="multiple">
          <br><br>
          <button class="btn btn-primary" type="submit">Save</button>
    </div>
  </div>
</div>
    
    {{Form::close()}}
@endsection