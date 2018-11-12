<?php 
if(isset($_SERVER['HTTP_COOKIE'])){$kue = $_SERVER['HTTP_COOKIE'];
	$cookies = explode(';', $kue);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $user = trim($parts[0]);
        setcookie($user, '', time()-1000);
        setcookie($user, '', time()-1000, '/');
		setcookie("user", '', time()-1000);
		setcookie("apl", '', time()-1000);		
    	unset($_COOKIE['user']);
    	setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp
    }
}
include "config/server.php";
if($val == TRUE){
$logo = $log['XLogo'];
$banner = $log['XBanner'];
$footer = $log['XSekolah'];
$warna = $log['XWarna'];
}else{ 
$banner = "bannerMadipo.png"; 
$logo ="logo-MADIPO.gif";
$warna = "#0AF713";
$footer = "MADRASAH ALIYAH Diponegoro Bandung";
}
?>
<!DOCTYPE html>
<html  lang="en">
<head>
		<title><?php echo $skull;?> | UJIAN ONLINE</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">   
		<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
		<link href="assets/global/plugins/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
		<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
		 <link href="assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" /> 
		<!-- BEGIN backstretch STYLES -->
		
		
		<link href='images/icon.png' rel='icon' type='image/png'/>
<style>
	.no-close .ui-dialog-titlebar-close {display: none;}
</style>
    
	    
	
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        
        
		

        <!-- BEGIN THEME LAYOUT STYLES -->
       
        <!-- END THEME LAYOUT STYLES -->
		
		
        
    
	<script src="panel/pages/js/bootstrap.js"></script>
	<script src="assets/bootstrap-show-password.min.js"></script>
	<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function () {
 $("#showHide").click(function () {
 if ($(".password").attr("type")=="password") {
 $(".password").attr("type", "text");
 }
 else{
 $(".password").attr("type", "password");
 }
 
 });
 });
</script>
<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script type="text/javascript">
$("form1").validate();
</script>

</head>

<!--
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<div class="page-header navbar navbar-fixed-top">

            
            <div class="page-header-inner ">
                
                <div class="page-logo" style="background-color:#000">
                    <a href="index.php">
                        <img src="images/<?php echo $banner; ?>" alt="logo" class="logo-default" style="width:145px;margin-top:10px;"   /> </a>
					 <!-- BEGIN MENU TOGGLER 
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header
					</div>
					
                </div>
				
               <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                
                <div class="page-top">
				<div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li >
								<a href="page_user_profile_1.html" class="user">
                                </a>
							</li>
						
					
                        
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile" id="user">Siswa Peserta Ujian</span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used 
                                    <img alt="" class="img-circle" src="images/avatar.gif" /> </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
									
                                    <li>
                                        <a href="logout.php" class="log">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
									
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER >
                            <li>
								<a href="logout.php" class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i></a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER 
                    </div>
                    <!-- END TOP NAVIGATION MENU 
            <!-- END HEADER INNER 
        </div>
	</div>
        <!-- END HEADER -->

			

			
 <body class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
                <img src="images/<?php echo $logo ?>" alt="logo" class="logo-default" style="width:100px;margin-top:0px;" /> </a>
				<!-- <br><center><font style="font-size:14px; color:#fff;"><?php echo $footer ?></font></center> -->
        </div>
        <!-- BEGIN LOGIN -->
		<div class="content">
            <!-- BEGIN LOGIN FORM -->
			<form class="login-form" action="konfirm.php" method="post" data-toggle="validator" id="form1">
                <h3 class="form-title">Login Peserta</h3>
                <div class="alert alert-danger display">
                    <button class="close" data-close="alert"></button>
                    
					<?php 
					if(isset($_REQUEST['salah'])){
					if($_REQUEST['salah']==2){echo "Database belum tersedia, Hubungi Administrator Ujian ";}
					elseif($_REQUEST['salah']==1){echo "Username atau Password anda salah";}
					$_REQUEST['salah']="";}
					?>
					
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label" for="UserName">Username</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
                        <input data-toggle="UserName" class="form-control placeholder-no-fix" data-val="true" data-val-required="User name wajib diisi"  type="text" autocomplete="off" id="inputUsername" name="UserName"  value=""  required />
					</div>
					
                </div>
                <div class="form-group">
                    <label class="control-label" for="Password">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input class="form-control password " data-val="true" data-val-required="Password wajib diisi" type="password" autocomplete="off" id="inputPassword" name="Password"  value=""  required />
						
						
					</div>
				</div>	
						<div class="form-actions">
						<label class="rememberme mt-checkbox mt-checkbox-outline">
							<input type="checkbox" id="showHide" for="Password" value=""  /> Show Password
							<span></span>
						</label>
						<button type="submit" class="btn green pull-right" onClick="validateAndSend()"> Login </button>
						</div>
					
                
                
        <!--        <div class="login-options"></div>
                
				<div class="forget-password">
                    <h4>Forgot your password ?</h4>
                    <p> no worries, click
                        <a href="javascript:;" id="forget-password"> here </a> to reset your password. </p>
                </div>
                <div class="create-account">
                    <p> Don't have an account yet ?&nbsp;
                        <a href="javascript:;" id="register-btn"> Create an account </a>
                    </p>
                </div>  -->
            </form>
            <!-- END LOGIN FORM -->
			</div>
		
		
		
		
		
		<br><br>


			
			
        <!-- BEGIN COPYRIGHT -->
                <center>
                    <font align="center">Copyright &copy;&nbsp;<?php echo date("Y"); ?>&nbsp;By &nbsp;
                    <a target="_blank" href=""><?php echo strtoupper($skull); ?></a> &nbsp;|&nbsp;Supported &nbsp;
                   <a href="http://www.dinartechshare-e.com/">PT.Dinar Tech Share </a></font> &
                    <a href="">LSP JPK Pratama</a></center>
                </div>
					<div class="scroll-to-top" style="display: block;">
						<i class="icon-arrow-up"></i>
					</div>
