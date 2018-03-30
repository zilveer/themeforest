<?php
/* ---------------------------------------------------------------------------
 * Custom Color Styles
 * --------------------------------------------------------------------------- */
if ( ! defined( 'ABSPATH' ) ) exit; ?>

/*----*****---- Font Size ----*****----*/
body { font-size:13px; line-height:24px; }

h1, h2, h3, h4, h5, h6 { letter-spacing:0.5px; }	

h1{ font-size:30px; }
h2{ font-size:24px; font-weight:600; }
h3{ font-size:18px; }
h4{ font-size:16px; }
h5{ font-size:14px; }
h6{ font-size:13px; }
	
/************** BPanel Options **************/
body, .layout-boxed .inner-wrapper { background-color:<?php veda_opts_show('body-bgcolor','#fffff');?>;}

<?php
$mtype = veda_option('layout','menu-active-type');
$skin = veda_option('colors','theme-skin');
# When Choosing Custom Skin...
if($skin == 'custom'): ?>

	.dt-sc-highlight.extend-bg-fullwidth-left:after, .dt-sc-highlight.extend-bg-fullwidth-right:after { background:<?php veda_opts_show('custom-default', '#da0000');?>;}   
       
      .top-bar a, .dt-sc-dark-bg.top-bar a { color:<?php veda_opts_show('topbar-linkcolor', veda_opts_get('custom-default', '#da0000'));?>; }<?php
    
    if( isset($mtype) && (($mtype == 'menu-active-highlight') || ($mtype == 'menu-active-highlight-with-arrow') || ($mtype == 'menu-active-with-icon menu-active-highlight')) ): ?>
        #main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu > ul.menu > li.current-menu-ancestor > a,  .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor {
            background-color:<?php veda_opts_show('menu-activebgcolor', veda_opts_get('custom-default', '#da0000'));?>;
        }<?php
    endif;
    if( isset($mtype) && (($mtype == 'menu-active-highlight') || ($mtype == 'menu-active-highlight-with-arrow')) ): ?>
        .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before {    	
            border-top-color:<?php veda_opts_show('menu-activebgcolor', veda_opts_get('custom-default', '#da0000'));?>;
        }<?php
    endif;
    if( isset($mtype) && (($mtype == 'menu-active-highlight-grey') || ($mtype == 'menu-active-with-icon menu-active-highlight')) ): ?>
        .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor > a:before {
            background-color:<?php veda_opts_show('menu-activecolor', veda_opts_get('custom-default', '#da0000'));?>;
        }<?php
    endif;
	if( isset($mtype) && ($mtype == 'menu-active-border-with-arrow') ): ?>
		.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before {
			border-bottom-color:<?php veda_opts_show('menu-activecolor', veda_opts_get('custom-default', '#da0000'));?>;
		}
		.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:after {
			background-color:<?php veda_opts_show('menu-activecolor', veda_opts_get('custom-default', '#da0000'));?>;
		}<?php
	endif;?>

    #main-menu ul.menu > li > a:hover, #main-menu ul.menu li.menu-item-megamenu-parent:hover > a, #main-menu ul.menu > li.menu-item-simple-parent:hover > a { color:<?php veda_opts_show('menu-hovercolor', veda_opts_get('custom-default', ''));?>; }
    #main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.current-menu-ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-ancestor > a, .left-header #main-menu > ul.menu > li.current_page_item > a,.left-header #main-menu > ul.menu > li.current_page_ancestor > a,.left-header #main-menu > ul.menu > li.current-menu-item > a, .left-header #main-menu > ul.menu > li.current-menu-ancestor > a { color:<?php veda_opts_show('menu-activecolor', veda_opts_get('custom-default', '#da0000'));?>; }

	#footer a:hover, #footer .dt-sc-dark-bg a:hover, #footer .widget ul li:hover:before { color:<?php veda_opts_show('footer-link-hcolor', veda_opts_get('custom-default', '#da0000'));?>; }<?php
