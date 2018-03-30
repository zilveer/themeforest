<div class="col-md-6 blg-typ3">
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blgtyp3'); ?>>

<?php
	$webnus_options = webnus_options();
	$webnus_options['webnus_blog_featuredimage_enable'] = isset( $webnus_options['webnus_blog_featuredimage_enable'] ) ? $webnus_options['webnus_blog_featuredimage_enable'] : '';
	$featured_enable = $webnus_options['webnus_blog_featuredimage_enable'];
	$post_format = get_post_format(get_the_ID());
	if(!$post_format) $post_format = 'standard';
	$content = get_the_content();
	global $featured_video;
	$meta_video = $featured_video->the_meta();
?>

<?php // Post Thumbnail
if( !empty($featured_enable) && $post_format != 'aside' && $post_format != 'quote' && $post_format != 'link' && (has_post_thumbnail() || !empty($meta_video))) { ?>
	 <div class="blg-typ3-thumb">
		<?php if($post_format  == 'video' || $post_format == 'audio') {
					$pattern = '\\[' . '(\\[?)' . "(video|audio)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
					preg_match('/'.$pattern.'/s', $post->post_content, $matches);
					if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))) {
					$video = $matches[0];
					echo do_shortcode($video);
					$content = preg_replace('/'.$pattern.'/s', '', $content);
					} elseif( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) ) {
					echo do_shortcode($meta_video['the_post_video']);
					}
			} elseif( 'gallery'  == $post_format) {
					$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
					preg_match('/'.$pattern.'/s', $post->post_content, $matches);
					if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
					$ids = (shortcode_parse_atts($matches[3]));				
					if(is_array($ids) && isset($ids['ids'])) { $ids = $ids['ids']; }
					echo do_shortcode('[vc_gallery img_size= "420x280" type="flexslider_slide" interval="3" images="'.$ids.'" onclick="link_image" custom_links_target="_self"]');
					$content = preg_replace('/'.$pattern.'/s', '', $content);}
			} else {
					get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog3_thumb' ) ); }
		?>
		<br>
	</div>
	<div class="blg-typ3-content">
<?php } else { ?>
	<div class="blg-typ3-inner">
<?php } ?>
		
			
<h6 class="blog-date"><?php the_time('F d, Y') ?></h6>
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
				}
			}
		}
		?>

	<?php // Post Content
		if($post_format == 'quote' ) echo '<blockquote>';
		$webnus_options['webnus_blog_excerptfull_enable'] = isset( $webnus_options['webnus_blog_excerptfull_enable'] ) ? $webnus_options['webnus_blog_excerptfull_enable'] : '';
		if($webnus_options['webnus_blog_excerptfull_enable']){
			apply_filters('the_content',$content);}
		else{
			echo '<p>'.webnus_excerpt(36).'</p>';}
		if($post_format == 'quote') echo '</blockquote>';
		if($post_format == ('quote') || $post_format == 'aside' )
			echo '<a class="readmore" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__('View Post', 'webnus_framework') . '</a>';
	?>
	
	 <div class="postmetadata">
		<?php
		$webnus_options['webnus_blog_meta_author_enable'] = isset( $webnus_options['webnus_blog_meta_author_enable'] ) ? $webnus_options['webnus_blog_meta_author_enable'] : '';
		if($webnus_options['webnus_blog_meta_author_enable']){ ?>	
		<h6 class="blog-author"><?php esc_html_e('by','webnus_framework'); ?> <?php the_author_posts_link(); ?> </h6>
		<?php }
		$webnus_options['webnus_blog_meta_category_enable'] = isset( $webnus_options['webnus_blog_meta_category_enable'] ) ? $webnus_options['webnus_blog_meta_category_enable'] : '';
		if( 1 == $webnus_options['webnus_blog_meta_category_enable'] ) { ?>
		<h6 class="blog-cat"><?php esc_html_e('in','webnus_framework'); ?> <?php the_category(', ') ?> </h6>
		<?php } ?>

	 </div>
		
	</div>
<hr class="vertical-space1">
</article></div>