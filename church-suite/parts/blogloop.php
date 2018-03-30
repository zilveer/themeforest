<?php
	$post_thumb = (!has_post_thumbnail())? 'post-no-image':'';
	$classes = array(
		'blog-post',
		'blgtyp1',
		$post_thumb,
	);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
<div class="blog-mtdt-lft">
<h6 class="blog-date-d"><?php the_time('d') ?></h6>
<h6 class="blog-date-my"><?php the_time('M Y') ?></h6>
</div>
<div class="blog-inner-cs">
	<?php
	$webnus_options = webnus_options();
	$post_format = get_post_format(get_the_ID());
	$content = get_the_content();
	if( !$post_format ) $post_format = 'standard';

	$webnus_options['webnus_blog_featuredimage_enable'] = isset( $webnus_options['webnus_blog_featuredimage_enable'] ) ? $webnus_options['webnus_blog_featuredimage_enable'] : '';
	if( $webnus_options['webnus_blog_featuredimage_enable'] ) {
		global $featured_video;
		$meta_video = !empty($featured_video)?$featured_video->the_meta():null;
		// video post type
		if( 'video'  == $post_format || 'audio'  == $post_format) {
			$pattern = '\\[' .'(\\[?)' ."(video|audio)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))) {
				$video = $matches[0];
				echo do_shortcode($video);
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			} else if( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) ) {
				echo do_shortcode($meta_video['the_post_video']);
			}
		// gallery post type
		} else if( 'gallery'  == $post_format) {		
			$pattern = '\\[' .'(\\[?)' ."(gallery)" .'(?![\\w-])' .'(' .'[^\\]\\/]*' .'(?:' .'\\/(?!\\])' .'[^\\]\\/]*' .')*?' .')' .'(?:' .'(\\/)' .'\\]' .'|' .'\\]' .'(?:' .'(' .'[^\\[]*+' .'(?:' .'\\[(?!\\/\\2\\])' .'[^\\[]*+' .')*+' .')' .'\\[\\/\\2\\]' .')?' .')' .'(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			
			if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
				$ids = (shortcode_parse_atts($matches[3]));
				if(is_array($ids) && isset($ids['ids'])) $ids = $ids['ids'];
				echo do_shortcode('[vc_gallery onclick="link_no" img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'"  custom_links_target="_self"]');
				$content = preg_replace('/'.$pattern.'/s', '', $content);
			}	
		} else {
			if(has_post_thumbnail()){
				get_the_image(array('meta_key' => array( 'Full', 'Full' ), 'size' => 'Full')); 
			}else{
				$webnus_options['webnus_no_image'] = isset( $webnus_options['webnus_no_image'] ) ? $webnus_options['webnus_no_image'] : '';
				if($webnus_options['webnus_no_image']){
					$no_image_src = isset( $webnus_options['webnus_no_image_src']['url'] ) ? $webnus_options['webnus_no_image_src']['url'] : get_template_directory_uri() . '/images/no_image.jpg';					
					echo '<img alt="'.get_the_title().'" width="756" height="443" src="'.$no_image_src.'">';
				}
			}
		}
	} ?> 
	<div class="col-md-12 omega alpha">
		<div class="blgt1-top-sec">
		<?php
		if(function_exists('wp_review_show_total')){wp_review_show_total(true, 'review-total-only small-thumb');}
			$webnus_options['webnus_blog_posttitle_enable'] = isset( $webnus_options['webnus_blog_posttitle_enable'] ) ? $webnus_options['webnus_blog_posttitle_enable'] : '';
			if(  $webnus_options['webnus_blog_posttitle_enable'] ) { 
				if( ('aside' != $post_format ) && ('quote' != $post_format)  ) { 	
					if( 'link' == $post_format ) {
						preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
						$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
						$link ='';
						if(isset($matches) && is_array($matches)) $link = $matches[0]; ?>
						<h3><a href="<?php echo esc_url($link); ?>"><?php the_title() ?></a></h3> <?php
					} else { ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3> <?php
		}}}?>
		</div>
		<div class="postmetadata">
<h6 class="blog-author"><i class="fa-user"></i><?php the_author_posts_link(); ?> </h6>
<h6 class="blog-cat"><i class="fa-folder-open"></i> <?php the_category(', ') ?> </h6>
		<h6 class="blog-comments"><i class="fa-comments"></i> <?php comments_number(  ); ?> </h6>
	  </div>
	<div class="blgt1-inner">
 <?php  
	$webnus_options['webnus_blog_excerptfull_enable'] = isset( $webnus_options['webnus_blog_excerptfull_enable'] ) ? $webnus_options['webnus_blog_excerptfull_enable'] : '';
	  if( 0 == $webnus_options['webnus_blog_excerptfull_enable']  ) {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo '<p>';
			$webnus_options['webnus_blog_excerpt_large'] = isset( $webnus_options['webnus_blog_excerpt_large'] ) ? $webnus_options['webnus_blog_excerpt_large'] : '';
			echo webnus_excerpt(($webnus_options['webnus_blog_excerpt_large'])?$webnus_options['webnus_blog_excerpt_large']:93);
			$webnus_options['webnus_blog_readmore_text'] = isset( $webnus_options['webnus_blog_readmore_text'] ) ? $webnus_options['webnus_blog_readmore_text'] : '';
			echo '... <br><br><a class="readmore" href="' . get_permalink($post->ID) . '">' . esc_html($webnus_options['webnus_blog_readmore_text']) . '</a>';
			echo '</p>';
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} else {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo apply_filters('the_content',$content);
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} ?>
	    </div>

	</div>
	<hr class="vertical-space1">
	</div>
</article>