# When choosing predefined Skins...
else: ?>
	.extend-bg-fullwidth-left:after, .extend-bg-fullwidth-right:after{ background:<?php veda_opts_show('custom-default', '');?>;}
	.top-bar a, .dt-sc-dark-bg.top-bar a { color:<?php veda_opts_show('topbar-linkcolor', '');?>; }<?php
    
    if( isset($mtype) && (($mtype == 'menu-active-highlight') || ($mtype == 'menu-active-highlight-with-arrow') || ($mtype == 'menu-active-with-icon menu-active-highlight') || ($mtype == 'menu-active-highlight-grey')) ): ?>
        #main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu > ul.menu > li.current-menu-ancestor > a,  .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor, .left-header #main-menu > ul.menu > li.current_page_item > a {
            background-color:<?php veda_opts_show('menu-activebgcolor', '');?>;
        }<?php
    endif;
    if( isset($mtype) && (($mtype == 'menu-active-highlight') || ($mtype == 'menu-active-highlight-with-arrow')) ): ?>
        .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before {    	
            border-top-color:<?php veda_opts_show('menu-activebgcolor', '');?>;
        }<?php
    endif;
    if( isset($mtype) && (($mtype == 'menu-active-highlight-grey') || ($mtype == 'menu-active-with-icon menu-active-highlight')) ): ?>
        .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight-grey #main-menu > ul.menu > li.current-menu-ancestor > a:before {
            background-color:<?php veda_opts_show('menu-activecolor', '');?>;
        }<?php
    endif;
	if( isset($mtype) && ($mtype == 'menu-active-border-with-arrow')): ?>
		.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:before {
			border-bottom-color:<?php veda_opts_show('menu-activecolor', '');?>;
		}
		.menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-border-with-arrow #main-menu > ul.menu > li.current-menu-ancestor > a:after {
			background-color:<?php veda_opts_show('menu-activecolor', '');?>;
		}<?php
	endif;
	
	$mhovercolor = veda_opts_get('menu-hovercolor', '');
	$mactivecolor = veda_opts_get('menu-activecolor', '');
	$flinkhcolor = veda_opts_get('footer-link-hcolor', '');
	
	if( !empty($mhovercolor) ){ ?>
      	#main-menu ul.menu > li > a:hover, #main-menu ul.menu li.menu-item-megamenu-parent:hover > a, #main-menu ul.menu > li.menu-item-simple-parent:hover > a { color:<?php echo $mhovercolor;?>; }<?php
	}
	
	if( !empty($mactivecolor) ){ ?>
      	#main-menu > ul.menu > li.current_page_item > a, #main-menu > ul.menu > li.current_page_ancestor > a, #main-menu > ul.menu > li.current-menu-item > a, #main-menu ul.menu > li.current-menu-ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul.menu li.menu-item-simple-parent ul > li.current-menu-ancestor > a, .left-header #main-menu > ul.menu > li.current_page_item > a,.left-header #main-menu > ul.menu > li.current_page_ancestor > a,.left-header #main-menu > ul.menu > li.current-menu-item > a, .left-header #main-menu > ul.menu > li.current-menu-ancestor > a { color:<?php echo $mactivecolor;?>;}<?php
	}
	
	if( !empty($flinkhcolor) ){?>
      	#footer a:hover, #footer .dt-sc-dark-bg a:hover { color:<?php echo $flinkhcolor;?>}<?php
	}
endif;?>

/*----*****---- Topbar  ----*****----*/
.top-bar { color:<?php veda_opts_show('topbar-textcolor', '#000000');?>; background-color:<?php veda_opts_show('topbar-bgcolor','#eeeeee');?>}
.top-bar a:hover, .dt-sc-dark-bg.top-bar a:hover { color:<?php veda_opts_show('topbar-linkhovercolor', '#000000');?>; }

