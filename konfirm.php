<?php include "config/server.php";

include "ip.php";
$tglbuat = date("Y-m-d");
$sqlcekdb = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `cbt_siswa` limit 1");
if (!$sqlcekdb){header('Location:login.php?salah=2');}
 
if(isset($_COOKIE['PESERTA'])&&isset($_COOKIE['KUNCI'])){
	$user = "$_COOKIE[PESERTA]"; 
	$pass = "$_COOKIE[KUNCI]";
	$txtuser = $user;
	$txtpass = $pass; } 
else {	
	$txtuser = str_replace(" ","",$_REQUEST['UserName']);
	$txtpass = str_replace(" ","",$_REQUEST['Password']);
	setcookie('PESERTA',$txtuser);
	setcookie('KUNCI',$txtpass);
	$user = "$txtuser";
	$pass = "$txtpass";}

$sqllogin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_siswa` WHERE XNomerUjian = '$txtuser' and XPassword = '$txtpass'");
$sis = mysqli_fetch_array($sqllogin);
$val_siswa = $sis['XNamaSiswa'];
$xjeniskelamin= $sis['XJenisKelamin']; 
$xkelz = $sis['XKodeKelas'];
$xjurz = $sis['XKodeJurusan'];
$xnamkel = $sis['XNamaKelas'];  
$xsesi = $sis['XSesi']; 
$poto = $sis['XFoto'];  

if($poto==''){$gambar="avatar.gif";} else {$gambar=$poto;} 
if($xjeniskelamin=="L"){$jekel = "LAKI-LAKI";} else {$jekel = "PEREMPUAN";}
$jmlsqllogin = mysqli_num_rows($sqllogin);
if($jmlsqllogin<1){ header('Location:login.php?salah=1&jumlah='.$jmlsqllogin); }
$tglujian = date("Y-m-d");
$xjam1 = date("H:i:s");

$sqluser = mysqli_query($GLOBALS["___mysqli_ston"], "
	SELECT u.*,m.XNamaMapel FROM `cbt_ujian` u LEFT JOIN cbt_paketsoal p on p.XKodeKelas = u.XKodeKelas and p.XKodeMapel = u.XKodeMapel
	left join cbt_mapel m on u.XKodeMapel = m.XKodeMapel 
	WHERE (u.XKodeKelas = '$xkelz' or u.XKodeKelas = 'ALL') and (u.XKodeJurusan = '$xjurz' or u.XKodeJurusan = 'ALL') and u.XTglUjian = '$tglujian' and u.XJamUjian <= '$xjam1'
	and u.XStatusUjian = '1'");

	$s = mysqli_fetch_array($sqluser);
	$xkodesoal = $s['XKodeSoal'];
	$xkodekelas = $s['XKodeKelas'];
	$xkodejurusan = $s['XKodeJurusan'];
	$xtglujian = $s['XTglUjian'];  
	$xkodemapel = $s['XKodeMapel'];
	$xjumlahsoal = $s['XJumSoal'];
	$xtokenujian = $s['XTokenUjian'];  
	$xlamaujian= $s['XLamaUjian'];
	$xjamujian= $s['XJamUjian'];    
	$xbatasmasuk= $s['XBatasMasuk'];   
	$xnamamapel = $s['XNamaMapel'];
	$xstatustoken = $s['XStatusToken'];
  
  
$sqlada0 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_siswa_ujian` WHERE XNomerUjian = '$txtuser' and XTokenUjian = '$xtokenujian'");
	$ad0 = mysqli_fetch_array($sqlada0);
	$user_ip2 = str_replace(" ","",$ad0['XGetIP']);
	$user_ip1 = $user_ip;
 
