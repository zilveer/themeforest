
<div id="masonry" class="clearfix">

	<!-- CENTERED HEADING -->
	<?php 
	global $NHP_Options; 
	global $paged;
	$options_morphis = $NHP_Options; 
	?>
	
	<?php 
		
		function custom_excerpt_length( $length ) {
			return 42;
		}
		add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
		
		function new_excerpt_more( $more ) {
			return '...';
		}
		add_filter('excerpt_more', 'new_excerpt_more');
		
	?>
			
	<div id="linky" class="wrap container">
	
	<?php global $wp_query; ?>	
	
	<?php $masonry_items_select = 'post'; // default items to show ?>
	
	<?php $page_id = $wp_query->get_queried_object_id(); // get page id ?>	
	
	<?php $masonry_items_select = get_post_meta($page_id,'_cmb_masonry_items_select',TRUE); // get which items to show (posts or portfolio items) ?>
		
	<?php $masonry_show_the_most = get_post_meta($page_id,'_cmb_masonry_show_the_most',TRUE); // get how many items to show ?>
	
	<?php // categories to exclude from ( post categories OR portfolio categories ?>
	<?php if($masonry_items_select == 'portfolio'): ?>
		<?php $masonry_excluded_cats = get_post_meta($page_id,'_cmb_exclude_masonry_portfolio_cat_multi',FALSE); // get excluded categories' id ?>
	<?php elseif($masonry_items_select == 'post' ): ?>
		<?php $masonry_excluded_cats = get_post_meta($page_id,'_cmb_exclude_masonry_cat_multi',FALSE); // get excluded categories' id ?>	
	<?php endif; ?>
	
	<?php if($masonry_show_the_most != ''): // default show the most ?>
		<?php $masonry_posts_number = $masonry_show_the_most; ?>
	<?php else: ?>
		<?php $masonry_posts_number = '15'; ?>
	<?php endif;?>
	
	<?php if(!empty($masonry_excluded_cats)) : // exclude categories ?>													
		<?php $exclude_array = $masonry_excluded_cats; ?>	
	<?php else : ?>
		<?php $exclude_array =''; ?>
	<?php endif; ?>
	
	<?php 
	
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	$taxonomy_name = "";
	if($masonry_items_select == 'post'):
		$taxonomy_name = 'category';
	elseif($masonry_items_select == 'portfolio'):
		$taxonomy_name = 'Categories';
	endif;
	
	?>
	
	<?php $all_category_terms_ids = get_terms( $taxonomy_name, array(
													'fields'    => 'ids',
													'exclude' => $exclude_array
												 )  ); 
					?>
					
	
	<?php $_filter = array( 
						'post_type' => $masonry_items_select, 
						'paged' => $paged,										
						'posts_per_page' => $masonry_posts_number,
						'orderby' => 'date',
						'order' => 'DESC',
						'tax_query' => array(
															array(
																'taxonomy' => $taxonomy_name,
																'field' => 'id',
																'terms' => $all_category_terms_ids,
																'operator' => 'IN'
															)
														)
					); 
	?>
	
	<?php// $query_args = apply_filters( 'masonry_template_query_args', $_filter, $exclude_array ); ?>
	
	  <?php
		  $linksPosts = new WP_Query($_filter);		  
		  $postCount = 1;
	  ?>
	  
	  <?php while ($linksPosts->have_posts()) : $linksPosts->the_post(); ?>	  
	  
	  <div class="boxy one-third column">	
					
	<?php if($masonry_items_select == 'post') : // Posts Items ?>
					
	  <?php // get post format ?>
	  <?php $_post_format = get_post_format(); ?>
		<?php if($_post_format == '') : ?> 
				<?php $_post_format = 'standard'; ?>				
		<?php endif; ?>
		
		<?php if( $_post_format == 'gallery' ) { ?>
			<?php gallery_carouFredSel($post->ID, get_the_content()); ?>
			
		<?php } elseif ( $_post_format == 'audio' ) { ?>
			<?php jPlayer_audio($post->ID, FALSE); ?>
			
		<?php } elseif ( $_post_format == 'image' ) { ?>
			<?php $image_pf = get_post_meta($post->ID,'_cmb_image_pf_upload',TRUE); ?>	
			<?php if ( $image_pf != '' ) { ?>
			<?php printf( '<div class="overlay squared remove-bottom"><figure><a href="'. get_permalink() .'" class="overlay-mask"></a><a class="icon-view" href="%1$s" rel="prettyPhoto" title=""></a><a class="icon-link" href="'. get_permalink() .'"></a><img src="%1$s" alt="' . get_the_title() . '" /></figure></div>', $image_pf ); ?>			
			<?php } ?>
			
		<?php } elseif ( $_post_format == 'video' ) { ?>
			<?php $codeEmbed = get_post_meta($post->ID, '_cmb_video_pf_embedded', true); ?>
			<?php if( !empty($codeEmbed) ) { ?>
			<?php morphis_embed_video($post->ID, $codeEmbed) ?>
			<?php } else { ?>
				<div class="half-bottom clearfix">
			<?php jPlayer_video($post->ID, FALSE); ?>
				</div>
			<?php } ?>			
			
		<?php } elseif ( $_post_format == 'quote' ) { ?>
			<?php $postformat_quote = get_post_meta($post->ID,'_cmb_quote_pf_text',TRUE); ?>
			<?php $postformat_quote_cite = get_post_meta($post->ID,'_cmb_quote_cite_pf_text',TRUE); ?>
			<div class="post-body quote-pf">
				<h6><blockquote><p>&#147;<?php echo $postformat_quote; ?>&#148;</p><cite><?php echo $postformat_quote_cite; ?></cite></blockquote></h6>
			</div>			
		<?php } elseif ( $_post_format == 'aside' ) { ?>					
			<?php $aside_pf_text = get_post_meta($post->ID,'_cmb_aside_pf_text',TRUE); ?>
			<p><?php echo $aside_pf_text; ?></p>			
			
		<?php } elseif ( $_post_format == 'status' ) { ?>
			<div class="status clearfix">
				<?php $statusMsg = get_post_meta($post->ID, '_cmb_status_pf_message', true); ?>
				<?php echo '<p class="status_pf">' . $statusMsg . '</p>'; ?>
			</div>						
			
		<?php } elseif ( $_post_format == 'link' ) { ?>
				<?php $postformat_link = get_post_meta($post->ID,'_cmb_link_pf_url',TRUE); ?>			
				<div class="home-meta">
					<h3 class="entry-title link-format"><a href="<?php echo $postformat_link; ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" target="_blank"><?php the_title(); ?> &rarr;</a></h3>												
				</div>								
				
		<?php } elseif ( $_post_format == 'chat' ) { ?>
				<?php $postformat_chat = get_post_meta($post->ID,'_cmb_chat_pf_text',TRUE); ?>
				<?php $chatHolder = trim($postformat_chat); ?>
				<?php $textAr = explode("\n", $chatHolder); ?>
				<?php echo '<div class="chat-post-format"><p>'; ?>
				<?php foreach ($textAr as $line) { ?>				  
				<?php    $line = preg_replace('/:/', ':</strong>', $line, 1); ?>	
				<?php $htmlLine = ''; ?>
				<?php    $htmlLine .= '<strong>' . $line . '<br />'; ?>
				<?php } ?>
				<?php echo $htmlLine; ?>
				<?php echo '</p></div>'; ?>								
				
		<?php } else { ?>
			<?php //get featured image ?>
			  <?php $featured_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				<?php if($featured_url != '') : ?>
					<div class="">
						<figure>		
							<a href="'. get_permalink() .'" class="overlay-mask"></a>
								<a class="icon-view" href="<?php echo $featured_url; ?>" rel="prettyPhoto" title=""></a>
								<a class="icon-link" href="<?php echo get_permalink(); ?>"></a>
							
							<a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_url; ?>" alt="<?php the_title(); ?>" /></a>
						</figure>
					</div>					
				<?php endif; ?>
			  <?php //END get featured image ?>
			  
		<?php } ?>
	  
		<h6 class="masonry-title"><a href="<?php if(get_post_meta($post->ID, "url", true)) echo get_post_meta($post->ID, "url", true); else the_permalink(); ?>"><?php the_title(); ?></a></h6>
		<?php //if($_post_format == '' || $_post_format == 'standard') : ?> 
				<?php the_excerpt(); ?>
		<?php //endif; ?>
		
		<?php // end Posts ?>
		
		<?php elseif($masonry_items_select == 'portfolio') : // Portfolio Items ?>
			
			<!-- Portfolio Attachment -->
			<?php $portfolio_attachment = get_post_meta($post->ID,'_cmb_select_attachment',TRUE); ?>																	
			<?php if($portfolio_attachment == 'slideshow') : ?>
				<?php $portfolio_attachment_slideshow = get_post_meta($post->ID,'_cmb_attachment_slideshow',TRUE); ?>
				<?php gallery_carouFredSel($post->ID,  $portfolio_attachment_slideshow); ?>
			<?php elseif($portfolio_attachment == 'image') : ?>
				<?php $image_pf = get_post_meta($post->ID,'_cmb_attachment_image',TRUE); ?>							
				<?php if ( $image_pf != '' ) { ?>
				<?php printf( '<div class="overlay squared half-bottom"><figure><a href="'. get_permalink() .'" class="overlay-mask"></a><a class="icon-view" href="%1$s" rel="prettyPhoto" title=""></a><a class="icon-link" href="'. get_permalink() .'"></a><img src="%1$s" alt="' . get_the_title() . '" /></figure></div>', $image_pf ); ?>					
				<?php } ?>
			<?php elseif($portfolio_attachment == 'vimeo') : ?>
				<div class="video-figure half-bottom">
				<?php $codeEmbed = get_post_meta($post->ID, '_cmb_attachment_vimeo', true); ?>						
				<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
				</div>
			<?php elseif($portfolio_attachment == 'youtube') : ?>
				<div class="video-figure half-bottom">
				<?php $codeEmbed = get_post_meta($post->ID, '_cmb_attachment_youtube', true); ?>						
				<?php echo stripslashes(htmlspecialchars_decode($codeEmbed)); ?>
				</div>
			<?php endif; ?>
			<!-- End Portfolio Attachment -->	
		
			<h6 class="masonry-title"><a href="<?php if(get_post_meta($post->ID, "url", true)) echo get_post_meta($post->ID, "url", true); else the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<p class="half-bottom"><?php echo truncateWords(get_post_meta($post->ID, '_cmb_info_desc', TRUE), 12, ""); ?></p>
		
		<?php endif; ?>
		
	  </div>	  	  
	  <?php $postCount++; ?>
	  <?php endwhile; ?>		
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var linky = (function() {
				var $linkyContainer = $('#linky'),
				boxCount = 1,
				init = function() {
					changeboxCount();
					initEvents();
					initPlugins();
				},
				changeboxCount = function() {
					var w_w = $(window).width();
					if( w_w <= 600 ) n = 1;
					else if( w_w < 768 ) n = 1;
					else if( w_w <= 959 ) n = 3;
					else n = 3;
				},
				initEvents = function() {
					$(window).on( 'smartresize.linky', function( event ) {
						changeboxCount();
					});
				},
				initPlugins = function() {
					//$linkyContainer.imagesLoaded( function(){
						$linkyContainer.masonry({							
							itemSelector : '.boxy',
							columnWidth : function( containerWidth ) {
								return containerWidth / n;
							},
							isAnimated : true,
							animationOptions: {
								duration: 400
							}
						});
					//});				
				};
				return { init: init };
			})();
			linky.init();
		}); 
	</script>
	
	<?php numbered_pagination($linksPosts->max_num_pages); ?>
	
</div>		
<!-- END Masonry SECTION -->