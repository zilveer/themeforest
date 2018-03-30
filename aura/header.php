<?php global $webbumobile_option;?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
		
		<!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="<?php bloginfo('description'); ?>">
        
        
        <?php 
		$general_ioswebapp = $webbumobile_option[ 'general_ioswebapp'];
		if( $general_ioswebapp == 1 ){
		?>
        <!-- web app -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <?php
		}
		?>
        
        <!-- mobile Features -->
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        
        <!-- iOS touch icons -->
        <?php 
		$iostouchicon_1 = AuraIssetControl('iostouchicon_1','url','');
		$iostouchicon_2 = AuraIssetControl('iostouchicon_2','url','');
		$iostouchicon_3 = AuraIssetControl('iostouchicon_3','url','');
		$iostouchicon_4 = AuraIssetControl('iostouchicon_4','url','');
		?>
        <link rel="shortcut icon" href="<?php echo $iostouchicon_1; ?>">
        <link rel="apple-touch-icon" href="<?php echo $iostouchicon_1;?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $iostouchicon_2;?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $iostouchicon_3;?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $iostouchicon_4;?>">
        <!-- iOS Splash screens -->
        
       
        <?php 		
		$splashscreen_iphone3 = AuraIssetControl('splashscreen_iphone3','url','');
		$splashscreen_iphone4 = AuraIssetControl('splashscreen_iphone4','url','');
		$splashscreen_iphone5 = AuraIssetControl('splashscreen_iphone5','url','');
		$splashscreen_iphone6 = AuraIssetControl('splashscreen_iphone6','url','');
		$splashscreen_iphone62 = AuraIssetControl('splashscreen_iphone62','url','');
		$splashscreen_porttablet = AuraIssetControl('splashscreen_porttablet','url','');
		$splashscreen_landtablet = AuraIssetControl('splashscreen_landtablet','url','');
		$splashscreen_porttabletret = AuraIssetControl('splashscreen_porttabletret','url','');
		$splashscreen_landtabletret = AuraIssetControl('splashscreen_landtabletret','url','');
		?>
		<!-- iPhone 320x460 -->
		<link href="<?php echo $splashscreen_iphone3;?>" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
		<!-- iPhone (Retina) 640x920 -->
		<link href="<?php echo $splashscreen_iphone4;?>" media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
		<!-- iPhone 5 640x1096-->
		<link href="<?php echo $splashscreen_iphone5;?>" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
		<!-- iPad 768x1004 / 748x1024-->
		<link href="<?php echo $splashscreen_porttablet;?>" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
		<link href="<?php echo $splashscreen_landtablet;?>" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)" rel="apple-touch-startup-image">
		<!-- iPad (Retina) 1536x2008 / 1496x2048 -->
		<link href="<?php echo $splashscreen_porttabletret;?>" media="(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
		<link href="<?php echo $splashscreen_landtabletret;?>" media="(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
		<!-- / Splash Screens -->
 		
 		<!-- iPhone 6 375x667-->
        <link href="<?php echo $splashscreen_iphone6;?>" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
        <!-- iPhone 6+ 414x736-->
        <link href="<?php echo $splashscreen_iphone62;?>" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
		<!-- / Splash Screens -->
		
		<!-- css + javascript -->
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> onload="loaded()">
        
        <?php
		$general_loading = $webbumobile_option[ 'general_loading'];
		
		if($general_loading == 1){
			$general_loadingcolor = $webbumobile_option[ 'general_loadingcolor'];
		?>
        <!--Loading Ani-->
        <div class="wmfloadingani wthemeloading<?php echo $general_loadingcolor;?>">
            <div class="wthemeloadingimage wthemeloadingimg<?php echo $general_loadingcolor;?>"></div>
        </div>
        <!--/Loading Ani-->
        <?php }?>
        
        
        
        <!-- Content -->
        	<?php 			
			$topbar_buton1icon = AuraIssetControl('topbar_buton1icon','url','');
			$topbar_buton1link = AuraIssetControl('topbar_buton1link','','');
			$topbar_buton2icon = AuraIssetControl('topbar_buton2icon','url','');
			$topbar_buton2link = AuraIssetControl('topbar_buton2link','','');
			$topbar_buton3icon = AuraIssetControl('topbar_buton3icon','url','');
			$topbar_buton3link = AuraIssetControl('topbar_buton3link','','');
			$topbar_buton4icon = AuraIssetControl('topbar_buton4icon','url','');
			$topbar_buton4link = AuraIssetControl('topbar_buton4link','','');
			$topbar_buton5icon = AuraIssetControl('topbar_buton5icon','url','');
			$topbar_buton5link = AuraIssetControl('topbar_buton5link','','');
			?>
            <!-- Header Top Bar -->
            <div id="auratoolbar">
                <?php 
				echo '<a id="aura-toggle-menu" class="auraopen"></a>';
				
				if(is_single()){echo '<a onclick="goBack();" id="aurabackbutton"></a>';}
				
				if($topbar_buton5icon != ''){echo '<a href="'.$topbar_buton5link.'" id="aurabuton5"></a>';}
				if($topbar_buton4icon != ''){echo '<a href="'.$topbar_buton4link.'" id="aurabuton4"></a>';}
				if($topbar_buton3icon != ''){echo '<a href="'.$topbar_buton3link.'" id="aurabuton3"></a>';}
				if($topbar_buton2icon != ''){echo '<a href="'.$topbar_buton2link.'" id="aurabuton2"></a>';}
				if($topbar_buton1icon != ''){echo '<a href="'.$topbar_buton1link.'" id="aurabuton1"></a>';}
				?>
            </div>
            <!-- Header Top Bar -->
            
            
            <!-- Logo Bar -->
            <div id="auralogobar" class="auralogobar">
				<?php 
                $logosettings_home = $webbumobile_option[ 'logosettings_home'];
                if($logosettings_home == 1){echo '<a href="'.home_url().'"><div class="auralogo"></div></a>';}else{echo '<div class="auralogo"></div>';}
                ?>
            </div>
            <!-- /Logo Bar-->
            
            <!-- Menu Bar -->
            <div id="auranavwrapper" class="auraoverlay auraoverlay-slidedown">
                <div id="scroller">
                
                    <div class="aurawrapper">
                        <div class="auracontainer">
                            
                           <?php add_auramainmenu_code()?>  
                            
                        </div>
                        <!--/.auracontainer-->
                    </div>
                    <!--/.aurawrapper-->
                </div>
            </div>
            <!-- /Menu Bar -->
            
            
            
            <!-- Main Content -->
            <div id="maincontent">