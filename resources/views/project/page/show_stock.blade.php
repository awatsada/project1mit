@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Home</span>
  </div>

  <header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
    <h1 class="w3-xxxlarge w3-padding-5">Dormitory Repairing System for PSU</h1>
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
    <h2>รายการอุปกรณ์สำรอง</h2>     
    <hr>
    <div class="w3-container w3-sand w3-leftbar">
      <p><i>เพื่อความสะดวกในการใช้งานสามารถค้นหาข้อมูลที่ต้องการได้โดยการพิมพ์ในช่อม Search...</i><br>
      </p>
    </div>
    <br>

    <div class="w3-container w3-padding-16 w3-card-2" style="background-color:#ECECEC">
      <div class="w3-content" style="max-width:800px">

        <!-- <form class="form-inline" action="search" method="POST">            
          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />  
          <input type="searchh" name="search" placeholder="Search...">
        </form>  -->

        <input type="searchh" name="search" class="w3-input w3-animate-input" data-table="order-table" placeholder="Search...">
        <br>
        
        <table class="order-table table">
          <thead>
            <tr>
              <th>ลำดับ</th>
              <th>ชื่ออุปกรณ์</th>
              <th>จำนวนอุปกรณ์</th>
            </tr>
          </thead>

          @foreach($equipment as $key => $v) 
          <tbody>
            <tr>       
              <td>{{$key+1}}</td>
              <td>{{$v->name}}</td>
              <td>{{$v->number}}</td>
             
            </tr>
            <tbody>    
              @endforeach
            </table>
          </div>

            <br>

            <div class="w3-row">
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
            </div>

          </div>
        </div>
        <br>

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


@endsection
