@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">

  <div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
    <i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
    <span id="myIntro" class="w3-hide">DR system: Statistic</span>
  </div>

  <header class="w3-container w3-theme w3-padding-32" style="padding-left:32px" >
    <h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>

    <script src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">

      window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
    theme: "theme2",//theme1
    title:{
      text: "Basic Column Chart - CanvasJS"              
    },
    animationEnabled: false,   // change to true
    data: [              
    {
      // Change type to "bar", "area", "spline", "pie",etc.
      type: "column",
      dataPoints: [
      { label: "apple",  y: 10  },
      { label: "orange", y: 15  },
      { label: "banana", y: 25  },
      { label: "mango",  y: 30  },
      { label: "grape",  y: 28  }
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

    <div class="w3-container w3-sand w3-leftbar">
      <br>
      
     
      
      <br>
    </div>


    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
       </div>
    </div>



@endsection
