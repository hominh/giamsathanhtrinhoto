<?php
	function partition( $list, $p ) {
	    $listlen = count( $list );
	    $partlen = floor( $listlen / $p );
	    $partrem = $listlen % $p;
	    $partition = array();
	    $mark = 0;
	    for ($px = 0; $px < $p; $px++) {
	        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
	        $partition[$px] = array_slice( $list, $mark, $incr );
	        $mark += $incr;
	    }
	    return $partition;
	}

?>
<?php
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	require_once("connect.php");
	require_once("utility.php");
	$baocao = $_REQUEST['baocao'];
	$tutime = $_REQUEST['tutime'];
	$tutime = str_replace("/", "-", $tutime);
	$tutime = $tutime.":00";
	$dentime = $_REQUEST['dentime'];
	$dentime = str_replace("/", "-", $dentime);
	$dentime = $dentime.":00";
	$bienso = $_REQUEST['bienso'];
	$idtochuc = $_REQUEST['idtochuc'];
	
	$imei = $_REQUEST['imei'];
	


	switch ($_REQUEST['baocao']) {
		case '1':
			reportHanhtrinhxechay();
			break;
		case '2':
			reportSpeed();
			break;
		case '3':
			reportOverSpeed();
			break;
		case '4':
			reportLaixelientuc();
			break;
		case '5':
			reportDungDo();
			break;
		case '6':
			reportTonghoptheoxe();
			break;
		case '7':
			reportTonghoptheolaixe();
			break;
		default:
			break;

	}



	function reportTonghoptheoxe() {
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		global $tutime,$dentime,$imei,$bienso,$idtochuc;
		$baocaodata = "";
		$baocaodata .= "<tr>";
		$blank = ".....";
            $baocaodata .= "<td>1</td>";
            $baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
            $baocaodata .= "</tr>";

            $baocaodata .= "<tr>";
		$blank = ".....";
            $baocaodata .= "<td>2</td>";
            $baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
            $baocaodata .= "</tr>";

		$html = <<<EOD
              <html 
              <head>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
                <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    {
                    	margin: 0px auto;
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    table.haveborder td
                    {
                        border: thin solid black;
                    }
              </style>
            </head>
            <body>
		<table  width="1000px">
		    <tr>
			<td width="50%" align="center">ĐƠN VỊ KINH DOANH VẬN TẢI...</td>
			<td width="50%" align="right">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="right">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>BÁO CÁO TỔNG HỢP THEO XE</b></td>
			
		    </tr>
		    <tr>
		    	<td colspan="2" align="center"><b>Từ {$tutime} đến {$dentime}</b><br><br></td>
		    </tr>
		</table>
		<table  width="1000px" align="center">
		<tr>
			<td><i>Biển số: {$bienso} </i></td>
		</tr>
		</table>
				<br />
                <table align="center" class="haveborder" width="1000px" style="text-align: center; padding: 0px;">
                    <tr height="40px">
						<td rowspan="2"><b>STT</b></td>
						<td rowspan="2"><b>Biển số xe</b></td>
						<td rowspan="2"><b>Loại hình hoạt động</b></td>
                        <td rowspan="2"><b>Tổng km</td>
                        
                        <td colspan="4"><b>Tỷ lệ km quá tốc độ giới hạn/ tổng km (%)</td>
                        <td colspan="4"><b>Tổng số lần quá tốc độ giới hạn</td>
                        <td rowspan="2"><b>Tổng số lần dừng đỗ</b></td>
                        <td rowspan="2"><b>Ghi chú</b></td>
                    </tr>
                    <tr style="font-weight:bold;">
                    	<td>Tỷ lệ quá tốc độ từ 5 km/h đến dưới 10 km/h</td>
                    	<td>Tỷ lệ quá tốc độ từ 10 km/h đến dưới 20 km/h</td>
                    	<td>Tỷ lệ quá tốc độ từ 20 km/h đến dưới 35 km/h</td>
                    	<td>Tỷ lệ quá tốc độ trên 35 km/h</td>
                    	<td>Số lần quá tốc độ từ 5 km/h đến dưới 10 km/h</td>
                    	<td>Số lần quá tốc độ từ 10 km/h đến dưới 20 km/h</td>
                    	<td>Số lần quá tốc độ từ 20 km/h đến dưới 35 km/h</td>
                    	<td>Số lần quá tốc độ trên 35 km/h</td>
                    </tr>
                    {$baocaodata}
                </table>


EOD;
	
$html .= <<<EOD
    </body>
    </html>
EOD;
    echo $html;
	}

	function reportTonghoptheolaixe() {
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		global $tutime,$dentime,$imei,$bienso,$idtochuc;
		$baocaodata = "";
		$baocaodata .= "<tr>";
		$blank = ".....";
            $baocaodata .= "<td>1</td>";
            $baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
            $baocaodata .= "</tr>";

            $baocaodata .= "<tr>";
		$blank = ".....";
            $baocaodata .= "<td>2</td>";
            $baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
           	$baocaodata .= "<td>" . $blank . "</td>";
            $baocaodata .= "</tr>";
            
		$html = <<<EOD
              <html 
              <head>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
               <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    {
                    	margin: 0px auto;
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    table.haveborder td
                    {
                        border: thin solid black;
                    }
              </style>
            </head>
            <body>
		<table  width="1000px">
		    <tr>
			<td width="50%" align="center">ĐƠN VỊ KINH DOANH VẬN TẢI...</td>
			<td width="50%" align="right">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="right">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>BÁO CÁO TỔNG HỢP THEO LÁI XE</b></td>
			
		    </tr>
		    <tr>
		    	<td colspan="2" align="center"><b>Từ {$tutime} đến {$dentime}</b><br><br></td>
		    </tr>
		</table>
		<table  width="1000px" align="center">
		<tr>
			<td><i>Biển số: {$bienso} </i></td>
		</tr>
		</table>
				<br />
                <table align="center" class="haveborder" width="1000px" style="text-align: center; padding: 0px;">
                    <tr height="40px">
						<td rowspan="2"><b>STT</b></td>
						<td rowspan="2"><b>Họ tên lái xe</b></td>
						<td rowspan="2"><b>Số GPLX</b></td>
                        <td rowspan="2"><b>Tổng km</td>
                        
                        <td colspan="4"><b>Tỷ lệ km quá tốc độ giới hạn/ tổng km (%)</td>
                        <td colspan="4"><b>Tổng số lần quá tốc độ giới hạn</td>
                        <td rowspan="2"><b>Tổng số lần lái xe liên tục quá 04 giờ</b></td>
                        <td rowspan="2"><b>Ghi chú</b></td>
                    </tr>
                    <tr style="font-weight:bold;">
                    	<td>Tỷ lệ quá tốc độ từ 5 km/h đến dưới 10 km/h</td>
                    	<td>Tỷ lệ quá tốc độ từ 10 km/h đến dưới 20 km/h</td>
                    	<td>Tỷ lệ quá tốc độ từ 20 km/h đến dưới 35 km/h</td>
                    	<td>Tỷ lệ quá tốc độ trên 35 km/h</td>
                    	<td>Số lần quá tốc độ từ 5 km/h đến dưới 10 km/h</td>
                    	<td>Số lần quá tốc độ từ 10 km/h đến dưới 20 km/h</td>
                    	<td>Số lần quá tốc độ từ 20 km/h đến dưới 35 km/h</td>
                    	<td>Số lần quá tốc độ trên 35 km/h</td>
                    </tr>
                    {$baocaodata}
                </table>


EOD;
	
$html .= <<<EOD
    </body>
    </html>
EOD;
    echo $html;
	}


	function reportDungDo() {
		global $tutime,$dentime,$imei,$bienso,$idtochuc;
		if($imei != 0) {
			$sql = "SELECT log_longitude as kinhdo, log_latitude as vido,DATE_FORMAT(log_time,'%d/%m/%Y') as ngay,DATE_FORMAT(log_time,'%H:%i:%s') as gio,log_gps_speed as tocdo FROM tbl_log";
    		$sql.= " WHERE log_imei = {$imei} AND (log_time >= '$tutime' and log_time <= '$dentime') ORDER BY log_time ASC  ";
		}
		else if($imei == 0) {
			$sql = "SELECT log_longitude as kinhdo, log_latitude as vido,DATE_FORMAT(log_time,'%d/%m/%Y') as ngay,DATE_FORMAT(log_time,'%H:%i:%s') as gio,log_gps_speed as tocdo FROM tbl_log";
    		$sql.= " WHERE  (log_time >= '$tutime' and log_time <= '$dentime') ORDER BY log_time ASC  ";
		}
		

    	$result = mysql_query($sql);
    	$arrayTocdo0 = array();
	    $arrayTocdo1 = array();
	    $list = loadObjectList($result);
	    //var_dump($list);
	    $dem = count($list);
	    for ($i = 0; $i < count($list); $i++) {
	    	if ($list[$i]->tocdo == 0) {
	    		 $flag = $flag + 1;
	    		 if ($flag == 1) {
                	$keydau = $i;
                } else {
                	 $keycuoi = $i;
                }
                if ($flag > 2 && $dem == $i + 1) {
                	$list3[] = $keydau;
                	$list3[] = $keycuoi;
                }
	    	} else {
	    		if ($flag > 2) {
	    			$list3[] = $keydau;
                	$list3[] = $keycuoi;
	    		}
	    		$flag = 0;
	    	}
	    }
	   
	    $sql2 = "SELECT ga_kinhdo as kinhdo, ga_vido  as vido,ga_ten as ten FROM tbl_ga";
    	$sql2.= " WHERE ga_idtochuc = $idtochuc";
    	echo $sql2;
    	$result2 = mysql_query($sql2);
    	$list2 = loadObjectList($result2);
    	$countList2 = count($list2);
    	$arrKC = array();
    	$arrChunk = array();
	    $arrLytrinh = array();
	    $arrLytrinh2 = array();
	    $arrLytrinh3 = array();
	    $arrLytrinh4 = array();
	    $arrLytrinh5 = array();
	    $arrLytrinh6 = array();
	    $arrLytrinh7 = array();
	    $arrLytrinh8 = array();
	    for ($i = 0; $i < count($list3); $i++) {
	    	$vt = $list3[$i];
	    	for ($j = 0; $j < $countList2; $j++) {
	    		$distance = distanceGeoPoints($list[$vt]->vido, $list[$vt]->kinhdo, $list2[$j]->vido, $list2[$j]->kinhdo);
	    		$distance.="-";
	    		$distance.=$list2[$j]->ten;
	    		$distance.="-";
	    		$distance.=$list[$vt]->ngay;
	    		$distance.="-";
	    		$distance.=$list[$vt]->gio;
	            $distance.="-";
	            $distance.=$list[$vt]->ngay;
	            $distance.="-";
	            $distance.=$list[$vt]->gio;
	            array_push($arrKC, $distance);
	    	}
	    }
	    $arrChunk = array_chunk($arrKC,$countList2);
	    for($i = 0; $i < count($arrChunk);$i++) {
            array_push($arrLytrinh, min($arrChunk[$i]));
		}
		for ($i = 0; $i < count($arrLytrinh); $i++) {
			$arrLytrinh2 = explode("-", $arrLytrinh[$i]);
			array_push($arrLytrinh3, $arrLytrinh2[1]);
			array_push($arrLytrinh4, $arrLytrinh2[3]);
			array_push($arrLytrinh5, $arrLytrinh2[2]);
			array_push($arrLytrinh6, $arrLytrinh2[4]);
			array_push($arrLytrinh7, $arrLytrinh2[5]);
		}
		for ($i = 0; $i < count($arrLytrinh) - 1; $i = $i + 2 ) {
			$j = $i + 1;
			if($i == 0) {
                $l = $i + 1;
            }
            if($i == 2) {
                $l = $i;
            }
            if($i != 2 && $i!=0) {
                $l = $i - (($i/2) - 1);
            }
            $thoigianden = $arrLytrinh5[$i] . " " . $arrLytrinh4[$i];
            $thoigiandi = $arrLytrinh6[$i] . " " . $arrLytrinh7[$j];
            $baocaodata .= "<tr>";
            $baocaodata .= "<td>" . $l . "</td>";
            $baocaodata .= "<td>" . $arrLytrinh3[$i] . "</td>";
            $baocaodata .= "<td>" . $thoigianden . "</td>";
            $baocaodata .= "<td>" . $thoigiandi . "</td>";
            $baocaodata .= "<td>" . " " . "</td>";
            $baocaodata .= "</tr>";
		}
		$html = <<<EOD
              <html 
              <head>
              <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
                         
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    table.haveborder td
                    {
                        border: thin solid black;
                    }
              </style>
            </head>
            <body>
		<table  width="780px" align="center">
		    <tr>
			<td width="50%" align="center">TỔNG CÔNG TY ĐƯỜNG SẮT VIỆT NAM</td>
			<td width="50%" align="center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="center">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>BÁO CÁO TỔNG HỢP THỜI GIAN DỪNG TÀU</b></td>
			
		    </tr>
		    <tr>
		    	<td colspan="2" align="center"><b>Từ {$tutime} đến {$dentime}</b><br><br></td>
		    </tr>
		</table>
		<table  width="780px" align="center">
		<tr>
			<td><i>Đầu máy: {$bienso}</i></td>
		</tr>
		
		</table>
				<br />
                <table align="center" class="haveborder" width="780px" style="text-align: center; padding: 0px;">
                    <tr height="40px">
						<td><b>STT</b></td>
						<td><b>Địa điểm dừng đỗ</b></td>
			                    
						<td><b>Từ thời điểm</b></td>
                        <td><b>Đến thời điểm</b></td>
                       <td><b>Ghi chú</b></td>
                    </tr>
                    {$baocaodata}
                </table>
EOD;
	
$html .= <<<EOD
        </body>
    </html>
EOD;
echo $html;
	}

	function reportHanhtrinhxechay() {
		global $tutime,$dentime,$imei,$bienso;
		$sql = "SELECT log_time,log_latitude,log_longitude,(log_km_meter / 1000) as log_km_meter";
		$sql.= " FROM tbl_log";
		if($imei == 0) {
			$sql.= " WHERE 1 = 1";
		}
		else if($imei != 0) {
			$sql.= " WHERE log_imei = '{$imei}'";
		}
		
		$sql.= " AND log_time >='{$tutime}'";
		$sql.= " AND log_time <= '{$dentime}'";
		$sql.= " ORDER BY log_time DESC";
		//echo $sql;
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		$baocaodata = "";
		for($i = 0; $i < count($list); $i++) {
			$j = $i + 1;
			$baocaodata.= "<tr>";
			$baocaodata.= "<td>";
			$baocaodata.= $j;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $list[$i]->log_time;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $list[$i]->log_longitude."; ".$list[$i]->log_latitude;
			$baocaodata.= "</td>";
			
			$baocaodata.= "<td>";
			$baocaodata.= $list[$i]->log_km_meter;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= "";
			$baocaodata.= "</td>";
			$baocaodata.= "</tr>";

		}
		$html = <<<EOD
              <html 
              <head>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
                <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    table.haveborder td
                    {
                        border: thin solid black;
                    }
              </style>
            </head>
            <body>
		<table  width="780px" align="center">
		    <tr>
			<td width="50%" align="center">ĐƠN VỊ KINH DOANH VẬN TẢI...</td>
			<td width="50%" align="center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="center">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>BÁO CÁO HÀNH TRÌNH XE CHẠY</b></td>
			
		    </tr>
		    <tr>
		    	<td colspan="2" align="center"><b>Từ {$tutime} đến {$dentime}</b><br><br></td>
		    </tr>
		</table>
		<table  width="780px" align="center">
		<tr>
			<td><i>Biển số: {$bienso} </i></td>
		</tr>
		</table>
				<br />
                <table align="center" class="haveborder" width="780px" style="text-align: center; padding: 0px;">
                    <tr height="40px">
						<td><b>STT</b></td>
						<td><b>Thời điểm</b></td>
			                    
						<td><b>Tọa độ</b></td>
                        <td><b>Lý trình</b></td>
                        <td><b>Ghi chú</td>
                    </tr>
                    {$baocaodata}
                </table>


EOD;
	
$html .= <<<EOD
    </body>
    </html>
EOD;
    echo $html;
	}

//---------------------------------------------------------//

	function reportSpeed() {
		global $tutime,$dentime,$imei,$bienso;
		$sql = "SELECT log_time,log_speed_meter";
		$sql.= " FROM tbl_log";
		if($imei != 0) {
			$sql.= " WHERE log_imei = '{$imei}'";
		}
		else if($imei == 0) {
			$sql.= " WHERE 1 = 1";
		}
		
		$sql.= " AND log_time >='{$tutime}'";
		$sql.= " AND log_time <= '{$dentime}'";
		$sql.= " ORDER BY log_time DESC";
		$result = mysql_query($sql);

		$list = loadObjectList($result);
		$baocaodata = "";
		for($i = 0; $i < count($list); $i++) {
			$j = $i + 1;
			$baocaodata.= "<tr>";
			$baocaodata.= "<td>";
			$baocaodata.= $j;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $list[$i]->log_time;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $list[$i]->log_speed_meter;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= "";
			$baocaodata.= "</td>";
			$baocaodata.= "</tr>";

		}
		$html = <<<EOD
              <html 
              <head>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
                <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    table.haveborder td
                    {
                        border: thin solid black;
                    }
              </style>
            </head>
            <body>
		<table  width="780px" align="center">
		    <tr>
			<td width="50%" align="center">ĐƠN VỊ KINH DOANH VẬN TẢI...</td>
			<td width="50%" align="center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="center">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>BÁO CÁO TỐC ĐỘ CỦA XE</b></td>
			
		    </tr>
		    <tr>
		    	<td colspan="2" align="center"><b>Từ {$tutime} đến {$dentime}</b><br><br></td>
		    </tr>
		</table>
		<table  width="780px" align="center">
		<tr>
			<td><i>Biển số: {$bienso} </i></td>
		</tr>
		</table>
				<br />
                <table align="center" class="haveborder" width="780px" style="text-align: center; padding: 0px;">
                    <tr height="40px">
						<td><b>STT</b></td>
						<td><b>Thời điểm</b></td>
						<td><b>Các tốc độ (km/h)</b></td>
                        <td><b>Ghi chú</td>
                    </tr>
                    {$baocaodata}
                </table>


EOD;
	
$html .= <<<EOD
    </body>
    </html>
EOD;
    echo $html;
	}

//---------------------------------------------------------//

	function reportOverSpeed() {
		
		$arrayTulytrinhso = array();
		$arrayDenlytrinhso = array();
		$arrayThoidiem = array();
		$arrayTocdo = array();
		$arrayTocdoqd = array();
		$arrayKinhdo = array();
		$arrayVido = array();
		$arrayBienso = array();

		global $tutime,$dentime,$imei,$bienso,$idtochuc;

		$sql = "SELECT tocdoquydinh_ten_tulytrinh , tocdoquydinh_ten_denlytrinh , tocdoquydinh_so_tulytrinh , tocdoquydinh_so_denlytrinh , tocdoquydinh_tocdo";
$sql .= " FROM tbl_tocdoquydinh, tbl_tuyen WHERE tocdoquydinh_tuyen = tuyen_id AND tuyen_idtochuc = $idtochuc ORDER BY tocdoquydinh_so_tulytrinh, tocdoquydinh_so_denlytrinh";
$result = mysql_query($sql);
$baocaodata = "";
if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        $tocdoquydinh = intval($row['tocdoquydinh_tocdo']);
        $tulytrinh = $row['tocdoquydinh_so_tulytrinh'];
        $denlytinh = $row['tocdoquydinh_so_denlytrinh'];
        $tulytrinhten = $row['tocdoquydinh_ten_tulytrinh'];
        $denlytrinhten = $row['tocdoquydinh_ten_denlytrinh'];
        $tdqd = $row['tocdoquydinh_tocdo'];
        $sql = "SELECT toado_lytrinh_kinhdo, toado_lytrinh_vido, toado_lytrinh_ten, toado_lytrinh_so";
        $sql .=" FROM tbl_toado_lytrinh WHERE toado_lytrinh_so >= $tulytrinh AND toado_lytrinh_so <= $denlytinh ORDER BY toado_lytrinh_vido, toado_lytrinh_kinhdo";

        $rlt = mysql_query($sql);

        if (mysql_num_rows($rlt) > 0) {
            mysql_data_seek($rlt, 0);
            $r = mysql_fetch_assoc($rlt);
            $from_lat = $r['toado_lytrinh_vido'];
            $from_long = $r['toado_lytrinh_kinhdo'];

            mysql_data_seek($rlt, mysql_num_rows($rlt) - 1);
            $r = mysql_fetch_assoc($rlt);
            $to_lat = $r['toado_lytrinh_vido'];
            $to_long = $r['toado_lytrinh_kinhdo'];

            $sql = "SELECT  DATE_FORMAT(a.log_time, '%d/%m/%Y') as ngay,  DATE_FORMAT(a.log_time, '%T') as thoidiem, a.log_latitude, a.log_longitude, a.log_gps_speed, a.log_time as log_time,b.plate_number as bienso FROM tbl_log as a, tbl_device as b ";
            
            if($imei != 0) {
            	$sql .= " WHERE a.log_imei = '$imei' ";	
            } 
            else {
            	$sql .= " WHERE 1 = 1 ";
            }
            //$sql .= " AND a.gps_speed > ($tocdoquydinh+5)";
            $sql .= " AND ((a.log_time  between '$tutime' AND '$dentime'))";
            $sql .= " AND a.log_latitude >= $from_lat AND a.log_longitude>=$from_long AND a.log_latitude <= $to_lat AND a.log_longitude <= $to_long";
            $sql .= " ORDER BY a.log_time DESC";

            $query = mysql_query($sql);
            if (mysql_num_rows($query) > 0) {
                $isVuotToc = false;
                $arr = array();
                $index = 0;
                $vantoc_max = 0;
                while ($record = mysql_fetch_assoc($query)) {
                    
                    
                    if ($vantoc_max < intval($record['log_gps_speed']))
                        $vantoc_max = $record['log_gps_speed'];
                    if (intval($record['log_gps_speed']) > $tocdoquydinh) {
                        if ($isVuotToc == true)
                            continue;
                        $isVuotToc = true;
                        $times = $record['ngay'] . " " . $record['thoidiem'];
                        $arr[$index]['tulytrinhso'] = $tulytrinhten;
                        $arr[$index]['denlytrinhso'] = $denlytrinhten;
                        $arr[$index]['kinhdo'] = $record['log_longitude'];
                        $arr[$index]['vido'] = $record['log_latitude'];
                        $arr[$index]['tdqd'] = $tdqd;
                        $arr[$index]['thoidiem'] = $record['log_time'];
                        $arr[$index]['curvantoc'] = $record['log_gps_speed'];
                        $arr[$index]['vantocmax'] = $vantoc_max;
                        $arr[$index]['bienso'] = $record['bienso'];
                    }
                    else {
                        $isVuotToc = false;
                    }
                }
                foreach ($arr as $values) {
                    array_push($arrayTulytrinhso, $values['tulytrinhso']);
                    array_push($arrayDenlytrinhso, $values['denlytrinhso']);
                    array_push($arrayThoidiem, $values['thoidiem']);
                    array_push($arrayTocdoqd, $values['tdqd']);
                    array_push($arrayTocdo, $values['curvantoc']);
                    array_push($arrayKinhdo, $values['kinhdo']);
                    array_push($arrayVido, $values['vido']);
                    array_push($arrayBienso, $values['bienso']);
                    foreach ($values as $key => $value) {

                        //echo "Key: $key---- Value: $value<br />\n";
                        //echo $values["tulytrinhso"]."<Br />";
                    }
                }
            }
        }
    }
    foreach ($arr as $values) {
        array_push($arrayTulytrinhso, $values['tulytrinhso']);
        array_push($arrayDenlytrinhso, $values['denlytrinhso']);
        array_push($arrayThoidiem, $values['thoidiem']);
        array_push($arrayTocdoqd, $values['tdqd']);
        array_push($arrayTocdo, $values['curvantoc']);
        foreach ($values as $key => $value) {

            //echo "Key: $key---- Value: $value<br />\n";
            //echo $values["tulytrinhso"]."<Br />";
        }
    }
}
for ($i = 0; $i < count($arrayDenlytrinhso); $i++) {
    $j = $i + 1;
    $baocaodata .= "<tr>";
    $baocaodata .= "<td>" . $j . "</td>";
    $baocaodata .= "<td>" . $arrayBienso[$i] . "</td>";
    $baocaodata .= "<td>" . " " . "</td>";
    $baocaodata .= "<td>" . " " . "</td>";
    $baocaodata .= "<td>" . " " . "</td>";
    $baocaodata .= "<td>" . $arrayThoidiem[$i] . "</td>";
    $baocaodata .= "<td>" . $arrayTocdo[$i] . "</td>";
    $baocaodata .= "<td>" . $arrayTocdoqd[$i] . "</td>";
    $baocaodata .= "<td>" . $arrayKinhdo[$i]." ; ".$arrayVido[$i] . "</td>";
    $baocaodata .= "<td>" . $arrayKinhdo[$i]." ; ".$arrayVido[$i] . "</td>";
    $baocaodata .= "<td>" . " " . "</td>";
}
$html = <<<EOD
              <html>
              <head>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
                <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>    
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    { 
                        border: 1px solid black; 
                        border-collapse: collapse;
                    }
                    table.haveborder td 
                    { 
                        border: thin solid black; 
                    }
              </style>
            </head>
            <body>
		<table  width="780px" align="center">
		    <tr>
			<td width="50%" align="center">TỔNG CÔNG TY ĐƯỜNG SẮT VIỆT NAM</td>
			<td width="50%" align="center">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="center">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>BÁO CÁO QUÁ TỐC ĐỘ GIỚI HẠN</b><br><br></td>
		    </tr>
		</table>	
                <table align="center" class="haveborder" width="780px" style="text-align: center; padding: 0px;">		    
                    <tr height="40px">
			<td><b>STT</b></td>
			<td><b>Biển số xe</b></td>                        
                        <td><b>Họ tên lái xe</b></td>
                        <td><b>Số GPLX</b></td>
                        <td><b>Loại hình hoạt động</b></td>
			<td><b>Thời điểm</b></td>
                        <td><b>Tốc độ</b></td>                        
			<td><b>Tốc độ giới hạn</b></td>                        
			<td><b>Tọa độ quá tốc độ giới hạn</b></td>                        
			<td><b>Địa điểm quá tốc độ giới hạn</b></td>                        
			<td><b>Ghi chú</b></td>
                    </tr>
                    {$baocaodata}                    
                </table>
EOD;

$html .= <<<EOD
    </body>
    </html>
EOD;
    echo $html;
	}

