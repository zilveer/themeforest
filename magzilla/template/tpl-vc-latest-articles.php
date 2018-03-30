<?php 
/**
 * Template Name: Homepage + Article Lists
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/
global $fave_container;
global $posts_excerpt;
global $pagination_type;
global $fave_sidebar_position;
global $module;
global $custom_title;
global $main_classes;
global $sidebar_classes;
global $fave_container;
global $ft_option;
global $fave_sidebar;
global $header_color;
global $header_text_color;
global $header_border_color;

get_header();

$stick_sidebar = '';
if( $ft_option['sticky_sidebar'] != 0 ) {
	$stick_sidebar = 'magzilla_sticky';
}

$fave_meta = get_post_meta( get_the_ID(), '_favethemes_meta', true );

if( $fave_meta ) {

	$posts_excerpt = $fave_meta['posts_excerpt'];
	$pagination_type = $fave_meta['pagination_style'];

	$fave_sidebar_position = $fave_meta['fave_article_list_use_sidebar'];
	$fave_sidebar = $fave_meta['fave_article_list_sidebar'];
	$header_color = $fave_meta['title_bg_color'];
	$header_text_color = $fave_meta['title_text_color'];
	$header_border_color = $fave_meta['title_border_color'];

	$blog_title = $fave_meta['blog_title'];

	$module = $fave_meta['articles_layout'];
	if( $module == 'module-default') {
		$module = 'module-a';
	}

	$custom_title = $fave_meta['custom_title'];
	if( empty( $custom_title ) ) {
		$custom_title = __( 'Latest Posts', 'magzilla' );
	}

	if( $fave_sidebar_position == "right") {
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

	} elseif ( $fave_sidebar_position == "left" ) {
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

	} else {
		$main_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	}

} else {
	$pagination_type = 'numeric';
	$module = 'module-a';
	$custom_title = __( 'Latest Posts', 'magzilla' );
	$fave_sidebar_position = 'right';
	$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
	$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
	$blog_title = 'show-title';
	$fave_sidebar = 'default-sidebar';
	$fave_sidebar = '';
	$header_color = '';
	$header_text_color = '';
	$header_border_color = '';
}

//custom colors
$block_header_color_css = '';
$block_header_border_color_css = '';
$block_header_text_color_css = '';


if (!empty($header_text_color) and $header_text_color != '#') {
	$block_header_text_color_css = ' color:' . $header_text_color . ' !important;';
}

if (!empty($header_color) and $header_color != '#') {
	$block_header_color_css = ' background-color:' . $header_color . ';';
}

if (!empty($header_border_color) and $header_border_color != '#') {
	$block_header_border_color_css = ' border-top: 5px solid ' . $header_border_color . ';';
}

//append to the color_css the border color
if (!empty($block_header_border_color_css)) {
	$block_header_color_css .= $block_header_border_color_css;
}

//append to the color_css the text color
if (!empty($block_header_text_color_css)) {
	$block_header_color_css .= $block_header_text_color_css;
}

//wrap the header css
if (!empty($block_header_color_css)) {
	$block_header_color_css = 'style="' . $block_header_color_css . '" ';
}
//end custom colors

// Pagination
if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');

} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');

} else {
    $paged = 1;
}

?>

<?php if (empty($paged) or $paged < 2) { ?>
<div class="<?php echo $fave_container; ?>">
	<div class="row">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<?php while( have_posts()): the_post(); ?>

				<?php the_content(); ?>
	        
	        <?php endwhile; ?>
			
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

	</div><!-- .row -->
</div>
<?php } ?>

<div class="<?php echo $fave_container; ?>">
	

	<div class="row">
		
		<div class="<?php echo $main_classes; ?> magzilla-home-articlelist main-box-for-load-more">
			
			<?php if( (empty($paged) or $paged < 2) && $blog_title != 'hide-title' ): ?>
			<div class="module-top clearfix">
				<div class="module-category pull-left">
					<a <?php echo $block_header_color_css; ?>><?php echo $custom_title; ?></a>
				</div>
			</div>
			<?php endif; ?>

			<?php query_posts(fave_data_source::metabox_to_args($fave_meta, $paged)); ?>

			<?php get_template_part( 'modules/'.$module ); ?>

			<?php if( !empty($pagination_type) ): ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php get_template_part( 'inc/pagination/'.$pagination_type ); ?>
				</div>
			</div>
			<?php endif; ?>
			
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

		<?php if( $fave_sidebar_position != "none" ) { ?>
		<div class="<?php echo $sidebar_classes.' '.$stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		<?php } ?>

	</div><!-- .row -->
</div>

<?php get_footer(); ?>