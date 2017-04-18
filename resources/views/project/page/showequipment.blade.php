@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Show Equipment</span>
  </div>

  <header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
    <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
  </header>


<!--   <style>
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
    <h2>รายละเอียดการแจ้งซ่อมทั่วไป</h2> 
    <a class="w3-btn w3-teal" href="{{url('getpdf')}}/{{$Eq->id_equipment}}">Export PDF</a>
   <!--  <form class="w3-container" action="re/report" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <p>
              <button class="w3-btn w3-yellow w3-border" type="submit" >Export PDF</button></p>
            </form> -->
<!-- <a class="w3-btn w3-blue" href="{{url('re/report')}}/{{$Eq->id_equipment}}">Print</a> -->
    <hr>

    <div class="w3-container w3-sand w3-leftbar">
      <!-- <p><strong>ลำดับ : </strong><i>{{$Eq->id_equipment}}</i></p> -->
      <p><strong>ห้อง : </strong><i>{{$Eq->num_room}}</i></p>
      <p><strong>เบอร์โทรศัพท์ : </strong><i>{{$Eq->phone_number}}</i></p>
      <p><strong>วันที่แจ้งซ่อม : </strong><i>{{$Eq->date_in}}</i></p> 
      <p><strong>วันที่ซ่อมได้ : </strong><i>{{$Eq->date_repair}}</i></p> 
      <p><strong>เวลาที่ซ่อมได้ : </strong><i>{{$Eq->time_repair}}</i></p>    
      @if ($Eq->live == 1)
      <p><strong>ต้องการให้ช่างซ่อมบำรุงเข้าซ่อมในช่วงเจ้าของห้องพัก : </strong><i>อยู่</i></p> 
      @else
      <p><strong>ต้องการให้ช่างซ่อมบำรุงเข้าซ่อมในช่วงเจ้าของห้องพัก : </strong><i>ไม่อยู่</i></p> 
      @endif

       @if ($Eq->note)
            
                          <p><strong>อื่นๆ : </strong><i>{{$Eq->note}}</i></p> 
  
            @endif
    </div>

    <br>
    <br>
    <h2>รายละเอียดอุปกรณ์</h2>
    <hr>
    <br>

    <div class="w3-container w3-padding-16 w3-card-2" style="background-color:#ECECEC">
      <div class="w3-content" style="max-width:800px">
        @foreach($Eqd as $v)
        <div class="w3-card-4 test" style="width:100%"> 

          <header class="w3-container w3-blue">
            <!-- <h2>ลำดับ {{$v->id}}</h2> -->
            <h2>อุปกรณ์ : <i>{{$v->equipment}}</i></h2>
          </header>

          <div class="w3-container">
            <div class="w3-panel w3-padding-4 w3-sand">
              <!-- <p><strong>ลำดับอุปกรณ์ : </strong><i>{{$v->id_equipment}}</i></p>  -->
              <!-- <p><strong>อุปกรณ์ : </strong><i>{{$v->equipment}}</i></p>  -->
              <p><strong>รายละเอียดอุปกรณ์ : </strong><i>{{$v->detail_equipment}}</i></p> 
             
            </div>detail_equipment
            @if ($v->photo_repair)
            <strong>ภาพอุปกรณ์  </strong>
            <h1><img src="{{asset('upload/repair/')}}/{{$v->photo_repair}}" class="w3-border w3-padding-4 w3-padding-tiny" alt="Norway" style="width:30%"></h1>  
            @endif
         </div>

        <footer class="w3-container w3-blue"></footer>
        </div>

           @endforeach



         

        <br>

        <form action="{{url('sh/recordequipment')}}/{{$Eq->id_equipment}}" method="get">
         <p><center><button class="w3-btn w3-pink">บันทึกการซ่อม</button></center></p>
       </form>
  

     </div> 
     </div> 
     </div> 


 
@endsection