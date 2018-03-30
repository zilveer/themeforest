<?php get_header(); ?>
	<?php
		// Check and get Sidebar Class
		$sidebar = get_post_meta($post->ID,'post-option-sidebar-template',true);
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}

		// Translator words
		global $gdl_admin_translator;	
		if( $gdl_admin_translator == 'enable' ){
			$translator_date = get_option(THEME_SHORT_NAME.'_translator_blog_date', 'Date: ');
			$translator_by = get_option(THEME_SHORT_NAME.'_translator_blog_by', 'By: ');
			$translator_tag = get_option(THEME_SHORT_NAME.'_translator_blog_tag', 'Tags: ');
			$translator_comment = get_option(THEME_SHORT_NAME.'_translator_blog_comment', 'Comments: ');		
			$translator_client = get_option(THEME_SHORT_NAME.'_translator_client', 'Client');
			$translator_visit_website = get_option(THEME_SHORT_NAME.'_translator_visit_website', 'Visit Website');
			$translator_about_author = get_option(THEME_SHORT_NAME.'_translator_about_author', 'About the Author');
			$translator_social_share = get_option(THEME_SHORT_NAME.'_translator_social_shares', 'Social Share');
		}else{
			$translator_date = __('Date: ','gdl_front_end');
			$translator_by = __('By: ','gdl_front_end');
			$translator_tag = __('Tags: ','gdl_front_end');
			$translator_comment = __('Comments: ','gdl_front_end');		
			$translator_client =  __('Client','gdl_front_end');
			$translator_visit_website = __('Visit Website','gdl_front_end');		
			$translator_about_author = __('About the Author','gdl_front_end');
			$translator_social_share = __('Social Share','gdl_front_end');
		}		
		
	?>
	<div class="content-wrapper <?php echo $sidebar_class; ?>"> 
		<div class="clear"></div>
		<?php
			$left_sidebar = get_post_meta( $post->ID , "post-option-choose-left-sidebar", true);
			$right_sidebar = get_post_meta( $post->ID , "post-option-choose-right-sidebar", true);		

			// page title
			echo '<div class="sixteen columns mb0">';
			echo '<div class="gdl-page-title-wrapper">';
			
			// print title
			echo '<h1 class="gdl-page-title gdl-title title-color">';
			the_title();
			echo '</h1>';
			echo '<div class="gdl-page-caption">';
			echo get_post_meta($post->ID, 'post-option-caption', true);
			echo '</div>';
			echo '<div class="gdl-page-title-left-bar"></div>';
			echo '<div class="clear"></div>';
			
			echo '</div>'; // gdl-page-title-wrapper
			echo '</div>'; // sixteen columns
			
			echo "<div class='gdl-page-float-left'>";		
		?>
		<div class='gdl-page-item'>

		<?php 
			if ( have_posts() ){
				while (have_posts()){
					the_post();

					// portfolio style case
					if( get_option(THEME_SHORT_NAME.'_use_portfolio_as') == 'portfolio style' ){
						echo '<div class="sixteen columns mt0">';			
						
						// Inside Thumbnail
						if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
							$item_size = "630x320";
						}else if( $sidebar == "both-sidebar" ){
							$item_size = "450x220";
						}else{
							$item_size = "580x482";
						} 
						
						$inside_thumbnail_type = get_post_meta($post->ID, 'post-option-inside-thumbnail-types', true);
						
						switch($inside_thumbnail_type){
						
							case "Image" : 
							
								$thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
								$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
								
								if( !empty($thumbnail) ){
									echo '<div class="single-port-thumbnail-image">';
									echo '<a href="' . $thumbnail_full[0] . '" data-rel="prettyPhoto" title="' . get_the_title() . '" ><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>'; 
									echo '</div>';
								}
								break;			
								
							case "Video" : 
							
								$video_link = get_post_meta($post->ID,'post-option-inside-thumbnail-video', true);
								echo '<div class="single-port-thumbnail-video">';
								echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
								echo '</div>';							
								break;
								
							case "Slider" : 
							
								$slider_xml = get_post_meta( $post->ID, 'post-option-inside-thumbnail-xml', true); 
								$slider_xml_dom = new DOMDocument();
								$slider_xml_dom->loadXML($slider_xml);
								
								echo '<div class="single-port-thumbnail-slider">';
								echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
								echo '</div>';					
								break;
						}
						
						
						
						// Single Content
						echo '<div class="single-port-context">';
						
						echo "<div class='single-port-content'>";
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
						echo "</div>";
						
						echo '<div class="single-port-little-bar"></div>';
						
						// Portfolio Information
						echo '<div class="single-port-info port-info-color">';
						$client_name = get_post_meta($post->ID, 'post-option-clients-name', true);
						if(!empty($client_name)){
							$client_head = $translator_client;
							echo '<div class="single-port-client"><span class="head">' . $client_head . ':</span>' . $client_name . '</div>';
						}
						
						echo '<div class="single-port-date"><span class="head">' . $translator_date . '</span>';
						echo get_the_time('F d, Y') . '</div>';
						
						$portfolio_tag = get_the_term_list( $post->ID, 'portfolio-tag', '', ', ' , '' );
						if(!empty($portfolio_tag)){
						echo '<div class="single-port-tag"><span class="head">' . $translator_tag . '</span>';
						echo $portfolio_tag;
						echo '</div>';
						}
						
						$website_link = get_post_meta( $post->ID, 'post-option-website-url', true); 
						if(!empty($website_link)){
							$visit_site_head = $translator_visit_website;
							echo '<div class="single-port-visit-website"><a href="' . $website_link . '">' . $visit_site_head . '</a></div>';
						}
						
						echo '</div>'; // single-port-info						
						
						// portfolio title navigation
						echo '<div class="single-port-nav">';
						previous_post_link('<div class="single-port-prev-nav">%link</div>');
						next_post_link('<div class="single-port-next-nav">%link</div>');
						echo '<div class="clear"></div>';
						echo '</div>'; // single-port-nav						
						
						// Include Social Shares
						if(get_post_meta($post->ID, 'post-option-social-enabled', true) == "Yes"){
							echo "<div class='social-share-title gdl-link-title gdl-title'>";
							echo $translator_social_share;
							echo "</div>";
							include_social_shares();
							echo "<div class='clear'></div>";
						}		
					
						echo "</div>"; // single-port-context
						
						echo "</div>"; // sixteen-columns
					
					// post style case
					}else{
					
						echo '<div class="sixteen columns mt0">';	
						
						// Inside Thumbnail
						if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
							$item_size = "640x240";
						}else if( $sidebar == "both-sidebar" ){
							$item_size = "460x170";
						}else{
							$item_size = "940x350";
						} 
						
						$inside_thumbnail_type = get_post_meta($post->ID, 'post-option-inside-thumbnail-types', true);
						
						switch($inside_thumbnail_type){
						
							case "Image" : 
							
								$thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
								$thumbnail_full = wp_get_attachment_image_src( $thumbnail_id , 'full' );
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
								
								if( !empty($thumbnail) ){
									echo '<div class="blog-thumbnail-image">';
									echo '<a href="' . $thumbnail_full[0] . '" data-rel="prettyPhoto" title="' . get_the_title() . '" ><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>'; 
									echo '</div>';
								}
								break;
								
							case "Video" : 
							
								$video_link = get_post_meta($post->ID,'post-option-inside-thumbnail-video', true);
								echo '<div class="blog-thumbnail-video">';
								echo get_video($video_link, gdl_get_width($item_size), gdl_get_height($item_size));
								echo '</div>';							
								break;
								
							case "Slider" : 
							
								$slider_xml = get_post_meta( $post->ID, 'post-option-inside-thumbnail-xml', true); 
								$slider_xml_dom = new DOMDocument();
								$slider_xml_dom->loadXML($slider_xml);
								
								echo '<div class="blog-thumbnail-slider">';
								echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
								echo '</div>';					
								break;
								
						}
						
						echo "<div class='clear'></div>";
						
						// Single info
						echo '<div class="single-thumbnail-info post-info-color">';

						echo '<div class="single-info-inner-wrapper">';
						echo '<span class="single-info-header">' . $translator_date . '</span>';
						echo '<span class="single-info-content">' . get_the_time('d M Y') . '</span>';
						echo '</div>';					

						echo '<div class="single-info-inner-wrapper">';
						echo '<span class="single-info-header">' . $translator_by . '</span>';
						echo '<span class="single-info-content">' . get_the_author_link() . '</span>';	
						echo '</div>';
						
						$tag_string = '<div class="single-info-inner-wrapper">';
						$tag_string = $tag_string . '<span class="single-info-header">' . $translator_tag . '</span>';
						$portfolio_tag = get_the_term_list( $post->ID, 'portfolio-tag', '', ', ' , '' );
						
						echo $tag_string . '<span class="single-info-content">' . $portfolio_tag . '</span></div>';
						
						echo '<div class="single-info-inner-wrapper">';
						echo '<span class="single-info-header">' . $translator_comment . '</span>';
						echo '<span class="single-info-content">';
						comments_popup_link( __('0','gdl_front_end'), __('1','gdl_front_end'), __('%','gdl_front_end'), '', __('Comments are off','gdl_front_end') );
						echo '</span>'; // single-thumbnial-comment
						echo '</div>';
						
						echo '<div class="clear"></div>';			
						echo '</div>';	// single-thumbnail-info			
						
						// Single Content
						echo "<div class='single-context'>";
						echo "<div class='single-content'>";
						the_content();
						wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
						echo "</div>";
						echo "</div>"; // single-context
						
						// About Author
						if(get_post_meta($post->ID, 'post-option-author-info-enabled', true) == "Yes"){
							echo "<div class='about-author-wrapper'>";
							echo "<div class='about-author-avartar'>" . get_avatar( get_the_author_meta('ID'), 90 ) . "</div>";
							echo "<div class='about-author-info'>";
							echo "<div class='about-author-title gdl-link-title gdl-title'>" . $translator_about_author . "</div>";
							echo get_the_author_meta('description');
							echo "</div>";
							echo "<div class='clear'></div>";
							echo "</div>";
						}
						
						// Include Social Shares
						if(get_post_meta($post->ID, 'post-option-social-enabled', true) == "Yes"){
							echo "<div class='social-share-title gdl-link-title gdl-title'>";
							echo $translator_social_share;
							echo "</div>";
							include_social_shares();
							echo "<div class='clear'></div>";
						}
					
						echo '<div class="comment-wrapper">';
						comments_template(); 
						echo '</div>';
						
						echo "</div>"; // sixteen-columns		
					
					}
					
				}
			}
		?>
			
		</div> <!-- gdl-page-item -->
		
		<?php 	
		
			get_sidebar('left');		
				
			echo "</div>"; // gdl-page-float-left	
			
			get_sidebar('right');
		?>
		
		<div class="clear"></div>
		
	</div> <!-- content-wrapper -->

<?php get_footer(); ?>