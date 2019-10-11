@extends('layouts.master')
@section('content')
	<div class="card-box">
		<table class="table table-hover table-striped" id="tadetails">
	        <thead>
	         <th>#</th>
	         <th>Matter</th>
	         <th>Description</th> 
	        
	         <th>Date</th>
	         <th>Supplier</th>
	         <th>Invoice Number</th>
	         <th>File</th>
	         <th>Recorded by</th>
	          <th>Amount</th> 
	        </thead>

	        <tbody>
	        	<?php $sum_total=0; ?>
	            @foreach($expense as $expenses)
	              <tr>
	                <td>{{$expenses->id}}</td>
	                <td><a href="matter_details/{{$expenses->matter->id}}">{{$expenses->matter->matter_number}}</a></td>
	                <td>{{$expenses->description}}</td>
	                
	                <td>{{date('d-M-Y',$expenses->date_spent)}}</td>
	                <td>{{$expenses->supplier_description}}</td>
	                <td>{{$expenses->invoice_number}}</td>
	                <td>
	                  @if(!empty($expenses->file_name))
	                    <a href="{{asset('documents')}}/{{$expenses->file_name}}">File</a>
	                  @endif
	                  </td>
	                <td>{{$expenses->user->name}}</td> 
	                <td>{{number_format($expenses->amount)}}</td>                        
	              </tr>
	              <?php $sum_total = $sum_total +  $expenses->amount;?>
	            @endforeach

	            <tr>
		         <th>Total</th>
		         <th></th>
		         <th></th> 
		         <th></th> 
		         <th></th>
		         <th></th>
		         <th></th>
		         <th></th>
		         <th>{{number_format($sum_total)}}</th>
	            </tr>
	        </tbody>
	   </table>
    </div>
@endsection  