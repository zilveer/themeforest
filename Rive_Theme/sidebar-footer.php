<?php
/**
 * The Footer widget areas.
 */
?>

<?php
/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 */
if ( ! is_active_sidebar( 'sidebar-1' )
	&& ! is_active_sidebar( 'sidebar-2' )
	&& ! is_active_sidebar( 'sidebar-3' )
	&& ! is_active_sidebar( 'sidebar-4' )
)
	return;

// How many footer columns to show?
$footer_columns = get_option( 'ch_footer_columns' );
if ( $footer_columns == false ) {
	$footer_columns = 4;
}

$class = ' span24 ';
if ( $footer_columns == 4 ) {
	$class = ' span6 ';
} elseif ( $footer_columns == 3 ) {
	$class = ' span8 ';
} elseif ( $footer_columns == 2 ) {
	$class = ' span12 ';
}

// If we get this far, we have widgets. Let do this.
?>
	<?php if ( is_active_sidebar( 'sidebar-1' ) && $footer_columns >= 1 ) { ?>
	<div id="first" class="widget-area footer-links <?php echo $class; if ( $footer_columns == 1 ) echo 'last'; ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #first .widget-area -->
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-2' ) && $footer_columns >= 2 ) { ?>
	<div id="second" class="widget-area footer-links <?php echo $class; if ( $footer_columns == 2 ) echo 'last'; ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #second .widget-area -->
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) && $footer_columns >= 3 ) { ?>
	<div id="third" class="widget-area footer-links <?php echo $class; if ( $footer_columns == 3 ) echo 'last'; ?>" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- #third .widget-area -->
	<?php } ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) && $footer_columns >= 4 ) { ?>
	<div id="fourth" class="widget-area footer-links <?php echo $class; ?> fourth last" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- #fourth .widget-area -->
	<?php }