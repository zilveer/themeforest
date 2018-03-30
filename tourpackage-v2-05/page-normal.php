<div class="page-normal-wrapper container main ">
	<?php global $sidebar, $sidebar_array, $gdl_page_xml, $left_sidebar, $right_sidebar; ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="page-wrapper single-page <?php echo $sidebar_array['sidebar_class']; ?>">
		<?php
			$left_sidebar = get_post_meta( $post->ID , "page-option-choose-left-sidebar", true);
			$right_sidebar = get_post_meta( $post->ID , "page-option-choose-right-sidebar", true);

			echo '<div class="row gdl-page-row-wrapper">';
			echo '<div class="gdl-page-left mb0 ' . $sidebar_array['page_left_class'] . '">';

			echo '<div class="row">';
			echo '<div class="gdl-page-item mb0 ' . $sidebar_array['page_item_class'] . '">';

			// page content
			global $gdl_item_row_size;
			while (have_posts()){
				the_post();

				// print content
				$gdl_show_content = get_post_meta($post->ID, 'page-option-show-content', true);
				if( $gdl_show_content != 'No' ){
					$content = get_the_content();
					$content = apply_filters('the_content', $content);
					if(empty($content)){
						$gdl_item_row_size = print_item_size( '1/1', $gdl_item_row_size ,'mb0');
					}else{
						$gdl_item_row_size = print_item_size( '1/1', $gdl_item_row_size, 'mb45');
					}

					echo '<div class="gdl-page-content">';
					echo $content;
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'gdl_front_end' ) . '</span>', 'after' => '</div>' ) );
					echo '</div>';

					echo '</div>'; // print_item_size
				}
			}

			// Page Item Part
			if(!empty($gdl_page_xml) && !post_password_required() ){
				$item_count = 0;

				$page_xml_val = new DOMDocument();
				$page_xml_val->loadXML($gdl_page_xml);
				foreach( $page_xml_val->documentElement->childNodes as $item_xml){
					if( $item_xml->nodeName != 'Color-Open' && $item_xml->nodeName != 'Color-Close' ){

						$additional_style = '';
						$additional_class = strtolower($item_xml->nodeName) . '-item-class ';
						$additional_class = $additional_class . strtolower($item_xml->nodeName) . '-item-class-' . $item_count;

						if( $item_xml->nodeName == 'Blog' || $item_xml->nodeName == 'Portfolio' ){
							$item_margin = find_xml_value($item_xml, 'item-margin', false, 40);
						}else{
							$item_margin = find_xml_value($item_xml, 'item-margin', false, 45);
						}
						$item_margin = intval($item_margin);
						if( $item_margin <= 50 ){
							$additional_class = $additional_class. ' mb' . $item_margin;
						}else{
							$additional_style = 'margin-bottom: ' . $item_margin . 'px;';
						}

						$gdl_item_row_size = print_item_size(find_xml_value($item_xml, 'size'), $gdl_item_row_size,
							$additional_class, 'div', 'div', $additional_style);

						switch($item_xml->nodeName){
							case 'Accordion' : print_accordion_item($item_xml); break;
							case 'Blog' : print_blog_item($item_xml); break;
							case 'Contact-Form' : print_contact_form($item_xml); break;
							case 'Column': print_column_item($item_xml); break;
							case 'Column-Service' : print_column_service($item_xml); break;
							case 'Content' : print_content_item($item_xml); break;
							case 'Divider' : print_divider($item_xml); break;
							case 'Feature-Media' : print_feature_media($item_xml); break;
							case 'Gallery' : print_gallery_item($item_xml); break;
							case 'Message-Box' : print_message_box($item_xml); break;
							case 'Page': print_page_item($item_xml); break;
							case 'Package': print_package_item($item_xml); break;
							case 'Package-Search': print_package_search_item($item_xml); break;
							case 'Personnal': print_personnal_item($item_xml); break;
							case 'Portfolio' : print_portfolio($item_xml); break;
							case 'Post-Slider' : print_post_slider_item($item_xml); break;
							case 'Price-Item': print_price_item($item_xml); break;
							case 'Slider' : print_slider_item($item_xml); break;
							case 'Stunning-Text' : print_stunning_text($item_xml); break;
							case 'Tab' : print_tab_item($item_xml); break;
							case 'Testimonial' : print_testimonial($item_xml); break;
							case 'Title' : print_title_item($item_xml); break;
							case 'Toggle-Box' : print_toggle_box_item($item_xml); break;
							default: break;
						}
						echo "</div>"; // close column from print_item_size()

						$item_count++;
					}
				}
			}
			echo '<div class="clear"></div>';
			echo "</div>"; // close row from print_item_size()
			echo "</div>"; // end of gdl-page-item

			wp_reset_query();

			get_sidebar('left');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
			echo "</div>"; // gdl-page-left

			get_sidebar('right');
			echo '<div class="clear"></div>';
			echo "</div>"; // row
		?>
		<div class="clear"></div>
	</div> <!-- page wrapper -->
	</div> <!-- post class -->
</div> <!-- content wrapper -->