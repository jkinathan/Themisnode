@extends('layouts.master')

@section('content')
        <div class="card-box">
            <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-expanded="true">Add new client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile">View Clients</a>
                </li>              
            </ul>
       
 
            <div class="tab-content">
                <div class="tab-pane" id="home1">
                    <form method="POST" action="{{route('client.store')}}">
                        <div class="row">
                            <div class="col-md-6">
                                @csrf
                                <label>Client Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control">

                                <!--<label>Client number</label>
                                <input type="text" name="client_number" class="form-control">

                                <br>
                                -->
                                <label>TIN Number</label>
                                <input type="text" name="tin_number" class="form-control">

                                <br>

                                <label>Client type</label>
                                <select class="form-control" id="client_type" name="client_type">
                                    <option></option>
                                    <option value="individual">Individual</option>
                                    <option value="company">Company</option>
                                </select>
                                &nbsp;
                                <br>

                                <label>Address</label>
                                <input type="text" name="address" class="form-control">

                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control">
            
                                <br>
                                <label>Secondary Phone Number</label>
                                <input type="text" name="phone_number_2" class="form-control">

                                <br>
                                <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save</button>
                            </div>

                            <div class="col-md-6">
                                <span class="contral_section">                            
                                    <label>Contact Person</label>
                                    <input type="text" name="contact_person" class="form-control">
                                </span>

                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control">

                                <label>Referred by</label>
                                <select class="form-control" id="reffered_by" name="reffered_by">
                                    <option></option>
                                    <option value="institution">Institution</option>
                                    <option value="individual">Individual</option>
                                    <option value="Self">Self referred</option>
                                </select>

                            <span class="refree_section">

                                <label>Name of referee</label>
                                <input type="text" name="referred_by_name" class="form-control">

                                <label>Phone Number of referee</label>
                                <input type="text" name="referred_by_phone" class="form-control">
                              </span>

                                <label>Date registered</label>
                                <input type="date" name="date_registered" class="form-control"> 
                          
                                <br>                            
                                
                            </div>
                        </div>
                    </form>
                   
                </div>


                <div class="tab-pane active" id="profile1">

                    <table class="table table-hover table-striped" id="clients">
                        <thead>
                           <th>#</th> <th>Date registered</th> <th>Name</th>  <th>Phone Number</th> <th>Secondary Phone Number</th> <th>Client Number</th> <th>Client Type</th> <th>By</th> <th></th>
                        </thead>

                        <tbody>
                            @foreach($read_clients as $clients)
                              <tr>
                                  <td>{{$clients->id}}</td>
                                  <td>{{date('d-m-Y',$clients->date_registered)}}</td>
                                  <td><a href="{{route('client.show',$clients->id)}}">{{$clients->name}}</a></td>
                                
                                  <td>{{$clients->phone_number}}</td>
                                  <td>{{$clients->phone_number_2}}</td>
                                   <td>{{$clients->client_number}}</td>
        
                                   <td>{{$clients->client_type}}</td>
                                   <td>{{$clients->user->name}}</td>
                                   <td>
                                    <a class="btn btn-primary" href="{{route('client.edit',$clients->id)}}">Edit</a>
                                    <!-- <a href="{{route('event_user.show',$clients->id)}}" class="btn btn-success">Report</a> -->
                                   </td>
                              </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
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