<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?>

        <?php
        /**
         * After page-wrapper part - action
         */
        do_action('kleo_after_main');
        ?>

    </div><!-- #page-wrapper -->
	
    <?php
    /**
     * After footer hook
     *
     */
    do_action('kleo_after_footer');
    ?>
	
	<!-- Analytics -->
	<?php echo stripslashes( sq_option( 'quick_js', '' ) ); ?>
	
	<?php wp_footer(); ?>

</body>
</html>