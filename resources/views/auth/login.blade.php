@extends("project.template")
@section("content")
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

  <div class="w3-main" style="margin-left:250px;">

    <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
      <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
      <span id="myIntro" class="w3-hide">DR system: Login</span>
    </div>

    <header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
      <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
    </header>






<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!} -->
<!-- {{bcrypt("adminadmin")}} -->
                        <!-- <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input type="name" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 -->













<div class="w3-container w3-padding-32" style="padding-left:32px">
<br>
<br>
<br>

<h1 class="w3-center">เข้าสู่ระบบ</h1>

<div class="w3-content" style="max-width:500px">



<form class="w3-container" role="form" method="POST" action="{{ url('/login') }}">

{!! csrf_field() !!}


<!-- <label>Username</label>
<input class="w3-input w3-hover-theme" type="text"> -->

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
<p>                            <label">ชื่อผู้ใช้</label>
                                <input type="name" class="w3-input w3-hover-sand" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
</p>
</div>

<!-- <p>
<label>Password</label>
<input class="w3-input w3-hover-theme" type="text"></p> -->



<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>รหัสผ่าน</label>
                                <input type="password" class="w3-input w3-hover-sand" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
</div>


<!-- <p>
<input class="w3-check w3-hover-theme" type="checkbox">
<label class="w3-validate">Remember Me</label></p> -->



<div class="form-group">
<!--  <p>
<input class="w3-check w3-hover-theme" type="checkbox" name="remember">
<label class="w3-validate">Remember Me</label></p>  -->
</div>






<!-- <p><center>
<button class="w3-btn w3-padding-12 w3-dark-grey" style="width:50%"> Log in </button></p>
<p><a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a></p>

</center> -->

<div class="form-group">
  <p><center>                          
                                <button type="submit" class="w3-btn w3-padding-12 w3-dark-grey" style="width:50%">
                                    เข้าสู่ระบบ
                                </button></p>

                               <p> <a class="btn btn-link" href="{{ url('/password/reset') }}">ลืมรหัสผ่าน</a>
</p>

</center>                           
                        </div>




<br>
</form>

</div>

<h1 style="background-color:#FFFFCC" class="w3-center">  </h1>
<h1 style="background-color:#FFCC66" class="w3-center">  </h1>
<h1 style="background-color:#FF9966" class="w3-center">  </h1>     
</div>









@endsection
