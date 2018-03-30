<?php if ( has_post_thumbnail() ) { ?>
<?php $id = get_the_ID(); ?>
<?php
	$vars = $wp_query->query_vars;
	$masonry = array_key_exists('masonry', $vars) ? $vars['masonry'] : false;
	$grid = array_key_exists('grid', $vars) ? $vars['grid'] : false;
?>
<figure class="post-gallery">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php
			if ($masonry) {
				the_post_thumbnail('north-blog-masonry'); 
			} else if ($grid) {
				the_post_thumbnail('north-blog-grid');  
			} else {
				the_post_thumbnail('north-blog-post');  
			}
		?>
	</a>
</figure>
<?php } ?>