/*----*****---- Header  ----*****----*/
<?php
$htype = veda_option('layout','header-type');
$hcolor = veda_option('colors','header-bgcolor');
if( isset($htype) && ($htype == 'boxed-header') && isset($hcolor) && ($hcolor != '')): ?>
	.main-header, .boxed-header.semi-transparent-header .main-header, .left-header #header-wrapper { background: rgba(<?php $rgbcolor = veda_hex2rgb(veda_opts_get('header-bgcolor', '')); $rgbcolor = implode(',', $rgbcolor); echo $rgbcolor; ?>, <?php veda_opts_show('header-bgcolor-opacity', '1');?>); }<?php
elseif( isset($hcolor) && ($hcolor != '') ):?>
	.main-header-wrapper, .fullwidth-header.semi-transparent-header .main-header-wrapper, .left-header .main-header-wrapper, .left-header .main-header, .two-color-header .main-header-wrapper:after, .header-on-slider.transparent-header .is-sticky .main-header-wrapper { background: rgba(<?php $rgbcolor = veda_hex2rgb(veda_opts_get('header-bgcolor', '')); $rgbcolor = implode(',', $rgbcolor); echo $rgbcolor; ?>, <?php veda_opts_show('header-bgcolor-opacity', '1');?>); }
    
	.two-color-header.semi-transparent-header .main-header-wrapper:after { background: rgba(<?php $rgbcolor = veda_hex2rgb(veda_opts_get('header-bgcolor', '')); $rgbcolor = implode(',', $rgbcolor); echo $rgbcolor; ?>, <?php veda_opts_show('header-bgcolor-opacity', '0.7');?>); }<?php
endif;

$headbg = veda_option('layout','header-bg');
$bgrepeat = veda_opts_get('header-bg-repeat', 'no-repeat');
$bgposition = veda_opts_get('header-bg-position', 'center center');
if( !empty( $headbg) ) {?>
	#main-header-wrapper { background-image: url('<?php echo $headbg;?>'); background-repeat: <?php echo $bgrepeat;?>; background-position: <?php echo $bgposition;?>; }<?php
}?>

/*----*****---- Menu  ----*****----*/
<?php
$mbg = veda_option('colors','menu-bgcolor');
if( isset($mbg) ): ?>
.menu-wrapper {  background: rgba(<?php $rgbcolor = veda_hex2rgb(veda_opts_get('menu-bgcolor', '')); $rgbcolor = implode(',', $rgbcolor); echo $rgbcolor; ?>, <?php veda_opts_show('menu-bgcolor-opacity', '1');?>); }<?php
endif; ?>

#main-menu ul.menu > li > a { color:<?php veda_opts_show('menu-linkcolor','#000000');?>; }

<?php
if( isset($mtype) && ($mtype == 'menu-active-with-icon menu-active-highlight') ): ?>
	.menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:before,  .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-highlight.menu-active-with-icon #main-menu > ul.menu > li.current-menu-ancestor > a:after {
		background-color:<?php veda_opts_show('menu-activecolor', '#ffffff');?>;
	}<?php
endif;
if( isset($mtype) && ($mtype == 'menu-active-with-two-border') ): ?>
	.menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:before, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current_page_ancestor > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-item > a:after, .menu-active-with-two-border #main-menu > ul.menu > li.current-menu-ancestor > a:after {
		background-color:<?php veda_opts_show('menu-activecolor', '');?>;
	}<?php
endif;
if( isset($mtype) && ($mtype == 'menu-active-with-double-border') ): ?>
	.menu-active-with-double-border #main-menu > ul.menu > li.current_page_item > a, .menu-active-with-double-border #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-with-double-border #main-menu > ul.menu > li.current-menu-item > a, .menu-active-with-double-border #main-menu > ul.menu > li.current-menu-ancestor > a {
		border-color:<?php veda_opts_show('menu-activecolor', '#ffffff');?>;
	}<?php
endif; ?>

.menu-active-highlight #main-menu > ul.menu > li.current_page_item > a, .menu-active-highlight #main-menu > ul.menu > li.current_page_ancestor > a, .menu-active-highlight #main-menu > ul.menu > li.current-menu-item > a, .menu-active-highlight #main-menu > ul.menu > li.current-menu-ancestor > a { color:<?php veda_opts_show('menu-activecolor', '#ffffff');?>; }

