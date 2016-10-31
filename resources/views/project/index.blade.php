@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Home</span>
  </div>

  <header class="w3-container w3-theme w3-padding-32" style="padding-left:32px" >
    <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
  </header>



  <style>
    .city {display:none;}
  </style>





  <div class="w3-container w3-padding-32" style="padding-left:32px">

    <hr>
    <!-- <h2>รายการแจ้งซ่อม</h2> -->
    <center>
      <div class="w3-row">
        <a href="#" onclick="openCity(event, 'London');">
          <div class="w3-third tablink w3-border-red w3-bottombar w3-hover-light-grey w3-padding"><h4>รายการแจ้งซ่อม</h4></div>
        </a>
        <a href="#" onclick="openCity(event, 'Paris');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h4>รายการซ่อมเสร็จ</h4></div>
        </a>
        <a href="#" onclick="openCity(event, 'Tokyo');">
          <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><h4>รายการซ่อมไม่ได้</h4></div>
        </a>
      </div>
    </center>
    
    <br>

    <div class="w3-container w3-sand w3-leftbar">
      <p><i>เมื่อผู้ใช้บริการทำการแจ้งซ่อมเรียบร้อยแล้ว สามารถตรวจสอบลำดับและสถานะการซ่อมได้ในตารางรายการซ่อม</i><br>
        หากไม่พบสถานะกรุณาทำการแจ้งซ่อมใหม่ หรือติดต่อเจ้าหน้าที่</p>
      </div>

<!-- <h2>W3.CSS Web Site Templates</h2>

<p>We have created some responsive W3CSS templates for you to use.</p>
<p>You are free to modify, save, share, use or do whatever you want with them:</p> -->

<br>

<div class="w3-container w3-padding-16 w3-card-2" style="background-color:#ECECEC">
  <!-- <h3 class="w3-center">Blog Template</h3> -->
  <div class="w3-content" style="max-width:800px">


  <!--   <table class="w3-table w3-striped w3-border">
      <thead>
        <tr class="w3-red">
          <th>ลำดับ</th>
          <th>ห้อง</th>
          <th>วันที่เจ้งซ่อม</th>
          <th>วันที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
          <th>สถานะ</th>
        </tr>
      </thead>
     @foreach($equipment as $v) 

      <tr>       
        <td>{{$v->id_equipment}}</td>
        <td>{{$v->num_room}}</td>
        <td>{{$v->date_in}}</td>
        <td>{{$v->date_repair}}</td>
        <td>{{$v->time_repair}}</td>
        <td>รอการซ่อม</td>
      </tr>
      
   
    @endforeach
  </table> -->


