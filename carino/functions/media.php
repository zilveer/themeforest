<?php

/**
* Medias Functions . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/**
* Get Gallery photos id's
************************************************************/
add_action( 'wp', 'van_get_gallery_ids' );
function van_get_gallery_ids( $post ) {
	$attachment_ids = array();
	$pattern 	        = get_shortcode_regex();
	if (  isset( $post->post_content ) && preg_match_all( "/". $pattern . "/s", $post->post_content, $matches ) ) 
	{
		 $count = count($matches[3]);  
		for ($i = 0; $i < $count; $i++)
		{
			$atts = shortcode_parse_atts( $matches[3][$i] );
			if ( isset( $atts['ids'] ) )  $attachment_ids = explode( ',', $atts['ids'] );
		}
	}

	return $attachment_ids;
}

/*
* Remove Gallery shortcode from contents
********************************************/

function van_remove_gellery($atts) {
    return "";
}

/**
* Embed Code
*****************************************/
function van_embed_code( $src, $width, $height, $style = "", $fullscreen = "allowfullscreen" ){

	return '<iframe src="' . $src . '" width="'.$width.'" height="'.$height.'" ' . $fullscreen . '  style="border:0 !important;' . $style . '"></iframe>';
}
/**
* Video functions
************************************************************/

// Videos Pattern

function van_video_pattern($pattern){
	$output = "";
	switch ($pattern) {
		case 'ytube_url':
			$output  = '#(?:https?(?:a|vh?)?://)?(?:www\.)?youtube(?:\-nocookie)?\.com/watch\?.*v=([A-Za-z0-9\-_]+)#'; 
			break;
		case 'ytube_short':
			$output  = '#(?:https?(?:a|vh?)?://)?youtu\.be/([A-Za-z0-9\-_]+)#'; 
			break;
		case 'ytube_embed':
			$output  = '#https?://www\.youtube(?:\-nocookie)?\.com/embed/([A-Za-z0-9\-_]+)#'; 
			break;
		case 'vimeo_url':
			$output  = '#(?:http://)?(?:www\.)?vimeo\.com/([A-Za-z0-9\-_]+)#'; 
			break;
		case 'vimeo_embed':
			$output  = '#http://player\.vimeo\.com/video/([0-9]+)#'; 
			break;
		case 'daily_url':
			$output  = '#(?:https?://)?(?:www\.)?dailymotion\.com/video/([A-Za-z0-9]+)#'; 
			break;
		case 'daily_embed':
			$output  = '#https?://www\.dailymotion\.com/embed/video/([A-Za-z0-9]+)#'; 
			break;
		case 'blip':
			$output  = '#(?:http://)?(?:www\.)?blip\.tv/play/([A-Za-z0-9+_]+)#'; 
			break;
	}
	return $output;
}

// embed video from url

function van_video_embed_url( $width = 620, $height = 330, $video ){

	$output = "";

	if (preg_match(van_video_pattern("ytube_url"), $video, $match) || preg_match(van_video_pattern("ytube_short"), $video, $match) || preg_match(van_video_pattern("ytube_embed"), $video, $match)) {
	
		$output = van_embed_code('http://www.youtube.com/embed/'.$match[1].'?rel=0&amp;theme=dark&amp;showinfo=0&amp;disablekb=0&amp;modestbranding=1&amp;hd=0&amp;autohide=1&amp;wmode=transparent', $width, $height);
	
	}elseif (preg_match(van_video_pattern("vimeo_url"), $video, $match) || preg_match(van_video_pattern("vimeo_embed"), $video, $match)) {
	
		$output = van_embed_code('http://player.vimeo.com/video/'.$match[1].'?title=0&amp;byline=0&amp;portrait=0', $width, $height);
	
	}elseif (preg_match(van_video_pattern("daily_url"), $video, $match) || preg_match(van_video_pattern("daily_embed"), $video, $match)) {
	
		$output = van_embed_code('http://www.dailymotion.com/embed/video/'.$match[1], $width, $height, '', '');
	
	}elseif (preg_match(van_video_pattern("blip"), $video, $match)) {

		$output = van_embed_code('http://blip.tv/play/'.$match[1].'.x?p=1', $width, $height );
	
	}

	return ( "" != $output ) ? $output : false;
}

// embed video from code


