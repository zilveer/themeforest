<?php global $custom_query, $wp_query, $portfolio; 

// Get shortcode params from the query_vars array
$params = ( isset($custom_query->query_vars) ) ? $custom_query->query_vars : false;

// Grid style
$layoutStyle = (isset($portfolio['type']) && $portfolio['type']) ? $portfolio['type'] : 'masonry'; // 'masonry' and 'fitRows' are expected parameters
$filtered = (isset($portfolio['filtered']) && $portfolio['filtered']) ? $portfolio['filtered'] : false;
$isotope = ($layoutStyle == 'masonry' || $layoutStyle == 'fitRows') ? true : false;

// Layout variables using params array passed from shortcode
$columns = (isset($params['columns']) && $params['columns']) ? $params['columns'] : 4; // number of columns (default 4)
$margin  = (isset($params['margin']) && $params['margin']) ? $params['margin'] : 20;   // Margin size (default 20px) [Future update: consider using %]
$width   = 1200; // only matters if we specify margin in pixels

$thumbnail_size = 'portfolio-thumb';

$quickID = str_pad(rand(0, pow(10, 3)-1), 3, '0', STR_PAD_LEFT); // 3 digit ID so lightboxes don't intermix when multiple portfolios are on same page

// Check for a custom query, typically sent by a shortcode
$the_query = (!$custom_query) ? $wp_query : $custom_query;	
if ( $the_query->have_posts() ) : ?>

	<?php 
	// Show filters
	if ($filtered) : 
		// list the filters ?>
		<div>
			<ul id="sort-by" class="entry-meta">
				<li><a href="#all" data-filter="type-portfolio" class="active"><?php _e('All', 'framework'); ?></a></li>
				<?php 
				// Get the categories to show in the filters
				$filterCategories = '';
				if (isset($params['tax_query'][0]['terms']) && !empty($params['tax_query'][0]['terms'])) {
					$terms = $params['tax_query'][0]['terms'];
					foreach ($terms as $term) {
						$ids = term_exists( $term, 'portfolio-category' );
						$filterCategories .= $ids['term_id'].',';
					}
				}
				// Output the filter list
				wp_list_categories( array('title_li' => '', 'taxonomy' => 'portfolio-category', 'include' => $filterCategories, 'walker' => new Portfolio_Category_Walker() ) ); 
				?>
			</ul>
		</div> 
		<?php
	endif; // end show filters ?>

	<div class="row-fluid portfolio-columns-<?php echo $columns ?> posts-grid" style="clear: both;">

		<?php 
		// Use isotope
		if ($isotope) :  ?>
			<div class="portfolio-wrapper isotope no-transition">
			<?php
		endif; // end show filters ?>

			<?php

			// Show Portfolio List
			// ------------------------------------------------------------------
			$item_count = 0; // to track the loops

			// Loop through the results and print each. 
			while ( $the_query->have_posts() ) : $the_query->the_post();  
				
				// Get associated categories
				$terms =  get_the_terms( $post->ID, 'portfolio-category' ); 
				$term_list = '';
				if( is_array($terms) ) {
					foreach( $terms as $term ) {
						$term_list .= urldecode($term->slug) . ' ';
					}
				}

				// Apply the custom grid settings
				$classes = 'portfolio-item '. $term_list;
				$styles  = '';

				// Isotope portfolio settings
				if ($isotope) {
					
					$itemStyle_data = 'data-style=\'{"layout": "'. $layoutStyle .'"}\'';
					// $classes       .= 'span-custom isotope-item '; // add selector class
					$classes       .= 'isotope-item '; // add selector class

					if ($isotope) {
						$thumbnail_size = 'portfolio-thumb-masonry';
					}
				
				// Static portfolio settings
				} else {

					$itemStyle_data = '';

				} // $isotope ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> style="<?php echo $styles; ?>" <?php echo $itemStyle_data; ?>>

					<header class="post-header">
						<?php 

						// Post formats that use the featured image (standard, image, audio)
						// --------------------------------------------------------------------
						$no_thumbnail = array('gallery', 'video', 'quote', 'link');
						// $media = get_the_post_thumbnail($post->ID, $thumbnail_size);
													

						if ( has_post_thumbnail($post->ID) && !in_array(get_post_format(), $no_thumbnail) ) : 
							
							$size  = get_post_image_size( $thumbnail_size, $params );
							// if (is_single() && !get_options_data('blog-options', 'single-post-image', false)) {
								// $media =  false;
							// } else {
							if (is_array($size)) {
								$thumb = get_post_thumbnail_id($post->ID); 
								$crop = (  $size[0] == 0 || $size[1] == 0 ) ? false : true;
								$image = vt_resize( $thumb, '', $size[0], $size[1], $crop );
								$media = '<img src="'. $image['url'] .'" width="'. $image['width'] .'" height="'. $image['height'] .'" alt="'. the_title_attribute( 'echo=0' ) .'">';
							} else {
								$media = get_the_post_thumbnail($post->ID, $size);
							}
							// }
							// A few items we need to create the media items
							$link_class       = 'styled-image '. get_post_format();
							$link_title       = sprintf( __( 'Permalink to %s', 'framework' ), the_title_attribute( 'echo=0' ) );
							$link_to_details  = get_permalink();
							$link_to_lightbox = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$link_href        = $link_to_details;
							$lightbox_group   = 'group-'.$quickID ;

							// Lightbox options
							$lightbox_option  = get_post_meta($post->ID, 'theme_portfolio_lightbox', true);
							if ($lightbox_option == 'lightbox') {
								$link_href = $link_to_lightbox[0];
								$link_class .= ' popup';
								$link_class .= (get_post_format()) ? ' '.get_post_format() : ' image'; // helper for icon overlay
								$link_title = the_title_attribute( 'echo=0' );
							}
							?>
							<div class="featured-image">
								<a href="<?php echo $link_href ?>" class="<?php echo $link_class ?>" title="<?php echo $link_title ?>" rel="bookmark" data-lightbox="<?php echo $lightbox_group ?>"><?php echo $media ?><div class="inner-overlay"></div></a>
							</div>
							<?php 



						endif;

						// Media selected by post format
						switch( get_post_format() ) {

							case "audio" :
								// Audio Player
								theme_audio_player($post->ID);
								break;
							case "gallery" :
								// Image size
								$size  = get_post_image_size( $thumbnail_size, $params );
								// Check for specific width and height settings
								if (is_array($size)) {
									$size = $size[0].'x'.$size[1]; 
								}
								// Content rotator parameters 
								$rotatorParams = array(
									'columns'      => 1, 
									'type'         => 'post-gallery',
									'image_size'   => $size,
									'transition'   => 'fade', 
									'slide_paging' => 'true', 
									'autoplay'     => 'true',
									'interval'     => '3500',
									'class'        => 'slideshow'
								);
								?>
								<div class="featured-image">
									<div class="styled-image <?php echo get_post_format() ?>"><?php echo theme_content_rotator( $rotatorParams ); ?></div>
								</div>
								<?php
								break;
							case "link" :
								// Link 
								?>
								<h1 class="entry-title">
									<a href="<?php echo esc_url(get_post_meta($post->ID, 'postformat_link_url', true)); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a>
								</h1>
								<span class="sub-title">&mdash; <?php echo get_post_meta($post->ID, 'postformat_link_url', true) ?></span>
								<?php
								break;
							case "quote" :
								// Quote 
								?>
								<h3 class="entry-title"><?php echo get_post_meta($post->ID, 'postformat_quote_text', true) ?></h3>
								<span class="sub-title">&mdash; <?php echo get_post_meta($post->ID, 'postformat_quote_source', true) ?></span>
								<?php
								break;
							case "video" :
								// Video Player or Embed
								theme_video_player($post->ID);
								break;
						} ?>

					</header>

					<?php 

					// Item title
					if ( get_post_format() != 'quote' &&  get_post_format() != 'link' )
					theme_post_title( $post->ID, 'h2'); 

				 	// Item Content ?>
					<div class="entry-summary">
						<?php 
						if (isset($params['post_excerpts'])) {
							theme_post_content();
						} ?>
					</div><!-- .entry-summary -->

				</article><!-- #post -->

				<?php 

				$item_count++;
			endwhile;

		// end filtered portfolio wrapper
		if ($isotope) { 
			echo '</div><!-- .portfolio-wrapper .isotope -->'; 
		} ?>

	</div><!-- .row-fluid -->

	<?php

	// Pagination
	$paging = ( isset($params['paging']) && $params['paging'] == 'false' ) ? false : true;
	if (  $paging ) : get_pagination($the_query); endif;

	// clean up
	unset($the_query);
	if (isset($custom_query)) : unset($custom_query); endif;

endif; // end have_posts() check 

?>