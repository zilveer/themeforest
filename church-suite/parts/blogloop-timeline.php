<?php
	get_header();
	$webnus_options = webnus_options();
	global $last_time;
	global $i;
	global $flag;
	$post_format = get_post_format(get_the_ID());	
	$content = get_the_content();	
	
	if( !$post_format ) $post_format = 'standard';			
	if(($last_time != date(' F Y',strtotime($post->post_date)) ) || $i==1)
	{
		$last_time = date(' F Y',strtotime($post->post_date));
		echo '<div class="tline-topdate">'.  date(' F Y',strtotime($post->post_date)) .'</div>';
		if( $i>1 ) $flag = true;
	}
?>
		<article id="post-<?php the_ID(); ?>"  class="tline-box <?php if(($i%2)==0 && $flag) { $flag = false; $i++; } elseif( ($i%2)==0 ) echo ' rgtline'; ?>"> <span class="tline-row-<?php if(($i%2)==0) echo 'r'; else echo 'l'; ?>"></span>
		<div class="tline-author-box">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
		<h6 class="tline-author">
		<?php the_author_posts_link(); ?>
		</h6>
		<h6 class="tline-date"><?php esc_html_e('Posted at: ','webnus_framework'); ?><?php echo get_the_date('d M Y');?> </h6>
		</div>
		 <?php
		 $webnus_options['webnus_blog_featuredimage_enable'] = isset( $webnus_options['webnus_blog_featuredimage_enable'] ) ? $webnus_options['webnus_blog_featuredimage_enable'] : '';
		if(  $webnus_options['webnus_blog_featuredimage_enable'] ){
	
		global $featured_video;
		
		$meta_video = $featured_video->the_meta();
		
		if( 'video'  == $post_format || 'audio'  == $post_format)
		{
			
			$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			
			
			if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2])))
			{
				$video = $matches[0];
				
				echo do_shortcode($video);
				
				$content = preg_replace('/'.$pattern.'/s', '', $content);
				
			}else				
			if( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) )
			{
				echo do_shortcode($meta_video['the_post_video']);
			}
				
	
			
			
		}else
		if( 'gallery'  == $post_format)
		{
			
						
			$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			
			
			if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2])))
			{
				
				$ids = (shortcode_parse_atts($matches[3]));
				
				if(is_array($ids) && isset($ids['ids']))
					$ids = $ids['ids'];
				echo do_shortcode('[vc_gallery onclick="link_no" img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'"  custom_links_target="_self"]');
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			}
				
	
			
			
		}else
	
		
			get_the_image( array( 'meta_key' => array( 'Thumbnail', 'Thumbnail' ), 'size' => 'blog2_thumb' )  ); 
	}
		
		?> <br>
          <div class="tline-ecxt">
		  
		    <?php
		    $webnus_options['webnus_blog_meta_category_enable'] = isset( $webnus_options['webnus_blog_meta_category_enable'] ) ? $webnus_options['webnus_blog_meta_category_enable'] : '';
		    if(  $webnus_options['webnus_blog_meta_category_enable'] ):?>
			<h6 class="blog-cat-tline"> <?php the_category('- ') ?></h6>
			<?php endif; ?>
			
      <?php
	  	$webnus_options['webnus_blog_posttitle_enable'] = isset( $webnus_options['webnus_blog_posttitle_enable'] ) ? $webnus_options['webnus_blog_posttitle_enable'] : '';
		if(  $webnus_options['webnus_blog_posttitle_enable'] ) { 
			if( ('aside' != $post_format ) && ('quote' != $post_format)  ) { 	
				if( 'link' == $post_format ) { 
				 preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
				 $content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
				 $link ='';
				if(isset($matches) && is_array($matches))
				$link = $matches[0];	
			?>
			<h4><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h4>
		<?php
		}else{
	  ?>
	  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	  <?php } } } ?>
          
		

          </div><p>
          <?php 
		  add_filter( 'excerpt_more', '__return_false' );
		  $webnus_options['webnus_blog_excerptfull_enable'] = isset( $webnus_options['webnus_blog_excerptfull_enable'] ) ? $webnus_options['webnus_blog_excerptfull_enable'] : '';
	  if( 0 == $webnus_options['webnus_blog_excerptfull_enable']  )
		{
			if( 'quote' == $post_format  ) echo '<blockquote>';
			
			echo webnus_excerpt(36);
			
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} 
	  else
	  	{
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo apply_filters('the_content',$content);
			if( 'quote' == $post_format  ) echo '</blockquote>';
		}


 ?>
		  </p>

           <?php
           $webnus_options['webnus_blog_meta_comments_enable'] = isset( $webnus_options['webnus_blog_meta_comments_enable'] ) ? $webnus_options['webnus_blog_meta_comments_enable'] : '';
             if( 1 == $webnus_options['webnus_blog_meta_comments_enable'] ) {
            ?>
          <div class="blog-com-sp"> <?php comments_popup_link(esc_html__('No Comments','webnus_framework') . ' &#187;', esc_html__('1 Comment','webnus_framework').' &#187;', esc_html__('% Comments','webnus_framework').' &#187;'); ?></div>
          <?php } ?>
        </article>
		<?php 
			$i++;
		?>