<!-- css textbox search -->
<style>
input[type=searchh] {
    width: 80%
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 10px;
    font-size: 16px;
    background-color: white;
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGYAAABmCAMAAAAOARRQAAAATlBMVEX///+SkpKPj4/z8/OMjIyysrKoqKivr6/t7e3n5+esrKyTk5P7+/ucnJz19fWlpaXQ0NDh4eHFxcXZ2dm4uLjDw8O9vb2amprNzc3W1tb1DK0TAAADMklEQVRoge1Za5OrIAxVxCqg4ANf//+PXktwpdW1Ae3O3BnPh53OLPUkOUmIaRTduHHjxo0bN/5rFGzUvJyh0q6V36HIp4xQSgiJ43j+S2nZsaupirof6JPAwcyVVcmVLEwPbxyWKVbTdSxNvEsCRDy/hoQ96Euk6KLQQlQVF7C0JVk5yqxvxrHp9CNepaLd+VSYFlUIFV2dS7BcJqxSK5E+yzNZWWZHNrHJ+aIZyc7FrbW+kHLce1CdLXFLz7Awqwvh9f4BOS7+jCdoHpblIPaTgDPDL4Yg0EAmk/7oUA0eExVaP8zGQx8faweQpwljKTSYyT9lawVOizB36gFy7HPQU4Lxeh9FT7AplNuEDGnXuXUGU3iQ1iREnclEnFYok5S57HhAL8iMhQL3TQgwQsZ3FMYZ0uFOMxHYChjQYO0zSUB676iNhqbE1oIGcbxzDb6XYS+Sys+qH3C/KECMBfOlgWCjK0GClP40pmrQqQOJSb9NEwGNd+GUfs09NGjQPpDVObebwBQwzf3odn5FG5jQnaF5YOvN3OcBFzWYF2OjADHW3s1GetwDUZQMoRcO1KfCHa5MhxatP40RJ6aoaBeQMCEzFLNzDeZsK4JnDgnXZ4wobI+jW1R22P9cOpWdO0NYokSBjR/7WiJg7AxIgCcmO9x+eIuVykPFPXBwRxzGXKZnXwly687RYCRTOBQHTupP2CGcDL82g0VAj7Fhi6KzptJ0t/JkJdb3aXSb3XmOXowtxw1R0WbuWoL6j08rT2Z3D4So/qVdJ1UqXJb5SBrOU6TLswgRpa6YLCKZt40a3khO6hON61rIbFIAzjZl/XhGn6h2lzYbD4YuW/99Rp8o6bYBsiSU15F0zDijz1yo2o3NGi1l+ljCnRBmpzZ5ScNLZ781fxRKL90hSS/SJ3ouIseel+K58BSl0k3rFFLi6nPOnydTkjPGasby/G2GuU6fY1yozzHPhfoc8lyqzwHPX+njdOyA1108z4s+3/kVwfC4+gRtpJA8jj7+L1UePKs+Avk6Ecbzo4+48GeKHR5u4ya+l2uGB/QJ3bGiIbWY8W2WGWyavhuxGzdu3LhxJf4BlaEcN6qRMjoAAAAASUVORK5CYII=');
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
</style>


  <div id="London" class="w3-container city" style="display: block;">
          <div class="w3-row">
          <div class="w3-col m4">
              <h2>รายการแจ้งซ่อม</h2>
            </div>
          <div class="w3-col m8">
              <input type="searchh" name="search" class="light-table-filter" data-table="order-table" placeholder="Search...">
              <!-- <input class="w3-input w3-animate-input" type="search" name="search" class="light-table-filter" data-table="order-table" style="width:70%" placeholder="Search..."> -->
            </div>
            
            
          </div>
    <table class="w3-table w3-striped w3-border order-table table">
      <thead>
        <tr class="w3-red">
          <th>ลำดับ</th>
          <th>ห้อง</th>
          <th>วันที่เจ้งซ่อม</th>
          <th>วันที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
          <th>สถานะ</th>
        </tr>
      </thead>
      @foreach($equipment as $v) 


      <tr>       
        <td>{{$v->id_equipment}}</td>
        <td>{{$v->num_room}}</td>
        <td>{{$v->date_in}}</td>
        <td>{{$v->date_repair}}</td>
        <td>{{$v->time_repair}}</td>
        <td>รอการซ่อม</td>
      </tr>
      

      @endforeach
    </table>

  </div>

  <div id="Paris" class="w3-container city">
    <h2>รายการซ่อมเสร็จ</h2>
    <table class="w3-table w3-striped w3-border">
      <thead>
        <tr class="w3-green">
          <th>ลำดับ</th>
          <th>ห้อง</th>
          <th>วันที่เจ้งซ่อม</th>
          <th>วันที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
          <th>สถานะ</th>
        </tr>
      </thead>


      @foreach($equipment as $v) 
   
      <tr>       
        <td>{{$v->id_equipment}}</td>
        <td>{{$v->num_room}}</td>
        <td>{{$v->date_in}}</td>
        <td>{{$v->date_repair}}</td>
        <td>{{$v->time_repair}}</td>
        <td>ซ่อมแล้ว</td>
      </tr>
      

      @endforeach
    </table>
  </div>


  <div id="Tokyo" class="w3-container city">
    <h2>รายการซ่อมไม่ได้</h2>
    <table class="w3-table w3-striped w3-border">
      <thead>
        <tr class="w3-pink">
          <th>ลำดับ</th>
          <th>ห้อง</th>
          <th>วันที่แจ้งซ่อม</th>
          <th>วันที่ซ่อมได้</th>
          <th>เวลาที่ซ่อมได้</th>
          <th>สถานะ</th>
        </tr>
      </thead> 
      
      
      @foreach($unrepair as $w) 
      {


      @foreach($equipmentdetail as $x)
      {
       @if($w->id_equipmentdetail==$x->id_equipmentdetail)
  {
  {{$x->id_equipmentdetail}}
 <!--  @foreach($equipment as $v)
  @if($x->id_equipment==$v->id_equipment) -->
      <!-- <tr>       
        <td>{{$x->id_equipment}}</td> -->
       <!--  <td>{{$x->num_room}}</td>
        <td>{{$x->date_in}}</td>
        <td>{{$x->date_repair}}</td>
        <td>{{$x->time_repair}}</td> -->
      <!--   <td>ซ่อมไม่ได้</td>
      </tr> -->
 <!-- 
      @endif
      @endforeach -->
  }
      @endif
      }

 

      @endforeach

 }
      @endforeach

    </table>
  </div>




  <script>
    function openCity(evt, cityName) {
      var i, x, tablinks;
      x = document.getElementsByClassName("city");
      for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
     }
     tablinks = document.getElementsByClassName("tablink");
     for (i = 0; i < x.length; i++) {
       tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
     }
     document.getElementById(cityName).style.display = "block";
     evt.currentTarget.firstElementChild.className += " w3-border-red";
   }
 </script>



<script src="//assets.codepen.io/assets/common/stopExecutionOnTimeout-53beeb1a007ec32040abaf4c9385ebfc.js"></script>
<script>(function (document) {
    'use strict';
    var LightTableFilter = function (Arr) {
        var _input;
        function _onInputEvent(e) {
            _input = e.target;
            var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
            Arr.forEach.call(tables, function (table) {
                Arr.forEach.call(table.tBodies, function (tbody) {
                    Arr.forEach.call(tbody.rows, _filter);
                });
            });
        }
        function _filter(row) {
            var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
            row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
        }
        return {
            init: function () {
                var inputs = document.getElementsByClassName('light-table-filter');
                Arr.forEach.call(inputs, function (input) {
                    input.oninput = _onInputEvent;
                });
            }
        };
    }(Array.prototype);
    document.addEventListener('readystatechange', function () {
        if (document.readyState === 'complete') {
            LightTableFilter.init();
        }
    });
}(document));
//# sourceURL=pen.js
</script>



 <br>
 <div class="w3-row">
 <!--  <div class="w3-col m6">
    <a href="tryw3css_templates_blog.htm" target="_blank" class="w3-btn w3-padding-12 w3-dark-grey" style="width:98.5%">Demo</a>
  </div>
  <div class="w3-col m6">
    <a href="w3css_templates.asp" class="w3-btn w3-padding-12 w3-dark-grey" style="width:98.5%">More Templates &raquo;</a>
  </div> -->
  <center>
    <ul class="w3-pagination w3-border w3-round">
      <li><a href="#">&laquo;</a></li>
      <li><a class="w3-red" href="#">1</a></li>
      <li><a href="#">2</a></li>
      <li><a href="#">3</a></li>
      <li><a href="#">4</a></li>
      <li><a href="#">5</a></li>
      <li><a href="#">&raquo;</a></li>
    </ul>
  </center>
</div>

</div>
</div>
</div>
<br>
@endsection