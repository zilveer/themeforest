
		<div id="recent-works" class="row clearfix">
			<!-- CENTERED HEADING -->
			<?php 
			global $NHP_Options; 
			$options_morphis = $NHP_Options; 
			?>
			<h4 class="centered-heading"><span><?php echo $options_morphis['portfolioHeading']; ?></span><a href="<?php echo $options_morphis['portfolioSubHeadingLink']; ?>"><?php echo $options_morphis['portfolioSubHeadingLinkText']; ?></a></h4>				
			<!-- END CENTERED HEADING -->
			<div class="caroufredselWorks-preloader">
<div class="preloader-image"></div>
</div>
			<div id="carousel-portfolio" class="caroufredselWorks">
<?php
	$postCount = 0;
	$portfolioItemsCount = $options_morphis['portfolioShowPortfolioCount'];
	$portfolioItemsASCorDESC = $options_morphis['portfolioItemsSortingASCDESC'];
	$post__in = array();
	$order__by = 'none';
	
	// facility to include which portfolio items to show:
	// check if not empty:
	if(!empty($options_morphis['portfolioItemsToShow'])):
		foreach($options_morphis['portfolioItemsToShow'] as $k => $v){
			$post__in[] = $k ;
		}		
	else:
		foreach(get_all_portfolio_list() as $k => $v){
			$post__in[] = $k ;
		}
	endif;
	
	// facility to order portfolio items
	if(!empty($options_morphis['portfolioItemsSorting'])):		
		$order__by = $options_morphis['portfolioItemsSorting'];	
	else:
		$order__by = 'none';
	endif;
	
	if(!empty($portfolioItemsASCorDESC)):		
		$order__ = $portfolioItemsASCorDESC;	
	else:
		$order__ = 'DESC';
	endif;	
	
	$query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $portfolioItemsCount, 'post__in' => $post__in, 'orderby' => $order__by, 'order' => $order__ ) );

	if( $query->have_posts() ) {
	
	  while ($query->have_posts()) : $query->the_post(); 
	  
			//Optional Link to page 
			$optional_link_page = '';
			$portfolio_link = ''; 
			$optional_link_page = get_post_meta($post->ID, '_cmb_optional_link_page', TRUE); 
			if($optional_link_page != ''): 
				$portfolio_link = $optional_link_page; 
			else: 
			
				//check if to link to portfolio page OR to its single page.
				if( $options_morphis['portfolio_select_link_to'] == 'portfolio-page' ):
				
					//check if view all portfolio link is not blank and use it as the default portfolio pages
					if($options_morphis['portfolioSubHeadingLink'] != ''):
						$portfolio_link = $options_morphis['portfolioSubHeadingLink']; 
						$arr_params = array ( 'data-post_id' => $post->ID );
						$portfolio_link = add_query_arg( $arr_params, $portfolio_link );
					else:
						//when 'view all portfolio' is blank 
						$portfolio_link = get_permalink(); 
						
					endif;	
				else:
					$portfolio_link = get_permalink(); 
				endif;			
				
			endif; 
	  
		++$postCount;
		if ($postCount == 1) {
			 // FIRST POST			
?>			

			<section class="one-third column alpha portfolio-data">					
						<div class="overlay">
							<figure>
								<?php $img_id = get_post_thumbnail_id($post->ID); ?>
								<?php $featured_image = wp_get_attachment_url( $img_id ); ?>
								<?php $info_desc = get_post_meta($post->ID,'_cmb_info_desc',TRUE); ?>
								<?php $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ); ?>			
								<?php $thumb_get = get_post($img_id); ?>
								<?php $thumb_title = $thumb_get->post_title; ?>
								<?php $portfolio_lightbox = get_post_meta($post->ID, '_cmb_feature_uncropped_image', TRUE);  //uncropped ?>

								<a href="<?php echo $portfolio_link; ?>" class="overlay-mask"></a>										
									
									<?php // get portfolio attachment video link if vimeo or youtube ?>
									<?php $attachment_type = get_post_meta($post->ID, '_cmb_select_attachment', TRUE)  ?>
									
									<?php if($attachment_type == 'youtube' || $attachment_type == 'vimeo') : ?>
										<?php if($attachment_type == 'vimeo'): ?>
											<a class="icon-view" href="http://vimeo.com/<?php echo getVimeoID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php elseif ($attachment_type == 'youtube'): ?>
											<a class="icon-view" href="http://www.youtube.com/watch?v=<?php echo getYoutubeID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php endif; ?>
									<?php else: ?>
										<?php if(!empty($portfolio_lightbox)): ?>
											<a class="icon-view" href="<?php echo $portfolio_lightbox; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php else: ?>
											<a class="icon-view" href="<?php echo $featured_image; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php endif; ?>
									<?php endif; ?>
									
									<a class="icon-link" href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"></a>							
												
								<img src="<?php echo $featured_image; ?>" width="300" height="300" alt="<?php echo $alt_text; ?>" title="<?php echo $thumb_title; ?>" />
							</figure>
							<h6><a href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"><?php the_title(); ?></a></h6>
							<p><?php echo strip_tags(truncateWords($info_desc, 12, "")); ?></p>
						</div>			
			</section>	
			
<?php
		
		} elseif($postCount % 3 == 0) {
			$postCount = 0;
			 // LAST POST IN LOOP			 
?>
			<section class="one-third column omega portfolio-data">					
						<div class="overlay">
							<figure>
								<?php $img_id = get_post_thumbnail_id($post->ID); ?>
								<?php $featured_image = wp_get_attachment_url( $img_id ); ?>
								<?php $info_desc = get_post_meta($post->ID,'_cmb_info_desc',TRUE); ?>
								<?php $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ); ?>			
								<?php $thumb_get = get_post($img_id); ?>
								<?php $thumb_title = $thumb_get->post_title; ?>
								<?php $portfolio_lightbox = get_post_meta($post->ID, '_cmb_feature_uncropped_image', TRUE);  //uncropped ?>

								<a href="<?php echo $portfolio_link; ?>" class="overlay-mask"></a>										
									
									<?php // get portfolio attachment video link if vimeo or youtube ?>
									<?php $attachment_type = get_post_meta($post->ID, '_cmb_select_attachment', TRUE)  ?>
									
									<?php if($attachment_type == 'youtube' || $attachment_type == 'vimeo') : ?>
										<?php if($attachment_type == 'vimeo'): ?>
											<a class="icon-view" href="http://vimeo.com/<?php echo getVimeoID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php elseif ($attachment_type == 'youtube'): ?>
											<a class="icon-view" href="http://www.youtube.com/watch?v=<?php echo getYoutubeID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php endif; ?>
									<?php else: ?>
									
										<?php if(!empty($portfolio_lightbox)): ?>
											<a class="icon-view" href="<?php echo $portfolio_lightbox; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php else: ?>
											<a class="icon-view" href="<?php echo $featured_image; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php endif; ?>
										
									<?php endif; ?>
									
									<a class="icon-link" href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"></a>							
												
								<img src="<?php echo $featured_image; ?>" width="300" height="300" alt="<?php echo $alt_text; ?>" title="<?php echo $thumb_title; ?>" />
							</figure>
							<h6><a href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"><?php the_title(); ?></a></h6>
							<p><?php echo strip_tags(truncateWords($info_desc, 12, "")); ?></p>
						</div>				
			</section>

