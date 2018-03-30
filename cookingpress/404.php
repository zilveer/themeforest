<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package CookingPress
 */

get_header();
$layout  = ot_get_option('pp_blog_layout','left-sidebar'); ?>
<?php switch ($layout) {
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
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout=='left-sidebar' ) { $classes = 'col-md-9 col-md-push-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout=='right-sidebar' ) { $classes = 'col-md-9'; }
?>

<div id="primary" class="<?php echo $classes; ?>">
	<main id="main" class="site-main" role="main">
		<article <?php post_class(); ?>>
			<header class="entry-header">

				<h2 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'cookingpress' ); ?></h2>
			</header><!-- .entry-header -->
			<div class="entry-content">


				<h1 class="page-title"></h1>

				<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links in sidebar or a search?', 'cookingpress' ); ?></p>

				<?php get_template_part( 'searchformadv' ) ?>




		</div><!-- .entry-content -->
	</article><!-- #post-## -->
</main><!-- #main -->
</div><!-- #primary -->

<?php if($layout != 'full-width')  { get_sidebar(); } ?>
<?php get_footer(); ?>


