<?php        	
    require_once("config.php");
	
    $con = mysql_connect($HOST, $USER, $PASSWORD);
    if ($con && mysql_select_db($DATABASE)) {	
    	mysql_query("SET NAMES 'utf8'");	
    }
    else
    {	
    	die('Không thể kết nối được với CSDL: ' . mysql_error());
    	echo json_encode(array('error'=>'Không kết nối được với CSDL'));	
    	exit();
    }
		
?>