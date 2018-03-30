<?php 
/**
* Main Carousel Template.
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

$posts_number    = ( van_get_option("carousel_number" ) and is_numeric( van_get_option("carousel_number") ) ) ? van_get_option("carousel_number") : 6;
$orderby 	         = van_get_option("carousel_by") ? van_get_option("carousel_by") : "date";
$category 	         = van_get_option("carousel_cats");
$meta_key		= "";

if ( $orderby == "views" ) {

	$meta_key = "van_post_view_count";
	$orderby   = "meta_value_num";

}elseif ( $orderby == "likes" ) {

	$meta_key = "van_votes_count";
	$orderby   = "meta_value_num";

}

$args = array( 'meta_key'=> $meta_key,
		     'orderby' => $orderby, 
		     'posts_per_page' => $posts_number );

if ( $category ) {
	$args['cat'] = $category;
}

$carousel_query = new WP_Query( $args );
?>

<?php if ( $carousel_query->have_posts() ): ?>

	<section id="main-carousel" class="before-load">

		<div id="carousel-items">
		
			<ul class="slides">
				
				<?php while ( $carousel_query->have_posts() ) : $carousel_query->the_post(); ?>
				
					<li class="item">

						<article class="content box-entry">

							<div class="entry-media <?php echo get_post_format(); ?>-format">

								<a href="<?php the_permalink(); ?>">
									<?php van_thumb( 300 , 190); ?>
									<div class="thumb-overlay"></div>
								</a>
								<?php if ( !van_get_option("hide_carousel_format") ): ?>
									<span class="post-format-icon"></span>
								<?php endif; ?>

							</div><!-- .entry-media -->

							<div class="entry-container">

								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'van' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h4><!-- .entry-title -->

								<?php if ( !van_get_option("hide_carousel_meta") ): ?>

									<div class="entry-meta">

										<?php if ( $orderby == 'date' ): ?>
										<span class="icon-clock icon"></span> <?php the_time(get_option('date_format'));  ?>
										<?php elseif ( $orderby == 'comment_count' ): ?>
										<span class="icon-chat icon"></span> <?php comments_popup_link( __( 'No Comment', 'van' ), __( '1 Comment', 'van' ), __( '% Comments', 'van' ) ); ?>
										<?php elseif ( $orderby == 'rand' ): ?>
										<span class="icon-clock icon"></span> <?php the_time(get_option('date_format'));  ?> <i class="divider">/</i>
										<span class="icon-chat icon"></span> <?php comments_popup_link( __( 'No Comment', 'van' ), __( '1 Comment', 'van' ), __( '% Comments', 'van' ) ); ?>
										<?php elseif ( $orderby == 'meta_value_num' && $meta_key == 'van_post_view_count'): ?>
										<span class="icon-eye icon"></span> <?php echo van_numbers_sin( van_post_view(), __(" View", "van"), __(" Views", "van") ); ?>
										<?php elseif ( $orderby == 'meta_value_num' && $meta_key == 'van_votes_count'): ?>
										<span class="icon-heart icon"></span> <?php echo van_numbers_sin( van_votes_count( get_the_ID() ), __(" Like", "van"),  __(" Likes", "van") ); ?>
										<?php endif; ?>

									</div><!-- .entry-meta -->

								<?php endif; ?>

							</div>

						</article>
					</li>

				<?php endwhile; ?>

			</ul>

		</div><!-- #carousel-items -->

		<script type="text/javascript">
			jQuery(document).ready(function($) {
			 
				$("#main-carousel #carousel-items").flexslider({
					    animation: "slide",
					    animationLoop: false,
					    controlNav: false,
					    itemWidth: 300,
					    itemMargin: 20,
					    start: function(){
					    	$("#main-carousel").removeClass("before-load");
					    }
				});
				$(window).smartresize(function() {
					var $fnCarousel = $('#main-carousel #carousel-items').data('flexslider');
					$fnCarousel.flexAnimate(0);
				});
			});
		</script>

	</section><!-- #main-carousel -->

<?php endif; ?>
<?php wp_reset_query(); ?>