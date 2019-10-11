@extends('layouts.master')
@section('content')
<div class="card-box">
    <!-- <form method="POST" action="{{route('matter_witness.store')}}"> -->
        <div class="row">
            <div class="col-md-6">
                @csrf
                <label>Name</label>
                <input type="text" id="name" class="form-control">

                <input type="hidden" id="matter_id" value="{{$read_Matter->id}}">

                <label>Phone Number</label>
                <input type="text" id="phone_number" class="form-control">

                <label>Address</label>
                <input type="text" id="address" class="form-control">              

                <br>
                <button class="btn btn-primary" id="newpar" type="submit">Save</button>
            </div>
        </div>
   <!-- </form>   -->
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
                matter_id:$("#matter_id").val(),              
                _token: "{{Session::token()}}"
            },
                success: function(result){
                    alert(result);
                    $("#name").val(" ");
                    $("#address").val(" ");
                    $("#phone_number").val(" ") ;                   
                }
        })
    });
  </script>
@endpush