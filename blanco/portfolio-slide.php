<?php 
$postId = get_the_ID();

$categories = wp_get_post_terms($postId, 'categories');
$catsClass = '';
foreach($categories as $category) {
	$catsClass .= ' sort-'.$category->slug;
}

$columns = etheme_get_option('portfolio_columns');


?>
<div class="portfolio-item <?php echo $catsClass; ?>">        
	<div class="portfolio-image">
		<?php if (has_post_thumbnail( $postId ) ): ?>
			<?php $image = etheme_get_image(false,220,220); ?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>" /></a>	
		<?php endif; ?>
        <div class="portfolio-mask"></div>
        <div class="portfolio-descr">
	        
	        <h3><?php the_title(); ?><h3>
	        
			<?php if (has_post_thumbnail( $postId ) ): ?>
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
			
				<?php if(etheme_get_option('port_use_lightbox')): ?><a class="button small btn-icon btn-enlarge" rel="lightbox[portfolio]" href="<?php echo $url; ?>"><i class="icon-fullscreen"></i></a><?php endif; ?>
			<?php endif; ?>
        	<a class="button small active btn-icon btn-link" href="<?php the_permalink($postId); ?>"><i class="icon-link"></i></a>
	        
        </div>
    </div>
</div>