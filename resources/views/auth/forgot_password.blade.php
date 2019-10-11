@extends('layouts.login_master')
@section('content')
<div class="account-bg">   
    <div class="card-box m-b-0">
        <div class="text-xs-center m-t-20">
           <!--  <a href="/" class="logo">
                <i class="zmdi zmdi-group-work icon-c-logo"></i>
                <span>{{ config('app.name', '') }}</span>
            </a> -->
        </div>
        <center>
             <img src="{{asset('documents/favicon.PNG')}}" width="20%">
        </center>
       
        <div class="m-t-30 m-b-20">
            <div class="col-xs-12 text-xs-center">
                <h6 class="text-muted text-uppercase m-b-0 m-t-0">Forgot my password</h6>
            </div>

             @if (session('status'))
                    <div class="alert alert-warning">
                        {{ session('status') }}
                    </div>
                @endif  

            <form class="form-horizontal m-t-20"  method="POST" action="/forgot_password">
                {{ csrf_field() }}

                <div class="form-group ">
                    <div class="col-xs-12">
                       <label>Email</label>
                       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="danger">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

 

                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-danger btn-block waves-effect waves-light" type="submit">Log In</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        <a href="login" class="text-muted"><i class="fa fa-lock m-r-5"></i> Login </a>
                    </div>
                </div>            

            </form>

        </div>
    </div>
</div>
@endsection