/*----*****---- Content  ----*****----*/
<?php
$ccolor = veda_option('colors','content-text-color');
if( isset($ccolor) ): ?>
	body { color:<?php veda_opts_show('content-text-color', '');?>; }<?php
endif;
$ccolor = veda_option('colors','content-link-color');
if( isset($ccolor) ): ?>
	a { color:<?php veda_opts_show('content-link-color', '');?>; }<?php
endif;
$ccolor = veda_option('colors','content-link-hcolor');
if( isset($ccolor) ): ?>
	a:hover { color:<?php veda_opts_show('content-link-hcolor', '');?>; }<?php
endif;?>

/*----*****---- Heading  ----*****----*/
<?php
for($i = 1; $i <= 6; $i++):
	$hcolor = veda_option("colors","heading-h{$i}-color");
	if( isset($hcolor) ):
		echo "h{$i} { color: ";
			veda_opts_show("heading-h{$i}-color", "");
		echo "; }\n";	
	endif;
endfor;?>

/*----*****---- Footer ----*****----*/
<?php
$rgbcolor = veda_hex2rgb(veda_opts_get('footer-bgcolor', '#000000'));
$rgbcolor = implode(',', $rgbcolor);
$opacity = veda_opts_get('footer-bgcolor-opacity', '1');
$footbg = veda_opts_get('footer-bg', '');
if( !empty( $footbg ) ) : ?>
	.footer-widgets { background-image: url(<?php echo $footbg; ?>); background-position: <?php veda_opts_show('footer-bg-position', 'center center');?>; background-repeat: <?php veda_opts_show('footer-bg-repeat', 'no-repeat');?>; }<?php
endif; ?>
.footer-widgets { background-color: rgba(<?php echo $rgbcolor; ?>, <?php echo $opacity; ?>); }

<?php
$darkbg = veda_option('layout','footer-darkbg');
if( isset($darkbg) ): ?>
	.footer-widgets.dt-sc-dark-bg, #footer .dt-sc-dark-bg, .footer-copyright.dt-sc-dark-bg{ color:<?php veda_opts_show('footer-text-color', 'rgba(255, 255, 255, 0.6)');?>; }
	.footer-widgets.dt-sc-dark-bg a, #footer .dt-sc-dark-bg a{ color:<?php veda_opts_show('footer-link-color', 'rgba(255, 255, 255, 0.6)');?>; }
	#footer .dt-sc-dark-bg h3, #footer .dt-sc-dark-bg h3 a { color:<?php veda_opts_show('footer-heading-color', '#ffffff');?>; }<?php
else: ?>
	.footer-widgets, #footer, .footer-copyright { color:<?php veda_opts_show('footer-text-color', '#000000');?>; }
	.footer-widgets a, #footer a { color:<?php veda_opts_show('footer-link-color', '#000000');?>; }
	#footer h3 { color:<?php veda_opts_show('footer-heading-color', '#000000');?>; }<?php
endif;?>

/*----*****---- Copyright Section ----*****----*/
.footer-copyright {
	background: rgba(<?php
    $rgbcolor = veda_hex2rgb(veda_opts_get('copyright-bgcolor', '#000000'));
	$rgbcolor = implode(',', $rgbcolor);
	echo $rgbcolor; ?>, <?php veda_opts_show('copyright-bgcolor-opacity', '1');?>);
}

