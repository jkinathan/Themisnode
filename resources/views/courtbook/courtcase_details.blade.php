@extends('layouts.master')
@section('content')
<div class="card-box">

            <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">                
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-expanded="true">Case details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#witness" role="tab" aria-controls="home" aria-expanded="true">+ Witness(es)</a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_authorities" role="tab" aria-controls="home" aria-expanded="true">+ Authority(ies)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_partenering_lawfirm" role="tab" aria-controls="home" aria-expanded="true">+ Partnering Law firm(s)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#opposingparties" role="tab" aria-controls="home" aria-expanded="true">+ Opposing party(ies)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#opposite_advocates" role="tab" aria-controls="home" aria-expanded="true">+ Opposing advocate(s)</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#follow_up" role="tab" aria-controls="profile">+ Case Record</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#records" role="tab" aria-controls="profile">Case Records</a>
                </li>

                                
            </ul>

	 

    <div class="tab-content">

        <div class="tab-pane" id="add_partenering_lawfirm">
            <h2>Add Partnering Law Firm(s)</h2>
             <div class="row">
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                  
                    <label>Firm Name</label>
                    <input type="text" id="firm_name" class="form-control">

                    <label>Contact person name</label>
                    <input type="text" id="person_name" class="form-control">

                    <label>Contact person Phone Number</label>
                    <input type="text" id="contact_phone_number" class="form-control">

                    <label>Contact person Email address</label>
                    <input type="text" id="contact_email" class="form-control">

                    <label>Firm Address</label>
                    <input type="text" id="contact_address" class="form-control">
 
                    <input type="hidden" id="authority_courtbook_id" value="{{$read_CourtBook->id}}"><br>
                    <button id="save_firm" class="btn btn-info">Save</button>
                  
                </div>
            </div> 
            
        </div>

      <div class="tab-pane" id="add_authorities">
          <h2>Add Authorities</h2>
         <div class="row">
            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
              
                <label>Name</label>
                <input type="text" id="authority_name" class="form-control">
                <label>Description</label>
                <textarea id="authority_description" class="form-control"></textarea> 
                <input type="hidden" id="authority_courtbook_id" value="{{$read_CourtBook->id}}"><br>
                <button id="save_authority" class="btn btn-info">Save</button>
              
            </div>
        </div>        
      </div>

        <div class="tab-pane" id="opposite_advocates">

            <h4>Opposing advocate</h4>

             <div class="row">
                <div class="col-md-6">                   
                    <label>Name</label>
                    <input type="text" id="advocate_name" class="form-control">

                    <label>Phone Number</label>
                    <input type="text" id="advocate_phone_number" class="form-control">

                    <label>Address</label>
                    <input type="text" id="advocate_address" class="form-control"> 

                    <input type="hidden" id="advocate_courtbook_id" value="{{$read_CourtBook->id}}">

                    <br>
                    <button class="btn btn-primary" id="advocates_btn" type="submit">Save</button>
                </div>
            </div>



        </div>
        <div class="tab-pane" id="opposingparties">
            <h4>Opposing Party</h4>
            <div class="row">
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" id="opposing_party_name" class="form-control">

                    <label>Phone Number</label>
                    <input type="text" name="phone_number" id="opposing_party_phone_number" class="form-control">

                    <label>Address</label>
                    <input type="text" name="address" id="opposing_address" class="form-control"> 

                    <input type="hidden" name="courtbook_id" id="opposingparty_courtbook_id" value="{{$read_CourtBook->id}}">

                    <br>
                    <button class="btn btn-primary" id="opposing_party" type="submit">Save</button>
                </div>
            </div>




        </div>

         <div class="tab-pane" id="witness">
            <h4>Witness</h4>

            <div class="row">
                <div class="col-md-6">                   
                    <label>Name *</label>
                    <input type="text" id="name" class="form-control">

                    <input type="hidden" id="courtbook_id" value="{{$read_CourtBook->id}}">

                    <label>Phone Number *</label>
                    <input type="text" id="phone_number" class="form-control">

                    <label>Address *</label>
                    <input type="text" id="address" class="form-control">

                    <label>Witness type *</label>
                    <select class="form-control" id="witness_type">
                        <option></option>
                        <option value="Potential">Potential</option>
                        <option value="Actual">Actual</option>
                    </select>


                    <br>
                    <button class="btn btn-primary" id="newpar" type="submit">Save</button>
                </div>
            </div>

         </div>
        <div class="tab-pane active" id="details">

        	<div class="row">
        		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

        			<table class="table table-hover table-striped" id="casedetails">
        				<tr>
                            <td>Case opening date</td>
                            <td><b>{{date('d-m-Y',$read_CourtBook->care_openning_date)}}</b></td> </tr>
            				<tr><td>Name</td> <td><b>{{$read_CourtBook->alias_name}}</b></td> </tr>
                            <tr><td>Matter</td> <td><b>{{$read_CourtBook->matter->name}}</b></td> </tr>
                            <?php try {
                                ?>

                                <tr><td>Case type</td> <td><b>{{$read_CourtBook->casetype->name}}</b></td> </tr>

                              <?php
                              } catch (\Exception $e) {
                                
                              }?>
                            <tr><td>Client Name</td> <td><b>{{$read_CourtBook->matter->client->name}}</b></td> </tr>
            				<tr><td>Client Phone</td> <td><b>{{$read_CourtBook->matter->client->phone_number}}</b></td> </tr>
            				<tr><td>Created by</td> <td><b>{{$read_CourtBook->user->name}}</b></td> </tr>
                    </table>

                    <strong>Description</strong><br>
                    <p>{{$read_CourtBook->alias_description}}</p>

                     <h5>Documents</h5>
                     <table class="table table-hover table-striped">
                        @foreach($read_CourtBook->document as $files)
                            <tr>
                                <td><a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a></td>
                            </tr>
                        @endforeach
                     </table>  
        			
        		</div>
        		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        			<h4>Opposing parties</h4>
        		 
        			<table class="table table-hover table-striped">
        				@foreach($read_CourtBook->opposingparty as $party)

        				<tr>
        					<td>{{$party->name}}</td> <td>{{$party->phone_number}}</td> <td>{{$party->address}}</td>
        			    </tr>

        				@endforeach
        			</table>

        			<h4>Opposing Advocates</h4>
        			<table class="table table-hover table-striped">
        				@foreach($read_CourtBook->opposingadvocates as $party)

        				<tr>
        					<td>{{$party->name}}</td> <td>{{$party->phone_number}}</td> <td>{{$party->address}}</td>
        			    </tr>

        				@endforeach
        			</table>

                    <h4>Authority</h4>
                    <table class="table table-hover table-striped">
                        @foreach($read_CourtBook->matterauthority as $authority)
                        <tr>
                            <td>{{$authority->name}}</td> <td>{{$authority->description}}</td>  
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="row">             
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <h4>Add Partnering Law Firm(s)</h4>
                    <table class="table table-hover table-striped">
                        <th>Name</th> <th>Contact person</th> <th>Phone</th> <th>Email</th> <th>Address</th>
                        @foreach($read_CourtBook->partneringfirm as $partneringfirms)
                        <tr>
                            <td>{{$partneringfirms->name}}</td>
                            <td>{{$partneringfirms->contact_name}}</td>
                            <td>{{$partneringfirms->contact_phone}}</td> 
                            <td>{{$partneringfirms->contact_email}}</td>
                            <td>{{$partneringfirms->address}}</td>
                        </tr>
                        @endforeach
                    </table>

                    <h4>Witnesses</h4>
                    <table class="table table-hover table-striped">
                      <th>Name</th> <th>Phone</th> <th>Address</th> <th>Type</th>
                      @foreach($read_CourtBook->matterwitness as $witness)
                        <tr>
                          <td>{{$witness->name}}</td> <td>{{$witness->phone_number}}</td> <td>{{$witness->address}}</td> <td>{{$witness->witness_type}}</td>
                        </tr>
                      @endforeach
                    </table>
        			 
        		</div>
        	</div>

        	

        </div>

        <div class="tab-pane" id="records">

        	<table class="table" id="court_records">
        		<thead>
        			<th>Hearing date</th> 
                    <th>Case stage</th> 
                    <th>Place of hearing</th> 
                    <th>Presiding judge name</th>
                    <th>Court clerk name</th> 
                    <th>Next hearing date</th>
                    <th>Next hearing place</th>
                    <!-- <th>Files</th> -->
                    <th>Action</th>
        		</thead>

        		<tbody>
        			@foreach($read_CourtBook->courtbookfollowup as $follow_ups)
        			  <tr>
        			  	<td>{{$follow_ups->hearing_date}}</td>
        			  	<td>{{$follow_ups->case_stage}}</td>
        			  	<td>{{$follow_ups->place_of_hearing}}</td>
        			  	<td>{{$follow_ups->presiding_judge_name}}</td>
        			  	<td>{{$follow_ups->court_clerk_name}} {{$follow_ups->court_clerk_phonenumber}}</td>
        			  
         			  	<td>{{$follow_ups->next_hearing_date}}</td>
        			  	<td>{{$follow_ups->next_hearing_place}}</td>
        			  	<!-- <td> 
							@foreach($follow_ups->document as $files)
                          		<a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a>@endforeach

        			  	</td> -->
                        <td>
                            <a class="btn btn-info" href="{{route('court_followup.show',$follow_ups->id)}}">View details</a>
                        </td>
        			  </tr>
        			@endforeach
        		</tbody>
        	</table>

        </div>

        <div class="tab-pane" id="follow_up">
	 		<form method="POST" action="{{route('court_followup.store')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        @csrf

                        <label>Place of hearing</label>
                        <input type="text" name="place_of_hearing" class="form-control">

                        <label>Presiding judge name</label>
                        <input type="text" name="presiding_judge_name" class="form-control">

                        <label>Court clerk name</label>
                        <input type="text" name="court_clerk_name" class="form-control"> 

                        <label>Court clerk phone number</label>
                        <input type="text" name="court_clerk_phonenumber" class="form-control">

                        <label>Case stage</label>
                        <select class="form-control" name="case_stage">
                        	<option></option>
                        	<option value="Arrest">Arrest</option>
                        	<option value="Bail">Bail</option>
                            <option value="Arraignment">Arraignment</option>
                            <option value="Pre-Trial Hearing">Pre-Trial Hearing</option>
                            <option value="Pre-Trial Motions">Pre-Trial Motions</option>
                            <option value="Trial">Trial</option>
                            <option value="Sentencing">Sentencing</option>
                            <option value="Appeal">Appeal</option>
                            <option value="Closed">Closed</option>
                        </select>                        

                        <input type="hidden" name="courtbook_id" value="{{$read_CourtBook->id}}">

                        <br>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>

                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <label>Hearing date</label>
                    <input type="date" name="hearing_date" class="form-control"> 
					<label>Notes</label>
                    <textarea name="notes" class="form-control"></textarea> 

                    <label>Next hearing date</label>                       
                    <input type="date" name="next_hearing_date" class="form-control">

                    <label>Next hearing place</label>
                    <input type="text" name="next_hearing_place" class="form-control">
                    <br>
                    <label>Any files</label><br>
                    <input type="file" name="documents[]" multiple="multiple">
                                    
                </div>


            </div>
           </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    $("#newpar").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('matter_witness.store') }}",
            data: {
                name: $("#name").val(),
                address: $("#address").val(),
                phone_number: $("#phone_number").val(),
                courtbook_id:$("#courtbook_id").val(),
                witness_type:$("#witness_type").val(),           
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#name").val(" ");
                    $("#address").val(" ");
                    $("#phone_number").val(" ");
                    $("#witness_type").val(" ");
                }
        })
    });
  </script>


  <script type="text/javascript">
    $("#opposing_party").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('opposite_party.store') }}",
            data: {
                name: $("#opposing_party_name").val(),
                address: $("#opposing_address").val(),
                phone_number: $("#opposing_party_phone_number").val(),
                courtbook_id:$("#opposingparty_courtbook_id").val(),
                 _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#opposing_party_name").val(" ");
                    $("#opposing_address").val(" ");
                    $("#opposing_party_phone_number").val(" ");               
                }
        })
    });
  </script>

  <script type="text/javascript">
    $("#advocates_btn").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('opposite_advocates.store') }}",
            data: {
                name: $("#advocate_name").val(),
                address: $("#advocate_address").val(),
                phone_number: $("#advocate_phone_number").val(),
                courtbook_id:$("#advocate_courtbook_id").val(),
                 _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#advocate_name").val(" ");
                    $("#advocate_address").val(" ");
                    $("#advocate_phone_number").val(" ");               
                }
        })
    });
  </script>

<script type="text/javascript">
    $("#save_authority").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('matter_authority.store') }}",
            data: {
                name: $("#authority_name").val(),
                description: $("#authority_description").val(),
                courtbook_id: $("#authority_courtbook_id").val(),
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#authority_name").val(" ");
                    $("#authority_description").val(" ");
                 }
        })
    });
  </script>


  <script type="text/javascript">
    $("#save_firm").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('parnering_firms.store') }}",
            data: {
                name: $("#firm_name").val(),
                contact_name: $("#person_name").val(),
                contact_phone: $("#contact_phone_number").val(),
                address: $("#contact_address").val(),
                contact_email: $("#contact_email").val(),
                courtbook_id: $("#authority_courtbook_id").val(),
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#firm_name").val(" ");
                    $("#person_name").val(" ");
                    $("#contact_phone_number").val(" ");
                    $("#contact_address").val(" ");
                    $("#contact_email").val(" ");
                 }
        })
    });
  </script>


@endpush