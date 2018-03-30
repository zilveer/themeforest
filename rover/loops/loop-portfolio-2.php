<?php
/**
 * Portfolio Loop 2
 * @package by Theme Record
 * @auther: MattMao
 */

global $tr_config, $post;

$column = $tr_config['portfolio_column'];
$show_title = $tr_config['enable_portfolio_title'];
$show_skills = $tr_config['enable_portfolio_skills'];
?>

<div class="portfolio-list portfolio-sortable-list">
<ul class="portfolio-sortable-grid clearfix">
<?php
	switch($column)
	{
		case 2: $col = 'col-2-1'; $size = 'column-2'; break;
		case 3: $col = 'col-3-1'; $size = 'column-3'; break;
		case 4: $col = 'col-4-1'; $size = 'column-4'; break;
	}

	$loop_count = 0;

	while (have_posts()) : the_post();
	$title = get_the_title();
	$loop_count ++;

	//Get the classes
	$terms = get_the_terms( $post->ID, 'portfolio-category' );

	if ($terms && ! is_wp_error($terms)) 
	{
		$terms_array = array();
		foreach ( $terms as $term ) 
		{
			$terms_array[] = $term->slug;
		}
		$sort_classes = join( ' ', $terms_array );
	}

	//Get icon
	$media_type = get_meta_option('portfolio_type');
	switch($media_type)
	{
		case 'image': $icon = 'item-image'; break;
		case 'slideshow': $icon = 'item-gallery'; break;
		case 'video': $icon = 'item-video'; break;
	}

	//Get item class
	$item_class = 'class="item post-item '.$icon.' '.$col.' '.$sort_classes.'"';
?>
	<li <?php echo $item_class; ?> data-id="post-<?php echo $loop_count; ?>">
	<?php if(has_post_thumbnail()) : ?>
	<div class="post-thumb post-thumb-hover post-thumb-preload">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="loader-icon">
	<?php echo get_featured_image($post_id=NULL, $size, 'wp-preload-image', $title); ?>
	</a>
	</div>
	<?php endif; ?>
	<?php if($show_title == true): ?><h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1><?php endif; ?>
	<?php if($show_skills == true): ?><?php echo get_the_term_list( $post->ID, 'portfolio-category', '<div class="cats meta">', ', ', '</div>' ); ?><?php endif; ?>
	</li>
<?php endwhile; ?>
</ul>
</div>