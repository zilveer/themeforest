<?php
/**
 * The Template Part for displaying "Related Posts" box.
 *
 * @package BTP_Flare_Theme
 */
?>
<?php 
global $post;

$related_ids = btp_relations_get_related_ids( $post->ID, 'post', 3 );
if ( !count( $related_ids ) ) {
	return;
}	 
		
$query_args = array(
	'post_type'				=> 'post',
  	'post__in'				=> $related_ids,
  	'orderby'				=> 'none',
  	'ignore_sticky_posts'	=> true,
);					
	
btp_loop_before();

$query = new WP_Query($query_args);	
		
if ( $query->have_posts() ) {
	?>
	<div class="related-entries related-posts">
		<h3><?php _e( 'Related Posts', 'btp_theme' ); ?></h3>
		
		<?php	
		btp_part_set_vars(array(
			'query'				=> $query,
			'elems' 			=> array(
				'title'					=> true,
				'featured_media'		=> true,
				'date'					=> false,
				'author'				=> false,
				'comments_link'			=> false,
				'summary'				=> false,
				'categories'			=> false,
				'tags'					=> false,
				'button_1'				=> false,
			),
			'lightbox_group'	=> 'related_posts_lightbox',
		));
		
		get_template_part( '/lib/posts/templates/collection', 'one_fourth' );
		?>
	</div>
	<?php	
}

btp_loop_after();
?>