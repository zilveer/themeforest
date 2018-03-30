<?php
/**
 * The template for displaying the footer.
 *
 */
$settings = get_option( "ntl_theme_settings" );
?>


</div> <!-- .frameset -->
</div> <!-- .outer -->

<div id="footerbottom">
	<div class="container clear">
		<div id="site-info">
			<a href="<?php echo home_url( '/' ) ?>" class="whites" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?> &copy; (<?php echo date('Y'); ?>)
			</a>
		</div><!-- #site-info -->	
		<div id="site-generator">
			<a href="<?php echo esc_url( __('http://www.netstudio.co.za/', 'localize') ); ?>" 
				title="<?php esc_attr_e('Netstudio', 'localize'); ?>" rel="generator">
			<?php printf( __('Proudly Designed by %s.', 'localize'), 'Netstudio' ); ?>
			</a>
		</div><!-- #site-generator -->
	</div>
</div>	

<div class="galleryover">
	<div class="goverlay">
		<div class="gloading">&nbsp;</div>
	</div>
	<img src="<?php echo get_template_directory_uri(); ?>/images/goright.png" class="goleft">
	<img src="<?php echo get_template_directory_uri(); ?>/images/goleft.png" class="goright">
	<p class="gallerytitle"></p>
	<a href="#" class="galclose">&nbsp;</a>
	<div class="galleryframe">	
		<div class="galleryoutside"><div class="galleryinside clear">&nbsp;</div></div>
		<a href="#"	class="insideleft">previous</a>
		<a href="#"	class="insideright">next</a>		
	</div>
</div>

<div class="jqmWindow" id="dialog">
	<a href="#" class="jqmClose">X</a>
	<div class="jqminner">

	</div>
</div>

<div class="imgloader">&nbsp;</div>
		
<script type="text/javascript">
	jQuery(document).ready(function($) {
		ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
		base_url = '<?php echo get_template_directory_uri(); ?>';
		cdelay = <?php echo ($settings['ntl_trans_time']*1000); ?>;
		ctrans = '<?php echo $settings['ntl_trans_type']; ?>';
		cstyle = '<?php echo $settings['ntl_slide_type']; ?>';
		ccol =  '<?php echo $settings['ntl_theme_color']; ?>';
		btpath = '<?php echo get_template_directory_uri(); ?>/images/';
		surl = '<?php echo get_template_directory_uri(); ?>/js/';
	});			
</script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.animate-colors-min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/cookie.js"></script>

<!-- the core stuff -->
<?php if ($settings['ntl_slide_type'] == 'image') { ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.skitter.min.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jcarousellite.js"></script>

<?php
wp_footer();
?>

<script src="<?php echo get_template_directory_uri(); ?>/js/custom.js" type="text/javascript"></script>
</body>
</html>