function van_video_embed_code( $width=620, $height=330, $video = "" ){
	
	$pattern   = array();
	$replace   = array();
	$pattern[] = '/width="([0-9]+)"/';
	$pattern[] = '/width:([0-9]+)/';
	$pattern[] = '/height="([0-9]+)"/';
	$pattern[] = '/height:([0-9]+)/';
	$replace[] = 'width="' . $width . '"';
	$replace[] = 'width:' . $width;
	$replace[] = 'height="' . $height . '"';
	$replace[] = 'height:' . $width;

	$output = preg_replace( $pattern, $replace, $video );

	return ( "" != $video ) ? $output : false;
}

/**
*  Self Hosted Video
**********************************************************/
function van_self_hosted_video( $width = 620, $height = 330 ){
	global $post;

	$mp4_video     = get_post_meta( $post->ID,'van_video_mp4',true );
	$webm_video   = get_post_meta( $post->ID,'van_video_webm',true );
	$ogv_video      = get_post_meta( $post->ID,'van_video_ogv',true );
	$video_poster = get_post_meta($post->ID, 'van_video_poster', true);

	$poster           = $video_poster ? $video_poster  : van_post_thumbnail( array($width, $height) );

	if ( !$mp4_video || !$webm_video || !$ogv_video ) {
		return false;
	}
	?>
		<video width="<?php echo $width; ?>" height="<?php echo $height; ?>" id="player2" style="background: transparent url(<?php echo esc_url( $poster ); ?>) no-repeat;" controls="controls" preload="none">
			
			<?php if ( $mp4_video ): ?>
				<source type="video/mp4" src="<?php echo esc_url( $mp4_video ); ?>" />
			<?php endif; ?>

			<?php if ( $webm_video ): ?>
				<source type="video/webm" src="<?php echo esc_url( $webm_video ); ?>" />
			<?php endif; ?>

			<?php if ( $ogv_video ): ?>
				<source type="video/ogg" src="<?php echo esc_url( $ogv_video ); ?>" />
			<?php endif; ?>

		</video>
	<?php

	wp_enqueue_style( 'wp-mediaelement' );
 	wp_enqueue_script( 'wp-mediaelement' );
}

/**
* Audio Format
************************************************************/

function van_self_hosted_audio(){

	global $post;

	$mp3_audio = get_post_meta( $post->ID,'van_audio_mp3',true );
	$ogg_audio  = get_post_meta( $post->ID,'van_audio_ogg',true );
	$wav_audio = get_post_meta( $post->ID,'van_audio_wav',true );
	
	if ( !$mp3_audio && !$ogg_audio && !$wav_audio ) {
		return false;
	}

	?>
		<audio id="player2" controls="controls">
			<?php if ( $mp3_audio ): ?>
				<source type="audio/mpeg" src="<?php echo esc_url( $mp3_audio ); ?>" />
			<?php endif; ?>
			<?php if ( $ogg_audio ): ?>
				<source type="audio/ogg" src="<?php echo esc_url( $ogg_audio ); ?>" />
			<?php endif; ?>
			<?php if ( $wav_audio ): ?>
				<source type="audio/wav" src="<?php echo esc_url( $wav_audio ); ?>" />
			<?php endif; ?>
		</audio>
	<?php

	wp_enqueue_style( 'wp-mediaelement' );
 	wp_enqueue_script( 'wp-mediaelement' );
}

/**
* Post thumbnail
************************************************************/

// Get thumbnail link
function van_post_thumbnail( $size, $id = "" ){
	global $post;

	if( isset($id) && $id != "" ){
		$img 	= wp_get_attachment_image_src($id,$size); 
		return $img[0];
	}
	elseif ( has_post_thumbnail( $post->ID ) ) {
		$img_id = get_post_thumbnail_id($post->ID); 
		$img 	= wp_get_attachment_image_src($img_id,$size); 
		return $img[0];
	}
}

// Get thumbnail
function van_thumb( $width, $height, $image=null ){
	global $post;

	if ( $image !== null ) {
		$thumb = apply_filters( 'post_thumbnail_html', wp_get_attachment_image( $image,  array($width, $height), false, '' ), $post->ID, $image, array($width, $height), '' );
		echo $thumb;
	}else{
		the_post_thumbnail( array($width, $height) );
	}
	
}

/**
* Images Sizes
****************************************/
function van_get_img_size(){

	$size = array(
			"image" => array("width" => 620,"height"=> 330),
			"video" => array("width" => 620,"height"=> 348)
		);

	if ( is_singular() ) {
		
		if ( van_sidebar_layout() == "full-width" ) {
			$size["image"]["width"]  = 940;
			$size["image"]["height"] = 510;
			$size["video"]["width"]  = 940;
			$size["video"]["height"] = 529;
		}
	}else{

		$pageType = van_page_type();

		if ( "two_col_sid" == van_get_option('post_layout') || "three_col_full" == van_get_option('post_layout') ) {
			
			$size["image"]["width"] = 300;
			$size["image"]["height"] = 320;
			$size["video"]["width"]  = 300;
			$size["video"]["height"] = 169;

		}elseif ( "two_col_full" == van_get_option('post_layout') ) {
			
			$size["image"]["width"] = 460;
			$size["image"]["height"] = 330;
			$size["video"]["width"]  = 460;
			$size["video"]["height"] = 259;

		}
	}
	return $size;
}