<?php
		} else {					
?>			
			<section class="one-third column portfolio-data">					
						<div class="overlay">
							<figure>
								<?php $img_id = get_post_thumbnail_id($post->ID); ?>
								<?php $featured_image = wp_get_attachment_url( $img_id ); ?>
								<?php $info_desc = get_post_meta($post->ID,'_cmb_info_desc',TRUE); ?>
								<?php $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ); ?>			
								<?php $thumb_get = get_post($img_id); ?>
								<?php $thumb_title = $thumb_get->post_title; ?>
								<?php $portfolio_lightbox = get_post_meta($post->ID, '_cmb_feature_uncropped_image', TRUE);  //uncropped ?>

								<a href="<?php echo $portfolio_link; ?>" class="overlay-mask"></a>										
									
									<?php // get portfolio attachment video link if vimeo or youtube ?>
									<?php $attachment_type = get_post_meta($post->ID, '_cmb_select_attachment', TRUE)  ?>
									
									<?php if($attachment_type == 'youtube' || $attachment_type == 'vimeo') : ?>
										<?php if($attachment_type == 'vimeo'): ?>
											<a class="icon-view" href="http://vimeo.com/<?php echo getVimeoID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php elseif ($attachment_type == 'youtube'): ?>
											<a class="icon-view" href="http://www.youtube.com/watch?v=<?php echo getYoutubeID(get_post_meta($post->ID, '_cmb_attachment_' . $attachment_type, TRUE)); ?>" rel=	"prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php endif; ?>
									<?php else: ?>
										
										<?php if(!empty($portfolio_lightbox)): ?>
											<a class="icon-view" href="<?php echo $portfolio_lightbox; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php else: ?>
											<a class="icon-view" href="<?php echo $featured_image; ?>" rel="prettyPhoto" title="<?php the_title(); ?>"></a>
										<?php endif; ?>
										
									<?php endif; ?>
									
									<a class="icon-link" href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"></a>							
												
								<img src="<?php echo $featured_image; ?>" width="300" height="300" alt="<?php echo $alt_text; ?>" title="<?php echo $thumb_title; ?>" />
							</figure>
							<h6><a href="<?php echo $portfolio_link; ?>" title="<?php _e( 'view portfolio', 'morphis' ); ?>"><?php the_title(); ?></a></h6>
							<p><?php echo strip_tags(truncateWords($info_desc, 12, "")); ?></p>
						</div>				
			</section>
<?php
		}
		
	  endwhile;
	  
	}
?>
		</div>
		<!-- END RECENT WORKS SLIDER -->
		<!-- RECENT WORKS SLIDER PAGINATION -->
		<div id="carousel-pagination"></div>			
		<!-- END RECENT WORKS SLIDER PAGINATION -->
		<div class="clear"></div>
	</div>			
	<!-- END RECENT WORKS SECTION -->
<div class="clear"></div>