<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?>>

<?php
	$webnus_options = webnus_options();
	$post_format = get_post_format(get_the_ID());
	if( !$post_format ) $post_format = 'standard';
	$content = get_the_content();
	if( !$post_format ) $post_format = 'standard';	
	$webnus_options['webnus_blog_featuredimage_enable'] = isset( $webnus_options['webnus_blog_featuredimage_enable'] ) ? $webnus_options['webnus_blog_featuredimage_enable'] : '';
	if(  $webnus_options['webnus_blog_featuredimage_enable'] ) {
	
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
			get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full' ) ); 
		}
	} ?>

<br> <?php
	$webnus_options['webnus_blog_posttitle_enable'] = isset( $webnus_options['webnus_blog_posttitle_enable'] ) ? $webnus_options['webnus_blog_posttitle_enable'] : '';
	if( $webnus_options['webnus_blog_posttitle_enable'] ) { 
		if( ('aside' != $post_format ) && ('quote' != $post_format)  ) { 	
			if( 'link' == $post_format ) {
				preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
				$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
				$link ='';
				if(isset($matches) && is_array($matches)) $link = $matches[0]; ?>
			<h3><a href="<?php echo esc_url($link); ?>"><?php the_title() ?></a></h3> <?php
			} else { ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3> <?php
			}
		}
	} ?>

	<div class="postmetadata">
		<?php
		$webnus_options['webnus_blog_meta_date_enable'] = isset( $webnus_options['webnus_blog_meta_date_enable'] ) ? $webnus_options['webnus_blog_meta_date_enable'] : '';
		if($webnus_options['webnus_blog_meta_date_enable']) { ?>
		<h6 class="blog-date"><?php the_time('d M Y') ?> </h6>
		<?php }
		$webnus_options['webnus_blog_meta_author_enable'] = isset( $webnus_options['webnus_blog_meta_author_enable'] ) ? $webnus_options['webnus_blog_meta_author_enable'] : '';
		if( 1 == $webnus_options['webnus_blog_meta_author_enable'] ) { ?>	
		<h6 class="blog-author"><strong><?php esc_html_e('by','webnus_framework'); ?></strong> <?php the_author_posts_link(); ?> </h6>
		<?php }
		$webnus_options['webnus_blog_meta_category_enable'] = isset( $webnus_options['webnus_blog_meta_category_enable'] ) ? $webnus_options['webnus_blog_meta_category_enable'] : '';
		if( 1 == $webnus_options['webnus_blog_meta_category_enable'] ) { ?>
		<h6 class="blog-cat"><strong><?php esc_html_e('in','webnus_framework'); ?></strong> <?php the_category(', ') ?> </h6>
		<?php }
		$webnus_options['webnus_blog_meta_comments_enable'] = isset( $webnus_options['webnus_blog_meta_comments_enable'] ) ? $webnus_options['webnus_blog_meta_comments_enable'] : '';
		if( 1 == $webnus_options['webnus_blog_meta_comments_enable'] ) { ?>
		<h6 class="blog-comments"><strong> - </strong> <?php comments_number(  ); ?> </h6>
		<?php } ?>
	</div>

	<p> <?php 
		$webnus_options['webnus_blog_excerptfull_enable'] = isset( $webnus_options['webnus_blog_excerptfull_enable'] ) ? $webnus_options['webnus_blog_excerptfull_enable'] : '';
		if( 0 == $webnus_options['webnus_blog_excerptfull_enable']  ) {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			the_excerpt();
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} 
		else {
			if( 'quote' == $post_format  ) echo '<blockquote>';
			echo apply_filters('the_content',$content);
			if( 'quote' == $post_format  ) echo '</blockquote>';
		} ?>
	</p>

	<hr class="vertical-space1">
</article>