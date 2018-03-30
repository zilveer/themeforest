			<div class="footer-top-shadow"></div>
		</div> <!-- container -->
		<div class="footer-container container">
		
		<!-- Get Footer Widget -->
		<?php $gdl_show_footer = get_option(THEME_SHORT_NAME.'_show_footer','enable'); ?>
		<?php if( $gdl_show_footer == 'enable' ){ ?>
			<div class="footer-wrapper">
				<div class="footer-widget-wrapper">
					<div class="row">
						<?php
							$gdl_footer_class = array(
								'footer-style1'=>array('1'=>'three columns', '2'=>'three columns', '3'=>'three columns', '4'=>'three columns'),
								'footer-style2'=>array('1'=>'six columns', '2'=>'three columns', '3'=>'three columns', '4'=>''),
								'footer-style3'=>array('1'=>'three columns', '2'=>'three columns', '3'=>'six columns', '4'=>''),
								'footer-style4'=>array('1'=>'four columns', '2'=>'four columns', '3'=>'four columns', '4'=>''),
								'footer-style5'=>array('1'=>'eight columns', '2'=>'four columns', '3'=>'', '4'=>''),
								'footer-style6'=>array('1'=>'four columns', '2'=>'eight columns', '3'=>'', '4'=>''),
								);
							$gdl_footer_style = get_option(THEME_SHORT_NAME.'_footer_style', 'footer-style1');
						 
							for( $i=1 ; $i<=4; $i++ ){
								$footer_class = $gdl_footer_class[$gdl_footer_style][$i];
									if( !empty($footer_class) ){
									echo '<div class="' . $footer_class . ' gdl-footer-' . $i . ' mb0">';
									dynamic_sidebar('Footer ' . $i);
									echo '</div>';
								}
							}
						?>
						<div class="clear"></div>
					</div> <!-- close row -->
				</div>
			</div> 
		<?php } ?>

		<!-- Get Copyright Text -->
		<?php $gdl_show_copyright = get_option(THEME_SHORT_NAME.'_show_copyright','enable'); ?>
		<?php if( $gdl_show_copyright == 'enable' ){ ?>
			<div class="copyright-wrapper">
				<div class="copyright-left">
					<?php echo do_shortcode( __(get_option(THEME_SHORT_NAME.'_copyright_left_area'), 'gdl_front_end') ); ?>
				</div> 
				<div class="copyright-right">
					<?php echo do_shortcode( __(get_option(THEME_SHORT_NAME.'_copyright_right_area'), 'gdl_front_end') ); ?>
				</div> 
				<div class="clear"></div>
			</div>
		<?php } ?>
		
		</div><!-- footer wrapper -->
	</div> <!-- content wrapper -->
</div> <!-- body wrapper -->
	
<?php wp_footer(); ?>

</body>
</html>