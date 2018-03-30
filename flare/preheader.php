<?php
/**
 * The Template Part for displaying the Preheader Theme Area.
 * 
 * The preheader is a collapsible, widget-ready theme area above the header.
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
		'3/4'	=> 'c-three-fourths',
	);
	
	$layout  = btp_theme_get_option_value( 'style_preheader_layout' );
	$columns = strlen( $layout ) ? explode( '_', $layout ) : array();
?>
<?php if( count( $columns ) ): ?>
	<aside id="preheader" class="<?php echo btp_content_get_class(); ?>">
		<div id="preheader-inner">
			<div class="grid">
				<?php foreach( $columns as $i => $column ): ?>
				<div class="<?php echo $mapping[ $column ]?>">
					<?php btp_sidebar_render( 'preheader-' . ( $i + 1 ) ); ?>				
				</div>
			<?php endforeach; ?>
			</div>				
		</div><!-- #preheader-inner -->
		<div class="background"></div>
		<div id="preheader-toggle">
			<span class="arrow"></span>
		</div>
	</aside><!-- #preheader -->	
<?php endif; ?>