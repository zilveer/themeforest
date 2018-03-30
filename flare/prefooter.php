<?php
/**
 * The Template Part for displaying the Prefooter Theme Area.
 * 
 * The prefooter is a widget-ready theme area below the content and above the footer.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php 
	$mapping = array(
		'1/1'	=> 'c-max',
		'1/2'	=> 'c-one-half',
		'1/3'	=> 'c-one-third',
		'1/4'	=> 'c-one-fourth',
		'3/4'	=> 'c-three-fourth',
	);
	
	$layout  = btp_theme_get_option_value( 'style_prefooter_layout' );	
	$columns = strlen( $layout ) ? explode( '_', $layout ) : array();
?>
<?php if( count( $columns ) ): ?>
	<aside id="prefooter" class="<?php echo btp_content_get_class(); ?>">
		<div id="prefooter-inner">
			<div class="grid">
				<?php foreach( $columns as $i => $column ): ?>
				<div class="<?php echo $mapping[ $column ]?>">
					<?php btp_sidebar_render( 'prefooter-' . ( $i + 1 ) ); ?>
				</div>
			<?php endforeach; ?>
			</div>				
		</div><!-- #prefooter-inner -->
		<div class="background">
			<div class="shadow"></div>
			<div class="pattern"></div>
			<div class="flare">
				<div></div>
				<div></div>
			</div>
		</div>
	</aside><!-- #prefooter -->	
<?php endif; ?>