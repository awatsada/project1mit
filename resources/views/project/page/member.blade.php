@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Home</span>
  </div>

  <header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
    <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
  </header>
  
  <!-- css table -->
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>

  <!-- css textbox search -->
<!--   <style>
    input[type=searchh] {
      width: 80%
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
      background-color: white;
      background-size:30px 25px;
      background-position: 5px 10px;
      background-repeat: no-repeat;
      padding: 12px 20px 12px 40px;
      -webkit-transition: width 0.4s ease-in-out;
      transition: width 0.4s ease-in-out;
    }

    input[type=searchh]:focus {
      width: 100%;
    }
  </style> -->
  

  <div class="w3-container w3-padding-32" style="padding-left:32px">
    <h2>รายชื่อสมาชิก (รอการยืนยันสมาชิก)</h2>     
    <hr>

    <br>

    
      <div class="w3-content" style="max-width:800px">

        <!-- <form class="form-inline" action="search" method="POST">            
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
          <input type="searchh" name="search" placeholder="Search...">
        </form>  -->

    
@foreach ($user as $key => $v)

        <form class="w3-container w3-card-4" action="{{url('member')}}/{{$v->id}}" enctype="multipart/form-data" method="post">
       <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <br>
  
    <header class="w3-container w3-light-grey">
      <h3>ชื่อ : {{$v->name}}</h3>
    </header>
    <div class="w3-container">
      <p>Email : {{$v->email}}</p>
      <hr>
      <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
      <p>สถานะ : บุคลทั่วไป</p><br> 
      <br>
      <button class="w3-btn-block w3-green" type="submit">กำหนดสถานะเป็นช่าง</button>
    </div>
  

  <br>

              </form>  
            
@endforeach         
          </div>

            <br>

            

          </div>
       
        <br>



@endsection