if($user_ip1<>$user_ip2&&!$user_ip2==""){header('Location:login.php?salah=3');}

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
<html class="no-js" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo $skull;?>  | UJIAN ONLINE</title>
	
	<link href='images/icon.png' rel='icon' type='image/png'/>
	<meta name="description" content="">    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style>
    .no-close .ui-dialog-titlebar-close {display: none;}
	</style>
	
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
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
        <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" /> 
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
	
	
	
	
<!--	<style>
		.left {float: left; width: 65%;}
		.right {float: right; width: 30%; background-color: #333333; height:101px; color:#FFFFFF;	
			font-size: 13px; font-style:normal; font-weight:normal;}
		.user {color:#FFFFFF; font-size: 15px; font-style:normal; font-weight:bold;	top:-20px;}
		.log {color:#3799c2; font-size: 11px; font-style:normal; font-weight:bold; top:-20px;}
		.group:after {content:""; display: table; clear: both;}
		/*	img {max-width: 100%; height: auto;}	*/
		.visible{display: block !important;}
		.hidden{display: none !important;}
		.foto{height:80px;}	
		@media screen and (max-width: 780px) { /* jika screen maks. 780 right turun */
		/*    .left, */
		.left,
		.right {float: none; width: auto; margin-top:0px; height:91px; color:#FFFFFF; display:block;}
		.foto{height:65px;}}
		@media screen and (max-width: 400px) { /* jika screen maks. 780 right turun */
		/*    .left, */
		.left{width: auto; height: 91px;}
		.right {float: none; width: auto; margin-top:0px; height:60px; color:#FFFFFF;}
		.foto{height:40px;}	}
	</style>
	<link href="css/klien.css" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap2.min.css">
    <script src="js/inline.js"></script>  -->
	<?php 	include "config/server.php";
			$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
			$r = mysqli_fetch_array($sql);
	?>

<div class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo" >
<div class="page-header navbar navbar-fixed-top" style="background-color:#336799 ;" >

            
            <div class="page-header-inner ">
                
                <div class="page-logo" style="background-color:#">
                    <a href="index.php">
                        <img src="images/<?php echo "$r[XBanner]"; ?>" alt="logo" class="logo-default" style="width:250px;margin-top:8px;"   /> </a>
					 <!-- BEGIN MENU TOGGLER 
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header 
					</div> -->
					
                </div>
				
              
                <div class="page-top">
				<div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li >
								<a href="#" class="user">
                                </a>
							</li>
						
					
                        
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile" id="user"><?php echo "$sis[XNamaSiswa]"; ?></span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
									<?php 	if(file_exists("fotosiswa/$sis[XFoto]")&&!$gambar==''){ ?>
                                    <img src="fotosiswa/<?php echo "$gambar"; ?>" class="img-circle" alt=""  /> 
									<?php 	} else {echo "<img src=fotosiswa/avatar.gif>";} ?>
									</a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    
                                    <li>
                                        <a href="logout.php" class="log">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
									
                                </ul>
                            </li>
						</ul>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER >
                            <li>
								<a href="logout.php" class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i></a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER  -->
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
            <!-- END HEADER INNER -->
        </div>
	</div>
        <!-- END HEADER -->
	
	
	<div class="page-container">
            <!-- BEGIN SIDEBAR  -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR  
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing  
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed  
                <div class="page-sidebar navbar-collapse collapse">
				<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200"></ul>
				</div>
			</div> -->
	
	
	
	
	
	
	
	
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>Konfirmasi Data Peserta
                                <small>Data Peserta</small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
						
						
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic" align="center">
									<?php 	if(file_exists("fotosiswa/$sis[XFoto]")&&!$gambar==''){ ?>
                                        <img src="fotosiswa/<?php echo "$gambar"; ?>" class="img-circle" alt="" style="height:200px ; width:200px;" /> 
										<?php 	} else {echo "<img src=fotosiswa/avatar.gif>";} ?>
										
									</div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"><?php echo "$sis[XNamaSiswa]"; ?></div>
                                        <div class="profile-usertitle-job"><?php echo "$user"; ?></div>
                                    </div>
                                    <!-- END SIDEBAR USER TITLE -->
                                <!--    <div class="profile-userbuttons">
                                        <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                                        <button type="button" class="btn btn-circle red btn-sm">Message</button>
                                    </div>
                                    <!-- END SIDEBAR BUTTONS 
                                    <!-- SIDEBAR MENU  -->
                                    <div class="profile-usermenu">
									<ul>
										<div id="myerror" class="alert alert-danger" role="alert" style=" font-size: 13px; font-style:normal; font-weight:normal; margin-left:-40px; padding-left:30px;">
											<?php 	if(isset($_REQUEST['salah'])){if($_REQUEST['salah']==1)
													{echo "<b><ul><li>Kode TOKEN Tidak sesuai</li></ul></b>";} } 
											?>
										</div>
									</ul>
									</div>  
                                </div>
                                <!-- END PORTLET MAIN -->
							</div>
							<!-- END PROFILE SIDEBAR -->
								<!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Data Peserta</span>
                                                </div>
                                                
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    
                                                        <form role="form" action="mulai.php" method="post">
														<div class="row">
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Nama Peserta</label>
                                                                <input type="text" placeholder="Nama" class="form-control" value="<?php echo "$sis[XNamaSiswa]"; ?>" readonly />
																<input id="NamaPeserta" name="NamaPeserta" type="hidden" value="glyphicon-warning-sign" readonly />
																</div>
															</div>
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Kode Peserta/Username</label>
                                                                <input type="text" placeholder="Username" class="form-control" value="<?php echo "$user"; ?>" readonly />
																<input id="KodeNik" name="KodeNik" type="hidden" value="<?php echo "$user"; ?>" readonly />
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Status Peserta</label>
                                                                <input type="text" placeholder="-" class="form-control" value="<?php echo "$val_siswa ($xkelz-$xjurz | $xnamkel)"; ?>" readonly />
																<input id="NamaPeserta" name="NamaPeserta" type="hidden" value="glyphicon-warning-sign" readonly />
																</div>
															</div>
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Jenis Kelamin</label>
                                                                <input type="text" placeholder="Jenis Kelamin" class="form-control" value="<?php echo "$jekel"; ?>" readonly />
																<input id="Gender" name="Gender" type="hidden" value="Pria" readonly />
																</div>
															</div>
														</div>
																
		<?php 	$sqlada = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_siswa_ujian` WHERE XNomerUjian = '$txtuser' and XTokenUjian = '$xtokenujian'");
		$ad = mysqli_fetch_array($sqlada);
		$jumsis = $ad['XStatusUjian'];
		$ada = mysqli_num_rows($sqlada);
 
		$sqlt = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_ujian` where XKodeSoal ='$xkodesoal'and (XKodeKelas = '$xkelz' or XKodeKelas = 'ALL') and (XKodeJurusan = '$xjurz' or XKodeJurusan = 'ALL') and XStatusUjian = '1' and (XSesi =  '$xsesi' or XSesi = 'ALL') and XTglUjian = '$tglbuat' ") ;
		$ttt = mysqli_fetch_array($sqlt);
		$xbatasmasuk = $ttt['XBatasMasuk'];
		$xtokuj = $ttt['XTokenUjian'];
		?>
		<?php	$sqlcekujian = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_ujian where(XKodeKelas = '$xkelz' or XKodeKelas = 'ALL') and (XKodeJurusan = '$xjurz' or XKodeJurusan = 'ALL') and XStatusUjian = '1' and (XSesi =  '$xsesi' or XSesi = 'ALL')"));
				if($sqlcekujian>0){ ?>								
														<div class="row">
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Mata Pelajaran </label>
                                                                <input type="text" placeholder="Tidak Ada" class="form-control" value="<?php echo "$xnamamapel"; ?>" readonly />
																<input id="KodePaket" name="KodePaket" type="hidden" value="IPA - SMP" readonly />
																</div>
															</div>	
															<?php if(($xjam1<=$xbatasmasuk&&$xjam1>=$xjamujian)&&($tglujian==$xtglujian)&&($jumsis!=='9')){	?>  
															<div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Masukkan TOKEN</label>
																<input autocomplete="off" class="input-token form-control field-xs" data-val="true" data-val-required="Kode token wajib diisi" id="KodeToken" maxlength="20" name="KodeToken" placeholder="masukan token" type="text" value=""  />
                                                                <div class="list"><br>TOKEN Anda:&nbsp;&nbsp; <span class="label" style="color:#f0f0e1; background-color:#2693ff; padding-left:40px ; padding-right:40px ; padding-top:6px; padding-bottom:6px; font-size:16px ; "><b><?php if ($xstatustoken==1) {echo "$xtokuj";} else {echo "Minta dari Proktor";}?></b></span>
															
															<td width="60px">
																<button type="submit" class="btn btn-success ">SUBMIT</button></td>
															</div>
															</div>
														</div>
														</div>
										<?php } else { ?>
															<div class="row">
															<div class="col-md-6">
															<div class="form-group">
                                                                <label class="control-label">Status Ujian</label>
																<?php if($jumsis=='9'){ ?>
                                                                <input type="text" placeholder="" class="form-control" value="Status Tes sudah SELESAI" readonly />
																<?php } elseif($xjam1<$xjamujian||$tglujian!==$xtglujian){ ?>
																<input type="text" placeholder="" class="form-control" value="Tidak Ada Jadwal Ujian" readonly />
																<?php } elseif($xjam1>=$xjamujian&&$xjam1>$xbatasmasuk){ ?>
																<input type="text" placeholder="" class="form-control" value="Terlambat Untuk Mengikuti Ujian" readonly />
																<?php } ?>
																</div>
															</div>
															</div>
															<?php } ?>
											<?php } else { ?>
															<div class="row">
															<div class="col-md-6">
															<div class="form-group">
                                                                <label class="control-label">Status Ujian</label>
                                                                <input type="text" placeholder="" class="form-control" value="Tidak ada Mata Uji AKTIF" readonly />
															</div>
															</div>
															</div>
															<?php } ?>
															
												
                                                        </form>
                                                    
												</div>
											</div>
                                                    <!-- END PERSONAL INFO TAB -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>












<!--
	
	
<body class="font-medium" style="background-color:#c9c9c9">
<header style="background-color:<?php echo "$r[XWarna]"; ?> ; ">
<div class="group">
    <div class="left" style="background-color:<?php echo "$r[XWarna]"; ?>"><img src="images/<?php echo "$r[XBanner]"; ?>" style=" margin-left:0px;"></div>
    	<div class="right">
			<table width="100%" border="0" cellspacing="5px;" style="margin-top:10px">   
				<tr><td rowspan="3" width="100px" align="center"><img src="fotosiswa/<?php echo "$gambar"; ?>" style=" margin-left:0px; margin-top:5px" class="foto"></td>
				
				<tr><td><span class="user"><?php echo "$val_siswa <br>($xkelz-$xjurz)"; ?></span></td></tr>
				<tr><td><span class="log"><a href="logout.php">Logout</a><span></td></tr>
			</table>
        </div>
           
</div>
</div> 
</div>         
</header> -->


 <!--   
<div  class="col-md-6 col-md-offset-3 login-wrapper" style="float:inherit">
<div class="panel panel-default">

<form action="mulai.php" method="post">    

                <div class="list-group-item top-heading">
                    <h1 class="list-group-item-heading page-label">Konfirmasi Data Peserta</h1>
                </div>
                <div class="list-group-item">
                    <label class="list-group-item-heading">Kode Peserta / User Name</label>
                    <p class="list-group-item-text"><?php echo "$user"; ?></p>
                    <!--<input id="KodeNik" name="KodeNik" type="hidden" value="<?php echo "$user"; ?>">!-->
<!--                    <input id="KodeNik" name="KodeNik" type="hidden" value="<?php echo "$user"; ?>">
                </div>
                <div class="list-group-item">
                    <label class="list-group-item-heading">Status Peserta</label>
                    <p class="list-group-item-text"><?php echo "$val_siswa ($xkelz-$xjurz | $xnamkel)"; ?></p>
                    <input id="NamaPeserta" name="NamaPeserta" type="hidden" value="glyphicon-warning-sign">
                </div>
                <div class="list-group-item">
                    <label class="list-group-item-heading">Jenis Kelamin</label>
                    <p class="list-group-item-text"><?php echo "$jekel"; ?></p>
                    <input id="Gender" name="Gender" type="hidden" value="Pria">
                </div>
<?php 	$sqlada = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_siswa_ujian` WHERE XNomerUjian = '$txtuser' and XTokenUjian = '$xtokenujian'");
		$ad = mysqli_fetch_array($sqlada);
		$jumsis = $ad['XStatusUjian'];
		$ada = mysqli_num_rows($sqlada);
 
		$sqlt = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_ujian` where XKodeSoal ='$xkodesoal'and (XKodeKelas = '$xkelz' or XKodeKelas = 'ALL') and (XKodeJurusan = '$xjurz' or XKodeJurusan = 'ALL') and XStatusUjian = '1' and (XSesi =  '$xsesi' or XSesi = 'ALL') and XTglUjian = '$tglbuat' ") ;
		$ttt = mysqli_fetch_array($sqlt);
		$xbatasmasuk = $ttt['XBatasMasuk'];
		$xtokuj = $ttt['XTokenUjian'];
?>
<?php	$sqlcekujian = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_ujian where(XKodeKelas = '$xkelz' or XKodeKelas = 'ALL') and (XKodeJurusan = '$xjurz' or XKodeJurusan = 'ALL') and XStatusUjian = '1' and (XSesi =  '$xsesi' or XSesi = 'ALL')"));
		if($sqlcekujian>0){ ?>
                <div class="list-group-item">
                    <label class="list-group-item-heading">Mata Pelajaran </label>
                    <p class="list-group-item-text"><?php echo "$xnamamapel"; ?></p>
                    <input id="KodePaket" name="KodePaket" type="hidden" value="IPA - SMP">
                </div>
                
		<?php if(($xjam1<=$xbatasmasuk&&$xjam1>=$xjamujian)&&($tglujian==$xtglujian)&&($jumsis!=='9')){	?>                
                <div class="list-group-item">
                    <label class="list-group-item-heading">Masukkan TOKEN <?php // echo "$jumsis = $ada"; ?> </label>
                    <div class="list-group-item-text">
                    <input autocomplete="off" class="input-token form-control field-xs" data-val="true" data-val-required="Kode 	
                    token wajib diisi" id="KodeToken" maxlength="20" name="KodeToken" placeholder="masukan token" type="text" value=""></div>
					<div class="list"><br>TOKEN Anda: --oO[<span style="color: #ff0000;"><b><?php if ($xstatustoken==1) {echo "$xtokuj";} 
					else {echo "Minta dari Proktor";}?></b></span>]Oo--</div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-xs-push-7 col-xs-5"><br>
                            <button type="submit" class="btn btn-success btn-block doblockui">SUBMIT</button>
                        </div>
                    </div>
                </div>
 
		 <?php } else { ?>
         		<div class="list-group-item">
                    <label class="list-group-item-heading">Status Ujian <?php // echo "$jumsis = $ada"; ?></label>
                    <div class="list-group-item-text">
                    <?php if($jumsis=='9'){ ?>
                    <p class="list-group-item-text">Status Tes sudah SELESAI</p>
                    <?php } elseif($xjam1<$xjamujian||$tglujian!==$xtglujian){ ?>
                    <p class="list-group-item-text">Tidak Ada Jadwal Ujian</p>
                    <?php } elseif($xjam1>=$xjamujian&&$xjam1>$xbatasmasuk){ ?>
                    <p class="list-group-item-text">Terlambat Untuk Mengikuti Ujian</p>
                    <?php } ?>
                    </div>
                </div>
  		<?php } ?> 
               
		<?php } else { ?>
         		<div class="list-group-item">
                    <label class="list-group-item-heading">Status Ujian<?php // echo "$jumsis / $ada"; ?> </label>
                    <div class="list-group-item-text">
                    <p class="list-group-item-text">Tidak ada Mata Uji AKTIF</p>
                    </div>
                </div>

<?php } ?>

    </div>
</form>       
</div>
</div>
<div id="buntut"  >
<div style="margin-top:00px; bottom:50px; background-color:#dcdcdc; padding:7px; font-size:12px">
    <div class="content">
        MA DIPONEGORO-CBT : <strong> Rev2.1</strong><br>
        CBT.BEESMART : <strong> v3.0</strong><br>
    </div>
</div>

                <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title">Konfirmasi Tes</h4>
             </div>
                <div class="modal-body">
                    <div class="inner-content">
                        <div class="wysiwyg-content">
                            <p>
                                Terimakasi telah berpartisipasi dalam tes ini.<br>
                                Silahkan klik tombol LOGOUT untuk mengakhiri test.                            </p>
                        </div>
                    </div>
                </div>
               <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
               </div>
            </div>
        </div>
    </div>




  
		<div class="page-footer-fixed">
		<div class="page-footer" style="background-color:#336799">
				<center><div class="page-footer-inner">
				
					<font >  Copyright &copy;&nbsp;2017&nbsp;By &nbsp;
					<a target="_blank" href="http://smpn6makassar.sch.id"><?php echo strtoupper($skull); ?></a> &nbsp;|&nbsp;Supported &nbsp;
					<a href="">PT. Dinar Tech Sahre-e </a></font>
				</div></center>
				<div class="scroll-to-top" style="display: block;">
					<i class="icon-arrow-up"></i>
				</div>
		</div>
		</div>  
<!--  
<div class="copyright"> 2017 &copy; <a href="http://www.tuwagapat.com" target="_blank">BeeSmart - CBT-Aplication.</a> | Design By <a href="http://www.facebook.com/jason.wen85/"> Suparman Albar.</a> </div>
				
					<div class="scroll-to-top" style="display: block;">
						<i class="icon-arrow-up"></i>
					</div>    -->
  
<!--   <footer>
    <div  style=" background-color:<?php echo "$r[XWarna]"; ?>; padding:7px; font-size:12px">
        <p><b><span style="color: #ff0000;"><?php echo strtoupper("$r[XSekolah]"); ?> </b><br> <span style="color: #1B06CF;">Supported by BEESMART</span></p>
    </div>
</footer>  !-->

		<!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
		
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
		
		<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$("form1").validate();
		</script>

<script src="js/jquery.cookie.js"></script>
<script src="js/common.js"></script>
<script src="js/main.js"></script>
<script src="js/cookieList.js"></script>
<script src="js/backend.js"></script>
</div>

</div>
</html>    
