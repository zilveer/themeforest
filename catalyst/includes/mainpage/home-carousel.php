<div id="main-portfolio-carousel" class="clearfix">
	<div class="viewport">
		<ul class="overview">
		
		<?php
		$carosel_portfolio=of_get_option ('sc_carousel_portfolio' );
		$carosel_from=of_get_option ('sc_carousel_from' );
		$carosel_limit=of_get_option ('sc_carousel_limit' );
		
		switch($carosel_from) {
		
		case "portfolio":
		
			$newquery = array(
				'post_type' => 'mtheme_portfolio',
				'types' => $carosel_portfolio,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'posts_per_page' => -1,
				);
			query_posts($newquery);
			
			if (have_posts()) : while (have_posts()) : the_post();
			
				echo '<li>';
				echo '<span class="c-element-preload"></span>';
				
				if ( of_get_option('sc_carousel_link')=="lightbox" ) { ?>
					<a rel="prettyPhoto" href="<?php echo featured_image_link($post->ID); ?>" title="<?php echo get_the_title(); ?>">
					<?php
					} else {
					?>
					<a href="<?php the_permalink(); ?>">
					<?php
				}

					echo mtheme_display_post_image (
					$ID=get_the_id(),
					$thumbnail_image_url=false,
					$link=false,
					$type="portfolio-four",
					$post->post_title,
					$class="preload" 
					);
					
				echo '</a>';
				echo '</li>';			
			
			
			endwhile; endif;
		
			break;
		
		case "pages":
		
			$thepage=of_get_option ('sc_carousel_page' );
			$images =& get_children( array( 
				'post_parent' => $thepage,
				'post_status' => 'inherit',
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'order' => 'ASC',
				'orderby' => 'menu_order',
				'numberposts' => $carosel_limit )
			);
							
			$page_title=get_the_title($thepage);
			$page_link=get_page_link($thepage);				
		
			foreach ( $images as $id => $image ) {

				$attatchmentID = $image->ID;
				$imagearray = wp_get_attachment_image_src( $attatchmentID , 'portfolio-four', false);
				$imageURI = $imagearray[0];
				$imageID = get_post($attatchmentID);
				$imageTitle = apply_filters('the_title',$image->post_title);
				$postlink = get_permalink($image->post_parent);
				$attatchmentURL = get_attachment_link($image->ID);
				$count++;
				
				echo '<li>';
				echo '<span class="c-element-preload"></span>';
				
				if ( of_get_option( 'sc_carousel_link')=="lightbox" ) { ?>
					<a rel="prettyPhoto" href="<?php echo $imageURI; ?>" title="<?php echo $imageTitle; ?>">
					<?php
					} else {
					?>
					<a href="<?php echo $attatchmentURL; ?>">
					<?php
				}
				
					echo mtheme_display_post_image (
					$ID=get_the_id(),
					$imageURI,
					$link=false,
					$type="portfolio-four",
					$imageTitle,
					$class="preload" 
					);
					
				echo '</a>';
				echo '</li>';
			}
			break;
		
		case "categories":
		
			global $post;
			
			$thecategory=of_get_option ('sc_carousel_category' );
			$thelimit=-1;
			
			query_posts(array(
					'cat' => $thecategory,
					'showposts' => $carosel_limit,
					'post_status' => 'publish',
					'order' => 'ASC',
					'orderby' => $galleryorder
			));
			
			while (have_posts()) : the_post();
			
				$image_id = get_post_thumbnail_id(($post->ID), 'portfolio-four'); 
				$image_url = wp_get_attachment_image_src($image_id,'portfolio-four');  
				$image_url = $image_url[0];
				$imageTitle = get_the_title($post->ID);
				$video=get_post_meta(($post->ID), $vkey, true);

				echo '<li>';
				echo '<span class="c-element-preload"></span>';
				
				if ( of_get_option( 'sc_carousel_link')=="lightbox" ) { ?>
					<a class="carousel-loader" rel="prettyPhoto" href="<?php echo $image_url; ?>" title="<?php echo $imageTitle; ?>">
					<?php
					} else {
					?>
					<a class="carousel-loader" href="<?php the_permalink() ?>">
					<?php
				}
				
					echo mtheme_display_post_image (
					$ID=get_the_id(),
					$image_url,
					$link=false,
					$type="portfolio-four",
					$imageTitle,
					$class="preload" 
					);
					
				echo '</a>';
				echo '</li>';
			endwhile;
			wp_reset_query();
			break;
		}				
		?>
		</ul>
	</div>
	<a class="buttons prev" href="#">prev</a>
	<a class="buttons next" href="#">next</a>
</div>

<?php
wp_reset_query();
?>