</div>		
<!--
<body class="font-medium">

<header style="background-color:<?php echo "$warna"; ?>">
<div class="group">
    <div class="left" style="background-color:<?php echo "$warna"; ?>"><img src="images/<?php echo $banner; ?>" style=" margin-left:0px;"></div>
    	<div class="right">
			<table width="100%" border="0" style="margin-top:10px">   
     			<tr><td rowspan="3" width="120px" align="center"><img src="images/avatar.gif" style=" margin-left:0px;" class="foto"></td>
				<td>Selamat Datang</td></tr>
				<tr><td><span class="user">Siswa Peserta Ujian</span></td></tr>
				<tr><td><span class="log"><a href="logout.php">Logout</a><span></td></tr>
			</table>
        </div>
           
</div>
</div> 
</div>   



  
<div  class="col-md-4 col-md-offset-4 login-wrapper" id="panel_login" style="float:inherit; margin-top:0px;  max-width:500px;">
<div class="panel panel-default" style="margin-top:20px">
	<div class="panel-heading " style="font-size:25px; font-weight:bold; padding-left:20px">
		<img src="images/<?php echo  $logo  ?>" style=" width:17%; margin-top:-5px; overflow:hidden "/>
		&nbsp&nbsp Login Peserta
    </div>
	<div class="inner-content" style="height:250px">
		<form action="konfirm.php" method="post" data-toggle="validator" id="form1" ><input  type="hidden">
			<div class="form-horizontal" style="margin-top:0px"><br>
				<div class="form-group error" >
					<label class="col-sm-3 control-label" for="UserName">Username</label>
					<div class="col-sm-8 input-wrapper">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							<input class="form-control" style="width:87%; height:37px; margin-left:38px" data-val="true" data-val-required="User name wajib diisi" 
								id="inputUsername" name="UserName" placeholder="Username" type="text" value="">
						<span class="hide error-message"><span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label" for="Password">Password</label>
						<div class="col-sm-8 input-wrapper">
							<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
							<span class="glyphicon glyphicon-eye-open showPassword" aria-hidden="true">&nbsp;&nbsp;</span>
								<input class="form-control" style="width:87%; height:37px; margin-left:38px"  data-val="true" data-val-required="Password wajib diisi" 
									id="inputPassword" name="Password" placeholder="Password" type="password" value=""> 
							<br>
						</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-8 text-right">
						<button type="submit" class="btn btn-success btn-block doblockui" onClick="validateAndSend()">LOGIN</button>
					</div>
				</div>
			</div>
		</form>                
</div>
</div>
</div>

<div id="buntut"  >

<div style="margin-top:0px; bottom:50px; background-color:#dcdcdc; padding:7px; font-size:12px">
    <div class="content">
		CBT.BEESMART : <strong> v3.0</strong><br>
		MODIFIKASI : <strong> Rev2.1</strong><br>
    </div>
</div>
<footer>
<div class="group" style="background-color:<?php echo $warna; ?>;">
    <div  style="background-color:<?php echo $warna; ?>; padding:7px; font-size:12px">
        <p><b><span style="color: #ff0000;"><?php echo strtoupper("$footer"); ?> </span></b><br> <span style="color: #1B06CF;">Supported by BEESMART</span></p>
    </div>
</footer>  -->

<!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        
		<script src="assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
		
<script type="text/javascript" src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<!--
		<script type="text/javascript">
        $.backstretch("assets/pages/media/bg/3.jpg", {speed: 500});.
		</script>    -->
		
<script type="text/javascript">
    $.backstretch([
      
      "assets/pages/media/bg/8.jpg",
      "assets/pages/media/bg/9.jpg"
      ], {
        fade: 750,
        duration: 4000
    });
</script>
			
			
<!--
<script src="js/jquery.cookie.js"></script>
<script src="js/common.js"></script>
<script src="js/main.js"></script>
<script src="js/cookieList.js"></script>
<script src="js/backend.js"></script>

<script>
document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
</script>
-->
</body>	
</html>	