@extends('layouts.master')

@section('content')
<div class="card-box">
    {{Form::model($read_Client,['method'=>'PATCH', 'action'=>['ClientController@update',$read_Client->id]])}}
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

                <label>Client Name</label>
                <input type="text" name="name" value="{{$read_Client->name}}" class="form-control">

                <!--<label>Client number</label>
                <input type="text" name="client_number" value="{{$read_Client->client_number}}" class="form-control">
                -->
                <label>Tin Number</label>
                <input type="text" name="tin_number" value="{{$read_Client->tin_number}}" class="form-control">

                <label>Client type</label>
                <select class="form-control" name="client_type" id="client_type">
                    <option></option>
                    <option value="individual">Individual</option>
                    <option value="company">Company</option>
                </select>

                <label>Address</label>
                <input type="text" name="address" value="{{$read_Client->address}}" class="form-control">

                <label>Phone Number</label>
                <input type="text" name="phone_number" value="{{$read_Client->phone_number}}" class="form-control">
                <br>
                <label>Secondary Phone Number</label>
                <input type="text" name="phone_number" value="{{$read_Client->phone_number_2}}" class="form-control">
                <br>
                <button class="btn btn-primary" type="submit">Save</button>                
            </div>

             <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
               <span class="contral_section">
                    <label>Contact Person</label>
                    <input type="text" name="contact_person" value="{{$read_Client->contact_person}}" class="form-control">
                </span>

                <label>Email Address</label>
                <input type="email" name="email" value="{{$read_Client->email}}" class="form-control">

                <label>Referred by</label>
                <select class="form-control select2" id="reffered_by" name="reffered_by">
                    <option></option>
                    <option value="institution">Institution</option>
                    <option value="individual">Individual</option>
                    <option value="Self">Self referred</option>
                </select>

                <span class="refree_section">

                    <label>Name of referee</label>
                    <input type="text" name="referred_by_name" value="{{$read_Client->referred_by_name}}" class="form-control">

                    <label>Phone Number of referee</label>
                    <input type="text" name="referred_by_phone" value="{{$read_Client->referred_by_phone}}" class="form-control">
                </span>

                <label>Date registered</label>
                <input type="date" name="date_registered" value="{{$read_Client->date_registered}}" class="form-control">             
        
            </div>
        </div>
    </div>
    {{Form::close()}}
@endsection
@push('scripts')
   <script type="text/javascript">
        $(document).ready(function() {
            $('#client_type').on('change',function(e){
                if ($("#client_type").val() == "individual") {
                    $(".contral_section").hide();
                }
                else{
                    $(".contral_section").show();
                }
           
            }) 
        })
   </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#reffered_by').on('change',function(e){
                if ($("#reffered_by").val() == "Self") {
                    $(".refree_section").hide();
                }
                else{
                    $(".refree_section").show();
                }           
            }) 
        })
   </script>
@endpush