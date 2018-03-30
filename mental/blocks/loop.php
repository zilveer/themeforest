<?php
/**
 * Posts loop template, shows default posts list
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<?php
$atts['type']    = get_mental_option( 'blog_type' );
$atts['columns'] = calc_bootstrap_columns( get_mental_option( 'blog_masonry_columns' ) );
?>

<div class="<?php if ( $atts['type'] == 'masonry' ) { echo 'row'; } ?> blog-list isotope-blog <?php echo 'blog-' . esc_attr($atts['type']); ?>" data-type="<?php echo esc_attr($atts['type']); ?>">

	<?php if ( have_posts() ): while( have_posts() ) : the_post(); ?>

		<?php mental_blog_item($atts); ?>

	<?php endwhile ?>
	<?php else: ?>

		<h2><?php _e( 'Sorry, nothing to display.', 'mental' ); ?></h2>

	<?php endif; ?>

</div>
