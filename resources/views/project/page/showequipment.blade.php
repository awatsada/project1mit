@extends("project.template")
@section("content")

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Show Equipment</span>
  </div>

  <header class="w3-container w3-theme w3-padding-32" style="padding-left:32px" >
    <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
  </header>

<!-- 
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
  </style> -->




  <div class="w3-container w3-padding-32" style="padding-left:32px">
    <h2>รายละเอียดการแจ้งซ่อมทั่วไป</h2> <a href="{{url('getpdf')}}/{{$user->id_equipment}}">Export to PDF</a>
    <hr>
    <div class="w3-container w3-sand w3-leftbar">
      <p><strong>ลำดับ : </strong><i>{{$user->id_equipment}}</i></p>
      <p><strong>ห้อง : </strong><i>{{$user->num_room}}</i></p>
      <p><strong>เบอร์โทรศัพท์ : </strong><i>{{$user->phone_number}}</i></p>
      <p><strong>วันที่แจ้งซ่อม : </strong><i>{{$user->date_in}}</i></p> 
      <p><strong>วันที่ซ่อมได้ : </strong><i>{{$user->date_repair}}</i></p> 
      <p><strong>เวลาที่ซ่อมได้ : </strong><i>{{$user->time_repair}}</i></p>    
       

@if ($user->live == 1)
    <p><strong>ต้องการให้ช่างซ่อมบำรุงเข้าซ่อมในช่วงเจ้าของห้องพัก : </strong><i>อยู่</i></p> 
@else
    <p><strong>ต้องการให้ช่างซ่อมบำรุงเข้าซ่อมในช่วงเจ้าของห้องพัก : </strong><i>ไม่อยู่</i></p> 
@endif




      </div>

<!-- <h2>W3.CSS Web Site Templates</h2>

<p>We have created some responsive W3CSS templates for you to use.</p>
<p>You are free to modify, save, share, use or do whatever you want with them:</p> -->
<br>
<br>
<h2>รายละเอียดอุปกรณ์</h2>
<hr>

<br>
<div class="w3-container w3-padding-16 w3-card-2" style="background-color:#ECECEC">
  <!-- <h3 class="w3-center">Blog Template</h3> -->
  <div class="w3-content" style="max-width:800px">




@foreach($user1 as $v)
<div class="w3-card-4 test" style="width:100%"> 
<header class="w3-container w3-blue">
  <h2>ลำดับ {{$v->id}}</h2>
</header>
<div class="w3-container">
<div class="w3-panel w3-padding-4 w3-sand">
<p><strong>ลำดับอุปกรณ์ : </strong><i>{{$v->id_equipment}}</i></p> 
<p><strong>อุปกรณ์ : </strong><i>{{$v->equipment}}</i></p> 
<p><strong>รายละเอียดอุปกรณ์ : </strong><i>{{$v->detail_equipment}}</i></p> 
<p>
</div>
<strong>ภาพอุปกรณ์  </strong>
<h1><img src="{{asset('upload/repair/')}}/{{$v->photo_repair}}" class="w3-border w3-padding-4 w3-padding-tiny" alt="Norway" style="width:30%"></h1></p>
</div>
<footer class="w3-container w3-blue">
 <!-- <p><center><button class="w3-btn w3-pink"><a href="{{url('/record')}}">บันทึกการซ่อม</a></button></center></p> -->

 <form action="{{url('sh/recordequipment')}}/{{$v->id}}" method="get">
 <p><center><button class="w3-btn w3-pink">บันทึกการซ่อม</button></center></p>
 </form>
</footer>

</div>
<br>

 @endforeach



<!-- <div class="w3-row">
            
              <p>ลำดับ : <i>{{$user->id_equipment}}</i></p>
           
              <p>ห้อง : <i>{{$user->num_room}}</i></p>
            

<div class="w3-container">
  <table class="w3-table w3-striped w3-border">
    <thead>
      <tr class="w3-red">
        <th>ลำดับ</th>
          <th>ห้อง</th>
          <th>วันที่เจ้งซ่อม</th>
          <th>วันที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
      </tr>
    </thead>
    <tr>
      <td>{{$user->id_equipment}}</td>
          <td>{{$user->num_room}}</td>
          <td>{{$user->date_in}}</td>
          <td>{{$user->date_repair}}</td>
          <td>{{$user->time_repair}}</td>
    </tr>

  </table>
</div>

<br>
<br>
<br> -->

<!-- <div class="w3-container">
  <table class="w3-table w3-striped w3-border">
    <thead>
      <tr class="w3-red">
        <th>ลำดับ</th>
          <th>ลำดับอุปกรณ์</th>
          <th>อุปกรณ์</th>
          <th>รายละเอียดอุปกรณ์</th>
          <th>ภาพอุปกรณ์</th>
           <th>บันทึกการซ่อม</th>
      </tr>
    </thead>
    @foreach($user1 as $v)
    <tr>
      <td>{{$v->id}}</td>
          <td>{{$v->id_equipment}}</td>
          <td>{{$v->equipment}}</td>
          <td>{{$v->detail_equipment}}</td>
           <td><img src="{{asset('upload/repair/')}}/{{$v->photo_repair}}" class="w3-border w3-padding-4 w3-padding-tiny" alt="Norway" style="width:50%"></td>
    </tr>
  @endforeach
  </table>
</div>

 -->






 
<!--     <table>
      <thead>
        <tr class="danger">     
          <th>ลำดับ</th>
          <th>ห้อง</th>
          <th>วันที่เจ้งซ่อม</th>
          <th>วันที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
        </tr>
      </thead>
      <tbody>
        <tr>       
          <td>{{$user->id_equipment}}</td>
          <td>{{$user->num_room}}</td>
          <td>{{$user->date_in}}</td>
          <td>{{$user->date_repair}}</td>
          <td>{{$user->time_repair}}</td>
        </tr>
      </tbody>
    </table>
    <hr>
    <hr>
    <table>
      <thead>
        <tr class="danger">     
          <th>ลำดับ</th>
          <th>ลำดับอุปกรณ์</th>
          <th>อุปกรณ์</th>
          <th>รายละเอียดอุปกรณ์</th>
          <th>ภาพอุปกรณ์</th>
           <th>บันทึกการซ่อม</th>
        </tr>
      </thead>
      @foreach($user1 as $v) 
      <tbody>
        <tr>
          <td>{{$v->id}}</td>
          <td>{{$v->id_equipment}}</td>
          <td>{{$v->equipment}}</td>
          <td>{{$v->detail_equipment}}</td>
           <td><img src="{{asset('upload/repair/')}}/{{$v->photo_repair}}" style="width:50%"></td>
            <td><a href="{{url('sh/record')}}/{{$v->id_equipment}}">บันทึกการซ่อม</a></td>
        </tr>
      </tbody>
      @endforeach
    </table> -->
    <br>
<!-- <div class="w3-row">
  <div class="w3-col m6">
    <a href="tryw3css_templates_blog.htm" target="_blank" class="w3-btn w3-padding-12 w3-dark-grey" style="width:98.5%">Demo</a>
  </div>
  <div class="w3-col m6">
    <a href="w3css_templates.asp" class="w3-btn w3-padding-12 w3-dark-grey" style="width:98.5%">More Templates &raquo;</a>
  </div>
  <center>
    <ul class="w3-pagination w3-border w3-round">
      <li><a href="#">&laquo;</a></li>
      <li><a class="w3-green" href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li><a href="#">&raquo;</a></li>
    </ul>
  </center>
</div> -->

</div>
</div>

<br>

@endsection