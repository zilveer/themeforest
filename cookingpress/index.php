<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout =='left-sidebar' ) { $classes = 'col-md-9 col-md-push-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout == 'right-sidebar' ) { $classes = 'col-md-9 '; }
?>
<div id="primary" class="<?php echo $classes; ?>">
	<div class="<?php echo $thumbstyle; ?>" >
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post();
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$format = get_post_format();
			            $formatslist = array('status','aside', 'audio','chat','image','link');

			            if( false === $format  )  $format = 'standard';

			            if (in_array($format, $formatslist))  $format = 'standard';

			            if($thumbstyle == 'full') {
			               get_template_part( 'postformats/'.$format , 'full' );
			            } else if($thumbstyle == 'excerpt') {
			                get_template_part( 'postformats/'.$format , 'excerpt' );
			            } else {
			            	get_template_part( 'postformats/'.$format );
			            }
				endwhile;
			else :
				get_template_part( 'no-results', 'index' ); ?>
		<?php endif; ?>
	</div>
	<?php if(function_exists('wp_pagenavi')) {
                wp_pagenavi();
            } else {
            	cookingpress_content_nav( 'nav-below' );
            }
    ?>



</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>