<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blgtyp2'); ?>>

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
	 <div class="col-md-5 alpha">
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
					echo do_shortcode('[vc_gallery img_size= "420x330" type="flexslider_slide" interval="3" images="'.$ids.'" onclick="link_image" custom_links_target="_self"]');
					$content = preg_replace('/'.$pattern.'/s', '', $content);}
			} else {
					get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb' ) ); }
		?>
	</div>
	<div class="col-md-7 omega">
<?php } else { ?>
	<div class="col-md-12 omega">
<?php } ?>
	


<?php // Post Title
$webnus_options['webnus_blog_posttitle_enable'] = isset( $webnus_options['webnus_blog_posttitle_enable'] ) ? $webnus_options['webnus_blog_posttitle_enable'] : '';
if( $webnus_options['webnus_blog_posttitle_enable'] && $post_format !='aside' && $post_format !='quote') { 	
	if( 'link' == $post_format ) {
		preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
		$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
		$link ='';
		if(isset($matches) && is_array($matches)) $link = $matches[0]; ?>
			<h3><a href="<?php echo esc_url($link); ?>"><?php the_title() ?></a></h3>
	<?php }	else { ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
	<?php }
} ?>

	<?php // Post Content
		if($post_format == 'quote' ) echo '<blockquote>';
		$webnus_options['webnus_blog_excerptfull_enable'] = isset( $webnus_options['webnus_blog_excerptfull_enable'] ) ? $webnus_options['webnus_blog_excerptfull_enable'] : '';
		if($webnus_options['webnus_blog_excerptfull_enable']){
			apply_filters('the_content',$content);}
		else{
			$webnus_options['webnus_blog_excerpt_list'] = isset( $webnus_options['webnus_blog_excerpt_list'] ) ? $webnus_options['webnus_blog_excerpt_list'] : '';
			echo '<p>'.webnus_excerpt(($webnus_options['webnus_blog_excerpt_list'])?$webnus_options['webnus_blog_excerpt_list']:35).'</p>';
			$webnus_options['webnus_blog_readmore_text'] = isset( $webnus_options['webnus_blog_readmore_text'] ) ? $webnus_options['webnus_blog_readmore_text'] : '';
			echo '<br><a class="readmore" href="' . get_permalink($post->ID) . '">' . esc_html($webnus_options['webnus_blog_readmore_text']) . '</a>';
			}
		if($post_format == 'quote') echo '</blockquote>';
		if($post_format == ('quote') || $post_format == 'aside' )
			echo '<a class="readmore" href="'. get_permalink( get_the_ID() ) . '">' . esc_html__('View Post', 'webnus_framework') . '</a>';
	?>
		
	<div class="postmetadata">
	<h6 class="blog-date"><?php the_time('F d, Y') ?> - </h6>
<h6 class="blog-author"><?php esc_html_e('by','webnus_framework'); ?> <?php the_author_posts_link(); ?> </h6>
<h6 class="blog-cat"><?php esc_html_e('in','webnus_framework'); ?> <?php the_category(', ') ?> </h6>
	 </div>
	</div>
<hr class="vertical-space1">
</article>