/**
*	SoundCloud embed
***********************************************************/

function van_soundcloud_embed($url, $auto_play='false' ) {
	echo van_embed_code('https://w.soundcloud.com/player/?url='.$url.'&amp;color=ff6600&amp;auto_play='.$auto_play.'&amp;show_artwork=true', '468', '166', 'width:100%!important;overflow:hidden;');
}


/**
* Post Media
****************************************/

// audio format

function van_format_audio(){

	global $post;

	$soundcloud     = get_post_meta( $post->ID,'van_soundcloud_url',true );
	$audio_embed  = get_post_meta( $post->ID,'van_audio_embed_code',true );
	$audio_mp3     = get_post_meta( $post->ID,'van_audio_mp3',true );
	$audio_ogg      = get_post_meta( $post->ID,'van_audio_ogg',true );
	$audio_wav      = get_post_meta( $post->ID,'van_audio_wav',true );
	$size 	     = van_get_img_size();
	$width 	     = $size["image"]["width"];
	$height 	     = $size["image"]["height"];

	if ( $soundcloud || $audio_embed || $audio_mp3 || $audio_ogg || $audio_wav ) {
		?>
		<div class="entry-media">
			<?php van_thumb($width, $height); ?>
			<div class="media-overlay"></div>
			<?php
			if ( $audio_mp3 || $audio_ogg || $audio_wav ) {
				echo '<div class="player-container">';
					van_self_hosted_audio();
				echo '</div>';
			}elseif ( $soundcloud ) {
				echo '<div class="player-container embed">';
					van_soundcloud_embed( $soundcloud );
				echo '</div>';
			}elseif ( $audio_embed ) {
				echo '<div class="player-container embed">';
					echo $audio_embed;
				echo '</div>';
			}
			?>
		</div><!-- .entry-media -->
		<?php
	}else{ 
	?>
		<div class="no-media"></div>
	<?php
	}
}

// gallery format

function van_format_gallery() {
	
	global $post;
	$size                 = van_get_img_size();
	$attachment_ids = van_get_gallery_ids($post);
	$width  	        = $size["image"]["width"];
	$height               = $size["image"]["height"];

	// Remove Gallery Shortcode
	add_shortcode('gallery', 'van_remove_gellery');

	?>
	<div class="entry-media">
		<div class="gallery-container">
			<div id="gallery-<?php echo $post->ID; ?>" class="flexslider">
				<ul class="slides">

					<?php foreach ($attachment_ids as $id): ?>

						<?php $attachment_meta = get_post($id); ?>
							
						<?php if ( $id ): ?>
							<li>
								<div class="slider-thumb">

									<a data-gal="prettyPhoto[gal]" href="<?php echo  esc_url( van_post_thumbnail( "large", $id ) );  ?>">
										<?php van_thumb( $width , $height , $id );  ?>
										<div class="thumb-overlay"></div>
									</a>
								
								</div>

								<?php if ( isset( $attachment_meta->post_excerpt ) &&  !empty($attachment_meta->post_excerpt) ) : ?>
									
									<div class="gallery-excerpt">
										<?php echo $attachment_meta->post_excerpt; ?>
									</div>

								<?php endif; ?>
							</li>
						<?php endif; ?>

					<?php endforeach; ?>

				</ul>
			</div><!-- #gallery-<?php echo $post->ID; ?>-->
			<script type="text/javascript">
				  jQuery(document).ready(function(){
					  jQuery('#gallery-<?php echo $post->ID; ?>').flexslider({
						animationLoop: true,
						pauseOnHover: true,
						pauseOnAction: false
					  });
				  });
			</script>
		</div><!-- .gallery-container -->
	</div><!-- .entry-media -->
	<?php 
}
			
// image format

