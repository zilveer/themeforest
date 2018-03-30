<?php 
/**
 * Template Name: Homepage + Sidebar
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
    global $ft_option;
    global $main_classes;
    global $sidebar_classes;
    global $fave_container;
	global $fave_sidebar;

	get_header();

	$stick_sidebar = '';
	if( $ft_option['sticky_sidebar'] != 0 ) {
		$stick_sidebar = 'magzilla_sticky';
	}

	$fave_meta = get_post_meta( get_the_ID(), '_favethemes_meta', true );

	$fave_sidebar = $fave_meta['fave_sidebar'];
 
	if( $fave_meta['fave_use_sidebar'] == "right") {
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

	} elseif ( $fave_meta['fave_use_sidebar'] == "left" ) {
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

	} else {
		$main_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	}
?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		
		<div class="<?php echo $main_classes; ?>">
			
			<?php while( have_posts()): the_post(); ?>

				<?php the_content(); ?>
	        
	        <?php endwhile; ?>
			
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

		<?php if( $fave_meta['fave_use_sidebar'] != "none" ) { ?>
		<div class="<?php echo $sidebar_classes.' '.$stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		<?php } ?>

	</div><!-- .row -->
</div>

<?php get_footer(); ?>