    <?php
	
		$todayArray = getdate();
		$today = $todayArray['year'] . '-';
		$today .= str_pad($todayArray['mon'], 2, 0, STR_PAD_LEFT) . '-';
		$today .= str_pad($todayArray['mday'], 2, 0, STR_PAD_LEFT);
		
		$args = array();
		
		$args['post_type'] = 'event';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = 10;
		$args['order'] = 'ASC';
		$args['orderby'] = 'meta_value';
		$args['meta_key'] = '_start_date';
		$args['meta_query'] = array(
			array(
				'key'		=> '_start_date',
				'value'		=> $today,
				'compare'	=> '>'
			)
		);
		
		$tbQuery = new WP_Query($args);
	?>

    <?php
	
	$listOfIDs = array();
	
	if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post();
	
	$listOfIDs[] = get_the_ID();
	
	endwhile; endif;
	
	wp_reset_postdata();
	
	?>
	
	<!-- CAMPAIGN -->
    <div id="campaign" class="width1000">
    	<div id="campaignTrail">
        	<h3>On <span>The </span> Campaign Trail</h3>
            <a href="<?php tb_write_link('tb_page_events'); ?>" class="checkTheDates">Check the dates and see when we're in your town!</a>
            
            <div id="campaignSlides">
            
            	<div class="slides_container">
				
				<?php
				
				$ePagination = array();
				
				foreach ($listOfIDs as $eID) {
					$postMeta = get_post_meta($eID);
					$startDate = $postMeta['_start_date'][0];
					$startDateArray = tb_get_date($startDate);
					$endDate = $postMeta['_end_date'][0];
					$endDateArray = tb_get_date($endDate);
				?>
					
                	<!-- Single slide -->
                	<div class="slide">
                    	<a href="<?php echo get_permalink($eID); ?>"><?php echo $postMeta['_location'][0]; ?></a>
                    	<?php echo tb_get_thumbnail($eID, 'campaign'); ?>
                        <div class="caption">
                        	<h4><?php echo $postMeta['_location'][0]; ?></h4>
                            <p>From <?php echo $startDateArray['monthname'] . ' ' . $startDateArray['day'] . $startDateArray['sufix']; ?> to <?php echo $endDateArray['monthname'] . ' ' . $endDateArray['day'] . $endDateArray['sufix']; ?></p>
                        </div>
                    </div>
                	<!-- .Single slide -->
					
				<?php
				$ePagination[] = $startDateArray['monthshort'] . ' ' . $startDateArray['day'];
				}
				
				?>
                
                </div>
                
                <ul class="pagination">
				<?php
				
				$paginationIndex = 0;
				foreach ($ePagination as $pagS) { ?>
					<li><a href="#<?php echo $paginationIndex; ?>"><?php echo $pagS; ?></a></li>
				<?php
				$paginationIndex++;				
				}
				?>
                </ul>
            </div>
        </div>
        
        <div id="campaignCountdown"></div>
    </div>
    <!-- .CAMPAIGN -->