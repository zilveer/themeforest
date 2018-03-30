<?php get_header(); ?>
	<?php
		
		$sidebar = get_post_meta($post->ID,'page-option-sidebar-template',true);
		$sidebar_class = '';
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar"){
			$sidebar_class = "sidebar-included " . $sidebar;
		}else if( $sidebar == "both-sidebar" ){
			$sidebar_class = "both-sidebar-included";
		}

	?>
	<div class="content-wrapper <?php echo $sidebar_class; ?>">
			
		<div class="page-wrapper">
			<?php
				$left_sidebar = get_post_meta( $post->ID , "page-option-choose-left-sidebar", true);
				$right_sidebar = get_post_meta( $post->ID , "page-option-choose-right-sidebar", true);		
			
				echo "<div class='gdl-page-float-left'>";
				
				echo "<div class='gdl-page-item'>";
				
				global $page_background;
				$page_background = get_post_meta( $post->ID, "page-option-enable-background", true);
				
				// Page title and content
				$gdl_show_title = get_post_meta($post->ID, 'page-option-show-title', true);
				$gdl_show_content = get_post_meta($post->ID, 'page-option-show-content', true);
				if ( have_posts() ){
					while (have_posts()){ the_post(); 

						if( $gdl_show_title != "No" ){
							echo '<div class="sixteen columns mb0">';
							echo '<div class="page-header-wrapper">';
							echo '<h1 class="page-header-title title-color gdl-title">' . get_the_title() . '</h1>';
							echo '<div class="header-gimmick mr0"></div>';
							echo '<div class="clear"></div>';
							echo '</div>';	
							echo '</div>'; // sixteen columns								
						}

						if( $page_background != 'No' ){
							echo "<div class='sixteen columns'>";
							echo '<div class="page-bkp-frame-wrapper">';
							echo '<div class="page-bkp-frame">';
						}	
						
						$content = get_the_content();
						$content = apply_filters('the_content', $content);
						// Show content
						if( $gdl_show_content != 'No' && !empty($content) ){
							echo '<div class="sixteen columns">';
							echo '<div class="gdl-page-content">';
							echo '<div class="bkp-frame-wrapper">';
							echo '<div class="bkp-frame p20">';							
							echo $content;
							wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
							echo '</div>';				
							echo '</div>';		
							echo '</div>'; // page-content
							echo '</div>'; // sixteen columns
						}

					} // while loop
					
				} //if have posts			
		
				global $gdl_item_row_size;
				$gdl_item_row_size = 0;
				// Page Item Part
				if(!empty($gdl_page_xml) && !post_password_required() ){
					$page_xml_val = new DOMDocument();
					$page_xml_val->loadXML($gdl_page_xml);
					foreach( $page_xml_val->documentElement->childNodes as $item_xml){
						switch($item_xml->nodeName){
							case 'Accordion' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_accordion_item($item_xml);
								break;
							case 'Blog' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper mb0');
								print_blog_item($item_xml);
								break;
							case 'Contact-Form' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_contact_form($item_xml);
								break;
							case 'Column':
								print_item_size(find_xml_value($item_xml, 'size'));
								print_column_item($item_xml);
								break;
							case 'Content' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_content_item($item_xml);
								break;								
							case 'Divider' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_divider($item_xml);
								break;
							case 'Gallery' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper mb0');
								print_gallery_item($item_xml);
								break;
							case 'Message-Box' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_message_box($item_xml);
								break;
							case 'Page':
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper gdl-portfolio-item mt0');
								print_page_item($item_xml);
								break;
							case 'Post-Slider':
								print_item_size(find_xml_value($item_xml, 'size'));
								print_post_slider_item($item_xml);
								break;							
							case 'Price-Item':
								print_item_size(find_xml_value($item_xml, 'size'), 'gdl-price-item');
								print_price_item($item_xml);
								break;
							case 'Portfolio' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper gdl-portfolio-item mb0');
								print_portfolio($item_xml);
								break;
							case 'Slider' : 
								print_item_size(find_xml_value($item_xml, 'size'));
								print_slider_item($item_xml);
								break;
							case 'Stunning-Text' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_stunning_text($item_xml);
								break;
							case 'Tab' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_tab_item($item_xml);
								break;
							case 'Testimonial' :
								print_item_size(find_xml_value($item_xml, 'size'), 'wrapper');
								print_testimonial($item_xml);
								break;
							case 'Toggle-Box' :
								print_item_size(find_xml_value($item_xml, 'size'));
								print_toggle_box_item($item_xml);
								break;
							default: 
								print_item_size(find_xml_value($item_xml, 'size'));
								break;
						}
						echo "</div>";
					}
				}
				
				if( $page_background != 'No' ){				
					echo "<div class='clear'></div>";
					echo "</div>"; // page-bkp-frame
					echo "</div>"; // page-bkp-frame-wrapper
					echo "</div>"; // sixteen-columns
				}
				
				echo "</div>"; // end of gdl-page-item
				
				get_sidebar('left');		
				
				echo "</div>"; // gdl-page-float-left	
				
				get_sidebar('right');
				
			?>
			
			<br class="clear">
		</div>
	</div> <!-- content-wrapper -->
	
<?php get_footer(); ?>