@extends('project.template')

@section('content')

  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

  <div class="w3-main" style="margin-left:250px;">

    <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
      <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
      <span id="myIntro" class="w3-hide">DR system: register</span>
    </div>

    <header class="w3-container w3-theme w3-padding-32" style="padding-left:32px" >
      <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
    </header>















<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->








<div class="w3-container w3-padding-16 w3-card-2" style="background-color:#eee">
    <br>
    <br>
    <br>

    <h1 class="w3-center">Register</h1>
    <div class="w3-content" style="max-width:500px">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {!! csrf_field() !!}



                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label>Name</label>

                            <div class="col-md-6">
                                <input type="text" class="w3-input w3-hover-sand" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

 <br>
          <!--   <p>                            
                <label">Name</label>
                <input type="name" class="w3-input w3-hover-sand" name="name">
            </p> -->

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="w3-input w3-hover-sand" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 <br>
           <!--  <p> 
                <label>E-Mail Address</label>
                <input type="password" class="w3-input w3-hover-sand" name="password">
            </p> -->

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label ">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="w3-input w3-hover-sand" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

 <br>

           <!--  <p>                          
                <label>Password</label>
                <input type="password" class="w3-input w3-hover-sand" name="password"> 
            </p>    --> 


                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label>Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="w3-input w3-hover-sand" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

 <br>
           <!--  <p>  
                <label>Confirm Password</label>
                <input type="password" class="w3-input w3-hover-sand" name="password">
            </p> -->

                <div class="form-group">
                  <center> 
                  <p>                         
                    <button type="submit" class="w3-btn w3-padding-12 w3-dark-grey" style="width:50%">
                        Register
                    </button>
                  </p>
                  </center>                           
                </div>

                      <!--   <div class="form-group">
                        <center> 
                            <p> 
                            <button type="submit" cclass="w3-btn w3-padding-12 w3-dark-grey" style="width:50%">
                                    Register
                                </button>
                            
                            </p>
                        </center>  
                        </div> -->


            <br>
        </form>
        <br>
      
    </div>

    <h1 style="background-color:#FFFFCC" class="w3-center">  </h1>
    <h1 style="background-color:#FFCC66" class="w3-center">  </h1>
    <h1 style="background-color:#FF9966" class="w3-center">  </h1>     
</div>




















@endsection
