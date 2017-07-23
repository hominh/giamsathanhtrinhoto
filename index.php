<?php        
	session_start();
	//wtf, cho nay nhu kieu no bi lap vo tan 
	if($_SESSION["session_nsd_taikhoan"]=="" || $_SESSION["session_nsd_matkhau"]==""){	
		
	}
	
?>
<DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
	#map {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
	<title>Chương trình giám sát hành trình của xe ô tô- Cadpro</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/app.css">
	<link rel="stylesheet" type="text/css" href="public/css/jquery.datetimepicker.css">
	<link  rel="stylesheet" href="public/js/jquery-ui/jquery-ui.css">
	<link  rel="stylesheet" href="public/js/jquery-ui/external/jquery/jqx.base.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="public/js/jquery-ui/external/jquery/jquery.layout.js"></script>    
	<script src="public/js/jquery-ui/external/jquery/jqxcore.js"></script>
	<script src="public/js/jquery-ui/external/jquery/jqxmenu.js"></script>
	<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>!-->
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDKqF9x0E5AonkidCUiuuOPuMh_C4kPRTQ"></script>

	<script type="text/javascript" src="public/js/jquery.datetimepicker.js"></script>
	<script type="text/javascript" src="public/js/public.js"></script>
	<script type="text/javascript" src="public/js/maps-utility/maplabel/src/maplabel-compiled.js"></script>
	<script src="public/js/jqwidgets/jqxdata.js"></script>
	<script src="public/js/jqwidgets/jqxdraw.js"></script>    
	<script src="public/js/jqwidgets/jqxchart.core.js"></script>
	<script src="public/js/jqwidgets/jqxscrollbar.js"></script>
	<script src="public/js/jqwidgets/jqxgrid.js"></script>
	<script src="public/js/jqwidgets/jqxgrid.edit.js"></script>    
	<script src="public/js/jqwidgets/jqxgrid.selection.js"></script>
	<script src="public/js/jqwidgets/jqxgrid.columnsresize.js"></script>
	<script src="public/js/jqwidgets/jqxpanel.js"></script>
	<script src="public/js/jqwidgets/jqxlistbox.js"></script>
	<script src="public/js/jqwidgets/jqxdropdownlist.js"></script>    
	<script src="public/js/jqwidgets/jqxgrid.pager.js"></script>    
	<!--<script src="jqwidgets/jqxtabs.js"></script>-->
	<script src="public/js/jqwidgets/jqxbuttons.js"></script>
	<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script>
		var map;
		function initialize() {
			var mapOptions = {
				zoom: 6,
				center: new google.maps.LatLng(16, 108),
			};
			 map = new google.maps.Map(document.getElementById('map'),mapOptions);
		}
		google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	
	</script>
	 <script>
		$(function() {
			$( "#tabs" ).tabs();

		});
	</script>
	<script>
		$(function() {
			var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var hour = d.getHours();
		var minute = d.getMinutes();
		var second = d.getSeconds();
		var start = d.getFullYear() + '/' +((''+month).length<2 ? '0' : '') + month + '/' +((''+day).length<2 ? '0' : '') + day;
				var startTime = start +  ' ' +
				((''+hour).length<2 ? '0' :'') + hour + ':' +
					((''+minute).length<2 ? '0' :'') + minute;
				
			$('#tungay').datetimepicker({
				//format:'Y-m-d',
				dayOfWeekStart : 1,
				lang:'en',
				disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
				startDate:	start
			});
		$('#tungay').datetimepicker({value:startTime,step:5});
		$('#denngay').datetimepicker({
			//format:'Y-m-d',
			dayOfWeekStart : 1,
			lang:'en',
			disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
			startDate:	start
		});
		$('#denngay').datetimepicker({value:startTime,step:5});
		
		$('#tungay2').datetimepicker({
				//format:'Y-m-d',
				dayOfWeekStart : 1,
				lang:'en',
				disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
				startDate:	start
			});
		$('#tungay2').datetimepicker({value:startTime,step:5});
		$('#denngay2').datetimepicker({
			//format:'Y-m-d',
			dayOfWeekStart : 1,
			lang:'en',
			disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
			startDate:	start
		});
		$('#denngay2').datetimepicker({value:startTime,step:5});

		});	


	</script>
	<script>
		$(function(){
			$('input:radio[name="type"]').change(function(){
				if($(this).val() == 'user'){
					$("#registeruser").css("display", "block");
					$("#registerdriver").css("display", "none");
				}
				else {
					$("#registeruser").css("display", "none");
					$("#registerdriver").css("display", "block");
				}
			});
		});
	</script>
	<script>
		$('#tblDevice').DataTable();
	</script>