/*----*****---- Megamenu ----*****----*/
<?php
# Border,Border radius
$applymenuborder = veda_option('layout','menu-border');
if( isset( $applymenuborder ) ):
	$borderstyle = veda_option('layout','menu-border-style');
	$bordercolor = veda_option('layout','menu-border-color');
	
	$bwtop = veda_option('layout','menu-border-width-top');
	$bwright = veda_option('layout','menu-border-width-right');
	$bwbottom = veda_option('layout','menu-border-width-bottom');
	$bwleft = veda_option('layout','menu-border-width-left');
	
	$brtop = veda_option('layout','menu-border-radius-top');
	$brright = veda_option('layout','menu-border-radius-right');
	$brbottom = veda_option('layout','menu-border-radius-bottom');
	$brleft = veda_option('layout','menu-border-radius-left');?>
    
    #main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container {
    	border-style:<?php echo $borderstyle;?>;
        border-color:<?php echo $bordercolor;?>;        
		<?php if( isset( $bwtop ) ) ?>
        	border-top-width:<?php echo $bwtop;?>px;        
		<?php if( isset( $bwright ) ) ?>
    		border-right-width:<?php echo $bwright;?>px;        
        <?php if( isset( $bwbottom ) ) ?>
    		border-bottom-width:<?php echo $bwbottom;?>px;
        <?php if( isset( $bwleft ) ) ?>
        	border-left-width:<?php echo $bwleft;?>px;
        <?php if( isset( $brtop ) ) ?>
        	border-top-left-radius:<?php echo $brtop;?>px;    
        <?php if( isset( $brright ) ) ?>
    		border-top-right-radius:<?php echo $brright;?>px;        
    	<?php if( isset( $brbottom ) ) ?>
    		border-bottom-right-radius:<?php echo $brbottom;?>px;        
    	<?php if( isset( $brleft ) ) ?>
    		border-bottom-left-radius:<?php echo $brleft;?>px;
	}
<?php
endif;
# Mega Menu Container BG Color
$menubgcolor = veda_option('layout','menu-bg-color');
if( isset( $menubgcolor ) ):?>
	#main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container { background-color:<?php echo $menubgcolor;?>;}<?php
endif;

# Mega Menu Container gradient
$menugrc1 =  veda_option('layout','menu-gradient-color1');
$menugrc2 =  veda_option('layout','menu-gradient-color2');

if( isset($menugrc1) && isset($menugrc2) ) {
	
	$p1 = (veda_option('layout','menu-gradient-percent1') != NULL) ? veda_option('layout','menu-gradient-percent1') : "0%";
	$p2 = (veda_option('layout','menu-gradient-percent2') != NULL) ? veda_option('layout','menu-gradient-percent2') : "100%";?>
    #main-menu ul li.menu-item-simple-parent ul, #main-menu .megamenu-child-container {
		background: <?php echo $menugrc1; ?>; /* Old browsers */
		background: -moz-linear-gradient(top, <?php echo $menugrc1.' '.$p1.', '.$menugrc2.' '.$p2; ?>); /* FF3.6-15 */
		background: -webkit-linear-gradient(top, <?php echo $menugrc1.' '.$p1.', '.$menugrc2.' '.$p2; ?>); /* Chrome10-25,Safari5.1-6 */
		background: linear-gradient(to bottom, <?php echo $menugrc1.' '.$p1.', '.$menugrc2.' '.$p2 ?>); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $menugrc1; ?>', endColorstr='<?php echo $menugrc2; ?>',GradientType=0 ); /* IE6-9 */
	}
    <?php  
}

# Default Menu Title text and hover color
$titletextdcolor = veda_option('layout','menu-title-text-dcolor');
$titletextdhcolor = veda_option('layout','menu-title-text-dhcolor');

if( isset( $titletextdcolor) )?>
	#main-menu .megamenu-child-container > ul.sub-menu > li > a, #main-menu .megamenu-child-container > ul.sub-menu > li > .nolink-menu { color:<?php echo $titletextdcolor;?>; }<?php
if( isset( $titletextdhcolor) )?>
	#main-menu .megamenu-child-container > ul.sub-menu > li > a:hover { color:<?php echo $titletextdhcolor;?>; }
	#main-menu .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a { color:<?php echo $titletextdhcolor;?>; }<?php


