<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Events - Past
*/

get_header('sidebar');

global $post;
$title = $post->post_title;

?>

<h2><?php echo $title; ?></h2>

<div id="events">
	<div>

    <?php get_sidebar('events'); ?>
	
    <!-- INNER content -->
    <div id="inner">   

	<?php
	
	$timezone = get_option('timezone_string');

	date_default_timezone_set(get_option('timezone_string'));
	
	$todayArray = getdate();
	$today = $todayArray['year'] . '-';
	$today .= str_pad($todayArray['mon'], 2, 0, STR_PAD_LEFT) . '-';
	$today .= str_pad($todayArray['mday'], 2, 0, STR_PAD_LEFT);
	
	$args = array();
	
	$args['post_type'] = 'event';
	$args['post_status'] = 'publish';
	$args['order'] = 'DESC';
	$args['orderby'] = 'meta_value';
	$args['meta_key'] = '_start_date';
	$args['meta_query'] = array(
		array(
			'key'		=> '_start_date',
			'value'		=> $today,
			'compare'	=> '<'
		)
	);

	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	$args['paged'] = $paged; 
	
	$tbQuery = new WP_Query($args);
	
	?>

    <?php if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
	
		<?php $postID = get_the_ID(); $permalink = get_permalink($postID); $postTitle = get_the_title(); ?>

		<?php
		$postMeta = get_post_custom($postID);
		$startDate = $postMeta['_start_date'][0];
		$startDateArray = tb_get_date($startDate);
		?>

	
        <div class="eventHolder">
			<div class="eventFrame">
				<div>
				<a href="<?php echo $permalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a>
				<span class="image" style="background-image: url('<?php
					$imageThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'campaign');
					echo $imageThumbnail[0]; ?>');"></span>
				<span class="paperClip"></span>
				
				<div>
				
				<strong><?php echo $startDateArray['day']; ?></strong><br>
				<?php echo $startDateArray['monthshort']; ?>
				
				</div>
				</div>
			</div>
			
			<h3>
				<a href="<?php echo $permalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a>
				<strong>
				(<?php echo $startDateArray['monthname'] . ' ' . $startDateArray['day'] . $startDateArray['sufix'] . ', ' . $startDateArray['year']; ?> at <?php echo date("g:ia", strtotime($postMeta['_time'][0])); ?>)				
				</strong>
			</h3>
			
			<p class="newsInfo"><?php if ($postMeta['_location'][0]) echo 'Location: ' . $postMeta['_location'][0]; ?></p>
						
			<?php the_excerpt(); ?>
			
			<a class="tinyButton roundButton alignright" href="<?php echo $permalink; ?>" title="<?php echo $postTitle; ?>">read more</a>
			
			<div class="horDashed"></div>
        </div>
    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>
		
	<?php kriesi_pagination($tbQuery->max_num_pages); ?>

    </div>
	
	</div>
	
	</div>

<?php
get_footer();
?>