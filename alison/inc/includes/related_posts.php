<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

$orig_post = $post;
global $post;

$tags = get_the_tags($post->ID);

if ($tags) {

	$tag_ids = array();

	foreach($tags as $individual_tags) $tag_ids[] = $individual_tags->term_id;
	
	$args = array(
		'tag__in'     => $tag_ids,
		'post__not_in'     => array($post->ID),
		'posts_per_page'   => 3, // Number of related posts that will be shown.
		'ignore_sticky_posts' => 1,
		'orderby' => 'rand'
	);

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
		<div class="related-posts"><div class="box-title-area"><h4 class="title"><?php _e('You Might Also Like', 'alison'); ?></h4></div>
		<div class="related-posts-inner clearfix"><?php while( $my_query->have_posts() ) { $my_query->the_post();?><div class="item">
					
					<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail('thumbnail-grid'); ?></a>
					<?php else: ?>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/thumb-placeholder.png" alt="" />
					<?php endif; ?>

					
					<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
					<span class="date"><?php the_time( get_option('date_format') ); ?></span>
					
				</div><?php }?>
		</div>
		</div>
<?php   }
}
$post = $orig_post;
wp_reset_postdata();

?>