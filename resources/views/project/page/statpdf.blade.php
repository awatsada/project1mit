<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <meta charset="utf-8">
    
    <style>
 body {
   font-family: 'Kanit', sans-serif;
 }
 h2 {
   font-family: 'Kanit', sans-serif;
 }
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




</head>
<body>
 <div class="w3-container">

  <center>
  
  <p><font size="5">สรุปรายการซ่อม ภายในห้องพักหอพักนักศึกษาในกำกับฯ ({{$month}})</font></p>
 
  </center>
  <hr>

 <!--  <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->
<!--   <hr> -->

  <table  border="1" cellspacing="5" width="100%" height="100">

              <thead>
                <tr >
                  <!-- <th bgcolor="#E6E6FA">ลำดับ</th> -->
                  <th bgcolor="#E6E6FA">รายการซ่อมแซม</th>
                  <th bgcolor="#E6E6FA">จำนวนรายการ</th>
                  <th bgcolor="#E6E6FA">ผลารซ่อมแซม</th>
                  
                </tr>
              </thead>
              @foreach($count_change as $key => $v)
              <tr>       
                <!-- <td align='center'>{{$key+1}}</td> -->
                <td align='center'>{{$v->equiment}}</td>
                <td align='center'>{{$v->count_c}}</td>
                <td align='center'>เปลี่ยน</td> 
              </tr>
          
              @endforeach

              @foreach($count_repair as $key => $v)
              <tr>       
                <!-- <td align='center'>{{$key+1}}</td> -->
                <td align='center'>{{$v->equiment}}</td>
                <td align='center'>{{$v->count_r}}</td>
                <td align='center'>ซ่อม</td> 
              </tr>
              @endforeach

              @foreach($count_unrepair as $key => $v)
              <tr>       
                <!-- <td align='center'>{{$key+1}}</td>    -->
                <td align='center'>{{$v->equiment}}</td>
                <td align='center'>{{$v->count_u}}</td>
                <td align='center'>ซ่อมไม่ได้</td> 
              </tr>
              @endforeach
            </table>

    
  </div>

</body>
</html>