@extends("project.template")
@section("content")
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
<div class="w3-main" style="margin-left:250px;">
	<div id="myTop" class="w3-top w3-container w3-padding-16 w3-theme w3-large">
		<i class="fa fa-bars w3-opennav w3-hide-large w3-xlarge w3-margin-left w3-margin-right" onclick="w3_open()"></i>
		<span id="myIntro" class="w3-hide">DR system: repair</span>
	</div>
	<header class="w3-container w3-theme w3-padding-24" style="padding-left:24px" >
		<h1 class="w3-xxxlarge w3-padding-5">Dormitory Repairing System for PSU</h1>
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
				<form class="w3-container" action="fixxx" enctype="multipart/form-data" method="post">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
					<h3 class="w3-text-blue">รายละเอียดผู้แจ้ง</h3>
					<div class="w3-row">
						<div class="w3-col m2">
							<p><label>ชื่อ - นามสกุล : </label></p>
						</div>
						<div class="w3-col m10">
							<input class="w3-input w3-animate-input" type="text" value="{{ Auth::user()->name }}" disabled="disabled" style="width:70%"></p>
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m2">
							<p><label>เบอร์โทรศัพท์ : </label></p>
						</div>
						<div class="w3-col m10">
							<input class="w3-input w3-animate-input" name="phone_number" type="text" style="width:70%" value="0883845297">
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m1">
							<p><label>ห้อง </label></p>
						</div>
						<div class="w3-col m11">
							<input class="w3-input w3-animate-input" name="num_room" type="text" style="width:70%" value="2325">
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
							<input class="w3-input datepicker" name="date_repair"  type="date" style="width:70%">
						</div>
					</div>
					<div class="w3-row">
						<div class="w3-col m1">
							<p><label>เวลา : </label></p>
						</div>
						<div class="w3-col m11">
							<input class="w3-input w3-animate-input" name="time_repair" type="time" style="width:70%" value="12:10">
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
							<div id="itemRows">
								<div class="ui-widget">
									<br>
									อุปกรณ์ <input class="w3-input w3-animate-input" id="tags" name="eq0"  type="text"  style="width:70%" /></div>
									<br>
									<i> รายละเอียดและปัญหา</i>  
									<input class="w3-input w3-animate-input" name="eqdetail0" type="text"  style="width:70%" />
									<br>
									<input type="file" multiple="" name="eqpho0"><br><br> 
									<input onclick="addRow(this.form);" class="w3-btn w3-teal"  type="button" value="เพิ่มอุปกรณ์" />
								</div>
								<br>
								<p>อื่น ๆ</p>
								<textarea class="w3-input w3-animate-input" name="note" style="width:70%;" rows="4" cols="50" placeholder="กรณีไม่พบอุปกรณ์"></textarea>
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

//ค้นหาอุปกรณ์				
<script>
$( function() {
var availableTags = [
@foreach($name_equipment as $a) 
"{{$a->name}}",
@endforeach
];
$("#tags" ).autocomplete({
source: availableTags
});
} );


//เพิ่มอุปกรณ์
var rowNum = 0;
function addRow(frm) {
	rowNum ++;
	var row = '<p  id="rowNum'+rowNum+'">อุปกรณ์ <input class="w3-input w3-animate-input ui-autocomplete-input"  type="text" name="eq'+rowNum+'" style="width:400px" autocomplete="off" > <br> <i>รายละเอียดและปัญหา</i> <input class="w3-input w3-animate-input" type="text" name="eqdetail'+rowNum+'" style="width:400px"><br> <input type="file" multiple="" name="eqpho'+rowNum+'"> <br> <br>  <input class="w3-btn w3-red" type="button"  value="ลบอุปกรณ์" onclick="removeRow('+rowNum+');"></p>';
	jQuery('#itemRows').append(row);
//	frm.add_qty.value = '';
//	frm.add_name.value = '';

//ค้นหาอุปกรณ์
$( function() {
	var availableTags = [
	@foreach($name_equipment as $a) 
	"{{$a->name}}",
	@endforeach
	];
	$( "input.ui-autocomplete-input" ).autocomplete({
		source: availableTags
	});
} );
}
function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
				// $('.datepicker').pickadate({
				//     selectMonths: true, // Creates a dropdown to control month
				//     selectYears: 15 // Creates a dropdown of 15 years to control year
				//   });
			</script>
			<br>
			@endsection
