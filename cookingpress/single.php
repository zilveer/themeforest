<?php
/**
 * The Template for displaying all single posts.
 *
 * @package CookingPress
 */

get_header();
$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
 switch ($layout) {
	case 'full-width':
		$classes = 'col-md-12 ';
		break;

	case 'left-sidebar':
		$classes = 'col-md-8 col-md-push-3 col-md-offset-1';
		break;

	case 'right-sidebar':
		$classes = 'col-md-8';
		break;

	default:
		$classes = 'col-md-8 col-md-push-3 col-md-offset-1';
		break;
}
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $layout=='left-sidebar' ) { $classes = 'col-md-9 col-md-push-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $layout=='right-sidebar' ) { $classes = 'col-md-9'; }
?>

<div id="primary" class="<?php echo $classes; ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php cookingpress_content_nav( 'nav-below' ); ?>

			<?php
					// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php if($layout != 'full-width')  { get_sidebar(); } ?>
<?php get_footer(); ?>