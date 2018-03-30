<?php
/**
 * The template used for displaying page content
 *
 *
 * @package WordPress
 * @subpackage Mtheme
 * @since Mtheme 1.0
 */
 	
$unique_id="post_".get_the_ID();;
$type=MthemeCore::getPostMeta(get_the_ID(),"post_type","image");
$prePost="post_";
$post_content=get_the_excerpt();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content clearfix">
		
		<?php if($type=='slider') { 
		$category=MthemeCore::getPostMeta(get_the_ID(),$prePost."gallery_cat","");
		echo do_shortcode('[carousel_slider category="'.$category.'"]'); ?>
		<?php  } elseif($type=='audio') { 
		$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."audio_url","https://api.soundcloud.com/tracks/145175216"); ?>
		<iframe class="audio-frame"  src="https://w.soundcloud.com/player/?url=<?php echo esc_url($url); ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=true&amp;visual=true"></iframe>		
		<?php } elseif($type=='html5video') {					
		$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."html_5_url",CHILD_URI."site/video.mp4");
		?>
		<video class="html5video-post" controls>
			<source src="<?php echo esc_url($url); ?>" type="video/mp4">
			<source src="<?php echo esc_url($url); ?>" type="video/ogg">
			your browser does not support HTML5 
		</video>
		<?php } elseif($type=='vimeo') {
		$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."vimeo_url","http://player.vimeo.com/video/75976293");
		?>
		<div class="video">
			<iframe src="<?php echo esc_url($url); ?>" class="venoframe figlio"></iframe>
		</div>		
		<?php } elseif($type=='youtube') {
		$url=MthemeCore::getPostMeta(get_the_ID(),$prePost."youtube_url","Cg4lEyWlm28");		
		?>
		<div class="venoframe">
			<iframe class="html5video" src="http://www.youtube.com/embed/<?php echo esc_attr($url); ?>"></iframe>
		</div>		
		<?php } else { if(has_post_thumbnail()) { ?>
		<div class="post-image"><?php the_post_thumbnail('extended'); ?></div>	
		<?php } }?>
		<div class="author-cmp-detail clearfix">
			<div class="author-img col-lg-2 col-md-2 col-sm-12 col-xs-12 clearfix">
				<?php echo get_avatar( get_the_author_meta( 'ID' ),90); ?>
			</div>
			<div class="author-name col-lg-10 col-md-10 col-sm-12 col-xs-12 clearfix">
				<h3 class="h3-30 notopmargin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>		
				<p class="author-title"><span>by </span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a></p>		
			</div>			
		</div>				
		<p class="blog-text">
		<?php echo mtheme_html_content(MthemeCore::getPostMeta(get_the_ID(),$prePost."overview",$post_content)); ?></p>
		<a class="learn-more-btn text-center btn-effect wow animated fadeIn animated" href="<?php echo esc_url(get_permalink()); ?>">read more</a>
		<div class="post-footer clearfix">
			<span class="date"><?php echo esc_attr(get_the_date('M j, Y')); ?></span>
			<span class="category">
			<?php if(has_category()) { ?><?php the_category(', '); } ?></span>			
		</div>
	</div>
</article>