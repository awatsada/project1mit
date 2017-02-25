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


    <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

      window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
    theme: "theme2",//theme1
    title:{
      text: ""              
    },
    animationEnabled: false,   // change to true
    data: [              
    {
      // Change type to "bar", "area", "spline", "pie",etc.     
      type: "column",
      dataPoints: [
      @foreach($count_change as $v)
      {  label: "{{$v->equiment}} (เปลี่ยน)",  y: {{$v->count_c}}  },
      @endforeach

      @foreach($count_repair as $v)
      {  label: "{{$v->equiment}} (ซ่อม)",  y: {{$v->count_r}}  },
      @endforeach

      @foreach($count_unrepair as $v)
      {  label: "{{$v->equiment}} (ซ่อมไม่ได้)",  y: {{$v->count_u}}  },
      @endforeach
      ]
    }
    ]
  });
        chart.render();
      }
    </script>

  </header>
  

  <div class="w3-container w3-padding-32" style="padding-left:32px">
    <div class="w3-container w3-padding-16 w3-card-2" style="background-color:#FFFFFF">

      <div class="w3-container w3-section w3-topbar w3-bottombar w3-border-green w3-pale-green">
        <center>
          <h1>สถิติการซ่อม ({{$month}})</h1>
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

<!-- <form class="w3-container" action="stat/pdf" enctype="multipart/form-data" method="post">
          
            <p>
              <input name="month" type="month" />
              <button class="w3-btn w3-green w3-border" type="submit">Export PDF</button></p>
            </form>
 -->
        <br>
        
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>

        <br>
        <hr>

        <br>
        <div class="w3-container">
        <!--   <center> -->
<!--           <form class="w3-container" action="stat/print" enctype="multipart/form-data" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <p>
              <input name="month" type="month" />
              <button class="w3-btn w3-yellow w3-border" type="submit">Print</button></p>
            </form> -->

          
<!-- </center> -->
<!--             <a class="w3-btn w3-yellow w3-border" href="stat/report">Export PDF</a>
            <a class="w3-btn w3-blue w3-border" href="#">Export Excel</a> -->
            


          </div>


          <br>

        </div>
      </div>

      <!-- tab -->
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








     @endsection