function van_format_image() {
	
	if ( has_post_thumbnail() && '' != get_the_post_thumbnail() ){

		$size    = van_get_img_size();
		$width  = $size["image"]["width"];
		$height = $size["image"]["height"];
		?>
			<div class="entry-media">
				
				<?php if ( is_single() ): ?><a data-gal="prettyPhoto" href="<?php echo  esc_url( van_post_thumbnail("large") );  ?>"><?php endif; ?>
					
					<?php van_thumb( $width, $height ); ?>	
				
				<?php if ( is_single() ): ?></a><?php endif; ?>
				
				<?php if( !is_single() ): ?>

					<div class="thumb-overlay"></div>
					<a data-gal="prettyPhoto" href="<?php echo  esc_url( van_post_thumbnail("large") );  ?>"  class="zoom"></a>
					<a  href="<?php the_permalink(); ?>" class="link"></a>
				
				<?php endif; ?>
				
			</div><!-- .entry-media -->

		<?php 
	}else{ 
	?>
		<div class="no-media"></div>
	<?php
	}
}

// quote format

function van_format_quote() {

	global $post;
	$quote_source = get_post_meta( $post->ID,'van_quote_source',true );
	$quote_link     = get_post_meta( $post->ID,'van_quote_link',true );
	$quote             = get_post_meta( $post->ID,'van_quote',true );
	?>

	<?php if ( $quote ) : ?>
		<div class="entry-media">

			<div class="quote-icon">
				<span class="icon-quote"></span>
			</div><!-- .quote-icon -->

			<blockquote>

				<p>
					<?php if ( !is_single() ): ?><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'van' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php endif; ?>
						
						<?php echo $quote; ?>
					
					<?php if ( !is_single() ): ?></a><?php endif; ?>
				</p>
				
				<?php if ( $quote_source ): ?>
					<footer>
						&mdash;
						<?php if ( $quote_link ): ?><a href="<?php echo $quote_link; ?>"><?php endif; ?>
							
							<?php echo $quote_source; ?>

						<?php if ( $quote_link ): ?></a><?php endif; ?>
					</footer>
				<?php endif; ?>
				

			</blockquote><!-- blockquote -->

			</div><!-- .entry-media -->

	<?php endif; ?>

	<?php
}

// video format
function van_format_video() {

	global $post;
	$video_url       = get_post_meta( $post->ID,'van_video_url',true );
	$video_embed  = get_post_meta( $post->ID,'van_video_embed_code',true );
	$video_mp4     = get_post_meta( $post->ID,'van_video_mp4',true );
	$video_webm   = get_post_meta( $post->ID,'van_video_webm',true );
	$video_ogv      = get_post_meta( $post->ID,'van_video_ogv',true );
	$size 	     = van_get_img_size();
	$width 	     = $size["video"]["width"];
	$height 	     = $size["video"]["height"];
	?>

	<?php if ( $video_url || $video_embed || $video_mp4 || $video_webm || $video_ogv ): ?>
		<div class="entry-media">
			<div class="player-container">

				<?php
				if ( $video_url ) {
					
					echo van_video_embed_url( $width, $height, $video_url );

				} elseif ( $video_embed ) {
					
					echo van_video_embed_code( $width, $height, $video_embed );

				} elseif ( $video_mp4 || $video_webm || $video_ogv ) {
					
					van_self_hosted_video( $width, $height );

				}
				?>

			</div>
		</div><!-- .entry-media -->
	<?php else: ?>
		<div class="no-media"></div>
	<?php endif; ?>

	<?php
}

// standard format

function van_format_standard() {

	if ( ( has_post_thumbnail() && '' != get_the_post_thumbnail() && !is_single() ) ||  ( is_single() && van_get_option("featured_img") ) ){

		$size    = van_get_img_size();
		$width  = $size["image"]["width"];
		$height = $size["image"]["height"];

		?>
		<div class="entry-media">

			<?php van_thumb( $width, $height ); ?>
			<div class="thumb-overlay"></div>
			<a data-gal="prettyPhoto" href="<?php echo  esc_url( van_post_thumbnail("large") );  ?>"  class="zoom"></a>
			<a  href="<?php the_permalink(); ?>" class="link"></a>
	
		</div><!-- .entry-media -->

		<?php 
	}else{ 
	?>
		<div class="no-media"></div>
	<?php
	}
}
// status

function van_format_status() {

	global $post;

	$twitter_status= get_post_meta( $post->ID,'van_twstatus',true );
	if ( $twitter_status ) {
		?>
			<div class="twitter-embed">
				<blockquote class="twitter-tweet"><a href="<?php echo esc_url( $twitter_status ); ?>"></a></blockquote>
				<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
			</div>
		<?php
	}
}

// is embed status

function van_is_embed_status(){
	
	global $post;


	if ( get_post_meta( $post->ID,'van_twstatus',true ) ) {
		return true;
	}else{
		return false;
	}
	
}