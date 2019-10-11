@extends('layouts.master')
@section('content')
	<div class="card-box">
		<table class="table table-hover table-striped" id="billingrecords">
            <thead>
                <th>#</th> <th>Matter Name</th> <th>Matter ID</th> <th>Recorded by</th> <th>Date recorded</th> <th>Date billed</th> <th>Billing type</th> <th>Particulars</th> <th>Number of hours</th> <th>Unit Amount</th> <th>Total amount</th> <th>Status</th>
            </thead>

            <tbody>
              <?php $total=0; ?>
                @foreach($billings as $matter_bills)
                <tr>
                    <td>{{$matter_bills->id}}</td>
                    <td>{{$matter_bills->matter->name}}</td>
                    <td><a href="matter_details/{{$matter_bills->matter->id}}">{{$matter_bills->matter->matter_number}}</a> </td>
                    <td>{{$matter_bills->user->name}}</td>
                    <td>{{$matter_bills->created_at}}</td>
                    <td>{{date('d-M-Y',$matter_bills->date_billed)}}</td>
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
                 <td>Total</td><td></td> <td></td> <td></td> <td></td> <td> </td> <td> </td> <td> </td> <td> </td> <td> </td> <td>{{number_format($total)}}</td><td></td>
                </tr>
            </tbody>
        </table>     
    </div>
@endsection  