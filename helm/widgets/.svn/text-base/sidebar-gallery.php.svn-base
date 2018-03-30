<?php
class mtheme_SidebarGallery_Widget extends WP_Widget {
	function mtheme_SidebarGallery_Widget() {
		$widget_ops = array('classname' => 'widget_mtheme_sidebar_gallery', 'description' => 'Generates a gallery to the sidebar or footer.' );
		$this->WP_Widget('mtheme_sidebar_gallery', MTHEME_NAME . '- Widget Gallery', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		$clickaction="";
		$thepage="";
		$thecategory="";
		$listchoice="";
		$galleryorder="";
		$thumbsize="";
		$thelimit	=	-1;
		
		$columnbreak="3";
		
		$height=82;
		$width=82;
		
		$gridtype="infobar-portfoliogrid";
		
		if (isset($instance['clickaction'])) { $clickaction = $instance['clickaction']; }
		if (isset($instance['thepage'])) { $thepage = $instance['thepage']; }
		if (isset($instance['thecategory'])) { $thecategory= $instance['thecategory']; }
		if (isset($instance['theportfolio'])) { $theportfolio= $instance['theportfolio']; }
		if (isset($instance['listchoice'])) { $listchoice=$instance['listchoice']; }
		if (isset($instance['thelimit'])) { $thelimit=$instance['thelimit']; }
		if (isset($instance['galleryorder'])) { $galleryorder=$instance['galleryorder']; }
		if (isset($instance['thumbsize'])) { $thumbsize=$instance['thumbsize']; }

		
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		if ( !empty( $title ) ) { 
			echo $before_title . $title . $after_title; 
		};

			$gridtype="infobar-portfoliogrid";
			$quality=THEME_IMAGE_QUALITY;
			$count=0;
			$vkey="video";
			?>
			
			<div>
			<ul class="<?php echo $gridtype; ?>">
			
			<?php
			switch ($listchoice) {
			
				case "portfolio" :
				
					if ($theportfolio=="BLANK") { $theportfolio=""; }

					$newquery = array(
					'post_type' => 'mtheme_portfolio',
					'types' => $theportfolio,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'posts_per_page' => $thelimit,
					);
					query_posts($newquery);
				
					if (have_posts()) : while (have_posts()) : the_post();
					
					$count++;
					
					$image_id = get_post_thumbnail_id(($post->ID), 'fullsize'); 
					$image_url = wp_get_attachment_image_src($image_id,'fullsize');  
					$image_url = $image_url[0];					
					
					$thumbnail_image_id = get_post_thumbnail_id(($post->ID), 'portfolio-tiny'); 
					$thumbnail_image_url = wp_get_attachment_image_src($image_id,'portfolio-tiny');  
					$thumbnail_image_url = $thumbnail_image_url[0];
					
					$imageTitle = get_the_title($post->ID);
					$video=get_post_meta(($post->ID), $vkey, true);
					
					$hovericon="imageicon";
					$lightbox_url=$image_url;
					
					if ($video<>"") {
						$hovericon="videoicon";
						$lightbox_url=$video;
					}
					
					if ($count==$columnbreak) { 
						$class_string=$hovericon;
						$count=0;
					} else {
						$class_string="rightspace " . $hovericon;
					}
					
					?>

						<li class="<?php echo $class_string; ?>">
						<?php

						if ($clickaction=="lightbox") { ?>
							<a rel="prettyPhoto[widget]" href="<?php echo $lightbox_url; ?>" title="<?php echo $imageTitle; ?>">
							<?php
							} else {
							?>
							<a href="<?php the_permalink() ?>">
							<?php
						}
						?>
								<?php 
								echo display_post_image (
									$post->ID,
									$have_image_url=$thumbnail_image_url,
									$link=false,
									$type="",
									$post->post_title,
									$class="sidegalleryfade" 
								);
								?>
							</a>
						</li>			
					
					<?php
					endwhile; endif;
				
					break;
					
				// If the choice is Pages
				case "page" :
					$images =& get_children( array( 
										'post_parent' => $thepage,
										'post_status' => 'inherit',
										'post_type' => 'attachment',
										'post_mime_type' => 'image',
										'order' => 'ASC',
										'orderby' => $galleryorder,
										'numberposts' => $thelimit )
										);
									
					$page_title=get_the_title($thepage);
					$page_link=get_page_link($thepage);

					foreach ( $images as $id => $image ) {

					$attatchmentID = $image->ID;
					
					$imagearray = wp_get_attachment_image_src( $attatchmentID , 'fullsize', false);
					$imageURI = $imagearray[0];					
					
					$thumbnail_imagearray = wp_get_attachment_image_src( $attatchmentID , 'portfolio-tiny', false);
					$thumbnail_imageURI = $thumbnail_imagearray[0];
					
					$imageID = get_post($attatchmentID);
					$imageTitle = apply_filters('the_title',$image->post_title);
					$postlink = get_permalink($image->post_parent);
					$attatchmentURL = get_attachment_link($image->ID);
					$count++;
					
					if ($count==$columnbreak) { 
						$class_string="imageicon";
						$count=0;
					} else {
						$class_string="rightspace imageicon";
					}
					
					?>

						<li class="<?php echo $class_string; ?>">
						<?php
						if ($clickaction=="lightbox") { ?>
							<a rel="prettyPhoto[widget]" href="<?php echo $imageURI; ?>">
							<?php
							} else {
							?>
							<a href="<?php echo $attatchmentURL; ?>">
							<?php
						}
						?>
								<?php  
								echo display_post_image (
									$post->ID,
									$have_image_url=$thumbnail_imageURI,
									$link=false,
									$type="",
									$post->post_title,
									$class="sidegalleryfade" 
								);
								?>
							</a>
						</li>
							<?php
					}

				break;
			Case "category" :
					// If the choice is Posts in Categories
					global $post;
					query_posts(array(
							'cat' => $thecategory,
							'showposts' => $thelimit,
							'post_status' => 'publish',
							'order' => 'ASC',
							'orderby' => $galleryorder
					));
					
					while (have_posts()) : the_post();
					
					$count++;
					
					$image_id = get_post_thumbnail_id(($post->ID), 'fullsize'); 
					$image_url = wp_get_attachment_image_src($image_id,'fullsize'); 
					$image_url = $image_url[0];
					
					$thumbnail_image_id = get_post_thumbnail_id(($post->ID), 'portfolio-tiny'); 
					$thumbnail_image_url = wp_get_attachment_image_src($thumbnail_image_id,'portfolio-tiny'); 
					$thumbnail_image_url = $thumbnail_image_url[0];

					$imageTitle = get_the_title($post->ID);
					$video=get_post_meta(($post->ID), $vkey, true);
					
					$hovericon="imageicon";
					$lightbox_url=$image_url;
					
					if ($video<>"") {
						$hovericon="videoicon";
						$lightbox_url=$video;
					}
					
					if ($count==$columnbreak) { 
						$class_string=$hovericon;
						$count=0;
					} else {
						$class_string="rightspace " . $hovericon;
					}
					
					?>

						<li class="<?php echo $class_string; ?>">
						<?php

						if ($clickaction=="lightbox") { ?>
							<a rel="prettyPhoto[widget]" href="<?php echo $lightbox_url; ?>">
							<?php
							} else {
							?>
							<a href="<?php the_permalink() ?>">
							<?php
						}
						?>
								<?php 
								echo display_post_image (
									$post->ID,
									$have_image_url=$thumbnail_image_url,
									$link=false,
									$type="",
									$post->post_title,
									$class="sidegalleryfade" 
								);
								?>
							</a>
						</li>
							<?php

					endwhile;
					?>
							
			
			<?php
			wp_reset_query();
			break;
			}
			?>
			</ul>
			<div class="clear"></div>
			</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		//$instance = $old_instance;
		//$instance['title'] = strip_tags($new_instance['title']);
		//$instance['clickaction'] = strip_tags($new_instance['clickaction']);
		return $new_instance;

		//return $instance;
	}

	function form($instance) {
	
		$clickaction="";
		$thepage="";
		$thecategory="";
		$listchoice="";
		$galleryorder="";
		$thumbsize="";
		$thelimit="";
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Sidebar Gallery' ) );
		$title = strip_tags($instance['title']);
		if (isset($instance['clickaction'])) { $clickaction = esc_attr($instance['clickaction']); }
		if (isset($instance['thepage'])) { $thepage = esc_attr($instance['thepage']); }
		if (isset($instance['thecategory'])) { $thecategory= esc_attr($instance['thecategory']); }
		if (isset($instance['theportfolio'])) { $theportfolio= esc_attr($instance['theportfolio']); }
		if (isset($instance['listchoice'])) { $listchoice=esc_attr($instance['listchoice']); }
		if (isset($instance['galleryorder'])) { $galleryorder=esc_attr($instance['galleryorder']); }
		if (isset($instance['thelimit'])) { $thelimit=esc_attr($instance['thelimit']); }
		
		// Start Generate a Page List
		$pagelist = get_pages();
		$page_options = array();
		$page_options[] = '<option value="BLANK">Select a Page</option>';
 
		foreach ($pagelist as $page) {
			if ($thepage==$page->ID) { $selected=' selected="selected"';} else { $selected=""; }
			$page_options[] = '<option value="' . $page->ID .'"' . $selected . '>' . $page->post_title . '</option>';
		}
		// End Generate a Page List
		
		// Start Generate a Category List
		$categories = get_categories();
		$cat_options = array();
		$cat_options[] = '<option value="BLANK">Select a Category</option>';
 
		foreach ($categories as $cat) {
			if ($thecategory==$cat->cat_ID) { $selected=' selected="selected"';} else { $selected=""; }
			$cat_options[] = '<option value="' . $cat->cat_ID .'"' . $selected . '>' . $cat->name . '</option>';
		}
		// End Generate a Category List
		
		// Start Generate a Category List
		$portfolios = get_categories('taxonomy=types&title_li=');
		$portfolio_options = array();
		$portfolio_options[] = '<option value="BLANK">All items</option>';
 
		foreach ($portfolios as $portfolio) {
			if ($theportfolio==$portfolio->slug) { $selected=' selected="selected"';} else { $selected=""; }
			$portfolio_options[] = '<option value="' . $portfolio->slug .'"' . $selected . '>' . $portfolio->name . '</option>';
		}
		
	?>
	<?php // Title Field ?>	
	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','mthemelocal'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>
	
	<?php // List Choice ?>		
	<p>
		<label for="<?php echo $this->get_field_id('listchoice'); ?>">
			<?php _e('List Choice:','mthemelocal'); ?>
		</label>
	<select id="<?php echo $this->get_field_id('listchoice'); ?>" class="widefat" name="<?php echo $this->get_field_name('listchoice'); ?>">
		<option value="page"<?php echo ($listchoice === 'page' ? ' selected="selected"' : ''); ?>>Page Atatchments</option>
		<option value="category"<?php echo ($listchoice === 'category' ? ' selected="selected"' : ''); ?>>Category of Posts</option>
		<option value="portfolio"<?php echo ($listchoice === 'portfolio' ? ' selected="selected"' : ''); ?>>Portfolio</option>
	</select>
	</p>
	
	<?php // Page List ?>	
	<p>
		<label for="<?php echo $this->get_field_id('thepage'); ?>">
			<?php _e('Select Page <br/><small><strong>If List-Choice is Page</strong></small> :','mthemelocal'); ?>
		</label>
		<select id="<?php echo $this->get_field_id('thepage'); ?>" class="widefat" name="<?php echo $this->get_field_name('thepage'); ?>">
			<?php echo implode('', $page_options); ?>
		</select>
	</p>
	
	<?php // Category List ?>	
	<p>
		<label for="<?php echo $this->get_field_id('thecategory'); ?>">
			<?php _e('Select Category <br/><small><strong>If List-Choice is Category</strong></small> :','mthemelocal'); ?>
		</label>
		<select id="<?php echo $this->get_field_id('thecategory'); ?>" class="widefat" name="<?php echo $this->get_field_name('thecategory'); ?>">
			<?php echo implode('', $cat_options); ?>
		</select>
	</p>
	
	<?php // Portfolio List ?>	
	<p>
		<label for="<?php echo $this->get_field_id('theportfolio'); ?>">
			<?php _e('Select Portfolio <br/><small><strong>If List-Choice is Portfolio</strong></small> :','mthemelocal'); ?>
		</label>
		<select id="<?php echo $this->get_field_id('theportfolio'); ?>" class="widefat" name="<?php echo $this->get_field_name('theportfolio'); ?>">
			<?php echo implode('', $portfolio_options); ?>
		</select>
	</p>
	
	<?php // Click Action Field ?>		
	<p>
		<label for="<?php echo $this->get_field_id('clickaction'); ?>">
			<?php _e('Click Action:','mthemelocal'); ?>
		</label>
	<select id="<?php echo $this->get_field_id('clickaction'); ?>" class="widefat" name="<?php echo $this->get_field_name('clickaction'); ?>">
		<option value="lightbox"<?php echo ($clickaction === 'lightbox' ? ' selected="selected"' : ''); ?>>Lightbox</option>
		<option value="directlink"<?php echo ($clickaction === 'directlink' ? ' selected="selected"' : ''); ?>>Direct Link</option>
	</select>
	</p>
	
	<?php // Click Action Field ?>		
	<p>
		<label for="<?php echo $this->get_field_id('galleryorder'); ?>">
			<?php _e('Image Order:','mthemelocal'); ?>
		</label>
	<select id="<?php echo $this->get_field_id('galleryorder'); ?>" class="widefat" name="<?php echo $this->get_field_name('galleryorder'); ?>">
		<option value="rand"<?php echo ($galleryorder === 'rand' ? ' selected="selected"' : ''); ?>>Random</option>
		<option value="date"<?php echo ($galleryorder === 'date' ? ' selected="selected"' : ''); ?>>Sequencial</option>
	</select>
	</p>
	
	<?php // Limit List ?>	
	<p>
		<label for="<?php echo $this->get_field_id('thelimit'); ?>">
			<?php _e('Limit Portfolio:','mthemelocal'); ?>
		</label>
		<select id="<?php echo $this->get_field_id('thelimit'); ?>" class="widefat" name="<?php echo $this->get_field_name('thelimit'); ?>">
			<option value="1"<?php echo ($thelimit === '1' ? ' selected="selected"' : ''); ?>>1</option>
			<option value="2"<?php echo ($thelimit === '2' ? ' selected="selected"' : ''); ?>>2</option>
			<option value="2"<?php echo ($thelimit === '3' ? ' selected="selected"' : ''); ?>>3</option>
			<option value="4"<?php echo ($thelimit === '4' ? ' selected="selected"' : ''); ?>>4</option>
			<option value="5"<?php echo ($thelimit === '5' ? ' selected="selected"' : ''); ?>>5</option>
			<option value="6"<?php echo ($thelimit === '6' ? ' selected="selected"' : ''); ?>>6</option>
			<option value="7"<?php echo ($thelimit === '7' ? ' selected="selected"' : ''); ?>>7</option>
			<option value="8"<?php echo ($thelimit === '8' ? ' selected="selected"' : ''); ?>>8</option>
			<option value="9"<?php echo ($thelimit === '9' ? ' selected="selected"' : ''); ?>>9</option>
			<option value="10"<?php echo ($thelimit === '10' ? ' selected="selected"' : ''); ?>>10</option>
			<option value="11"<?php echo ($thelimit === '11' ? ' selected="selected"' : ''); ?>>11</option>
			<option value="12"<?php echo ($thelimit === '12' ? ' selected="selected"' : ''); ?>>12</option>
			<option value="13"<?php echo ($thelimit === '13' ? ' selected="selected"' : ''); ?>>13</option>
			<option value="14"<?php echo ($thelimit === '14' ? ' selected="selected"' : ''); ?>>14</option>
			<option value="15"<?php echo ($thelimit === '15' ? ' selected="selected"' : ''); ?>>15</option>
			<option value="20"<?php echo ($thelimit === '20' ? ' selected="selected"' : ''); ?>>20</option>
			<option value="25"<?php echo ($thelimit === '25' ? ' selected="selected"' : ''); ?>>25</option>
			<option value="30"<?php echo ($thelimit === '30' ? ' selected="selected"' : ''); ?>>30</option>
			<option value="-1"<?php echo ($thelimit === '-1' ? ' selected="selected"' : ''); ?>>Unlimited</option>
		</select>
	</p>


	
<?php
	}
}
register_widget('mtheme_SidebarGallery_Widget');
?>