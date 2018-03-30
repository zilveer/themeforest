<?php
/**
 * Monarch Related Posts
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

$orig_post = $post;

global $post;

$categories = get_the_category($post->ID);

if ($categories) {
	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

	$args = array(
		'category__in'        => $category_ids,
		'post__not_in'        => array($post->ID),
		'posts_per_page'      => 2,
		'ignore_sticky_posts' => 1,
		'orderby'             => 'rand'
	);

	$my_query = new wp_query( $args );

	if( $my_query->have_posts() ) { ?>
		<div class="relatedposts clearfix ShowOnScroll">
		<div class="row">
		<?php while( $my_query->have_posts() ) {
			$my_query->the_post();?>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-bg-6">
			<div class="relatedpost">
				<div class="image">
					<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail(); ?></a>
					<?php else : ?>
					<a href="<?php echo get_permalink() ?>" rel="bookmark"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/css/img/noimage.jpg" alt=""></a>
					<?php endif; ?>
				</div>
				<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
				<span class="date"><?php the_time( get_option('date_format') ); ?></span>
			</div>
		</div>
<?php
	}
		echo '</div></div>';
	}
}

$post = $orig_post;
wp_reset_query();
	
?>