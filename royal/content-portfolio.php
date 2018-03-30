<?php 
$postId = get_the_ID();

$categories = wp_get_post_terms($postId, 'portfolio_category');
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
		$span = 'col-md-6';
	break;
	case 3:
		$span = 'col-md-4';
	break;
	case 4:
		$span = 'col-md-3';
	break;
	default:
		$span = 'col-md-4';
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
					<div class="zoom">
						<div class="btn_group">
							<?php if($lightbox): ?><a href="<?php echo etheme_get_image(get_post_thumbnail_id($postId)); ?>" class="btn btn-black xmedium-btn" rel="lightbox"><span><?php _e('View large', ETHEME_DOMAIN); ?></span></a><?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="btn btn-black xmedium-btn"><span><?php _e('More details', ETHEME_DOMAIN); ?></span></a>
						</div>
						<i class="bg"></i>
					</div>
		    </div>
		<?php endif; ?>
	    <div class="portfolio-descr">
	    		<?php if(etheme_get_option('project_byline')): ?>
					<span class="posted-in"><?php print_item_cats($postId); ?></span> 
			    <?php endif; ?>
			    
	    		<?php if(etheme_get_option('project_name')): ?>
			    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			    <?php endif; ?>

    		<?php if(etheme_get_option('project_excerpt')): ?>
				<?php the_excerpt(); ?>
		    <?php endif; ?>

	    </div>    
</div>