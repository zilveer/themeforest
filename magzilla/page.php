<?php 
/**
 * The template for displaying all pages
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
global $ft_option;
global $fave_sidebar;
global $stick_sidebar;
global $sidebar_use;
global $main_classes;
global $sidebar_classes;
global $fave_container;

get_header();

	if( $ft_option['sticky_sidebar'] != 0 ) {
		$stick_sidebar = 'magzilla_sticky';
	}
	$fave_meta = get_post_meta( get_the_ID(), '_favethemes_meta', true );
 	
 	if( $fave_meta ) {

	    $fave_sidebar = $fave_meta['fave_sidebar'];
	    $fave_sticky_sidebar = $fave_meta['sticky_sidebar'];
		$sidebar_use = $fave_meta['fave_use_sidebar'];

		if( $sidebar_use == "right") {
			$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
			$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

		} elseif ( $sidebar_use == "left" ) {
			$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
			$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

		} else {
			$main_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
		}
	
	} else {

	    $fave_sidebar = 'page-sidebar';
	    $fave_sticky_sidebar = '';
		$sidebar_use = 'right';
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
	}
?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
	</div><!-- row -->

	<div class="row">
		<div class="<?php echo $main_classes; ?>">
			<main class="site-main" role="main">
				<div class="entry-content">
					<?php if( have_posts() ): while( have_posts() ): the_post();

                        the_content();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;
					endwhile; endif;?>
				</div><!-- entry-content -->
			</main><!-- site-main -->
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

		<?php if( $sidebar_use != "none" ) { ?>
		<div class="<?php echo $sidebar_classes.' '.$stick_sidebar;?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		<?php } ?>

	</div><!-- .row -->

</div>

<?php get_footer(); ?>