<?php
/**
 * @package WordPress
 * @subpackage Arapah-WP
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
    
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
        
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie9" lang="en"> <![endif]-->
    
    <title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>
        
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Favicons
  ================================================== -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/logo57.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/logo72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/logo114.png">

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	
<?php wp_head(); ?>        
</head>

<body <?php body_class(); ?>><!-- the Body  -->

<div class="wrapper clearfix"><!-- Will be ended on footer.php  -->

	<section id="topest">
		<div class="justbg">
			<div class="container">
				<div id="time" class="three column">
					<?php if ( of_get_option('top-date') ) : ?> 	
					<div class="time gutter alpha">
						<?php echo date_i18n('l, M jS Y', time()); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="float-right">
					<div id="search-topmenu">
						<?php if ( of_get_option('top-search') ) : ?>
						<form role="search" method="get" id="search-form" action="<?php echo home_url( '/' ); ?>">
							<div>
								<input type="text" name="s" id="s" class="inputbox" value="Search..." onblur="if(this.value=='') this.value='Search...';" onfocus="if(this.value=='Search...') this.value='';" />
								<input type="submit" id="search-submit" value="" />
							</div>
						</form>
						<?php endif; ?>
						
						<div class="float-right topmenu">
							<?php if ( is_active_sidebar( 'topest-sidebar' ) ) : ?> <?php dynamic_sidebar( 'topest-sidebar' ); ?>
							<?php endif; ?>
						</div>
						<div class="clear"></div>
					</div>
				</div><!-- .justbg -->
			</div><!-- .container -->
		</div><!-- .justbg -->
	</section><!-- #topest  -->