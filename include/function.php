<?php

	require_once("connect.php");
	require_once("utility.php");
	//error_reporting(E_ALL);
    //ini_set("display_errors", 1);
	switch ($_REQUEST['service']) {
		case 'gettochuc':
			getTochuc();
			break;
		case 'getbiensobydonvi':
			getBiensoByDonvi();
			break;
		case 'getallbienso':
			getAllBienso();
			break;
		case 'getvitritaumoinhatbybienso':
			getVitriTauMoinhatByBienso();
			break;
		case 'getgabydonvi':
			getGaByDonVi();
			break;
		case 'reguser':
			regUser();
			break;
		case 'regdriver':
			regDriver();
			break;
		case 'thongtinoto':
			thongtinOto();
			break;
		case 'getvitritaumoinhatbyarrbienso':
			getVitriTauMoinhatByArrBienso();
			break;
		default:
			break;
	}

	function getVitriTauMoinhatByArrBienso() {
		$arrbienso = $_REQUEST['arrBS'];
		$strTemp = "";
		$arrTempBs = explode(",", $arrbienso);
		for($i = 0; $i < count($arrTempBs); $i++) {
			$strTemp.= "'";
			$strTemp.= $arrTempBs[$i];
			$strTemp.= "'";
			$strTemp.= ",";
		}
		if($strTemp != ""){
			$strTemp = substr_replace($strTemp, "", -1);
		}
		$strTemp = str_replace('"', "", $strTemp);
		$sql = "SELECT a.log_id,a.log_km_meter,a.log_latitude,a.log_longitude,a.log_gps_speed,a.log_wheel_speed,a.log_time, c.plate_number FROM tbl_log a, tbl_phuongtien c, (SELECT MAX( a.log_time ) AS timemax, a.log_imei AS tmp_imei FROM tbl_phuongtien b, tbl_log a WHERE b.plate_number IN ($strTemp) AND b.imei = a.log_imei
GROUP BY b.imei) as tmp WHERE a.log_imei = tmp.tmp_imei AND a.log_time = tmp.timemax AND a.log_imei = c.imei ";
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		echo json_encode($list);
	}


	function thongtinOto() {
		$bienso = $_GET['bienso'];
		$tutime = $_REQUEST['tutime'];
		$tutime = str_replace("/", "-", $tutime);
		$tutime = $tutime.":00";
		$dentime = $_REQUEST['dentime'];
		$dentime = str_replace("/", "-", $dentime);
		$dentime = $dentime.":00";
		$sql = "SELECT a.log_gps_speed as log_gps_speed,a.log_latitude as log_latitude,a.log_longitude as log_longitude,a.log_time as log_time,(a.log_km_meter / 1000) as log_km_meter,b.plate_number as sohieu FROM tbl_log a LEFT JOIN tbl_phuongtien b ON a.log_imei = b.imei WHERE b.plate_number = '{$bienso}' AND (log_time >= '$tutime' and log_time <= '$dentime')  ORDER BY log_time DESC ";

		$result = mysql_query($sql);
		$list = loadObjectList($result);
		//$sothutu = $start + 1;
	   
	    //$maxrows = mysql_num_rows($result);
	    $dem = count($list);
	    $flag = 0;
    	$mang3 = array();
    	$mang4 = array();
    	$mang2 = array();
    	foreach($list as $key => $val) {
    		if($val->log_gps_speed == "0") {
    			$mang3[] = $key;
    			$flag = $flag + 1;
    			if($flag == 1) {
    				$keydau = $key;
    			}
    			else {
    				$keycuoi = $key;
    			}
    			if($flag > 2 and $dem == $key + 1) {
	                $mang2[] = $keydau;
	                $mang2[] = $keycuoi;
            	}
    		}
    		if($val->log_gps_speed != "0") {
    			if($flag > 2) {
    				$mang2[] = $keydau;
                	$mang2[] = $keycuoi;
    			}
    			$flag = 0;
    		}
    	}
    	$mang4 = array_diff($mang3,$mang2);
    	$mang4 = array_values($mang4);
    	for($i = 0; $i < count($mang4); $i++) {
	        $n = $mang4[$i];
	        unset($list[$n]);
    	}
    	$list = array_values($list);
		echo json_encode($list);
	}

	function regDriver() {
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$password = md5($password);
		$bienso = $_REQUEST['bienso'];
		$gplx = $_REQUEST['gplx'];
		$sql = "INSERT INTO tbl_nguoidung(username,password,phuongtien) VALUES ('{$username}','{$password}','{$bienso}')";
		$result = mysql_query($sql);
		echo json_encode($result);
	}


	function getGaByDonVi() {
		$donvi = isset($_REQUEST['donvi']) ? intval($_REQUEST['donvi']) : 0;
		$sql = "SELECT * FROM tbl_ga WHERE ga_idtochuc = {$donvi} AND ga_active = 1";
		//echo $sql;
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		echo json_encode($list);
	}

	function regUser() {
		$donvi = $_REQUEST['donvi'];
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];
		$password = md5($password);
		$sql = "INSERT INTO tbl_nguoidung(username,password,idtochuc) VALUES ('{$username}','{$password}','{$donvi}')";
		$result = mysql_query($sql);
		echo json_encode($result);
	}

	function getTochuc() {
		//Fuck
		$sql = "SELECT * FROM tbl_tochuc";
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		echo json_encode($list);
	}
	
	function getBiensoByDonvi() {
		$donvi = isset($_REQUEST['donvi']) ? intval($_REQUEST['donvi']) : 0;
		$sql = "SELECT id,imei,	plate_number,update_time FROM tbl_phuongtien WHERE idtochuc = {$donvi} ORDER BY update_time DESC";
		//echo $sql;
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		echo json_encode($list);
	}

	function getAllBienso() {
		$sql = "SELECT id,imei,	plate_number FROM tbl_phuongtien";
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		echo json_encode($list);
	}

	function getVitriTauMoinhatByBienso() {
		//$bienso = isset($_REQUEST['bienso']) ? intval($_REQUEST['bienso']) : 0;
		$bienso = $_GET['bienso'];
		$sql = "SELECT a.*,b.plate_number as sohieu FROM tbl_log a LEFT JOIN tbl_phuongtien b ON a.log_imei = b.imei WHERE b.plate_number = '{$bienso}'  ORDER BY log_time DESC LIMIT 0,1";
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		//echo $sql;
		echo json_encode($list);
	}

	
	/*
	CREATE EVENT IF NOT EXISTS `session_cleaner_event`
ON SCHEDULE
  EVERY 13 DAY_HOUR
  COMMENT 'Clean up sessions at 13:00 daily!'
  DO
    DELETE FROM site_activity.sessions;
	*/

?>