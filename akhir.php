<?php include "config/server.php"; 
// ===============================
// Status Ujian XStatusUjian = 1 Aktif
// Status Ujian XStatusUjian = 0 BelumAktif
// Status Ujian XStatusUjian = 9 Selesai
if(isset($_COOKIE['PESERTA'])){
$user = $_COOKIE['PESERTA'];} else {
header('Location:login.php');}

$tgl = date("H:i:s");
$tgl2 = date("Y-m-d");
				
		$sqltoken = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `cbt_siswa_ujian` s left join cbt_ujian u on u.XKodeSoal = s.XKodeSoal
		WHERE s.XNomerUjian = '$user' and s.XStatusUjian = '1'");
		$st = mysqli_fetch_array($sqltoken);
		$xtokenujian = $st['XTokenUjian'];  
		
		
		
		$sqlgabung = mysqli_query($GLOBALS["___mysqli_ston"], "
		SELECT * FROM `cbt_siswa_ujian` s LEFT JOIN cbt_jawaban j ON j.XUserJawab = s.XNomerUjian and j.XTokenUjian = s.XTokenUjian left join cbt_siswa s1 on s1.XNomerUjian =
		s.XNomerUjian WHERE s.XNomerUjian = '$user' and s.XStatusUjian = '1'");
		  
		//=======================
		  $s0 = mysqli_fetch_array($sqlgabung);
		  $xkodesoal = $s0['XKodeSoal'];
		  $xtokenujian = $s0['XTokenUjian'];  
		  $xnomerujian = $s0['XNomerUjian'];  
		  $xnik = $s0['XNIK'];    
		  $xkodeujian = $s0['XKodeUjian'];
		  $xkodemapel = $s0['XKodeMapel'];
		  $xkodekelas = $s0['XKodeKelas'];  
		  $xkodejurusan = $s0['XKodeJurusan']; 		
		  $xsemester = $s0['XSemester']; 		  
		  $xnamkel = $s0['XNamaKelas'];
		  
		  $sqlsoal = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_ujian  WHERE XKodeSoal = '$xkodesoal'");
		  $sa = mysqli_fetch_array($sqlsoal);
		  //$xkodeujian = $sa['XKodeUjian'];
		  $xjumsoal = $sa['XJumSoal'];
		  $xjumpil = $sa['XPilGanda']; 	
		  $xtampil = $sa['XTampil'];
		  
		 $sql4 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_mapel  WHERE XKodeMapel = '$xkodemapel'");
		  $km = mysqli_fetch_array($sql4);
		  $kkm = $km['XKKM'];
		  
		  
		  if($xjumsoal>0){

	$sqlnilai = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT * FROM cbt_paketsoal WHERE XKodeSoal = '$xkodesoal'");
	$sqn = mysqli_fetch_array($sqlnilai);
	$per_pil = $sqn['XPersenPil'];	
	$per_esai = $sqn['XPersenEsai'];
	$xesai = $sqn['XEsai'];
	$xpilganda = $sqn['XPilGanda'];
$sqltahun = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_setid where XStatus = '1'");
		$st = mysqli_fetch_array($sqltahun);
		$tahunz = $st['XKodeAY'];
		  
$xjumbenarz = mysqli_query($GLOBALS["___mysqli_ston"], "select count(XNilai) as benar from cbt_jawaban where XUserJawab = '$user' and XJenisSoal = '1' and XKodeSoal = '$xkodesoal' and XTokenUjian = '$xtokenujian' and XNilai = '1'");
		  $r = mysqli_fetch_array($xjumbenarz);
		  $xjumbenar = $r['benar'];
		  $xjumsalah = $xjumpil-$xjumbenar;
		  $nilaix = ($xjumbenar/$xjumpil)*100;
		  if(isset($_COOKIE['beetahun'])){$setAY =$_COOKIE['beetahun'];}else{$setAY = "$tahunz";}
		  
		  //cek apakah nilai untuk token ini sudah ada atau tidak 
		  $sqlceknilai= mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_nilai where XNomerUjian = '$xnomerujian' and XKodeSoal = '$xkodesoal' and XTokenUjian = '$xtokenujian' 
		  and XSemester = '$xsemester' and XSetId = '$setAY' and XKodeMapel = '$xkodemapel' and XNIK = '$xnik'"));
		  
		  if($sqlceknilai>0){
		  $sqlmasuk = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_nilai set XJumSoal='$xjumsoal',XBenar='$xjumbenar',XSalah='$xjumsalah',XNilai='$nilaix',XTotalNilai=,'$nilaix'
		  where XNomerUjian = '$xnomerujian' and XKodeSoal = '$xkodesoal' and XTokenUjian = '$xtokenujian' and XSemester = '$xsemester' and XSetId = '$setAY' 
		  and XKodeMapel = '$xkodemapel' and XNIK = '$xnik'");
		  } else {
		  $sqlmasuk = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_nilai (
		  XKodeUjian,XTokenUjian,XTgl,XJumSoal,XBenar,XSalah,XNilai,XKodeMapel,XKodeKelas,XKodeSoal,XNomerUjian,XNIK,XSemester,XSetId,XPersenPil,XPersenEsai,XTotalNilai,XPilGanda,XEsai,XNamaKelas) 
		  values 
		  ('$xkodeujian','$xtokenujian','$tgl2','$xjumsoal','$xjumbenar','$xjumsalah','$nilaix','$xkodemapel','$xkodekelas','$xkodesoal','$xnomerujian','$xnik','$xsemester',
		  '$setAY','$per_pil','$per_esai','$nilaix','$xpilganda','$xesai','$xnamkel')");
		  }
					
		  if(isset($xtokenujian)){
		  $sql = mysqli_query($GLOBALS["___mysqli_ston"], "Update cbt_siswa_ujian set XStatusUjian = '9' where XNomerUjian = '$user' and XStatusUjian = '1'  and XTokenUjian = '$xtokenujian'");}
		  $sql = mysqli_query($GLOBALS["___mysqli_ston"], "Update cbt_siswa_ujian set XStatusUjian = '9',XLastUpdate = '$tgl' where XNomerUjian = '$user' and XStatusUjian = '1'");

		  }

?>
		  

<style>
.left {
    float: left;
    width: 70%;
}
.right {
    float: right;
    width: 30%;
	background-color: #333333;
			height:101px;	
		color:#FFFFFF;	
		font-size: 13px; font-style:normal; font-weight:normal;
}
.user {
		color:#FFFFFF;	
		font-size: 15px; font-style:normal; font-weight:bold;
		top:-20px;
}
.log {
		color:#3799c2;	
		font-size: 11px; font-style:normal; font-weight:bold;
		top:-20px;
}
.group:after {
    content:"";
    display: table;
    clear: both;
	
}
/*
img {
    max-width: 100%;
    height: auto;
}
*/

.visible{
    display: block !important;
}

.hidden{
    display: none !important;
}
.foto{height:80px;}	
.buntut{width:100%;bottom:0px; position:absolute;}	
@media screen and (max-width: 780px) { /* jika screen maks. 780 right turun */
/*    .left, */
    .left,
    .right {
        float: none;
        width: auto;
		margin-top:0px;
		height:101px;
		color:#FFFFFF;
		display:block;	
    }
.foto{height:80px;}	
.buntut{width:100%;bottom:0px; position:absolute;}		
}
@media screen and (max-width: 400px) { /* jika screen maks. 780 right turun */
/*    .left, */
    .left{width: auto;    height: 91px;}
    .right {
        float: none;
        width: auto;
		margin-top:0px;
		height:60px;
		color:#FFFFFF;
    }
.foto{height:60px;}	
.buntut{width:100%;bottom:0px; position:absolute;}	
}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $skull;?> | UJIAN ONLINE</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='images/icon.png' rel='icon' type='image/png'/>
	
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
	
	    

	
</head>
<?php 

$sqllogin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_siswa` WHERE XNomerUjian = '$user'");
 $sis = mysqli_fetch_array($sqllogin);
 
  $xkodekelas = $sis['XKodeKelas'];
  $xnamkelas = $sis['XNamaKelas'];
  $xjurz = $sis['XKodeJurusan'];
  $val_siswa = $sis['XNamaSiswa'];
  $poto = $sis['XFoto'];  
  
  if($poto==''){
	  $gambar="avatar.gif";
  } else{
	  $gambar=$poto;
  } 
?>

<div class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<div class="page-header navbar navbar-fixed-top" style="background-color:#336799 ;">

            
     <div class="page-header-inner ">
                
                <div class="page-logo" style="background-color:#">
                    <a href="index.php">
                        <img src="images/<?php echo "$log[XBanner]"; ?>" alt="logo" class="logo-default" style="width:250px;margin-top:8px;"   /> </a>
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
                                    <span class="username username-hide-on-mobile" id="user"><?php echo "$val_siswa <br>($xkodekelas-$xjurz | $xnamkelas)"; ?></span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
									<?php 	if(file_exists("fotosiswa/$sis[XFoto]")&&!$gambar==''){ ?>
                                    <img alt="" class="img-circle"  src="fotosiswa/<?php echo "$gambar"; ?>" /> 
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



<!--

<header style="background-color:<?php echo "$log[XWarna]"; ?>">
<div class="group">
    <div class="left" style="background-color:<?php echo "$log[XWarna]"; ?>"><img src="images/<?php echo "$log[XBanner]"; ?>" style=" margin-left:0px;">
    </div>
    	<div class="right"><table width="100%" border="0" style="margin-top:10px">   
     					<tr><td rowspan="3" width="100px" align="center"><img src="fotosiswa/<?php echo "$gambar"; ?>" style=" margin-left:0px; margin-top:5px" class="foto"></td>
						<td><span  class="user" style=" margin-left:0px; margin-top:5px">Terima Kasih</span></td></tr>
                        <tr><td><span class="user"><?php echo "$val_siswa <br>($xkodekelas-$xjurz | $xnamkelas)"; ?></span></td></tr>
                        <tr><td><span class="user"><br><span></td></tr>
						<tr></tr>
						</table>
                        </div>

      	
	</div> 
</div>         
</header>    -->
<div class="page-container">
	
            <!-- BEGIN SIDEBAR  -->
           
			 <div class="page-content">
				
                    <div class="col-md-12">
						<div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
									<?php 	if(file_exists("fotosiswa/$sis[XFoto]")&&!$gambar==''){ ?>
                                        <center><img src="fotosiswa/<?php echo "$gambar"; ?>" class="img-circle" style="height:200; width:200;" alt=""> </center>
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
                                                    <span class="caption-subject font-blue-madison bold uppercase"> Konfirmasi Tes</span>
                                                </div>
                                                
                                            </div>
                                       <div class="portlet-body">
									   
											<div class="inner-content">
												<div class="wysiwyg-content" style="text-align: center;">
													<p>	Terimakasih telah berpartisipasi dalam tes
														<br>	<?php 	if($xtampil=='1'){ ?>
														<br>	<font color="red">
																	<?php echo 	"Nilai Pilihan Ganda Non Esai" 
																	?>
														<br>	<font size="2" color="blue">
																	<?php	
																			echo " KKM : ".$kkm."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Benar : ".$xjumbenar."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salah: ".$xjumsalah."</Font>"; 
																	?>
														<br>
														<br>	<font size="7" color="blue">
														<?php
														
														echo " Nilai : ".$nilaix."</br></Font>";
														}
														?>
													   
													</p>
												</div>
											</div>
											<div class="modal-footer">
											<div class="row">
												<div ><a href="logout.php">
													<button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
												</div>
											</div>
											</div> 
										
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
							<div class="page-footer-fixed">
							<div class="page-footer" style="background-color:#00468C">
									<center><div class="page-footer-inner">
									
                    <font align="center">Copyright &copy;&nbsp;<?php echo date("Y"); ?>&nbsp;By &nbsp;
                    <a target="_blank" href=""><?php echo strtoupper($skull); ?></a> &nbsp;|&nbsp;Supported &nbsp;
                   <a href="http://www.dinartechshare-e.com/">PT.Dinar Tech Share </a></font> &
                    <a href="">LSP JPK Pratama</a>
									</div></center>
									<div class="scroll-to-top" style="display: block;">
										<i class="icon-arrow-up"></i>
									</div>
							</div>
							</div> 					
								
	</div>							
			<!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
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




</html>