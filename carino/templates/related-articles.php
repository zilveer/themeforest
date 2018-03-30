<?php 
/**
* Related Posts Template. 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

$related_number = ( van_get_option("related_number" ) and is_numeric( van_get_option("related_number") ) ) ? van_get_option("related_number") : 3;
$related_by 	= van_get_option("related_by");
$tags 		= wp_get_post_tags($post->ID);
$categories 	= get_the_category($post->ID);

if ( $related_by == "tag" && $tags) {

	$tag_ids = array();
	foreach($tags as $individual_tag) {
		$tag_ids[] = $individual_tag->term_id;
	}
	$args = array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>$related_number);

} elseif ( $related_by == "category" && $categories) {

	$category_ids = array();

	foreach( $categories as $individual_category ) {
		$category_ids[] = $individual_category->term_id;
	}

	$args = array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> $related_number);

} else {
	$args = array(
		'author'=> get_the_author_meta( 'ID' ),
		'post__not_in' => array($post->ID),
		'posts_per_page'=> $related_number);
}

$related_query = new wp_query($args);

?>
<?php if ( $related_query->have_posts() ) : ?>

	<div class="related-articles row clearfix before-load">

		<h3 class="row-title"><?php _e("Related Articles","van"); ?></h3>

		<div id="carousel-items">

			<ul class="slides">
				<?php while ( $related_query->have_posts() ): $related_query->the_post(); ?>
					<li class="item">
						<article class="content box-entry">

							<?php  if( has_post_thumbnail() && '' != get_the_post_thumbnail() ) : ?>
								<div class="entry-media <?php echo get_post_format(); ?>-format">

									<a href="<?php the_permalink(); ?>">
										<?php van_thumb(300,190); ?>
										<div class="thumb-overlay"></div>
									</a>
									<span class="post-format-icon"></span>

								</div><!-- .entry-media -->
							<?php  endif; ?>

							<div class="entry-container">

								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'van' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h4><!-- .entry-title -->

							</div>

						</article>
					</li>
				<?php endwhile; ?>
			</ul>

		</div><!-- #carousel-items -->

		<script type="text/javascript">
			jQuery(document).ready(function($) {
			 
				$(".related-articles #carousel-items").flexslider({
					    animation: "slide",
					    animationLoop: false,
					    controlNav: false,
					    itemWidth: 300,
					    itemMargin: 20,
					    start: function(){
					    	$(".related-articles").removeClass("before-load");
					    }
				});
				$(window).smartresize(function() {
					var $fnRelated = $('.related-articles #carousel-items').data('flexslider');
					$fnRelated.flexAnimate(0);
				});
			});
		</script>

	</div><!-- .related-articles -->
<?php endif; ?>
<?php wp_reset_query(); ?>