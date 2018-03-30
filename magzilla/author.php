<?php 
/**
 * Author template. Display the author 
 * info and all posts by the author
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 

global $ft_option;
global $module;
global $pagination_type;
global $fave_sidebar;
global $fave_sidebar_position;
global $posts_excerpt;
global $fave_container;
global $main_classes;
global $sidebar_classes;
global $curauth;
global $stick_sidebar;

get_header();

$curauth = get_query_var( 'author_name' ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );

if( $ft_option['sticky_sidebar'] != 0 ) {
	$stick_sidebar = 'magzilla_sticky';
}

$module = 'a-b';
$pagination_type = 'numeric';
$fave_sidebar = 'author-sidebar';
$fave_sidebar_position = 'right';

$posts_excerpt = "enable";


if( $fave_sidebar_position == "right") {
	$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
	$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

} elseif ( $fave_sidebar_position == "left" ) {
	$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
	$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

} else {
	$main_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
}

?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		
		<div class="<?php echo $main_classes; ?> main-box-for-load-more">
			<main class="site-main" role="main">
				<div class="archive author-archive">
					<?php get_template_part( 'inc/post-author-for-archive' ); ?>
					
					<div class="module-top clearfix">
						<h1 class="module-title"><?php _e( 'Post by', 'magzilla' ); ?> <?php echo $curauth->display_name; ?>   </h1>
					</div><!-- module-top -->
					
					<!-- ==== start all post ==== -->
					
					<?php get_template_part( 'modules/module', $module ); ?>

					<?php if( !empty($pagination_type) ): ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php get_template_part( 'inc/pagination/'.$pagination_type ); ?>
						</div>
					</div>
					<?php endif; ?>
	
					
				</div><!-- archive post-archive -->
			</main><!-- site-main -->
		</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->

		<?php if( $fave_sidebar_position != "none" ) { ?>
		<div class="<?php echo $sidebar_classes.' '.$stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		<?php } ?>

	</div><!-- .row -->
</div>

<?php get_footer(); ?>
