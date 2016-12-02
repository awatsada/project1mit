<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

</head>
<body onload=" window.print();">
 <div class="w3-container">

  <center>
  <h3>สรุปรายการซ่อมอุปกรณ์ภายในห้องพัก </h3>
  <h3>หอพักนักศึกษาในกำกับฯ วิทยาเขตภูเก็ต</h3>
  </center>
  <hr>
  
  <table class="w3-table w3-bordered">

              <thead>
                <tr >
                     
                  <th>รายการซ่อมแซม</th>
                  <th>จำนวนรายการ</th>
                  <th>ผลารซ่อมแซม</th>
                  
                </tr>
              </thead>
              @foreach($count_change as $v)
              <tr>       
                
                <td>{{$v->equiment}}</td>
                <td>{{$v->count_c}}</td>
                <td>เปลี่ยน</td> 
              </tr>
          
              @endforeach

              @foreach($count_repair as $v)
              <tr>       
            
                <td>{{$v->equiment}}</td>
                <td>{{$v->count_r}}</td>
                <td>ซ่อม</td> 
              </tr>
              @endforeach

              @foreach($count_unrepair as $v)
              <tr>       
                
                <td>{{$v->equiment}}</td>
                <td>{{$v->count_u}}</td>
                <td>ซ่อมไม่ได้</td> 
              </tr>
              @endforeach
            </table>

    
  </div>

</body>
</html>