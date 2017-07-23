<?php
    session_start();
    unset($_SESSION['session_nsd_taikhoan']);
    unset($_SESSION['session_nsd_matkhau']);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Hệ thống giám sát và điều khiển mạng giao thông</title>
        <link rel="stylesheet" type="text/css" href="public/css/demo.css" />
        <link rel="stylesheet" type="text/css" href="public/css/style2.css" />
        <link rel="stylesheet" type="text/css" href="public/css/animate-custom.css" />
    </head>
    <body>
        <?php
        	include ("include/connect.php");	
       
			if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
				if (isset($_POST ['username'])) {                
                	$username = $_POST['username'];
            	}
            	if (isset($_POST ['password'])) {
                	$password = md5($_POST ["password"]);
            	}
            	$q = "SELECT * FROM tbl_nguoidung WHERE username='$username' LIMIT 0,1 ";
            	$r = mysql_query($q);
            	$rows = mysql_fetch_array($r);  
            	$count = mysql_num_rows($r);
            	$errmsg="";
            	if ($count == 0) {
            		$errmsg = "Tài khoản này không tồn tại";
            	}
            	else if ($count == 1) {
            		if ($rows["password"] == $password) {
            			session_start();
            			$_SESSION['session_nsd_id'] = $rows["id"];
                        $_SESSION['session_nsd_taikhoan'] = $username;
                        $_SESSION['session_nsd_matkhau'] = $password;
                        session_write_close();
            		}
            	}

			}
	
       		if ($errmsg != "") {
		$location.="?errmsg=" . $errmsg;
	    } else {	   
	       $location = "Location: index.php";
	       header($location); 
	    }
        
        ?>
        <div class="container">
            <header>
                <h1>CADPROTMMS</h1>
            </header>
            <section>
                <div id="container_demo">
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form method="post" action="" autocomplete="on">
                                <h1>Đăng nhập</h1>
                                <p>
                                    <label for="username" class="uname">Tên tài khoản</label>
                                    <input id="username" name="username" required="required"
                                           type="text" />
                                </p>
                                <p>
                                    <label for="password" class="youpasswd">Mật khẩu</label>
                                    <input id="password" name="password" required="required"
                                           type="password" />
                                </p>
                                <p class="login button">
                                    <input type="submit" value="Đăng nhập" />
                                </p>
                                <p class="errormsg"> 
                                    <?php echo $errmsg; ?>
                                </p>
                            </form>
                        </div>
                    </div>

            </section>
        </div>
    </body>
</html>