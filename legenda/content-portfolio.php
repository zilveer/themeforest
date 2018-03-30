<?php 
$postId = get_the_ID();

$categories = wp_get_post_terms($postId, 'categories');
$catsClass = '';
foreach($categories as $category) {
	$catsClass .= ' sort-'.$category->slug;
}

$columns = etheme_get_option('portfolio_columns');
$lightbox = etheme_get_option('portfolio_lightbox');


if(isset($_GET['col'])) {
	$columns = $_GET['col'];
}

switch($columns) {
	case 2:
		$span = 'span6';
	break;
	case 3:
		$span = 'span4';
	break;
	case 4:
		$span = 'span3';
	break;
	default:
		$span = 'span4';
	break;
}
	
	$width = etheme_get_option('portfolio_image_width');
	$height = etheme_get_option('portfolio_image_height');
	$crop = etheme_get_option('portfolio_image_cropping');

?>
<div class="portfolio-item columns-count-<?php echo $columns; ?> <?php echo $span; ?> <?php echo $catsClass; ?>">       
		<?php if (has_post_thumbnail( $postId ) ): ?>
			<div class="portfolio-image">
					<?php $imgSrc = etheme_get_image(get_post_thumbnail_id($postId), $width, $height, $crop) ?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo $imgSrc; ?>" alt="<?php the_title(); ?>"></a>
					<div class="portfolio-mask">
						<div class="mask-content">
							<?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" rel="lightbox"><i class="icon-resize-full"></i></a><?php endif; ?>
							<a href="<?php the_permalink(); ?>"><i class="icon-link"></i></a>
						</div>
					</div>
		    </div>
		<?php endif; ?>
	    <div class="portfolio-descr">
	    		<?php if(etheme_get_option('project_name')): ?>
			    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			    <?php endif; ?>
			    
	    		<?php if(etheme_get_option('project_byline')): ?>
					<div class="post-info">
						<span class="posted-on">
							<?php _e('Posted on', ETHEME_DOMAIN) ?>
							<?php the_time(get_option('date_format')); ?> 
							<?php _e('at', ETHEME_DOMAIN) ?> 
							<?php the_time(get_option('time_format')); ?>
						</span> 
						<span class="posted-by"> <?php _e('by', ETHEME_DOMAIN);?> <?php the_author_posts_link(); ?></span> / 
						<span class="posted-in"><?php print_item_cats($postId); ?></span> 
					</div>
			    <?php endif; ?>

    		<?php if(etheme_get_option('project_excerpt')): ?>
				<?php the_excerpt(); ?>
		    <?php endif; ?>

	    </div>    
</div>