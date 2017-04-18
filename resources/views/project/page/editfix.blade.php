@extends("project.template")
@section("content")




<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">
	<div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
		<i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
		<span id="myIntro" class="w3-hide">DR system: repair</span>
	</div>
	<header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
		<h1 class="w3-xxxlarge w3-padding-16">Dormitory Repairing System for PSU</h1>
	</header>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<div class="w3-container w3-padding-32" style="padding-left:32px">
		<div class="w3-container w3-padding-16 w3-card-2" style="background-color:#FFFFFF">
			<div class="w3-container w3-sand w3-leftbar">
				<br>
				<h1 class="w3-center w3-text-indigo">ใบแจ้งซ่อม</h1>
				<br>
			</div>
			<br>
			<div class="w3-content" style="max-width:800px">


				<br>
				<form class="w3-container" action="{{url('fix/detail/update_fix')}}/{{$Eq->id_equipment}}" enctype="multipart/form-data" method="post">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<h3 class="w3-text-blue">รายละเอียดผู้แจ้ง</h3>
					<br>
					
					@if ($level == 3)
					<div class="w3-row">
						<div class="w3-col m2">
							<p><label>ชื่อ - นามสกุล : </label></p>
						</div>
						
						<div class="w3-col m10">
							<input class="w3-input w3-animate-input" type="text" value="น.ส.{{ Auth::user()->name_student }}"  style="width:70%" disabled="disabled" required/></p>
						</div>
					</div>
					@else
					<div class="w3-row">
						<div class="w3-col m2">
							<p><label>ชื่อ - นามสกุล : </label></p>
						</div>
						
						<div class="w3-col m10">
							<input class="w3-input w3-animate-input" type="text" value="{{ Auth::user()->name }}"  style="width:70%" required/></p>
						</div>
						
					</div>
					@endif
					<div class="w3-row">
						<div class="w3-col m2">
							<p><label>เบอร์โทรศัพท์ : </label></p>
						</div>
						<div class="w3-col m10">
							<input class="w3-input w3-animate-input" name="phone_number" type="text" style="width:70%" value="{{$Eq->phone_number}}">
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m1">
							<p><label>ห้อง </label></p>
						</div>
						<div class="w3-col m11">
							<input class="w3-input w3-animate-input" name="num_room" type="text" style="width:70%" value="{{$Eq->num_room}}">
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m2">
							<p><label>วันที่แจ้งซ่อม : </label></p>
						</div>
						<div class="w3-col m10">
							<input class="w3-input datepicker" name="date_in" value="{{$date = date("Y-m-d")}}" disabled="disabled"  type="date" style="width:70%" >
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m2">
							<p><lavel>วันที่ให้เข้าซ่อมได้ : </lavel></p>
						</div>
						<div class="w3-col m10">
							<input class="w3-input datepicker" name="date_repair" value="{{$Eq->date_repair}}" type="date" style="width:70%">
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m1">
							<p><label>เวลา : </label></p>
						</div>
						<div class="w3-col m11">
							<input class="w3-input w3-animate-input" name="time_repair" value="{{$Eq->time_repair}}" type="time" style="width:70%" value="12:10">
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m6">
							<i><p>ต้องการให้ช่างซ่อมบำรุงเข้าซ่อมในช่วงเจ้าของห้องพัก</p></i>
						</div>
						<div class="w3-col m2">
							<p>
								<input class="w3-radio" type="radio" name="live" value="1" checked>
								<label class="w3-validate">อยู่</label></p>
							</div>
							<div class="w3-col m4">
								<p>
									<input class="w3-radio" type="radio" name="live" value="0" checked>
									<label class="w3-validate">ไม่อยู่</label></p>
								</div>
							</div>
							<br>
							<h3 class="w3-text-blue">รายการแจ้งซ่อม</h3>							
							@foreach($Eqd as $key => $v) 
							<div id="itemRows">
							
								<div class="ui-widget">
								
									<br>
									อุปกรณ์ <input class="w3-input w3-animate-input" id="tags" name="eq{{$key}}" value="{{$v->equipment}}" type="text"  style="width:70%" /></div>
									<br>
									<i> รายละเอียดและปัญหา</i>  
									<input class="w3-input w3-animate-input" name="eqdetail{{$key}}" value="{{$v->detail_equipment}}" type="text"  style="width:70%" />
									<br>
									<input type="file" multiple="" value="{{$v->photo_repair}}" name="eqpho{{$key}}"><br><br> 
								
								</div>
                            @endforeach
								<br>
								<p>อื่น ๆ</p>
								<textarea class="w3-input w3-animate-input" name="note" style="width:70%;" rows="4" value="{{$Eq->note}}" cols="50" placeholder="กรณีไม่พบอุปกรณ์" ></textarea>
								<br>
								<br>
								<div class="w3-row">
									<div class="w3-col m6">
										<!-- <a href="tryw3css_templates_blog.htm" target="_blank" type="submit"  class="w3-btn w3-padding-12 w3-dark-grey" style="width:98.5%">บันทึก</a> -->
										<center><p><button class="w3-btn w3-padding-12 w3-green" type="submit" style="width:80%" >บันทึก</button></p></center>
									</div>
									<div class="w3-col m6">
										<!-- <a href="w3css_templates.asp" class="w3-btn w3-padding-12 w3-dark-grey" style="width:98.5%">ย้อนกลับ</a> -->
										<center><p><button class="w3-btn w3-padding-12 w3-red" type="submit" style="width:80%" >ย้อนกลับ</button></p></center>
									</div>
								</div>
							</form>
							<br>
						</div>
					</div>
				</div>





<br>
@endsection