</head>
<body>
	<div class="header">
		<div class="container header-bg">

		</div>
	</div>
	<div style="height: 5px;"></div>
	<div class="content">
		<div class=".col-xs-12 col-md-8">
			<div id="map">

			</div>
		</div>
		<div class=".col-xs-6 col-md-4">
			<div>
			<div id="tabs">
				 <ul class="tabfont">
					<li><a href="#tabs-1">Hành trình</a></li>
					<li><a href="#tabs-2">Phân loại</a></li>
					<li><a href="#tabs-3">Báo cáo</a></li>
					<li><a href="#tabs-4">Đăng kí</a></li>
				</ul>
				 <div id="tabs-1">
					<table style="font-size: 12px; width: 100%;">
						<tr>
							<td>
								Chọn đơn vị:
							</td>
							<td>
								<select class="form-control" name="donvi5" id="donvi5">
									<option value="0">Chọn đơn vị</option>
								</select>
							</td>
						</tr>

					</table>
					
					<table  style="font-size: 12px; width: 100%;" id="tblDevice" class="cell-border dataTable" cellspacing="0" width="100%">
						
						<tbody id="checkboxBienso">
							
						</tbody>
					</table>
				</div>
				<div id="tabs-2">
					<table style="font-size: 12px; width: 100%;">
						<tr>
							<td>
								Từ ngày:
							</td>
							<td>
								<input type="text" value="" id="tungay2"/>
							</td>
						</tr>
						<tr>
							<td>
								Đến ngày:
							</td>
							<td>
								<input type="text" value="" id="denngay2"/>
							</td>
						</tr>
						<tr>
							<td>
								Chọn đơn vị:
							</td>
							<td>
								<select class="form-control" name="donvi" id="donvi">
									<option value="0">Chọn đơn vị</option>
								</select>
							</td>
						</tr>

						<tr>
							<td>
								Chọn biển số:
							</td>
							<td>
								<select class="form-control" name="biensonl" id="biensonl" class="biensonl">
									<option x="0">Tất cả</option>
								</select>
							</td>
						</tr>
						
						<tr style="height: 5px;"></tr>
						<tr>
							<td><button id="btnXemthongtin">Xem thông tin</button></td>
						</tr>
						
					</table>
					<br />
				</div>
				<div id="tabs-3">
					<table style="font-size: 11px;">
						<tr>
							<td>Chọn báo cáo:</td>
							<td>
								<select class="form-control" id="baocao" name="baocao">
									<option value="1">Hành trình xe chạy</option>
									<option value="2">Tốc độ của xe</option>
									<option value="3">Quá tốc độ giới hạn</option>
									<option value="4">Thời gian lái xe liên tục</option>
									<option value="5">Dừng đỗ</option>
									<option value="6">Tổng hợp theo xe</option>
									<option value="7">Tổng hợp theo lái xe</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Chọn đơn vị:
							</td>
							<td>
								<select class="form-control" name="donvi2" class="donvi2" id="donvi2">
									<option value="0">Chọn đơn vị</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Chọn biển số:
							</td>
							<td>
								<select class="form-control" name="bienso2" id="bienso2">
									<option value="0">Tất cả</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								Từ ngày:
							</td>
							<td>
								<input type="text" value="" id="tungay"/>
							</td>
						</tr>
						<tr>
							<td>
								Đến ngày:
							</td>
							<td>
								<input type="text" value="" id="denngay"/>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<td>
							</td>
							<td>
								<input type="button" value="Xem báo cáo" id="btnXembaocao">
								<input type="button" value="In ngay" id="btnInngay"> 
								<input type="button" value="Download" id="btnDownload"> 
							</td>
							

						</tr>
					</table>
				</div>
				<div id="tabs-4" style="font-size: 12px;">
					<input type="radio" name="type" value="user">Đăng kí người sử dụng
					<input type="radio" name="type" value="driver">Đăng kí tài xế
					<div style="height: 5px;"></div>
					<div id="registeruser" style="display: block;font-size:11px;">
						<h4>Đăng kí tài khoản người sử dụng</h4>
						<form method="POST" action="" >
							<table style="font-size: 12px;">
								<tr>
									<td>Tên đăng nhập: </td>
									<td><input type="text" name="username" id="username" size="25"></td>
								</tr>
								<tr>
									<td>Mật khẩu: </td>
									<td><input type="password" name="password" id="password" size="25"></td>
								</tr>
								<tr>
									<td>
										Chọn đơn vị:
									</td>
									<td>
										<select class="form-control" name="donvi3" id="donvi3">
											<option value="0">Chọn đơn vị</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><input type="button" value="Đăng kí" id="reg1" name="reg1"></td>
								</tr>
							</table>
						</form>
					</div>
					<div id="registerdriver" style="display: none;font-size:11px;">
						<h4>Đăng kí tài xế</h4>
						<form method="POST" action="" >
							<table style="font-size: 12px;">
								<tr>
									<td>Họ tên: </td>
									<td><input type="text" name="name_driver" id="name_driver" size="20"></td>
								</tr>
								<tr>
									<td>Tài khoản: </td>
									<td><input type="text" name="username_driver" id="username_driver" size="20"></td>
								</tr>
								<tr>
									<td>Mật khẩu: </td>
									<td><input type="password" name="password_driver" id="password_driver" size="20"></td>
								</tr>
								<tr>
									<td>GPLX: </td>
									<td><input type="text" name="gplx" id="gplx" size="20"></td>
								</tr>
								<tr>
									<td>
										Chọn xe:
									</td>
									<td>
										<select class="form-control" id="bienso_driver" name="bienso_driver">
											<option value="0">Chọn xe</option>
										</select>
									</td>
								</tr>
								<tr>
									<td><input type="button" value="Đăng kí" id="reg2" name="reg2"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br />
		<div id="panel-sukien">
			
		</div>
		</div>
		
	</div>
	

	
</body>
</html>