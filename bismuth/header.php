<?php global $lb_opc; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('-');?></title>

    <!-- Mobile
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE]>
        <link href="<?php echo get_template_directory_uri() . '/css/ie.css';?>" rel='stylesheet' type='text/css'>
    <![endif]-->

    <?php if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>
   
<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<!-- scripts for background slider start -->
<?php		
	include (TEMPLATEPATH . '/includes/slider.php'); 
?>
<!-- scripts for background slider end -->

<!-- begin HEADER -->
<!--
<div id="mobile-header">
<a style="padding: 250px 10px; background: #000;" id="responsive-menu-button" href="#sidr-main">Menu</a>
</div>
-->



<!--
MOBILE MENU
-->
<div class="mmenufix">

	<div class="navi2">
		<a  class="closed" id="mobile"></a>
	</div>


<div id="mobi-menu" class="off">		

					<!--<nav>-->
					<?php wp_nav_menu(array(
						'theme_location' => 'top-menu',
						'container' => 'div',
						'container_class' => 'container',
						'container_id' => 'header',
						'menu_class' => 'navigation',
						'fallback_cb' => 'show_top_menu',
						'echo' => true,
						'walker' => new description_walker(),
						'depth' => 0 ) ); ?>
					<!--</nav>-->

</div>
</div>







<div class="navi">

	<div id="header-wrap">	
		<div id="slideout-wrap">   
			<div id="slideout-container">				
				<div id="header" class="container">
<!--
<div id="navigation">
<nav class="nav">
-->
					<!--<nav>-->
					<?php wp_nav_menu(array(
						'theme_location' => 'top-menu',
						'container' => 'div',
						'container_class' => 'container',
						'container_id' => 'header',
						'menu_class' => 'navigation',
						'fallback_cb' => 'show_top_menu',
						'echo' => true,
						'walker' => new description_walker(),
						'depth' => 0 ) ); ?>
					<!--</nav>-->
				</div>
			</div>           	
		</div>					
	</div>

</div>
</div>
<!--
</div>					
</div>
-->