$(document).ready(function () {
	var host = 'http://' + window.location.hostname;
	host = host+'/giamsathanhtrinhoto/';
	//alert(host);
	getAllBienso();
	//------------------------------------------//
	$( "#donvi" ).change(function() {
		//getBiensoByDonvi();
		var donvi = $(this).val();
		getBiensoByDonvi(donvi);
		getGaByDonVi(donvi);
		
	});
	//------------------------------------------//

	$(document).on('click', '#bienso', function(){
		var arrBS = $("input[name=bienso]:checked").map(
     		function () {return this.value;}).get().join(",");
		getVitriMoinhatByArrBienSo(arrBS);
	});

	//------------------------------------------//

	$( "#donvi5" ).change(function() {
		var donvi = $(this).val();
		getBiensoByDonvi5(donvi);
		getGaByDonVi(donvi);
	});

	//------------------------------------------//

	$("#btnXemthongtin").click(function () {
		thongtinoto();
	});

	//------------------------------------------//

	$('#btnXembaocao').click(function(){
		report();
	});

	//------------------------------------------//

	$('#btnInngay').click(function(){
		printReport();
	});

	//------------------------------------------//

	$('#btnDownload').click(function(){
		Downloadreport();
	});

	//------------------------------------------//

	$( "#donvi2" ).change(function() {
		//getBiensoByDonvi();
		var donvi = $(this).val();
		getBiensoByDonvi(donvi);
		
		
	});

	//------------------------------------------//

	$('#reg1').click(function(){
		regUser();
	});

	$('#reg2').click(function(){
		regDriver();
	});


	//------------------------------------------//
	$( "#biensonl" ).change(function() {
		var bienso = ($('option:selected', $(this)).text());
		getVitriMoinhatByBienSo(bienso);
		//alert($('option:selected', $(this)).text());
	});
	//------------------------------------------//


	var url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/';
	$.ajax({
		type: "POST",
		url: url+'function.php?service='+'gettochuc',
		success: function(data) {
			var $donvi = $('#donvi');
			var $donvi3 = $('#donvi3');
			var $donvi2 = $('#donvi2');
			var $donvi5 = $('#donvi5');
			var json =  $.parseJSON(data);
			var json2 = $.parseJSON(data);
			var json3 = $.parseJSON(data);
			var json5 = $.parseJSON(data);
			//console.log(data);
			$(json).each(function (index, o) {
				var $option = $("<option/>").attr("value", o.idtochuc).text(o.tentochuc);
				$donvi.append($option);
				
			});

			$(json2).each(function (index, o) {
				var $option = $("<option/>").attr("value", o.idtochuc).text(o.tentochuc);
				$donvi2.append($option);
				
			});

			$(json3).each(function (index, o) {
				var $option = $("<option/>").attr("value", o.idtochuc).text(o.tentochuc);
				
				$donvi3.append($option);
			});

			$(json5).each(function (index, o) {
				var $option = $("<option/>").attr("value", o.idtochuc).text(o.tentochuc);
				
				$donvi5.append($option);
			});

		}
	});

	function thongtinoto() {
		//alert('1');
		var bienso = ($('option:selected', $('#biensonl')).text());
		
		var tutime = $('#tungay2').val();
		var dentime = $('#denngay2').val();
		var url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'thongtinoto'+'&bienso='+bienso+'&tutime='+tutime+'&dentime='+dentime;
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				var decodeResult = $.parseJSON(data);
				var source = 
				{
					localdata: decodeResult,
					datafields:
					[
						{ name: 'livelog_gps_speed', type: 'string' },
						{ name: 'livelog_time', type: 'string' },
						{ name: 'livelog_latitude', type: 'string' },
						{ name: 'livelog_longitude',type: 'string' },
						{ name: 'livelog_km_meter',type: 'string' }
					],
					datatype: "array",
					pagesize: 20
				};
				var dataAdapter = new $.jqx.dataAdapter(source);
				var parentElement = $("#panel-sukien").parent();
				$("#panel-sukien").remove();
				parentElement.append("<div id='panel-sukien'></div>");
				$("#panel-sukien").jqxGrid({
					source: dataAdapter,
					width: '100%',
					height: '100%',
					pageable: true,
					autorowheight: true,
					altrows: true,
					columns: [
						{ text: 'Vận tốc', datafield: 'livelog_gps_speed', width: 150 },
							  	{ text: 'Thời gian', datafield: 'livelog_time', width: 150, cellsalign: 'left' },
							  	{ text: 'Vĩ độ', datafield: 'livelog_latitude', width: 80, cellsalign: 'left' },
								{ text: 'Kinh độ', datafield: 'livelog_longitude', width: 80, cellsalign: 'left' },
								{ text: 'Lý trình', datafield: 'livelog_km_meter', width: 80, cellsalign: 'left' }
					]
				});
			}
		});
	}

	function regUser() {
		var username = $('#username').val();
		var password = $('#password').val();
		var dv = $('select[name=donvi3]').val();
		if(username == '') {
			alert('Bạn chưa nhập tài khoản');
			return;
		}
		if(password == '') {
			alert('Bạn chưa nhập mật khẩu');
			return;
		}
		if(dv == 0) {
			alert('Bạn chưa chọn đơn vị');
			return;
		}
		//alert(dv);
		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'reguser'+'&username='+username+'&password='+password+'&donvi='+dv;
	
		$.ajax({
			url: url,
			type: "POST",
			url: url,
			success: function(data) {
				if(data == 'true') {
					alert('Đăng kí tài khoản thành công');
				} else {
					alert('Đăng kí tài khoản thất bại');
				}
			}	
		});
	}


	function regDriver() {
		var username = $('#username_driver').val();
		var password = $('#password_driver').val();
		var name_driver = $('#name_driver').val();
		
		var gplx = $('#gplx').val();
		var bienso = $('select[name=bienso_driver]').val();
		if(username == '') {
			alert('Bạn chưa nhập tài khoản');
			return;
		}
		if(password == '') {
			alert('Bạn chưa nhập mật khẩu');
			return;
		}
		if(name_driver == '') {
			alert('Bạn chưa nhập tên');
			return;
		}
		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'regdriver'+'&username='+username+'&password='+password+'&bienso='+bienso;
	
		$.ajax({
			url: url,
			type: "POST",
			url: url,
			success: function(data) {
				if(data == 'true') {
					alert('Đăng kí thành công');
				} else {
					alert('Đăng kí thất bại');
				}
			}	
		});

	}

	function getAllBienso() {

		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'getallbienso';
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				
				var json = $.parseJSON(data);
				var $bienso_driver = $('#bienso_driver');
				
				$(json).each(function (index, o) {
					var $option = $("<option/>").attr("value", o.imei).text(o.plate_number);
					$bienso_driver.append($option);
				});
			}
		});
	}

	function getBiensoByDonvi5(donvi) {
		$("#tblDevice").html("");
		var $tblDevice = $('#tblDevice');
		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'getbiensobydonvi'+'&donvi='+donvi;
		var $th = "<thead><tr><th></th><th>Biển số</th><th>Hoạt động</th></tr></thead>";
		$tblDevice.append($th);
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				

				var json = $.parseJSON(data);
				$(json).each(function (index, o) {

					var $datatableDevice = "<tr><td><input type='checkbox' name='bienso' id='bienso' value='"+o.plate_number+"'></td></td><td>"+o.plate_number+"</td><td>"+o.update_time+"</td></tr>";
					$tblDevice.append($datatableDevice);
				});
			}
		});
	}	

	function getBiensoByDonvi(donvi) {
		//first: remove, then insert
		$('#bienso').find('option:not(:first)').remove();
		$('#bienso2').find('option:not(:first)').remove();
		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'getbiensobydonvi'+'&donvi='+donvi;
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				var $biensonl = $('#biensonl');
				var $bienso2 = $('#bienso2');
				var json = $.parseJSON(data);
				
				console.log(json);
				$(json).each(function (index, o) {
				 	var $option = $("<option/>").attr("value", o.id).text(o.plate_number);
				 	var $option2 = $("<option/>").attr("value", o.imei).text(o.plate_number);

				 	$biensonl.append($option);
				 	$bienso2.append($option2);
				 	
				});
			}
		});
	}

	function getGaByDonVi(donvi) {
		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'getgabydonvi'+'&donvi='+donvi;
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				var json = $.parseJSON(data);
				//console.log(json);
				var length = json.length;
				length2 = length / 2;
				length2 = Math.round(length2);
				//alert(length);
				var latCenter = json[length2].ga_vido;
				var lonCenter = json[length2].ga_kinhdo;
				var myLatlng = new google.maps.LatLng(latCenter,lonCenter);
				var mapOptions = {
				    zoom: 12,
				    center: myLatlng
				}
				var map = new google.maps.Map(document.getElementById('map'), mapOptions);
				var image = host+'public/images/icon/station48.png';
				var arrLat = [];
				var arrLon = [];
				
				for(var i = 0; i < length; i++) {
					//console.log(json[i].ga_kinhdo);
					arrLat.push(json[i].ga_vido);
					arrLon.push(json[i].ga_kinhdo);
				}
				console.log(arrLat);
				for(var i = 0; i < arrLon.length; i++) {
					var mapLabel = new MapLabel({
						text: json[i].ga_ten,
						position: new google.maps.LatLng(arrLat[i], arrLon[i]),
						map: map,
                        fontSize: 18,
                        align: 'right',
                        fontColor: '#00ccbb'
					});
				mapLabel.set('position', new google.maps.LatLng(arrLat[i], arrLon[i]));
					var listlatlon = new google.maps.LatLng(arrLat[i], arrLon[i]);
					new google.maps.Marker({
		                position: listlatlon,
		                icon: image,
		                animation: google.maps.Animation.DROP,
		                map: map
		            });
				}


			}
		});
	}

	function getVitriMoinhatByArrBienSo(arrBS) {
		var jsonString = JSON.stringify(arrBS);
		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'getvitritaumoinhatbyarrbienso'+'&arrBS='+jsonString;
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				var json = $.parseJSON(data);
				var length = json.length;
				length2 = length / 2;
				length2 = Math.round(length2);
				console.log(length2);
				if(length2 == 1) {
					length2 = length2 - 1;
				}
				var lonCenter = json[length2].livelog_longitude;
				var latCenter = json[length2].livelog_latitude;
				var myLatlng = new google.maps.LatLng(latCenter,lonCenter);
				var mapOptions = {
				    zoom: 10,
				    center: myLatlng
				}
				var map = new google.maps.Map(document.getElementById('map'), mapOptions);
				var image = '';
				var arrLat = [];
				var arrLon = [];
				var arrSohieu = [];
				var arrTime = [];
				var arrLyTrinh = [];
				var arrSpeed = [];
				var arrSpeedDautruc = [];
				for(var i = 0; i < length; i++) {
					//console.log(json[i].ga_kinhdo);
					arrLat.push(json[i].livelog_latitude);
					arrLon.push(json[i].livelog_longitude);
					arrSohieu.push(json[i].plate_number);
					arrTime.push(json[i].livelog_time);
					arrLyTrinh.push(json[i].livelog_km_meter);
					arrSpeed.push(json[i].livelog_gps_speed);
					arrSpeedDautruc.push(json[i].livelog_wheel_speed);
					if(json[i].livelog_gps_speed > 80) {
						image = '';
						image = image + host+'public/images/train-icon16.png';
					}
					else if(json[i].livelog_gps_speed <= 80) {
						image = '';
						image = image + host+'public/images/train-icon16-enable.png';
					}
				}
				//console.log(arrLon.length);
				for(var i = 0; i < arrLon.length; i++) {
					var html = '<div style="width: 350px;">';
					html += '<table>';
					html += '<tr style="font-weight:bold;"><td>Số hiệu đầu máy: </td><td>' + arrSohieu[i] + '</td></tr>';
					html += '<tr style="font-weight:bold;"><td>Lái tàu: </td><td>' + 'Chưa rõ danh tính' + '</td></tr>';
					html += '<tr style="font-weight:bold;"><td>Thời điểm: </td><td>' +  arrTime[i] + '</td></tr>';
					html += '<tr style="font-weight:bold;"><td>Lý trình: </td><td>' + arrLyTrinh[i] + '</td></tr>';
					html += '<tr><td>Tốc độ GPS: </td><td>' + arrSpeed[i] + ' km/h</td></tr>';
					html += '<tr><td>Tốc độ đầu trục: </td><td>' + arrSpeedDautruc[i] + ' km/h</td></tr>';
					html += '<tr><td>Kinh độ: </td><td>' + arrLat[i] + '</td></tr>';
	               	html += '<tr><td>Vĩ độ: </td><td>' + arrLon[i] + '</td></tr>';
	               	//html += '<tr><td>Imei: </td><td>' + imei + '</td></tr>';
	                html += '</table>';
	               	html += '</div>';
	               	var myLatlng = new google.maps.LatLng(arrLat[i],arrLon[i]);
	               	var infowindow = new google.maps.InfoWindow({
	               		content: html
	               	});


					var mapLabel = new MapLabel({
						text: json[i].plate_number,
						position: new google.maps.LatLng(arrLat[i], arrLon[i]),
						map: map,
                        fontSize: 18,
                        align: 'right',
                        fontColor: '#00ccbb'
					});
					mapLabel.set('position', new google.maps.LatLng(arrLat[i], arrLon[i]));
					var listlatlon = new google.maps.LatLng(arrLat[i], arrLon[i]);
					new google.maps.Marker({
		                position: listlatlon,
		                icon: image,
		                animation: google.maps.Animation.DROP,
		                map: map
		            });



		            var marker = new google.maps.Marker({
					   	position: myLatlng,
					    map: map,
					    icon: image,
					   	title: 'Thông tin'
					});

					//infowindow.open(map, marker);
				}
			}
		});			
	}

	function getVitriMoinhatByBienSo(bienso) {

		url = 'http://didau.cadpro.vn/giamsathanhtrinhoto/include/'+'function.php?service='+'getvitritaumoinhatbybienso'+'&bienso='+bienso;
		$.ajax({
			type: "POST",
			url: url,
			success: function(data) {
				var dv = $('select[name=donvi]').val();
				//getGaByDonVi(dv);
				var json = $.parseJSON(data);
				var sohieu = json[0].sohieu;
				var time = json[0].livelog_time;
				var lytrinh = json[0].livelog_km_meter;
				var gps_speed = json[0].livelog_gps_speed;
				var wheel_speed = json[0].livelog_wheel_speed;
				var kinhdo = json[0].livelog_longitude;
				var vido = json[0].livelog_latitude;
				var imei = json[0].livelog_imei;
				var html = '<div style="width: 350px;">';
				html += '<table>';
				html += '<tr style="font-weight:bold;"><td>Số hiệu đầu máy: </td><td>' + sohieu + '</td></tr>';
				html += '<tr style="font-weight:bold;"><td>Lái tàu: </td><td>' + 'Chưa rõ danh tính' + '</td></tr>';
				html += '<tr style="font-weight:bold;"><td>Thời điểm: </td><td>' +  time + '</td></tr>';
				html += '<tr style="font-weight:bold;"><td>Lý trình: </td><td>' + lytrinh + '</td></tr>';
				html += '<tr><td>Tốc độ GPS: </td><td>' + gps_speed + ' km/h</td></tr>';
				html += '<tr><td>Tốc độ đầu trục: </td><td>' + wheel_speed + ' km/h</td></tr>';
				html += '<tr><td>Kinh độ: </td><td>' + kinhdo + '</td></tr>';
               	html += '<tr><td>Vĩ độ: </td><td>' + vido + '</td></tr>';
               	html += '<tr><td>Imei: </td><td>' + imei + '</td></tr>';
                html += '</table>';
               	html += '</div>';
			  	var infowindow = new google.maps.InfoWindow({
      				content: html
  				});

				var lat = json[0].livelog_latitude;
				var lon = json[0].livelog_longitude;
				var myLatlng = new google.maps.LatLng(lat,lon);
				var mapOptions = {
				    zoom: 15,
				    center: myLatlng
				}
				var image = host+'public/images/train-icon16.png';
				var map = new google.maps.Map(document.getElementById('map'), mapOptions);
				var marker = new google.maps.Marker({
				   	position: myLatlng,
				    map: map,
				    icon: image,
				   	title: 'Thông tin'
				});

				infowindow.open(map, marker);


				//----------------------------


				//alert(json[0].livelog_latitude)
			}
		});
	}

	function report() {
		var imei = $('select[name=bienso2]').val();
		var bienso = ($('option:selected', $('#bienso2')).text());
		var baocao = $('select[name=baocao]').val();
		var tutime = $('#tungay').val();
		var dentime = $('#denngay').val();
		var dv = $('select[name=donvi2]').val();
		var reportPage = host + 'include/report.php?baocao='+baocao+'&imei='+imei+'&tutime='+tutime+'&dentime='+dentime+'&bienso='+bienso+'&idtochuc='+dv;
		window.open(reportPage, '_blank');
	}

	function Downloadreport() {
		alert('download');
		var donvi2 = $('select[name=donvi2]').val();
		var imei = $('select[name=bienso2]').val();
		var bienso = ($('option:selected', $('#bienso2')).text());
		var baocao = $('select[name=baocao]').val();
		var tutime = $('#tungay').val();
		var dentime = $('#denngay').val();
		var dv = $('select[name=donvi2]').val();
		var reportPage = host + 'include/downloadreport.php?baocao='+baocao+'&imei='+imei+'&tutime='+tutime+'&dentime='+dentime+'&bienso='+bienso+'&idtochuc='+dv;
		window.open(reportPage, '_blank');
	}

	function printReport() {

		var donvi2 = $('select[name=donvi2]').val();
		var imei = $('select[name=bienso2]').val();
		var bienso = ($('option:selected', $('#bienso2')).text());
		var baocao = $('select[name=baocao]').val();
		var tutime = $('#tungay').val();
		var dentime = $('#denngay').val();
		var dv = $('select[name=donvi2]').val();
		var reportPage = host + 'include/printreport.php?baocao='+baocao+'&imei='+imei+'&tutime='+tutime+'&dentime='+dentime+'&bienso='+bienso+'&idtochuc='+dv;
		window.open(reportPage, '_blank');
	}

}); 
