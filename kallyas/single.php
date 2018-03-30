<?php if(! defined('ABSPATH')){ return; }
/**
 * Template layout for single entries
 * @package  Kallyas
 * @author   Team Hogash
 */
get_header();

$args = array();
$override_page_title = zget_option( 'zn_override_single_title', 'blog_options' );
if( 'yes' === $override_page_title ){
	$args['title'] = zget_option( 'single_page_title', 'blog_options' );
}

/*** USE THE NEW HEADER FUNCTION **/
WpkPageHelper::zn_get_subheader( $args );


// Check to see if the page has a sidebar or not
$main_class = zn_get_sidebar_class('single_sidebar');
if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-8 col-md-9' : 'col-sm-12';

?>

	<section id="content" class="site-content">
		<div class="container">
			<div class="row">

				<!--// Main Content: page content from WP_EDITOR along with the appropriate sidebar if one specified. -->
				<div class="<?php echo $main_class;?>" <?php echo WpkPageHelper::zn_schema_markup('main'); ?>>
					<div id="th-content-post">
						<?php
						while ( have_posts() ) : the_post();
							get_template_part( 'inc/page', 'content-view-post.inc' );
						endwhile;

						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>
					</div><!--// #th-content-post -->
				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</section><!--// #content -->
<?php
get_footer();
