<?php

	/*
	*	CrunchPress Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	
		$blog_div_size_num_class = array(
			"1/1 Full Thumbnail" => array("index"=>"2", "class"=>"span12", "size"=>"930x300", "size2"=>"630x200", "size3"=>"450x150"));
			
    function print_post_meta () { ?>
    <div class="poted-by"> <?php $post_format = get_post_format(); if ( $post_format == "video" ) { ?><i class="post-icon icon-film"></i><?php }else{?><i class="post-icon icon-picture"></i><?php } ?>
            <ul class="tags">
            <li> <i class="icon-user"></i><?php _e('Posted by ','cp_front_end')?><?php echo get_the_author_link(); ?></li>
            <li><i class="icon-folder-close"></i><?php echo get_the_category_list( __( ', ', 'cp_front_end' ) ); ?></li>
            <li><i class="icon-tag"></i><?php the_tags( '<span class="tag-links">', ', ', '</span>' ); ?></li>
            <li><i class="icon-comments"></i><?php comments_popup_link( __('0 Comment','cp_front_end'), __('1 Comment','cp_front_end'), __('% Comments','cp_front_end'), '',__('Comments are off','cp_front_end') );?></li>
            </ul>
            <?php if (!is_single()) {  echo '<a class="more" href="' . get_permalink() . '">' . __('Read More ','cp_front_end') . '</a>'; } ?></div>
    
    <?php }
	// Print blog item
	function print_blog_item($item_xml){

		wp_reset_query();
		global $paged;
		global $sidebar;
		global $blog_div_size_num_class;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
		$item_type = '1/1 Full Thumbnail';
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size2'];
		}else{
			$item_size = $blog_div_size_num_class[$item_type]['size3'];
		}
		
		
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
													$item_size = "750x250";
												}else if( $sidebar == "both-sidebar" ){
													$item_size = "560x200";
												}else{
													$item_size = "1170x350";
												} 
		// get the blog meta value		
		$header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}

		// start fetching database
		query_posts(array('post_type'=>'post', 'paged'=>$paged,
			 'category_name'=>$category, 'posts_per_page'=>$num_fetch  ));		
		
		echo '<div id="blog-item-holder" class="blog-item-holder">';

	        global $item_class, $item_index;
			print_blog_full($item_class, $item_size, $item_index, $num_excerpt, $full_content);
		
		echo '</div>';
		echo '<div class="clear"></div>';
	
	}	
	
	// print the blog thumbnail
	function print_blog_thumbnail( $post_id, $item_size ){
	
		$thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
		
		if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
		
			$thumbnail_id = get_post_thumbnail_id( $post_id );
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			if( !empty($thumbnail) ){
				echo '<div class="blog-thumbnail-image">';
				echo '<a href="' . get_permalink() . '"><img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/></a>';
				echo '</div>';
			}
		
		}else if( $thumbnail_types == "Video" ){
			
			$video_link = get_post_meta( $post_id, 'post-option-inside-thumbnail-video', true); 
			echo '<div class="blog-thumbnail-video">';
			echo get_video($video_link, cp_get_width($item_size), cp_get_height($item_size));
			echo '</div>';
			
		}else if ( $thumbnail_types == "Slider" ){

			$slider_xml = get_post_meta( $post_id, 'post-option-inside-thumbnail-xml', true); 
			$slider_xml_dom = new DOMDocument();
			$slider_xml_dom->loadXML($slider_xml);
			
			echo '<div class="blog-thumbnail-slider">';
			echo print_flex_slider($slider_xml_dom->documentElement, $item_size);
			echo '</div>';			
		
		}	
		
	}
	
	// print blog full thumbnail type
	function print_blog_full( $item_class, $item_size, $item_index, $num_excerpt, $full_content = "No" ){
		
		wp_reset_query();
		
		global $blog_div_size_num_class, $item_type, $sidebar, $paged, $item_xml;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// get the item class and size from array
        $item_type = '1/1 Full Thumbnail';
		$full_content = find_xml_value($item_xml, 'show-full-blog-post');
		
		if( $sidebar == "no-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $blog_div_size_num_class[$item_type]['size2'];
		}else{
			$item_size = $blog_div_size_num_class[$item_type]['size3'];
		}
		
		if( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
													$item_size = "745x350";
												}else if( $sidebar == "both-sidebar" ){
													$item_size = "560x200";
												}else{
													$item_size = "1170x350";
												} 
				
		// get the blog meta value		
        $header = find_xml_value($item_xml, 'header');
		$num_fetch = find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = find_xml_value($item_xml, 'num-excerpt');
		
		$category = find_xml_value($item_xml, 'category');
		$category = ( $category == 'All' )? '': $category;
		if( !empty($category) ){
			$category_term = get_term_by( 'name', $category , 'category');
			$category = $category_term->slug;
		}

		// Query Posts
          
		  
			$args = array(
			'post_type'=>'post',
							'posts_per_page'=>$num_fetch, 
							'paged'=>$paged,
							'category_name'=>$category,
			'tax_query' => array(
					array( 'taxonomy' => 'post_format',
						  'field' => 'slug',
						  'terms' => array('post-format-video'),
						  'operator' => 'NOT IN',
						   )
					)
			);

			query_posts( $args );
			
		?>
		

<!-- Start of Blog Section -->
 <article class="blog-post">
    <div class="widget-bg"> 
<?php
                   $post_id = get_the_ID();
                   $thumbnail_types = get_post_meta( $post_id, 'post-option-inside-thumbnail-types', true);
                   $thumbnail_id = get_post_thumbnail_id( $post_id );
                   $thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
                  ?>


      <?php while( have_posts() ){ the_post();
                     ?>
      <!--BLOG POST START-->
       <figure id="post-<?php the_ID(); ?>" <?php post_class('wrap-blog-post mbtm2'); ?>>
        <div class="thumb"> <?php '<a href="' . get_permalink() . '">' . print_blog_thumbnail( get_the_ID(), $item_size ). '</a>'; ?> </div>
        <div class="text">
          <h2 class="post-title"><?php echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>'; ?></h2>
          <?php if ($full_content == 'No' ) { ?>
              <div class="blog-content">
                <p> <?php echo  mb_substr( get_the_excerpt(), 0, '300' ) ;	?> </p>
              </div>
              <?php }else { ?>
              <div class="blog-content"><?php echo the_content(); 
                           wp_link_pages( array(
                            'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
                            'after'       => '</div>',
                            'link_before' => '<span>',
                            'link_after'  => '</span>',
                            ) );
                           ?></div>
              <?php } ?>
              <?php print_post_meta(); ?>
        </div>
      
      <!--BLOG POST END--> 
    
</figure>
<?php } ?>

</div>
  </article>
<?php if( find_xml_value($item_xml, "pagination") == "Yes" ){
                    echo ' <div class="pagination">';
                   			 pagination();
                    echo '</div>';
                }	
                ?>

<!-- End of Blog Section-->
<?php } ?>
