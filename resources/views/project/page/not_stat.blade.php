@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Statistic</span>
  </div>

  <header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
    <h1 class="w3-xxxlarge w3-padding-5">Dormitory Repairing System for PSU</h1>

    <!-- tab -->
    <style>
      .city {display:none;}
    </style>

  </header>
  

  <div class="w3-container w3-padding-32" style="padding-left:32px">
    <div class="w3-container w3-padding-16 w3-card-2" style="background-color:#FFFFFF">

      <div class="w3-container w3-section w3-topbar w3-bottombar w3-border-green w3-pale-green">
        <center>
          <h1>ไม่สามารถแสดงสถิติของ ({{$month}}) ได้</h1>
          <h2>เนื่องจากท่านยังไม่มีบันทึกการซ่อมของ ({{$month}})</h2>
        </center>
      </div>
      <br>

      <form class="w3-container" action="statt" enctype="multipart/form-data" method="post">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <p><input name="month" type="month" />
    <input id="pdf" class="w3-check" type="checkbox"  name="pdf">
    <label class="w3-validate">PDF</label>
          
          <button class="w3-btn w3-blue w3-border" type="submit">แสดง</button></p>
        </form>

   
      

     
        <div class="w3-container">
        <center><h2><font color="red">กรุณาบันทึกการซ่อม</h2></font></center>
  <hr>
            <div class="w3-container w3-center">
 
  <img src="https://scontent.fbkk10-1.fna.fbcdn.net/v/t1.0-9/17155157_1073744012730619_6980382826849071615_n.jpg?oh=c6d568178a4d48a1e0563d29d867526c&oe=59692438" alt="car" style="width:20%">
  
</div>


          </div>


          <br>

        </div>
      </div>










     @endsection
