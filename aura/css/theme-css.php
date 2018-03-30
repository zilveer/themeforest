<?php header('Content-type: text/css'); ?>
<?php //Setup location of WordPress
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0]; 

//Access WordPress
require_once( $path_to_wp.'/wp-load.php' );
global $webbumobile_option;

$tcustomizer_contentelementcolor1 = $webbumobile_option[ 'tcustomizer_contentelementcolor1'];
$tcustomizer_contentelementcolor2 = $webbumobile_option[ 'tcustomizer_contentelementcolor2'];
$logosettings_image_url = AuraIssetControl('logosettings_image','url','');
$logosettings_image_height = AuraIssetControl('logosettings_image','height','');
$logosettings_image_width = AuraIssetControl('logosettings_image','width','');
$general_customcss = AuraIssetControl('general_customcss','','');
$tcustomizer_contentbackground_color = AuraIssetControl('tcustomizer_contentbackground','background-color','');


$tcustomizer_topheaderbackground = $webbumobile_option[ 'tcustomizer_topheaderbackground'];
$tcustomizer_contentbackground = $webbumobile_option[ 'tcustomizer_contentbackground'];
$tcustomizer_topheaderheight = $webbumobile_option[ 'tcustomizer_topheaderheight'];

$tcustomizer_typography = $webbumobile_option[ 'tcustomizer_typography'];
$blogbgcolor = $webbumobile_option[ 'blogbgcolor'];
$logosettings_barheight = $webbumobile_option[ 'logosettings_barheight'];
$logosettings_bgcolor = $webbumobile_option[ 'logosettings_bgcolor'];
$logosettings_margins = $webbumobile_option[ 'logosettings_margins'];
$logosettings_retina = $webbumobile_option[ 'logosettings_retina'];

$topbar_menuimg_url = AuraIssetControl('topbar_menuimg','url','');
$topbar_menucloseimg_url = AuraIssetControl('topbar_menucloseimg','url','');
$topbar_backimg_url = AuraIssetControl('topbar_backimg','url','');

$topbar_buton1icon_url = AuraIssetControl('topbar_buton1icon','url','');
$topbar_buton2icon_url = AuraIssetControl('topbar_buton2icon','url','');
$topbar_buton3icon_url = AuraIssetControl('topbar_buton3icon','url','');
$topbar_buton4icon_url = AuraIssetControl('topbar_buton4icon','url','');
$topbar_buton5icon_url = AuraIssetControl('topbar_buton5icon','url','');

$menudefaults_buttontype = $webbumobile_option[ 'menudefaults_buttontype'];
$tcustomizer_linkcolor_regular = AuraIssetControl('tcustomizer_linkcolor','regular','#444');
$tcustomizer_linkcolor_hover = AuraIssetControl('tcustomizer_linkcolor','hover','#333');
$tcustomizer_linkcolor_active = AuraIssetControl('tcustomizer_linkcolor','active','#444');

?>
/*------------------------------------*\
    CUSTOM CSS CODE
\*------------------------------------*/
a{color:<?php echo $tcustomizer_linkcolor_regular;?>};
a:hover{color:<?php echo $tcustomizer_linkcolor_hover;?>};
a:active{color:<?php echo $tcustomizer_linkcolor_active;?>};
<?php echo $general_customcss;?>
.wmf_separator{border-bottom: 1px solid <?php echo $tcustomizer_contentelementcolor2?>!important; }
.wmftable-striped > tbody > tr:nth-child(odd) > td, .wmftable-striped > tbody > tr:nth-child(odd) > th {background-color: <?php echo $tcustomizer_contentelementcolor2?>!important;}
.wmf_separator div,.format-chat .post-content .chat-right {background-color: <?php echo $tcustomizer_contentbackground_color?>!important; }
.wmffcontainer .wmffrow article, .sidebar-widget > div{background: <?php echo $blogbgcolor?>; }
.sidebar-widget > div{padding:20px;margin-bottom:25px;}

/*------------------------------------*\
    NAVIGATION SYSTEM
\*------------------------------------*/
.aurawrapper {padding-top: <?php echo $tcustomizer_topheaderheight;?>px;}


/*------------------------------------*\
    TOP BAR & CONTENT
\*------------------------------------*/
#maincontent {left:0;right:0;margin:0;}
#auratoolbar{height: <?php echo $tcustomizer_topheaderheight;?>px; z-index:10002;top:0;left:0;right:0; background-color:<?php echo $tcustomizer_topheaderbackground;?>}
.auralogobar{height:<?php echo $logosettings_barheight;?>px;left:0;right:0;margin:<?php echo $tcustomizer_topheaderheight;?>px 0 0 0;display:block;background:<?php echo $logosettings_bgcolor;?>}

<?php
if($menudefaults_buttontype == 1){
	echo '.aura-menu-icon{border-radius:150px;-webkit-border-radius:150px;-moz-border-radius:150px;-o-border-radius:150px;-ms-border-radius:150px;}';
}else if($menudefaults_buttontype == 2){
	echo '.aura-menu-icon{border-radius:0px;-webkit-border-radius:0px;-moz-border-radius:0px;-o-border-radius:0px;-ms-border-radius:0px;}';
}else if($menudefaults_buttontype == 3){
	echo '.aura-menu-icon{border-radius:12px;-webkit-border-radius:12px;-moz-border-radius:12px;-o-border-radius:12px;-ms-border-radius:12px;}';
}else{
	echo '.aura-menu-icon{border-radius:12px;-webkit-border-radius:12px;-moz-border-radius:12px;-o-border-radius:12px;-ms-border-radius:12px;}';
}
?>

