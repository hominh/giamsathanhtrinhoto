<?php
  include ("include/connect.php");	
  
  session_start();
  if($_SESSION["session_nsd_taikhoan"]!="" && $_SESSION["session_nsd_matkhau"]!=""){      
    $q = " SELECT * FROM tbl_nguoidung ";    
    $r = mysql_query($q);
    $rows = mysql_fetch_array($r);    
    $iduser = $rows['id'];
    $count = mysql_num_rows($r);    
    if ($count == 0) {
      echo "<script language=\"javascript\">";
      echo "window.location = \"login.php\";";
      echo "</script>";
    }
    else {
      if ( ($rows["password"] != $_SESSION["session_nsd_matkhau"])) {       
        echo "<script language=\"javascript\">";
        echo "window.location = \"login.php\";";
        echo "</script>";
      }
    }
  }    
?>