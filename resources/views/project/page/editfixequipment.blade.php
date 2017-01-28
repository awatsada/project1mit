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
				<h1 class="w3-center w3-text-indigo">แก้ไขอุปกรณ์</h1>
				<br>
			</div>
			<br>
			<div class="w3-content" style="max-width:800px">


				<br>
				<form class="w3-container" action="{{url('fix/detail_Eq/update_Eq')}}/{{$Eqd->id}}" enctype="multipart/form-data" method="post">
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
				<h3 class="w3-text-blue">รายการแจ้งซ่อม</h3>							
							<div id="itemRows">
								<div class="ui-widget">
									<br>
									อุปกรณ์ <input class="w3-input w3-animate-input" id="tags" name="eq0" value="{{$Eqd->equipment}}" type="text"  style="width:70%" /></div>
									<br>
									<i> รายละเอียดและปัญหา</i>  
									<input class="w3-input w3-animate-input" name="eqdetail0" type="text" value="{{$Eqd->detail_equipment}}" style="width:70%" />
									<br>
									<input type="file" multiple="" value="{{$Eqd->photo_repair}}" name="eqpho0"><br><br> 
									
								</div>
								<br>
								
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
