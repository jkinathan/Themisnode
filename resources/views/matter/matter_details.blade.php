@extends('layouts.master')

@section('content')
<div class="card-box">

    <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#matters_details" role="tab" aria-controls="profile">Details</a>
        </li>  

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#records" role="tab" aria-controls="home" aria-expanded="true">Records</a>
        </li> 

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_records" role="tab" aria-controls="home" aria-expanded="true">Add Records</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_parties" role="tab" aria-controls="home" aria-expanded="true">Add parties</a>
        </li> 
    

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#task" role="tab" aria-controls="home" aria-expanded="true">Tasks</a>
        </li> 

         <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_task" role="tab" aria-controls="home" aria-expanded="true">Add Task</a>
        </li>
<!-- new 
         <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="home" aria-expanded="true">Expense</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_expense" role="tab" aria-controls="home" aria-expanded="true">Add Expense</a>
        </li> 
   endnew -->
        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#billings" role="tab" aria-controls="home" aria-expanded="true">Billing</a>
        </li> 

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="home" aria-expanded="true">Add Time Spent</a>
        </li>    
    </ul>

 

    <div class="tab-content">

      <div class="tab-pane" id="add_parties">
        <h4>Add Matter parties</h4>

         <input type="text" id="party_names" class="form-control" placeholder="Full names (Required)">
          <br>

          <input type="text" id="party_phone" class="form-control" placeholder="Phone(Required)">
          <br>

          <input type="hidden" id="party_matter_id" value="{{$save_Matter->id}}">

          
          <input type="text" id="party_address" class="form-control" placeholder="Address (Required)">
          <br>
          
          <a href="#" id="newparty" class="btn btn-success">Add</a>

      </div>


<!--
new time spent div testing
-->
<div class="tab-pane" id="profile2">
  <form action="/matter_time" method="POST">
    {{ csrf_field() }}
         <div class="row">
                    <div class="col-md-6">
                        
                        <label>Matter Name</label>
                        <select class="form-control inputstl" name="mattername">
                        <option value="{{$save_Matter->name}}">{{$save_Matter->name}}</option>
                        </select>
                        <!--<select class="form-control inputstl" name="mattername">
                              @foreach($matters as $matter)
                          <option value="{{$matter->name}}">{{$matter->name}}</option>
                            @endforeach
                        </select>-->
                        
                        <label>Activity</label>
                        <input class="form-control inputstl" type="text" name="activity" placeholder="Activity"/>
                    <!--<input type="text" name="mattername" class="form-control">
                    --> <label>Date </label>
                        <input type="date" name="date" placeholder="YYYY-MM-DD" class="form-control">
                        <label>Time in hours</label>
                        <input class="form-control inputstl" type="number" name="timeinhours" placeholder="Time in hours">
    
                        <br>
                        <form method="POST" action="/matter_time">
                          @csrf
                        <input class="btn btn-success" name="submit" type="submit" value="Save"/>
                        </form>
                      </div>
         </div>
    </form>

</div>
<!-- end new -->
      <div class="tab-pane" id="communications">

        <ol class="navigation-menu">
            @foreach($readCommunication as $communication)
            <div class="card-box">
                <li style="margin: 10px;">
                  <h4>{{$communication->message_title}}</h4>
                  <h5>{{$communication->matter->name}} ({{$communication->matter->matter_number}})</h5>
                  <span>From: {{$communication->name_of_person}}</span><br>
                  <span>{{$communication->message_body}}</span><br>
                  <span class="text-success">Media: {{$communication->media_used}}</span><br>
                  <span>Date: {{$communication->date_of_message}}</span><br>

                  <h4>Documents</h4>
                  
                  @foreach($communication->document as $files)
                    <a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a> 
                  @endforeach

                  
                </li>
              </div>
             @endforeach
          </ol>
        
      </div>


        <div class="tab-pane" id="billings">
            <h4>Billing</h4>

             <ul class="nav nav-tabs m-b-10" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#hourly_rate" role="tab" aria-controls="profile">Hourly rate</a>
                </li>  

                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#flat_fee" role="tab" aria-controls="home" aria-expanded="true">Flat Fee</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#billing_records" role="tab" aria-controls="home" aria-expanded="true">Records</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#expense" role="tab" aria-controls="home" aria-expanded="true">Expenses</a>
                    
                </li> 
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#add_expense" role="tab" aria-controls="home" aria-expanded="true">Add Expenses</a>
                    
                </li> 
            </ul>


            <div class="tab-content">
                <div class="tab-pane" id="hourly_rate">

                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <form method="POST" action="{{route('billing.store')}}">
                                 @csrf
                                 <label>Particulars</label>
                                 <textarea name="particulars" class="form-control"></textarea>

                                 <label>Number of hours</label>
                                 <input type="number" step="any" name="number_of_hours" class="form-control">

                                 <label>Amount per hour</label>
                                 <input type="text" name="amount" class="form-control numberss">

                                 <label>Date</label>
                                 <input type="date" name="date_billed" class="form-control">

                                 <input type="hidden" name="billing_type" value="hourly">
                                 <input type="hidden" name="matter_id" value="{{$save_Matter->id}}">

                                 <br>
                                 <button type="submit" class="btn btn-info">Save bill</button>
                            </form>
                        </div>
                    </div>
                   
                </div>
