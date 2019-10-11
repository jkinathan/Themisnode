@extends('layouts.master')
@section('content')
<div class="card-box">

  <!-- <div class="row"> -->
  	<center>
  		<img src="{{asset('documents')}}/{{Auth::user()->company->logo_url}}" width="200">
  		<br>
  		<span>
  			Address:{{Auth::user()->company->location_address}}<br>
 	  		Phone Number:	{{Auth::user()->company->phone_number}}, Email: {{Auth::user()->company->email_address}} <br> Website: {{Auth::user()->company->website_url}}
  		</span>
  	</center> 	 
<!-- </div> -->

<br><br><br>
 
	<div class="row">

		
		<h3> <legend>Client Bio Data</legend></h3>
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			<table class="table table-hover table-striped" id="clients">
				<tr>
					<td>Client name </td><td><b>{{$read_Client->name}}</b></td>
				</tr>
				<tr>
					<td>Client number </td><td><b>{{$read_Client->client_number}}</b></td>
				</tr>

				<tr>
					<td>Client Type: </td><td><b>{{$read_Client->client_type}}</b></td>
				</tr>

				<tr>
					<td>Address: </td><td><b>{{$read_Client->address}}</b></td>
				</tr>

				<tr>
					<td>Phone Number: </td><td><b>{{$read_Client->phone_number}}</b></td>
				</tr>
				<tr>
					<td>Secondary Phone Number: </td><td><b>{{$read_Client->phone_number_2}}</b></td>
				</tr>
				<tr>
					<td>Contact person: </td><td><b>{{$read_Client->contact_person}}</b></td>
				</tr>

				<tr>
					<td>Email: </td><td><b>{{$read_Client->email}}</b></td>
				</tr>

				<tr>
					<td>Referred by: </td><td><b>{{$read_Client->reffered_by}} ( {{$read_Client->referred_by_name}} {{$read_Client->referred_by_phone}})</b></td>
				</tr>

				<tr>
					<td>Date registered: </td><td><b>{{date('d-m-Y',$read_Client->date_registered)}}</b></td>
				</tr>

				<tr>
					<td>Created By: </td><td><b>{{$read_Client->user->name}}</b></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="row">
		<h3> <legend>Matters</legend></h3>
		<ol>
		  @foreach($read_Client->matter as $save_Matter)
				<li>
				  <legend><u>{{$save_Matter->name}}</u></legend>

				     <div class="row">
		                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
		                    <table class="table table-hover table-striped" id="tabledetails">
		                        <tr><td>Name</td> <td><b>{{$save_Matter->name}}</b></td></tr>
		                        <tr><td>Number</td> <td><b>{{$save_Matter->matter_number}}</b></td></tr>
		                        <tr><td>Start date</td> <td><b>{{date('d-m-Y',$save_Matter->start_date)}}</b></td></tr>
		                        <tr><td>Client</td> <td><b>{{$save_Matter->client->name}}</b></td></tr>
		                        <?php try {?>
		                        	<tr><td>Originating Lawyer</td> <td><b>{{App\User::find($save_Matter->originating_lawyer)->name}}</b></td></tr>
		                        <?php } catch (\Exception $e) {
		                        	
		                        } ?>	                        
		                        

		                        <tr><td>Statutory Limit</td> <td><b>{{$save_Matter->statutery_limitation}}</b></td></tr>
		                        <tr><td>Status</td> <td><span class="btn btn-success">{{$save_Matter->status}}</span></td></tr>
		                         
		                        <tr><td>Practice area</td> <td>
		                            @foreach($save_Matter->practicearea as $practice_area)
		                              {{$practice_area->name}}; 
		                            @endforeach
		                        </td> </tr>
		                    </table>
		                    <strong>Description</strong>
		                    <br>
		                    <p>{{$save_Matter->description}}</p>

		                    
		                </div>
		                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">

		                    <h4>Lawyers</h4>
		                    <table class="table table-hover table-striped">
		                        @foreach($save_Matter->users as $user)
		                            <tr><td>{{$user->name}}</td> <td>{{$user->phone_number}}</td> <td>{{$user->email}}</td> </tr>
		                        @endforeach
		                    </table>

		                   	<h4>Parties</h4>
		                    <table class="table table-hover table-striped">
		                        @foreach($save_Matter->matterparty as $parties)                        
		                          <tr><td>{{$parties->party->name}}</td> <td>{{$parties->party->phone_number}}</td> <td>{{$parties->party->address}}</td> </tr>
		                        @endforeach                  
		                    </table>
		                    
		                    <h5>Documents</h5>   

		                     <table class="table table-hover table-striped">
		                         
		                        @foreach($save_Matter->document as $files)
		                            <tr>
		                                <td><a href="{{asset('documents')}}/{{$files->file_url}}">{{asset('documents')}}/{{$files->file_url}}</a></td>
		                            </tr>
		                        @endforeach
		                     </table>   

		                     <h5>Follow up documents</h5> 
		                     <table class="table table-hover table-striped">
		                         @foreach($save_Matter->matterfollowup as $follow_up)
		                            @foreach($follow_up->document as $files)
		                            <tr>
		                              <td>
		                                 <a href="{{asset('documents')}}/{{$files->file_url}}">{{asset('documents')}}/{{$files->file_url}}</a><br>
		                              </td>                              
		                            </tr>
		                             
		                            @endforeach
		                         @endforeach 
		                     </table>                         
		                </div>
		            </div>


		            <h3><legend>Records </legend></h3>
			            <div class="row">
			            	<ol>
				            	@foreach($save_Matter->matterfollowup as $follow_ups)
				            	   
				            	   	<li>
				            	   		<h4>{{$follow_ups->title}}</h4>
				            	   		<p>{{$follow_ups->description}}</p>
				            	   		<p>Recorded by {{$follow_ups->user->name}}</p>
				            	   		<p>Date: {{date('d-m-Y',$follow_ups->date_created)}}</p>
				            	   		@foreach($follow_ups->document as $files)
									    	<a href="{{asset('documents')}}/{{$files->file_url}}">{{asset('documents')}}/{{$files->file_url}}</a><br>
									    @endforeach 
				            	   	</li>
				            	  
				                @endforeach
			                 </ol>
			            </div>


			       <h3><legend>Court Book</legend></h3>
			       @foreach($save_Matter->courtbook as $read_CourtBook)

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
					            					
					            				} ?>
			            				
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
			                                <td><a href="{{asset('documents')}}/{{$files->file_url}}">{{asset('documents')}}/{{$files->file_url}}</a></td>
			                            </tr>
			                        @endforeach
			                     </table> 
			        			
			        		</div>
			        		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
			        			<h4>Opposing party</h4>
			        		 
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
			                            <td>{{$authority->name}}</td> <td>{{$authority->description}}</td> <td> 
			                        </tr>
			                        @endforeach
			                    </table>

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

				                <strong>Witnesses</strong>
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

			        	<h4>Court Book Follow-up</h4>

			        	<ol>
							<table class="table table-hover table-striped">
			        			@foreach($read_CourtBook->courtbookfollowup as $read_courtbookFollowup)
			        			<li>
					        	 	<tr>
					        	 		<td>Hearing Date</td> <td><strong>{{$read_courtbookFollowup->hearing_date}}</strong></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td>Place of Hearing:</td> <td><span> <strong>{{$read_courtbookFollowup->place_of_hearing}}</strong> </span></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td>Presiding Judge name:</td> <td><span> <strong>{{$read_courtbookFollowup->presiding_judge_name}}</strong> </span></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td>Court clerk name:</td> <td><span> <strong>{{$read_courtbookFollowup->court_clerk_name}}</strong> </span></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td>Court clerk Phone number:</td> <td><span> <strong>{{$read_courtbookFollowup->court_clerk_phonenumber}}</strong> </span></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td>Next hearing date:</td> <td><span> <strong>{{$read_courtbookFollowup->next_hearing_date}}</strong> </span></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td>Next hearing place:</td> <td><span> <strong>{{$read_courtbookFollowup->next_hearing_place}}</strong> </span></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td><p>{{$read_courtbookFollowup->notes}}</p></td> <td></td>
					        	 	</tr>

					        	 	<tr>
					        	 		<td><h4>Documents</h4>

									  	@foreach($read_courtbookFollowup->document as $files)
								            <a href="{{asset('documents')}}/{{$files->file_url}}">{{asset('documents')}}/{{$files->file_url}}</a>
								            @endforeach
								    	<br>
								    	<span>Recorded by {{$read_courtbookFollowup->user->name}}</span></td><td></td> 
					        	 	</tr>
					        	 </li>
							@endforeach
				        </table>
				    </ol>
				      

			       @endforeach


			        <h3><legend>Communications</legend></h3>

					<ol>
			            @foreach($save_Matter->communication as $communication)
			           
			                <li style="margin: 10px;">
			                  <h4>{{$communication->message_title}}</h4>
			                  <h5>{{$communication->matter->name}} ({{$communication->matter->matter_number}})</h5>
			                  <span>From: {{$communication->name_of_person}}</span><br>
			                  <span>{{$communication->message_body}}</span><br>
			                  <span class="text-success">Media: {{$communication->media_used}}</span><br>
			                  <span>Date: {{$communication->date_of_message}}</span><br>
			                  
			                  @foreach($communication->document as $files)
			                    <a href="{{asset('documents')}}/{{$files->file_url}}">{{asset('documents')}}/{{$files->file_url}}</a> 

			                  @endforeach			                  
			                </li>
			            
			             @endforeach
			        </ol>

			        <h3><legend>Expenses</legend></h3>

						<table class="table table-hover table-striped">
			                <thead>
			                 <th>#</th>
			                 <th>Description</th>
			                 <th>Date</th>
			                 <th>Supplier</th>
			                 <th>Invoice Number</th>
			                 <th>File</th>
			                 <th>User</th>
			                 <th>Amount</th>
			                </thead>

			                <tbody>
			                	<?php $total = 0; ?>
			                    @foreach($save_Matter->expense as $expenses)
			                      <tr>
			                        <td>{{$expenses->id}}</td>
			                        <td>{{$expenses->description}}</td>			                        
			                        <td>{{date('d-M-Y',$expenses->date_spent)}}</td>
			                        <td>{{$expenses->supplier_description}}</td>
			                        <td>{{$expenses->invoice_number}}</td>
			                        <td>
			                          @if(!empty($expenses->file_name))
			                            <a href="{{asset('documents')}}/{{$expenses->file_name}}">{{asset('documents')}}/{{$expenses->file_name}}</a>


			                          @endif
			                          </td>
			                        <td>{{$expenses->user->name}}</td>
			                        <td>{{number_format($expenses->amount)}}</td>

			                      </tr>
			                      <?php $total = $total +  $expenses->amount?>
			                    @endforeach

			                    <tr>
			                    	<th>Total</th>
					                 <th></th>
					                 <th></th>
					                 <th></th>
					                 <th></th>
					                 <th></th>
					                 <th></th>
					                 <th>{{number_format($total)}}</th>
			                    </tr>
			                </tbody>
			            </table> 


			</li>
		@endforeach
	</ol>
	</div>
</div>
@endsection

@section('styles')
	<style type="text/css">
		@media print{
			.card-box{
				float: none !important; 
				overflow: none;
			}
		}
	</style>
@endsection
