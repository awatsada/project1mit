<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<body>

  <h2>รายละเอียดการแจ้งซ่อมทั่วไป</h2>
  <hr>
  <div class="w3-container w3-sand w3-leftbar">
    <p><strong>ลำดับ : </strong><i>{{$Eq->id_equipment}}</i></p>
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

    <br>
    <br>
    <h2>รายละเอียดอุปกรณ์</h2>
    <hr>
    <br>

    @foreach($Eqd as $v)
    <header class="w3-container w3-blue">
      <h2>ลำดับ {{$v->id}}</h2>
    </header>

    <p><strong>ลำดับอุปกรณ์ : </strong><i>{{$v->id_equipment}}</i></p> 
    <p><strong>อุปกรณ์ : </strong><i>{{$v->equipment}}</i></p> 
    <p><strong>รายละเอียดอุปกรณ์ : </strong><i>{{$v->detail_equipment}}</i></p> 
    <p>  
      <strong>ภาพอุปกรณ์  </strong>
      <h1><img src="{{asset('upload/repair/')}}/{{$v->photo_repair}}" class="w3-border w3-padding-4 w3-padding-tiny" alt="Norway" style="width:30%"></h1>
    </p>
    @endforeach
  </div>

</body>
</html>