<?php

/* ------------------------------------
:: 	RECENT POSTS
------------------------------------*/

	function nv_recent_posts_shortcode($atts)
	{
		extract(shortcode_atts(array(
			'limit' => '',
			'categories' => '',
			'metadata' => '',
			'show_date' => '',
			'order' => 'date',
			'orderby' => '',
			'offset' =>'',
			'image_width' =>'',
			'image_height' =>'',
			'image_align' =>'',
			'image_effect' =>'',
			'content_type' => '',
			'content' =>'textimage',
			'excerpt' =>'',
			), $atts));

		if( !empty( $content_type ) )
		{
			$content = $content_type;
		}			
	
		ob_start();  	
		
		$q = new WP_Query('offset='.$offset.'&orderby='.$order.'&order='.$orderby.'&category_name='.$categories.'&posts_per_page=' . $limit);
	  
		if(esc_attr($excerpt)) {
			$recent_excerpt = esc_attr($excerpt);
		} else {
			$recent_excerpt = "15";
		} ?>
		
		<ul class="nv-recent-posts">
		
		<?php
	 
		while($q->have_posts()) : $q->the_post();
			$post_id 			= get_the_ID();
			$NV_previewimgurl  	= ( get_post_meta( $post_id, '_cmb_previewimgurl', true ) !='' )   ? get_post_meta( $post_id, '_cmb_previewimgurl', true ) : '';
			$disablegallink 	= ( get_post_meta( $post_id, '_cmb_disablegallink', true ) !='' )  ? get_post_meta( $post_id, '_cmb_disablegallink', true ) : '';
			$disablereadmore 	= ( get_post_meta( $post_id, '_cmb_disablereadmore', true ) !='' ) ? get_post_meta( $post_id, '_cmb_disablereadmore', true ) : '';
			$link_url 			= ( get_post_meta( $post_id, '_cmb_galexturl', true ) !='' ) 	   ? get_post_meta( $post_id, '_cmb_galexturl', true ) : get_permalink();
			
			// check what image to use, custom, featured, image within post. 
			if( empty($NV_previewimgurl) )
			{ 
				$post_image_id = get_post_thumbnail_id(get_the_ID());
				if ($post_image_id)
				{
					$thumbnail = wp_get_attachment_image_src( $post_image_id, 'medium', false);
					$NV_previewimgurl = $thumbnail[0];
					$NV_previewimgurl = parse_url($NV_previewimgurl, PHP_URL_PATH); // make relative Image URL
				}
				else
				{
					$NV_previewimgurl = catch_image(); // Check for images within post 
				}
			}	
			
			$image = $NV_previewimgurl;
			
			if( $image && ( $content == 'textimage' || $content == 'titleimage' || $content == 'image' ) )
			{
				// check if link is disabled
				$image_link = ( $disablegallink != 'yes' ) ? $image_link = 'link="'. $link_url .'"' : '';
				
				$image='[imageeffect type="'.$image_effect.'" align="'.$image_align.'" width="'.$image_width.'" height="'.$image_height.'"  alt="'. get_the_title().'" url="'. $image .'" '. $image_link .' ]';					
	
			}
			else
			{
				$image='';	
			} ?>
		
			<li>
				<?php 
				echo do_shortcode($image);
				if( $content != 'image' )
				{ ?>
					<div>
					<h4>
                    	<?php 
						if( $disablegallink == 'yes' )
						{ 
							the_title();
						}
						else
						{ ?>
							<a href="<?php echo $link_url; ?>"><?php the_title(); ?></a>
						<?php 
						} ?>
                    </h4>    
					<?php
					if( $show_date == 'yes' )
					{ ?>
						<small><?php echo get_the_date(); ?></small>
					<?php
					}
					
					if( $content != 'titleimage' && $content != 'title' )
					{ 			
						the_excerpt(); 
					} ?>
					</div>
				<?php 
				} 
				
				if( $metadata == 'yes' )
				{ ?>
					<div class="recent-metadata">
						<?php echo __('by', 'themeva' ); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author_meta('first_name') ." ". get_the_author_meta('last_name'); ?></a> <span class="subbreak">/</span> 
						<?php echo __('in', 'themeva' ).' '; the_category(', ') ?> <span class="subbreak">/</span> 
						<?php comments_popup_link( __('No Comments', 'themeva' ) .' ', '1 '. __('Comment', 'themeva' ) . ' ', '% '. __('Comments', 'themeva' )); ?>
						<div class="hozbreak clearfix">&nbsp;</div>
					</div>
				<?php 
				} ?>                
				<div class="clear"></div>
			</li>
		<?php 
		
		endwhile;	wp_reset_query();  ?>
		
		</ul>
		
		
	<?php 
	   $output_string = '';
	   $output_string = ob_get_contents();
	   ob_end_clean();
	   
	   return $output_string;	
	}

	/* ------------------------------------
	:: RECENT POSTS MAP
	------------------------------------*/
	
	add_shortcode('recent_posts', 'nv_recent_posts_shortcode');
	
	wpb_map( array(
		"name"		=> __("Recent Posts", "js_composer"),
		"base"		=> "recent_posts",
		"controls"	=> "edit_popup_delete",
		"class"		=> "",
		"icon"		=> "icon-list",
		"category"  => __('Content', 'js_composer'),
		"params"	=> array(
			get_common_options('content', 'recent_posts'),				
			array(
				"type" => "checkbox",
				"holder" => "div",
				"heading" => __("Post Categories", "js_composer"),
				"param_name" => "categories",
				"value" => get_data_source( 'data-2', 'shortcode' ),
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Display Date", "js_composer"),
				"param_name" => "show_date",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),
			array(
				"type" => "checkbox",
				"class" => "",
				"heading" => __("Display Metadata", "js_composer"),
				"param_name" => "metadata",
				"value" =>  array(
					__('Enable', "js_composer") => "yes", 
				)
			),								
			get_common_options( 'order', 'recentposts' ),
			get_common_options( 'orderby', 'recentposts' ),
			get_common_options( 'excerpt', 'recentposts' ),	
			array(
				"type" => "textfield",
				"heading" => __("Offset", "js_composer"),
				"param_name" => "offset",
				"value" => "",
				"description" => __("Enter the  number of posts to offset by.", "js_composer")
			),						
			array(
				"type" => "textfield",
				"heading" => __("Limit", "js_composer"),
				"param_name" => "limit",
				"value" => "",
				"description" => __("Limit the number of posts.", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Image Width", "js_composer"),
				"param_name" => "image_width",
				"value" => "",
				"description" => __("px", "js_composer")
			),
			array(
				"type" => "textfield",
				"heading" => __("Image Height", "js_composer"),
				"param_name" => "image_height",
				"value" => "",
				"description" => __("px", "js_composer")
			),			
			array(
				"type" => "dropdown",
				"heading" => __("Image Effect", "js_composer"),
				"param_name" => "image_effect",
				"value" => get_options_array( 'imageeffect' ),
			),	
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __( 'Image Align', "js_composer"),
				"param_name" => "image_align",
				"value" => array(
					'Normal' => '',
					'Left' => 'alignleft',
					'Center' => 'aligncenter',
					'Right' => 'alignright'
				)
			),
		)
	) );