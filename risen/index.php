<?php
/**
 * Homepage
 */

// Check if bottom widget columns are active
$home_column_left_active = is_active_sidebar( 'home-column-left' ) ? true : false;
$home_column_right_active = is_active_sidebar( 'home-column-right' ) ? true : false;
 
// Output header
get_header();

?>

<div<?php // adding classes to home content container allows layout to be adjusted via stylesheet

	$home_classes = array();
	
	if ( ! risen_option( 'slider_enabled' ) ) { // no slider used
		$home_classes[] = 'no-slider';
	}

	if ( ! risen_option( 'home_intro' ) ) { // no home intro used
		$home_classes[] = 'no-intro';
	}
	
	if ( $home_column_left_active && $home_column_right_active ) { // both widget columns used
		$home_classes[] = 'home-column-widgets-both';
	}

	if ( ! empty( $home_classes ) ) { // output class attribute and values
		echo ' class="' . implode( ' ', $home_classes ) . '"';
	}
	
?>>

	<?php get_template_part( 'loop', 'slider' ); ?>

	<?php if ( risen_option( 'home_intro' ) ) : ?>
	<div id="intro">
		<?php echo force_balance_tags( do_shortcode( risen_option( 'home_intro' ) ) ); // auto-close <b> tag to rpevent messing up whole page ?>
	</div>
	<?php endif; ?>

	<?php get_template_part( 'loop', 'home-boxes' ); ?>	
	
	<?php if ( is_active_sidebar( 'home-column-left' ) || is_active_sidebar( 'home-column-right' ) ) : ?>
	<div id="home-column-widgets">

		<?php get_sidebar( 'home-column-left' ); ?>
	
		<?php get_sidebar( 'home-column-right' ); ?>
		
		<div class="clear"></div>
		
	</div>
	<?php endif; ?>
	
</div>

<?php get_footer(); ?>