# Menu Title Background
if( "true" == veda_option('layout','menu-title-bg') ) :
	$menutitlebgcolor = veda_option('layout','menu-title-bg-color');
	$bghovercolor = veda_option('layout','menu-title-hoverbg-color');
	$menutitletxtcolor = veda_option('layout','menu-title-text-color');
	$hovertxtcolor = veda_option('layout','menu-title-hovertext-color');
	$menutitlebr = veda_option('layout','menu-title-border-radius');?>
    #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > .nolink-menu {
    	<?php if( isset( $menutitlebgcolor ) )?>
        	background:<?php echo $menutitlebgcolor;?>;
        <?php if( isset( $menutitlebr ) ) ?>
        	border-radius:<?php echo $menutitlebr;?>px;        
    }
    
    <?php if( isset($bghovercolor) ) {?>
    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover { background:<?php echo $bghovercolor;?>;}
		#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a { background:<?php echo $bghovercolor;?>; }<?php
	}
	
	if( isset( $menutitletxtcolor ) ) {?>
    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > .nolink-menu, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a .menu-item-description { color:<?php echo $menutitletxtcolor;?>;}<?php
	}
	
	if( isset( $hovertxtcolor ) ) {?>
    	#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li > a:hover .menu-item-description { color:<?php echo $hovertxtcolor;?>;}
		#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_item > a .menu-item-description
#main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current_page_ancestor > a .menu-item-description, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-item > a .menu-item-description, #main-menu .menu-item-megamenu-parent.menu-title-with-bg .megamenu-child-container > ul.sub-menu > li.current-menu-ancestor > a .menu-item-description { color:<?php echo $hovertxtcolor;?>; }<?php
	}
endif;

#Menu Title With Border
$mtbwtop = veda_option('layout','menu-title-border-width-top');
$mtbwright = veda_option('layout','menu-title-border-width-right');
$mtbwbottom = veda_option('layout','menu-title-border-width-bottom');
$mtbwleft = veda_option('layout','menu-title-border-width-left');

if( isset($mtbwtop) || isset($mtbwright) || isset($mtbwbottom) || isset($mtbwleft) ) :

	$menutitlebrc = veda_option('layout','menu-title-border-color');
	$menutitlebrs = veda_option('layout','menu-title-border-style'); ?>
    #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > a, #main-menu .menu-item-megamenu-parent .megamenu-child-container > ul.sub-menu > li > .nolink-menu {
    	<?php if( isset( $mtbwtop ) ) : ?>
        		 border-top-width:<?php echo $mtbwtop; ?>px;
                 padding-top:10px;

    	<?php endif;
			  if( isset( $mtbwright ) ): ?>
        		 border-right-width:<?php echo $mtbwright; ?>px;
                 padding-right:10px;

    	<?php endif;
			  if( isset( $mtbwbottom ) ): ?>
        		 border-bottom-width:<?php echo $mtbwbottom; ?>px;
                 padding-bottom:10px;

    	<?php endif;
			  if( isset( $mtbwleft ) ): ?>
        		 border-left-width:<?php echo $mtbwleft; ?>px;
                 padding-left:10px;       
    	
        <?php endif;
		     if( isset( $menutitlebrs ) ) ?>
        	 	border-style:<?php echo $menutitlebrs;?>;
        <?php if( isset( $menutitlebrc ) ) ?>
        		 border-color:<?php echo $menutitlebrc;?>;
   }<?php	
endif;

# Default text and hover color
$textdcolor = veda_option('layout','menu-link-text-dcolor');
$textdhcolor = veda_option('layout','menu-link-text-dhcolor');

if( isset( $textdcolor) )?>
	#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a { color:<?php echo $textdcolor;?>; }<?php
if( isset( $textdhcolor) ) :?>
	#main-menu .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover { color:<?php echo $textdhcolor;?>; }
	#main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent ul > li.current-menu-ancestor > a { color:<?php echo $textdhcolor;?>; }<?php
endif;

