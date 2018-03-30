<?php
/**
 *	Kalium WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


// Hover State
if ( $hover_state ) :
	?>
	<span href="<?php echo esc_url( $permalink ); ?>" class="hover-state<?php
		when_match( in_array( $thumbnail_hover_effect, array( 'distanced', 'distanced-no-opacity' ) ), 'with-spacing' );
		when_match( in_array( $thumbnail_hover_effect, array( 'full-cover-no-opacity', 'distanced-no-opacity' ) ), 'no-opacity' );
	?>">
	
		<?php if ( 'custom' == $blog_post_hover_layer_icon ) : ?>
			<span class="custom-hover-icon">
			<?php echo $blog_post_hover_layer_icon_custom_markup; ?>
			</span>
		<?php else: ?>
			<i class="<?php echo "icon {$hover_state}"; ?>"></i>
		<?php endif; ?>
		
	</span>
	<?php
endif;