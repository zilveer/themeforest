	</div> <!-- container -->
	<div class="footer-wrapper">
		<?php $gdl_show_footer = get_option(THEME_SHORT_NAME.'_show_footer','enable'); ?>
		
		<!-- Get Footer Widget -->
		<?php if( $gdl_show_footer == 'enable' ){ ?>
			<div class="container">
				<div class="footer-widget-wrapper">
					<?php
						$gdl_footer_class = array(
							'footer-style1'=>array('1'=>'four columns', '2'=>'four columns', '3'=>'four columns', '4'=>'four columns'),
							'footer-style2'=>array('1'=>'eight columns', '2'=>'four columns', '3'=>'four columns', '4'=>'display-none'),
							'footer-style3'=>array('1'=>'four columns', '2'=>'four columns', '3'=>'eight columns', '4'=>'display-none'),
							'footer-style4'=>array('1'=>'one-third column', '2'=>'one-third column', '3'=>'one-third column', '4'=>'display-none'),
							'footer-style5'=>array('1'=>'two-thirds column', '2'=>'one-third column', '3'=>'display-none', '4'=>'display-none'),
							'footer-style6'=>array('1'=>'one-third column', '2'=>'two-thirds column', '3'=>'display-none', '4'=>'display-none'),
							);
						$gdl_footer_style = get_option(THEME_SHORT_NAME.'_footer_style', 'footer-style4');
					 
						for( $i=1 ; $i<=4; $i++ ){
							echo '<div class="' . $gdl_footer_class[$gdl_footer_style][$i] . ' mt0">';
							dynamic_sidebar('Footer ' . $i);
							echo '</div>';
						}
					?>
					<div class="clear"></div>
				</div>
			</div> <!-- container -->
		<?php } ?>
		
		<?php $gdl_show_copyright = get_option(THEME_SHORT_NAME.'_show_copyright','enable'); ?>
		
		<!-- Get Copyright Text -->
		<?php if( $gdl_show_copyright == 'enable' ){ ?>
			<div class="clear"></div>
			<div class="copyright-wrapper">
				<div class="container">
						<?php echo get_option(THEME_SHORT_NAME.'_copyright_area') ?>
				</div> <!-- container -->
			</div>
		<?php } ?>
		
	</div><!-- footer-wrapper -->
</div> <!-- body-wrapper -->
	
<?php wp_footer(); ?>

<script type="text/javascript"> 	
	<?php include ( TEMPLATEPATH."/javascript/cufon-replace.php" ); ?>
</script>
<!--
<script type="text/javascript"> 	
	jQuery(document).ready(function(){
		var header_height = jQuery('.header-wrapper').filter(':first').height();
		var footer_height = jQuery('.footer-wrapper').filter(':first').height();
		var window_height = jQuery(window).height();
		var content = jQuery('.content-wrapper').filter(':first');
		
		content.css( 'min-height', window_height - (header_height + footer_height) );
	});
</script>
-->
</body>
</html>