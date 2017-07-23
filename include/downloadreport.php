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
	require_once ("Classes/PHPExcel.php");

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
		default:
			break;

	}
	function reportDungDo() {

	}
	function reportHanhtrinhxechay() {
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
		global $tutime,$dentime,$imei,$bienso;
		$sql = "SELECT log_time,log_latitude,log_longitude,(log_km_meter / 1000) as log_km_meter";
		$sql.= " FROM tbl_log";
		$sql.= " WHERE log_imei = '{$imei}'";
		$sql.= " AND log_time >='{$tutime}'";
		$sql.= " AND log_time <= '{$dentime}'";
		$sql.= " ORDER BY log_time DESC";
		$result = mysql_query($sql);
		$list = loadObjectList($result);


		$headings = array("STT", "Thời điểm", "Tọa độ", "Lý trình", "Ghi chú");
		$headings2 = array("BÁO CÁO HÀNH TRÌNH XE CHẠY");
		$style_header = array('borders' => array('bottom' => $default_border, 'left' => $default_border, 'top' => $default_border, 'right' => $default_border, ), 'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => 'FFFFFF'), ), 'font' => array('bold' => true, ));
	$styleHeader = array(
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
					'bold'  => false,
					'color' => array('rgb' => '000000'),
					'size'  => 10,
					'name'  => 'Times New Roman'
			));
	$styleHeader2 = array(
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
			),
			'font'  => array(
					'bold'  => true,
					'color' => array('rgb' => '000000'),
					'size'  => 10,
					'name'  => 'Times New Roman'
			));
	
	$styleArray3 = array(
			'borders' => array(
					'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			),
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'font'  => array(
					'bold'  => false,
					'color' => array('rgb' => '000000'),
					'size'  => 10,
					'name'  => 'Times New Roman'
			));
	
	$styleArray4 = array(
			'borders' => array(
					'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
					)
			),
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'font'  => array(
					'bold'  => true,
					'color' => array('rgb' => '000000'),
					'size'  => 10,
					'name'  => 'Times New Roman'
			));
	$styleArray5 = array(
			'borders' => array(
					'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_NONE
					)
			),
			'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'font'  => array(
					'bold'  => false,
					'italic' => true,
					'color' => array('rgb' => '000000'),
					'size'  => 10,
					'name'  => 'Times New Roman'
			));
		$objPHPExcel->getActiveSheet()
		->getRowDimension('2')
		->setRowHeight(15);
		$objPHPExcel->getActiveSheet()
		->getRowDimension('1')
		->setRowHeight(15);
		$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
		$objPHPExcel->getActiveSheet()->setCellValue('A1','ĐƠN VỊ KINH DOANH VẬN TẢI...');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleHeader2);
		$objPHPExcel->getActiveSheet()->mergeCells('D1:E1');
		$objPHPExcel->getActiveSheet()->setCellValue('D1','CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM');
		$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleHeader2);
		$objPHPExcel->getActiveSheet()->mergeCells('D2:E2');
		$objPHPExcel->getActiveSheet()->setCellValue('D2','               Độc lập - tự do - hạnh phúc');
		$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($styleHeader2);
		$objPHPExcel->getActiveSheet()->setCellValue('C4','BÁO CÁO HÀNH TRÌNH XE CHẠY');
		$objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($styleHeader2);
		$objPHPExcel->getActiveSheet()->mergeCells('A5:B5');
		$objPHPExcel->getActiveSheet()->mergeCells('A6:B6');
		$objPHPExcel->getActiveSheet()->getStyle('B5')->applyFromArray($styleHeader2);
		$objPHPExcel->getActiveSheet()
		->getColumnDimension('B')
		->setWidth(22);
		$objPHPExcel->getActiveSheet()
		->getColumnDimension('C')
		->setWidth(14);
		$objPHPExcel->getActiveSheet()
		->getColumnDimension('D')
		->setWidth(14);
		$objPHPExcel->getActiveSheet()
		->getColumnDimension('E')
		->setWidth(14);
		$objPHPExcel->getActiveSheet()
		->getColumnDimension('A')
		->setWidth(7);

		$objPHPExcel->getActiveSheet()->setCellValue('A7','STT');
		$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleArray4);
		$objPHPExcel->getActiveSheet()->setCellValue('B7','Thời điểm');
		$objPHPExcel->getActiveSheet()->getStyle('B7')->applyFromArray($styleArray4);
		$objPHPExcel->getActiveSheet()->setCellValue('C7','Tọa độ');
		$objPHPExcel->getActiveSheet()->getStyle('C7')->applyFromArray($styleArray4);
		$objPHPExcel->getActiveSheet()->setCellValue('D7','Lý trình');
		$objPHPExcel->getActiveSheet()->getStyle('D7')->applyFromArray($styleArray4);
		$objPHPExcel->getActiveSheet()->setCellValue('E7','Ghi chú');
		$objPHPExcel->getActiveSheet()->getStyle('E7')->applyFromArray($styleArray4);

		for ($i = 0; $i <= count($list); $i++ ) {
			$j = $i + 1;
			$row = $i + 8;
			$toado = $list[$i]->log_latitude."; ".$list[$i]->log_longitude;
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $j );
			$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $list[$i]->log_time );
			$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $toado );
			$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $list[$i]->log_km_meter );
			$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, " " );
		}
		$objPHPExcel->getActiveSheet()->getStyle('H13:H20'.$objPHPExcel->getActiveSheet()->getHighestRow())
   				->getAlignment()->setWrapText(true); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="baocaohanhtrinhxechay.xls"');
		header('Cache-Control: max-age=0');
		$objWriter->save('php://output');
	}