<!-- new -->
<div class="tab-pane" id="add_expense">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
         
    <form method="POST" action="{{route('matter_expenses.store')}}" enctype="multipart/form-data">
      
              @csrf
              <label>Particulars</label>
              <input type="text" name="description" class="form-control">

              <label>Amount</label>
              <input type="text" name="amount" class="form-control number">

              <label>Date</label>
              <input type="date" name="date_spent" class="form-control">
             

              <label>Supplier Details</label>
              <input type="text" name="supplier_description" class="form-control">

              <label>Invoice number</label>
              <input type="text" name="invoice_number" class="form-control">

              <label>Any file?</label><br>
              <input type="file" name="filename"><br>

              <input type="hidden" name="matter_id" value="{{$save_Matter->id}}">
              <br>
              <button class="btn btn-primary" type="submit">Save</button>                       
        
    </form>
</div>                       
</div>
</div>
<!-- endnew -->
                <div class="tab-pane" id="flat_fee">
                     <div class="row">
                        <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                            <form method="POST" action="{{route('billing.store')}}">
                                 @csrf
                                 <label>Particulars</label>
                                 <textarea name="particulars" class="form-control"></textarea>

                                 <label>Amount</label>
                                 <input type="text" name="amount" class="form-control numbers">

                                 <label>Date</label>
                                 <input type="date" name="date_billed" class="form-control">

                                 <input type="hidden" name="billing_type" value="flat">
                                 <input type="hidden" name="matter_id" value="{{$save_Matter->id}}">

                                 <br>
                                 <button type="submit" class="btn btn-info">Save bill</button>
                            </form>
                        </div>
                    </div>
                </div>
<!--  new -->
<div class="tab-pane" id="expense">
        <div class="row">
                <div class="table table-hover table-striped">
                
    <h3>Expenses</h3>
       <table class="table table-hover table-striped" id="tadetails">
          <thead>
           <th>#</th>
           <th>Description</th> 
           <th>Amount</th> 
           <th>Date</th>
           <th>Supplier</th>
           <th>Invoice Number</th>
           <th>File</th>
           <th>Recorded by</th>
          </thead>
             
          <tbody>
              <?php
                  $totals = 0;
              ?>    
              @foreach($read_expenses as $expenses)
              <?php
                  $totals += $expenses->amount;
              ?>
                <tr>
                  <td>{{$expenses->id}}</td>
                  <td>{{$expenses->description}}</td>
                  <td>{{number_format($expenses->amount)}}</td>
                  <td>{{date('d-M-Y',$expenses->date_spent)}}</td>
                  <td>{{$expenses->supplier_description}}</td>
                  <td>{{$expenses->invoice_number}}</td>
                  <td>
                    @if(!empty($expenses->file_name))
                      <a href="{{asset('documents')}}/{{$expenses->file_name}}">File</a>
                    @endif
                    </td>
                  <td>{{$expenses->user->name}}</td>                         
                </tr>
                
              @endforeach
              
              <tr>
                      <td>Total</td><td> </td> <td>{{$totals}} </td> <td> </td></td>
                     </tr>
          </tbody>
      </table>  
    </div>
