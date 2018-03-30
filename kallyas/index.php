<?php if(! defined('ABSPATH')){ return; }
/**
 * Template layout for ARCHIVES
 * @package  Kallyas
 * @author   Team Hogash
 */
get_header();

/*** USE THE NEW HEADER FUNCTION **/
	// Saved title in options
	$title = zget_option( 'archive_page_title', 'blog_options' );
	$subtitle = zget_option( 'archive_page_subtitle', 'blog_options' );
	if( empty( $title ) ){
		//** Put the header with title and breadcrumb
		$title = __( 'Blog', 'zn_framework' );
	}

	if ( is_home() && $blog_page_id = get_option( 'page_for_posts' ) ){
		$title = get_the_title( $blog_page_id );
	}
	WpkPageHelper::zn_get_subheader( array( 'title' => $title, 'subtitle' => $subtitle ) );

	// Check to see if the page has a sidebar or not
	$main_class = zn_get_sidebar_class('blog_sidebar');
	if( strpos( $main_class , 'right_sidebar' ) !== false || strpos( $main_class , 'left_sidebar' ) !== false ) { $zn_config['sidebar'] = true; } else { $zn_config['sidebar'] = false; }
	$zn_config['size'] = $zn_config['sidebar'] ? 'col-sm-8 col-md-9' : 'col-sm-12';
?>
	<section id="content" class="site-content" >
		<div class="container">
			<div class="row">

				<div id="mainbody" class="<?php echo $main_class;?>">
					<?php

					$columns = zget_option( 'blog_style_layout', 'blog_options', false, '1' );
					$blog_layout = $columns > 1 ? 'cols' : 'def_classic';
					$blog_layout = zget_option( 'blog_layout', 'blog_options', false, $blog_layout );

					if ( $blog_layout == 'cols' ) {
						get_template_part( 'blog', 'columns' );
					}
					elseif ( $blog_layout == 'def_classic' || $blog_layout == 'def_modern' ) {
						get_template_part( 'blog', 'default' );
					}
					?>
				</div><!--// #mainbody -->
				<?php get_sidebar(); ?>
			</div><!--// .row -->
		</div><!--// .container -->
	</section><!-- end content -->
<?php get_footer();