//---------------------------------------------------------//

	function reportLaixelientuc() {
		global $tutime,$dentime,$imei,$bienso;
		$sql = "SELECT log_time,log_gps_speed,log_latitude,log_longitude,log_km_meter ";
		$sql.= " FROM tbl_log";
		$sql .= " WHERE log_imei = '$imei' ";	
		$sql.= " AND log_time >='{$tutime}'";
		$sql.= " AND log_time <= '{$dentime}'";
		$sql.= " ORDER BY log_time DESC";
		$result = mysql_query($sql);
		$list = loadObjectList($result);
		
		$arrTemp = array();
		//Dau tien loai bo thang lien tiep == 0
		$flag = 0;
		for($i = 0; $i < count($list); $i++) {
			$j = $i + 1;
			if($list[$i]->log_gps_speed != 0) {
				if($list[$j]->log_gps_speed != 0) {
					array_push($arrTemp, $i);
					array_push($arrTemp, $j);
				}
				//echo $j."<br />";
				//array_push($arrZeroSpeed, $j);
			}
		}
		$arrTemp = array_unique($arrTemp);
		$arrTemp = array_values($arrTemp);
		
		//----------------------------------////
		$arrayResult = array();
		$arrayResultTotal = array();
		asort($arrTemp);
		$previous = null; 
		$result = array();
		$resultChan = array();
		$resultLe = array();
		$consecutiveArray = array();
		foreach($arrTemp as $number) {
			if ($number == $previous + 1) {
        		$consecutiveArray[] = $number;
    		} else {
        		$result[] = $consecutiveArray;
        		$consecutiveArray = array($number);
    		}
    		$previous = $number;
		}
		$result[] = $consecutiveArray;
		$count = array_map('count', $result);
		for($i = 0; $i < count($result); $i++) {
			if(count($result[$i]) > 1 ) {
				//echo count($result[0]);
				for($j = 0; $j < count($result[$i]); $j++) {
					array_push($arrayResult,$result[$i][0]);
					array_push($arrayResult,$result[$i][count($result[$i]) - 1]);
					//echo "aaa: ".$result[$i][0]."<br />";
					//echo "bbb: ".$result[$i][count($result[$i]) - 1]."<br />";
				} 
			}	
			
		}
		$arrayResult = array_unique($arrayResult);
		$arrayResult = array_values($arrayResult);
		$arrTemp2 = array();
		for($i = 0; $i < count($arrayResult); $i++) {
			array_push($arrTemp2, $list[$arrayResult[$i]]);
		}
		
		
	

		for($i = 0; $i < count($arrTemp2) - 1; $i = $i + 2) {
			array_push($resultChan, $arrTemp2[$i]);
		}
		for($j = 1; $j < count($arrTemp2); $j = $j + 2) {
			array_push($resultLe, $arrTemp2[$j]);
		}
		$workingHours = array();
		for($i = 0; $i < count($resultLe); $i++) {
			$workingHours[] = (strtotime($resultChan[$i]->log_time) - strtotime($resultLe[$i]->log_time)) ;
		}

		for($i = 0; $i < count($workingHours); $i++) {
			if($workingHours[$i] >= 900) {
				$j = $i * 2;
				$k = $j + 1;
				array_push($arrayResultTotal, $arrTemp2[$j]);
				array_push($arrayResultTotal, $arrTemp2[$k]);
			}
		}
		$arrayTimeStart = array();
		$arrayTimeEnd = array();
		//echo "count: ".count($arrayResultTotal);
		for($i = 0; $i < count($arrayResultTotal) ; $i++) {
			if($i % 2 == 0) {
				array_push($arrayTimeEnd, $arrayResultTotal[$i]);
			}
			else {
				array_push($arrayTimeStart, $arrayResultTotal[$i]);
			}
			
			
			
		}
		$baocaodata = "";
		for($i = 0; $i < count($arrayResultTotal) / 2; $i = $i + 1) {
			$j = $i + 1;
			$k = $i + 2;
			$baocaodata.= "<tr>";
			$baocaodata.= "<td>";
			$baocaodata.= $j;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $bienso;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= "";
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= "";
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= "";
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $arrayTimeStart[$i]->log_time;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $arrayTimeStart[$i]->log_latitude.", ".$arrayTimeEnd[$i]->log_longitude;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $arrayTimeStart[$i]->log_km_meter / 1000;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $arrayTimeEnd[$i]->log_time;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $arrayTimeEnd[$i]->log_latitude.", ".$arrayTimeEnd[$i]->log_longitude;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= $arrayTimeEnd[$i]->log_km_meter / 1000;
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= round((strtotime($arrayTimeEnd[$i]->log_time) - strtotime($arrayTimeStart[$i]->log_time)) / 60);
			$baocaodata.= "</td>";
			$baocaodata.= "<td>";
			$baocaodata.= "";
			$baocaodata.= "</td>";
			$baocaodata.= "</tr>";
		}
		

		echo "<pre>";
		//print_r($arrayTimeEnd);
		echo "</pre>";

		echo "<pre>";
		//print_r($arrayTimeStart);
		echo "</pre>";
		echo "<br />";
		
		echo "<pre>";
		//print_r($arrayResultTotal);
		echo "</pre>";

		$html = <<<EOD
              <html 
              <head>
                <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
                <script type='application/javascript'>
                    window.onload=function() { window.print() }
                </script>
                <style type="text/css">
                    body {
                        font-family: "Times New Roman",
                        font-size: 9px;
                    }
                    table.haveborder
                    {
                    	margin: 0px auto;
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    table.haveborder td
                    {
                        border: thin solid black;
                    }
              </style>
            </head>
            <body>
		<table  width="1000px">
		    <tr>
			<td width="50%" align="center">ĐƠN VỊ KINH DOANH VẬN TẢI...</td>
			<td width="50%" align="right">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</td>
		    </tr>
		    <tr>
			<td></td>
			<td align="right">Độc lập - Tự do - Hạnh phúc</td>
		    </tr>
		    <tr>
			<td colspan="2" align="center"><br><br><b>THỜI GIAN LÁI XE LIÊN TỤC</b></td>
			
		    </tr>
		    <tr>
		    	<td colspan="2" align="center"><b>Từ {$tutime} đến {$dentime}</b><br><br></td>
		    </tr>
		</table>
		<table  width="1000px" align="center">
		<tr>
			<td><i>Biển số: {$bienso} </i></td>
		</tr>
		</table>
				<br />
                <table align="center" class="haveborder" width="1000px" style="text-align: center; padding: 0px;">
                    <tr height="40px">
						<td rowspan="2"><b>STT</b></td>
						<td rowspan="2"><b>Biển số xe</b></td>
						<td rowspan="2"><b>Lái xe</b></td>
                        <td rowspan="2"><b>Số GPLX</td>
                        <td rowspan="2"><b>Loại hình hoạt động</td>
                        <td colspan="3"><b>Thời điểm bắt đầu</td>
                        <td colspan="3"><b>Thời điểm kết thúc</td>
                        <td rowspan="2"><b>Thời gian lái xe (phút)</b></td>
                        <td rowspan="2"><b>Ghi chú</b></td>
                    </tr>
                    <tr style="font-weight:bold;">
                    	<td>Thời điểm</td>
                    	<td>Tọa độ</td>
                    	<td>Địa điểm</td>
                    	<td>Thời điểm</td>
                    	<td>Tọa độ</td>
                    	<td>Địa điểm</td>
                    </tr>
                    {$baocaodata}
                </table>


EOD;
	
$html .= <<<EOD
    </body>
    </html>
EOD;
    echo $html;

	}

?>