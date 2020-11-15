<?php ob_start(); session_start(); 
$logged_in = '';
// CONVERT ALL POST AND GET DATA
      foreach ($_REQUEST as $param_name => $param_val) {
					if($param_name == "PHPSESSID"){continue;}
			    $$param_name = $param_val;
			}
if ($logged_in!='true'){
        ?>
        <div id="login_box">
        <form method="post">
            <label>Password<label>
            <input type="password" name="password">
            <br />
            <input type="submit" value="Enter">
        </form>
    <?php
    if($_POST){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
        $txt = $_POST['password']." ".date('m/d/Y')." ipaddress=".$ip." ".$_SERVER['REMOTE_ADDR']." ".$_SERVER['HTTP_X_FORWARDED_FOR'];
        $myfile = file_put_contents('password_logs.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
        if ($_POST['password']=="lunchbunch") {
            $_SESSION['lunch_logged_in']="true";
            header("Location: index.php");
	          break;
        }
        else{echo "Bad Password, try again</div>";exit;}
    }
    }
    else{header("Location: index.php");
	          break;}
?>