# Menu Links Background
if( "true" == veda_option('layout','menu-links-bg') ) :
	$menulinkbgcolor = veda_option('layout','menu-link-bg-color');
	$menulinkbghovercolor = veda_option('layout','menu-link-hoverbg-color');
	$menulinktxtcolor = veda_option('layout','menu-link-text-color');
	$menulinkhovertxtcolor = veda_option('layout','menu-link-hovertext-color');
	$menulinkbr = veda_option('layout','menu-link-border-radius');
	echo "\n";?>    
    /* Menu Link */   
    #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li > a {
    	<?php if( !is_null( $menulinkbgcolor ) || !empty( $menulinkbgcolor ) ):?>
        		background:<?php echo $menulinkbgcolor;?>;
        <?php endif;
			if( isset( $menulinkbr ) ) ?>
        	border-radius:<?php echo $menulinkbr;?>px;
        <?php if(!is_null($menulinktxtcolor) || !empty( $menulinktxtcolor ) ): ?>
        	color:<?php echo $menulinktxtcolor;?>;
        <?php endif; ?>
    }
    /* Menu Link Hover */
    #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li > a:hover {
    	<?php if( !is_null( $menulinkbghovercolor ) || !empty( $menulinkbghovercolor ) ):?>
        		background:<?php echo $menulinkbghovercolor;?>;
        <?php endif;
			if( !is_null( $menulinkhovertxtcolor ) || !empty( $menulinkhovertxtcolor ) ):?>
        	color:<?php echo $menulinkhovertxtcolor;?>;
       <?php endif;?>
    }
	#main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current_page_item > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current_page_ancestor > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-item > a, #main-menu .menu-item-megamenu-parent.menu-links-with-bg .megamenu-child-container ul.sub-menu > li > ul > li.current-menu-ancestor > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current_page_item > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current_page_ancestor > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current-menu-item > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-bg ul > li.current-menu-ancestor > a {
    	<?php if( !is_null( $menulinkbghovercolor ) || !empty( $menulinkbghovercolor ) ):?>
        	background:<?php echo $menulinkbghovercolor;?>;
        <?php endif;
			if( !is_null( $menulinkhovertxtcolor ) || !empty( $menulinkhovertxtcolor ) ):?>
        	color:<?php echo $menulinkhovertxtcolor;?>;
        <?php endif;?>
    }<?php
endif;

#Menu link hover boder 
if( "true" == veda_option('layout','menu-hover-border') ) {
	$mlhcolor = veda_option('layout','menu-link-hborder-color');
	
	if( isset( $mlhcolor ) ) {?>   
      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li, #main-menu ul li.menu-item-simple-parent ul > li { width:100%; box-sizing:border-box; } 
      #main-menu .menu-item-megamenu-parent.menu-links-with-arrow .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-arrow ul > li > a { padding-left:27px; }
	  #main-menu .menu-item-megamenu-parent.menu-links-with-arrow .megamenu-child-container ul.sub-menu > li > ul > li > a:before, #main-menu ul li.menu-item-simple-parent.menu-links-with-arrow ul > li > a:before { left:12px; }
      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li > a, #main-menu ul li.menu-item-simple-parent ul > li:last-child > a { padding:7px 10px; width:100%; box-sizing:border-box; border:1px solid transparent; }
      #main-menu .menu-item-megamenu-parent .megamenu-child-container ul.sub-menu > li > ul > li > a:hover, #main-menu ul li.menu-item-simple-parent ul > li > a:hover {
        border:1px solid <?php echo $mlhcolor;?>;        
      }<?php		
	}
}

#Menu Links With Border
if( "true" == veda_option('layout','menu-links-border') ) :

	$menulinkbrw = veda_option('layout','menu-link-border-width');
	$menulinkbrc = veda_option('layout','menu-link-border-color');
	$menulinkbrs = veda_option('layout','menu-link-border-style'); ?>
    #main-menu .menu-item-megamenu-parent.menu-links-with-border .megamenu-child-container ul.sub-menu > li > ul > li > a, #main-menu ul li.menu-item-simple-parent.menu-links-with-border ul > li > a {
    	<?php if( isset( $menulinkbrw ) ) ?>
        	 border-bottom-width:<?php echo $menulinkbrw;?>px;
        <?php if( isset( $menulinkbrc ) ) ?>
        	 border-bottom-style:<?php echo $menulinkbrs;?>;
        <?php if( isset( $menulinkbrs ) ) ?>
        	 border-bottom-color:<?php echo $menulinkbrc;?>;
   }<?php	
endif;
