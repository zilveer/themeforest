<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package shift_cv
 */
?>

<?php 
global $sidebar_position, $sidebar_class, $sidebar_id;
if ($sidebar_position != 'fullwidth') {
?>
        <aside id="secondary" class="widget_area sidebar_blog <?php echo $sidebar_class . ' ' . $sidebar_id; ?>" role="complementary">
            <?php do_action( 'before_sidebar' ); ?>
            <?php if ( ! dynamic_sidebar( $sidebar_id ) ) { ?>
    			<?php // Put here html if user no set widgets in sidebar ?>
            <?php } // end sidebar widget area ?>
        </aside>
<?php
}
?>