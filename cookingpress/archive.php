<?php
/**
 * The template for displaying Archive pages.
 *
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
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout == 'left-sidebar' ) { $classes = 'col-md-9 col-md-push-3'; }
if(get_theme_mod( 'cp_layout_style', 'default' ) == 'boxed' && $bloglayout == 'right-sidebar' ) { $classes = 'col-md-9'; }
?>
<div id="primary" class="<?php echo $classes; ?>">
	<header class="page-header">
				<h1 class="page-title">
					<span><?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author: %s', 'cookingpress' ), '<span class="vcard">' . get_the_author() . '</span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'cookingpress' ),  get_the_date()  );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'cookingpress' ),  get_the_date( 'F Y' )  );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'cookingpress' ),  get_the_date( 'Y' ) );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'cookingpress' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'cookingpress');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'cookingpress' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'cookingpress' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'cookingpress' );

						else :
							_e( 'Archives', 'cookingpress' );

						endif;
					?> </span>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
	<div class="<?php echo $thumbstyle; ?>" >
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post();
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						$format = get_post_format();
			            $formatslist = array('status','aside','quote','audio','chat','link');
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





