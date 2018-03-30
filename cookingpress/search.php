<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package CookingPress
 */


get_header();
$thumbstyle = ot_get_option('pp_blog_style','grid');
$bloglayout = ot_get_option('pp_blog_layout','left-sidebar');
 switch ($bloglayout) {
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

	<?php get_template_part( 'searchformadv' ) ?>
	<header class="page-header">
		<h1 class="page-title"><span><?php _e( 'Search Results', 'cookingpress' ); ?></span></h1>
	</header><!-- .page-header -->
	<?php if ( have_posts() ) : ?>
		<div class="<?php echo $thumbstyle; ?>" >
			<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<?php 	$format = get_post_format();
				$formatslist = array('status','aside','quote','audio','chat','link');
				if( false === $format  )  $format = 'standard';
				if (in_array($format, $formatslist))  $format = 'standard';

				if($thumbstyle == 'full') {
					get_template_part( 'postformats/'.$format , 'full' );
				} else if($thumbstyle == 'excerpt') {
					get_template_part( 'postformats/'.$format , 'excerpt' );
				} else {
					get_template_part( 'postformats/'.$format );
				} ?>

				<?php endwhile; ?>
		</div>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>

	<?php endif; ?>


<?php cookingpress_content_nav( 'nav-below' ); ?>


</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>