</div>
  </div>

<!-- endnew -->
                <div class="tab-pane active" id="billing_records">
                  <h3>Billing records</h3>
                    <table class="table table-hover table-striped" id="billingrecords">
                        <thead>
                            <th>#</th><th>Recorded by</th> <th>Date recorded</th> <th>Date billed</th> <th>Billing type</th> <th>Particulars</th> <th>Number of hours</th> <th>Unit Amount</th> <th>Total amount</th> <th>Status</th>
                        </thead>

                        <tbody>
                          <?php $total=0; ?>
                            @foreach(App\Billing::all()->where('matter_id',$save_Matter->id) as $matter_bills)
                            <tr>
                                <td>{{$matter_bills->id}}</td>
                                <td>{{$matter_bills->user->name}}</td>
                                <td>{{$matter_bills->created_at}}</td>
                                <td>{{date('d-m-Y',$matter_bills->date_billed)}}</td>
                                <td>
                                    @if($matter_bills->billing_type=="hourly")
                                        <span class="btn btn-success">{{$matter_bills->billing_type}}</span>
                                     @elseif($matter_bills->billing_type=="flat")
                                        <span class="btn btn-info">{{$matter_bills->billing_type}}</span>
                                    @endif 

                                </td>
                                <td>{{$matter_bills->particulars}}</td>
                                <td>{{$matter_bills->number_of_hours}}</td>
                                <td>{{number_format($matter_bills->amount)}}</td>
                                <td>
                                    @if($matter_bills->billing_type=="hourly")
                                        {{number_format($matter_bills->amount*$matter_bills->number_of_hours)}}
                                          <?php $total=$total+ $matter_bills->amount*$matter_bills->number_of_hours?>
                                    @elseif($matter_bills->billing_type=="flat")
                                        {{number_format($matter_bills->amount)}}
                                          <?php $total=$total+ $matter_bills->amount?>
                                    @endif                                    
                                </td>

                                <td>
                                  @if($matter_bills->status==0)
                                    <span class="text-danger"><a title="Click to mark as Invoiced" href="{{route('billing.edit',$matter_bills->id)}}" style="color: red;"> Not Invoiced </a></span>
                                  @elseif($matter_bills->status==1)
                                    <span class="text-success">Invoiced</span>
                                  @endif
                                </td>


                            </tr>
                            @endforeach
                            <tr>
                             <td>Total</td><td></td> <td></td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td>{{number_format($total)}}</td><td></td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>

        <div class="tab-pane active" id="matters_details">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                    <table class="table table-hover table-striped" id="tabledetails">
                        <tr><td>Name</td> <td><b>{{$save_Matter->name}}</b></td></tr>
                        <tr><td>Number</td> <td><b>{{$save_Matter->matter_number}}</b></td></tr>
                        <tr><td>Start date</td> <td><b>{{date('d-m-Y',$save_Matter->start_date)}}</b></td></tr>
                        <tr><td>Client</td> <td><b><a href="{{route('client.show',$save_Matter->client->id)}}">{{$save_Matter->client->name}}</a></b></td></tr>
                        <?php try {?>
                              <tr><td>Originating Lawyer</td> <td><b>{{App\User::find($save_Matter->originating_lawyer)->name}}</b></td></tr>
                            <?php } catch (\Exception $e) {
                              
                            } ?>
                        <tr><td>Statutory Limit</td> <td><b>{{$save_Matter->statutery_limitation}}</b></td></tr>
                        <tr><td>Status</td> <td><span class="btn btn-success">{{$save_Matter->status}}</span></td></tr>
                        <tr><td>Description</td> <td>{{$save_Matter->description}}</td> </tr>
                        <tr><td>Practice area</td> <td>
                            @foreach($save_Matter->practicearea as $practice_area)
                              {{$practice_area->name}}; 
                            @endforeach
                        </td> </tr>
                    </table>
                </div>
                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">

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
                                <td>

                                 <a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a>

 

                                </td>
                            </tr>
                        @endforeach
                     </table>   

                     <h5>Follow up documents</h5> 
                     <table class="table table-hover table-striped">
                         @foreach($save_Matter->matterfollowup as $follow_up)
                            @foreach($follow_up->document as $files)
                            <tr>
                              <td>
                                 <a href="{{asset('documents')}}/{{$files->file_url}}">{{$files->file_title}}</a><br>
                              </td>                              
                            </tr>
                             
                            @endforeach
                         @endforeach 
                     </table>                         
                </div>
            </div>

           

        </div>

        <div class="tab-pane" id="records">

             <table class="table table-hover table-striped" id="table_records">
                <thead>
                 <th>Subject</th> <th>Recorded by</th> <th>Date</th>
                </thead>

                <tbody>
                    @foreach($read_MatterFollowup as $follow_ups)
                      <tr>
                        <td><a href="{{route('matter_follow.edit',$follow_ups->id)}}">{{$follow_ups->title}}</a></td>
                        <td>{{$follow_ups->user->name}}</td>
                        <td>{{date('d-m-Y',$follow_ups->date_created)}}</td>                      
                      </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="tab-pane" id="add_records">

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                    <form method="POST" action="{{route('matter_follow.store')}}" enctype="multipart/form-data">
                        @csrf
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">

                        <label>Stage</label>
                        <select class="form-control" name="status">
                            <option></option>
                            <option value="process">Under process</option>
                            <option value="ruling">Ruling</option>
                            <option value="postponed">Postponed</option>
                            <option value="abandoned">Abandoned</option>
                            <option value="done">Done</option>
                        </select>

                        <label>Date</label>
                        <input type="date" name="date_created" class="form-control">
                        
                        <label>Description</label>
                        <textarea  name="description" class="form-control"></textarea>

                        <label>Any files</label><br>
                        <input type="file" name="documents[]" multiple="multiple">
                        
                        <input type="hidden" name="matter_id" value="{{$save_Matter->id}}">
                         
                        <br><br>
                        <button class="btn btn-primary" type="submit">Save</button>

                    </form>
                </div>
            </div>
            
        </div>

        <div class="tab-pane" id="add_task">

                    <form method="POST" action="{{route('matter_task.store')}}" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-6">
                                @csrf
                                <label>Title</label>
                                <input type="text" name="name" class="form-control">

                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Start date</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>                                    
                                    <div class="col-md-6">
                                        <label>Start Time</label>
                                        <input type="time" name="start_time" class="form-control">
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>End date</label>
                                        <input type="date" name="end_date" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>End time</label>
                                        <input type="time" name="end_time" class="form-control">
                                    </div>
                                </div>

                                

                                <div class="row">
                                  
                                    <div class="col-md-3">
                                      <label>Reminder Type</label>
                                         <select class="form-control" name="mode">
                                           <option value="SMS">SMS</option>
                                           <option value="Email">Email</option>
                                           <option value="SMSEmail">Both SMS and Email</option>
                                         </select>
                                    </div>

                                    <div class="col-md-3">
                                      <label>Reminder period</label>
                                      <input type="number" min="0" name="remider_number" class="form-control">
                                    </div> 

                                    <div class="col-md-3">
                                      <label>.</label>
                                        <select class="form-control" name="period">
                                          <option value="Minutes">Minutes</option>
                                          <option value="Hours">Hours</option>
                                          <option value="Days">Days</option>
                                          <!-- <option value="Weeks">Weeks</option> -->
                                        </select>
                                    </div>                                    
                                </div>

                                <br><br>
                                <button class="btn btn-primary" type="submit">Save</button>

                            </div>

                             <div class="col-md-6">

                                <input type="hidden" name="matter_id" value="{{$save_Matter->id}}">
                                <br>

                                <label>Other users to see this task</label>
                                 <select class="multi-select" name="users[]" id="fsg_service_id_medical" multiple="multiple">
                                    <option></option>
                                     @foreach(App\User::all()->where('company_id',Auth::user()->company_id) as $user)
                                       <option value="{{$user->id}}">{{$user->name}}</option>
                                     @endforeach
                                 </select>

                             <!--    <label>Any files</label><br>
                                <input type="file" name="documents[]" multiple="multiple"> -->
                              
                                                          
                            
                            </div>
                        </div>
                     </form>

        </div>

         <div class="tab-pane" id="task">

            <ol>
               
                    @foreach($read_Task as $tasks)
                     <div class="card-box">
                        <li>
                            <h4>{{$tasks->name}}</h4>
                            <span>{{$tasks->description}}</span><br>
                            <span style="color: green;">From: {{$tasks->start_time}}  To: {{$tasks->end_time}}</span><br>
                             @if($tasks->status==0)
                              <span class="text-warning">Pending</span>

                              @else

                              <span class="text-success">Completed</span>

                            @endif
                            <br>
                            <legend>People involved</legend>
                             @foreach($tasks->users as $user)
                                <span class="text-success"> {{$user->name}} {{$user->phone_number}}</span>, 
                             @endforeach

                             <br>
                              @if($tasks->status==0)
                                <a class="text-danger" href="{{route('party.show',$tasks->id)}}">Mark as complete</a>
                            @endif
                        </li>
                      </div>
                     @endforeach        
                  </ol>
                </div>

        <div class="tab-pane" id="expense">
          <h3>Expenses</h3>
             <table class="table table-hover table-striped" id="tadetails">
                <thead>
                 <th>#</th>
                 <th>Description</th> 
                 <th>Amount</th> 
                 <th>Date</th>
                 <th>Supplier</th>
                 <th>Invoice Number</th>
                 <th>File</th>
                 <th>Recorded by</th>
                </thead>
                   
                <tbody>
                    <?php
                        $totals = 0;
                    ?>    
                    @foreach($read_expenses as $expenses)
                    <?php
                        $totals += $expenses->amount;
                    ?>
                      <tr>
                        <td>{{$expenses->id}}</td>
                        <td>{{$expenses->description}}</td>
                        <td>{{number_format($expenses->amount)}}</td>
                        <td>{{date('d-M-Y',$expenses->date_spent)}}</td>
                        <td>{{$expenses->supplier_description}}</td>
                        <td>{{$expenses->invoice_number}}</td>
                        <td>
                          @if(!empty($expenses->file_name))
                            <a href="{{asset('documents')}}/{{$expenses->file_name}}">File</a>
                          @endif
                          </td>
                        <td>{{$expenses->user->name}}</td>                         
                      </tr>
                      
                    @endforeach
                    
                    <tr>
                            <td>Total</td><td> </td> <td>{{$totals}} </td> <td> </td></td>
                           </tr>
                </tbody>
            </table>  

        </div>

        <div class="tab-pane" id="add_expense">

            <form method="POST" action="{{route('matter_expenses.store')}}" enctype="multipart/form-data">
              <div class="row">
                  <div class="col-md-6">
                      @csrf
                      <label>Particulars</label>
                      <input type="text" name="description" class="form-control">

                      <label>Amount</label>
                      <input type="text" name="amount" class="form-control number">

                      <label>Date</label>
                      <input type="date" name="date_spent" class="form-control">
                     

                      <label>Supplier Details</label>
                      <input type="text" name="supplier_description" class="form-control">

                      <label>Invoice number</label>
                      <input type="text" name="invoice_number" class="form-control">

                      <label>Any file?</label><br>
                      <input type="file" name="filename"><br>

                      <input type="hidden" name="matter_id" value="{{$save_Matter->id}}">
                      <br>
                      <button class="btn btn-primary" type="submit">Save</button>                       
                  </div>                       
              </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        var el = document.querySelector('input.number');
        el.addEventListener('keyup', function (event) {
          if (event.which >= 37 && event.which <= 40) return;
          this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });

        var el = document.querySelector('input.numbers');
        el.addEventListener('keyup', function (event) {
          if (event.which >= 37 && event.which <= 40) return;
          this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });

        var el = document.querySelector('input.numberss');
        el.addEventListener('keyup', function (event) {
          if (event.which >= 37 && event.which <= 40) return;
          this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
    </script>

  <script type="text/javascript">
    $("#newparty").click(function() {
        $.ajax({
                type: "POST",
                url: "{{ route('party.store') }}",
            data: {
                name: $("#party_names").val(),
                phone: $("#party_phone").val(),
                matter_id: $("#party_matter_id").val(),
                address: $("#party_address").val(),              
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result)
                    $("#party_names").val("")
                    $("#party_phone").val("")
                    $("#party_address").val("")             
                }
        })
    });
  </script>
@endpush