<?php 
if($logosettings_image_url != '' && $logosettings_retina == 0){
echo '.auralogo{display:block;position:relative;background-image: url('.$logosettings_image_url.');	background-repeat: no-repeat; background-size:'.$logosettings_image_width.'px '.$logosettings_image_height.'px; width:'.$logosettings_image_width.'px;height:'.$logosettings_image_height.'px;top:'.$logosettings_margins['margin-top'].';}';
}else if($logosettings_image_url != '' && $logosettings_retina == 1){
echo '.auralogo{display:block;position:relative;background-image: url('.$logosettings_image_url.');	background-repeat: no-repeat; background-size:'.($logosettings_image_width)/(2).'px '.($logosettings_image_height)/(2).'px; width:'.($logosettings_image_width)/(2).'px;height:'.($logosettings_image_height)/(2).'px;top:'.$logosettings_margins['margin-top'].';}';
}else{
echo '.auralogo{display:none;}';
}
?>

/* Top Bar Buttons */
<?php 
if($topbar_menuimg_url == ''){
	echo '#aura-toggle-menu.auraopen{  background:url(../images/menu.png) center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;left: 0;}';
}else{
	echo '#aura-toggle-menu.auraopen{  background:url('.$topbar_menuimg_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;left: 0;}';
}

if($topbar_menucloseimg_url == ''){
	echo '#aura-toggle-menu.auraclose{background:url(../images/close.png) center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;left: 0;}';
}else{
	echo '#aura-toggle-menu.auraclose{background:url('.$topbar_menucloseimg_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;left: 0;}';
}

if($topbar_backimg_url == ''){
	echo '#aurabackbutton{  background:url(../images/back.png) center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;left: 44px;}';
}else{
	echo '#aurabackbutton{  background:url('.$topbar_backimg_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;left: 44px;}';
}

if($topbar_buton1icon_url != ''){
	echo '#aurabuton1{  background:url('.$topbar_buton1icon_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;right: 0px;}';
}

if($topbar_buton2icon_url != ''){
	echo '#aurabuton2{  background:url('.$topbar_buton2icon_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;right: 44px;}';
}

if($topbar_buton3icon_url != ''){
	echo '#aurabuton3{  background:url('.$topbar_buton3icon_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;right: 88px;}';
}

if($topbar_buton4icon_url != ''){
	echo '#aurabuton4{  background:url('.$topbar_buton4icon_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;right: 132px;}';
}

if($topbar_buton5icon_url != ''){
	echo '#aurabuton5{  background:url('.$topbar_buton5icon_url.') center center no-repeat;  background-size:32px 22px;  display:block;  width:44px;  height:44px; cursor: pointer;position: absolute;top: 0;right: 176px;}';
}
?>



/*------------------------------------*\
    CONTENT ELEMENTS
\*------------------------------------*/
.wmf_services_class .wmf_icon_class{background:<?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmf_services_class:hover .wmf_icon_class{background:<?php echo $tcustomizer_contentelementcolor2?>!important;}
.wmf_services_class:hover .wmf_icon_class i{color:<?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmf_services_class .wmf_icon_class:hover:after{border-top:9px solid <?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmfaccordion-heading{border-bottom: 1px solid <?php echo $tcustomizer_contentelementcolor1?>!important;}
a.wmfaccordion-toggle:hover:before{ color: <?php echo $tcustomizer_contentelementcolor1?>!important; }
a.wmfaccordion-toggle:before{ color: <?php echo $tcustomizer_contentelementcolor1?>!important; }
.wmfnav-tabs>li.active>a,.wmfnav-tabs>li.active>a:hover,.wmfnav-tabs>li.active>a:focus{ border-top: 1px solid <?php echo $tcustomizer_contentelementcolor1?>!important; }
.wmfaccordion-heading{border-bottom:1px solid <?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmfaccordion-heading{border-bottom:1px solid <?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmfnav-tabs>li.active>a, .wmfnav-tabs>li.active>a:hover, .wmfnav-tabs>li.active>a:focus{border-top:1px solid <?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmfnav-tabs>li.active>a, .wmfnav-tabs>li.active>a:hover, .wmfnav-tabs>li.active>a:focus{border-top:1px solid <?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmftab-content>.wmftab-pane, .pill-content>.pill-pane{background-color:<?php echo $tcustomizer_contentelementcolor2?>!important;}
.wmfnav-tabs>li.active>a, .wmfnav-tabs>li.active>a:hover, .wmfnav-tabs>li.active>a:focus, .wmfnav-tabs>li>a{background-color: <?php echo $tcustomizer_contentelementcolor2?>!important;}
.wmfnav-tabs > li.active > a, .wmfnav-tabs > li.active > a:hover, .wmfnav-tabs > li.active > a:focus {color: <?php echo $tcustomizer_contentelementcolor1?>!important;}
.wmfaccordion-heading {background-color: <?php echo $tcustomizer_contentelementcolor2?>!important;}
.wmfaccordion-inner {background-color: <?php echo $tcustomizer_contentelementcolor2?>!important;}
.wmfnav-tabs > li > a:hover {border: none!important; border-color:<?php echo $tcustomizer_contentelementcolor2?>!important;}