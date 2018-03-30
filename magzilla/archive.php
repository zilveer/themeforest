<?php
/**
 * The archive page
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/

get_header();

global $ft_option;
global $pagination_type;
global $fave_sidebar;
global $stick_sidebar;
global $fave_sidebar_position;
global $posts_excerpt;
global $main_classes;
global $sidebar_classes;
global $fave_container;

$module = $ft_option['archives_template'];

if( empty( $module )) {
	$module = 'module-a-b';
}

if( $ft_option['sticky_sidebar'] != 0 ) {
	$stick_sidebar = 'magzilla_sticky';
}

$pagination_type = $ft_option['archives_pagination_style'];
$fave_sidebar = $ft_option['archives_custom_sidebar'];
$fave_sidebar_position = $ft_option['archives_sidebar_position'];
$posts_excerpt = $ft_option['archives_post_excerpt'];


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
			
			
			<div class="module-top clearfix">
				<div class="module-category pull-left">
					<a>
					<?php if(is_tag()) { ?>
                    <?php single_tag_title(); ?>
                    
                    <?php } elseif (is_day()) { ?>
                    <?php printf( __( '%s', 'magzilla' ), get_the_date() ); ?>
                    
                    
                    <?php } elseif (is_month()) { ?>
                    <?php printf( __( '%s', 'magzilla' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'magzilla' ) ) ); ?>
                    
                    <?php } elseif (is_year()) { ?>
                    <?php printf( __( '%s', 'magzilla' ), get_the_date( _x( 'Y', 'yearly archives date format', 'magzilla' ) ) ); ?>
                    
                    <?php } elseif ( get_post_format() ) { ?>
                    <?php echo get_post_format(); ?>
                   
                    
                    <?php } ?>
                	</a>
				</div>
			</div>
			

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
		<div class="<?php echo $sidebar_classes.' '.$stick_sidebar;?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		<?php } ?>

	</div><!-- .row -->
</div>

<?php get_footer(); ?>
