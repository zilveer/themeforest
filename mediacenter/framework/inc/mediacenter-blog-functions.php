<?php

#-----------------------------------------------------------------
# Blog Related Functions
#-----------------------------------------------------------------

// Get Blog Layout
//...............................................

if ( ! function_exists( 'media_center_blog_layout' ) ) :
	function media_center_blog_layout() {
		return apply_filters( 'mc_get_blog_layout', 'sidebar_right' );
	}
endif;

if ( ! function_exists( 'media_center_blog_fw_density' ) ) :
	function media_center_blog_fw_density() {
		return apply_filters( 'mc_blog_fw_density', 'narrow' );
	}
endif;

if ( ! function_exists( 'media_center_default_post_thumbnail' ) ) :
function media_center_default_post_thumbnail( $post_format ){
	return media_center_post_icon( $post_format, false, true, false );
}
endif;

if ( ! function_exists( 'media_center_blog_style' ) ) :
	function media_center_blog_style() {
		return apply_filters( 'mc_get_blog_style', 'normal' );
	}
endif;

// Get Blog Variables
//...............................................

function media_center_blog_settings() {

	$blog_layout = media_center_blog_layout();

	$full_width_density = media_center_blog_fw_density();

	switch($blog_layout){
		
		case 'sidebar_right';
			$container_class 	= 'container inner-top-xs inner-bottom-xs classic-blog';
			$content_area_class = 'col-md-9 inner-right-sm';
			$sidebar_class 		= 'col-md-3';
			$has_sidebar 		= true;
		break;
		
		case 'sidebar_left';
			$container_class 	= 'container inner-top-xs inner-bottom-xs classic-blog sidebar-left';
			$content_area_class = 'col-md-9 col-md-push-3 inner-left-sm';
			$sidebar_class 		= 'col-md-3 col-md-pull-9';
			$has_sidebar 		= true;
		break;

		case 'without_sidebar';
			$container_class	= 'container inner-top-xs inner-bottom-xs classic-blog no-sidebar';
			$content_area_class	= ( $full_width_density == 'wide' ) ? 'col-md-12' : 'col-md-9 center-block col-xs-12 col-sm-10 col-lg-9';
			$sidebar_class		= '';
			$has_sidebar		= false;
		break;
	}

	return array( 'container_class' => $container_class, 'content_area_class' => $content_area_class, 'has_sidebar' => $has_sidebar, 'sidebar_class' => $sidebar_class );
}

#-----------------------------------------------------------------
# Post Content and Related Functions
#-----------------------------------------------------------------

// Get Post Header
//...............................................

if ( ! function_exists( 'media_center_post_header' ) ) :
function media_center_post_header( $style = 'style-1'){
	if( ! is_blog_layout_grid() && !is_single() ){
		if( $style == 'style-2') {
			printf( '<div class="date-wrapper"><a href="%1$s">%2$s</a></div><!-- /.date-wrapper --><div class="format-wrapper">%3$s</div>',
				get_permalink(),
				media_center_posted_on( true, $style ), 
				media_center_post_icon( get_post_format() , true , true ) 
			);
		} else {
			printf( '<div class="date-wrapper"><a href="%1$s">%2$s</a></div><!-- /.date-wrapper --><div class="format-wrapper">%3$s</div>',
				get_permalink(),
				media_center_posted_on( true ), 
				media_center_post_icon( get_post_format() , true , true ) 
			);
		}
	}
}
endif;

// Get Post Date
//...............................................

if ( ! function_exists( 'media_center_posted_on' ) ) :
function media_center_posted_on( $return = false, $style = 'style-1' ){
	if( $style == 'style-2' ){
		$output = sprintf( '<div class="date"><span class="month">%1$s</span><span class="day">%2$s</span></div>',
			esc_html( get_the_date( 'M' ) ),
			esc_attr( get_the_date( 'd' ) )
		);
	} else {
		$output = sprintf( '<div class="date"><span class="day">%1$s</span><span class="month">%2$s</span></div>',
			esc_attr( get_the_date( 'd' ) ),
			esc_html( get_the_date( 'M' ) )
		);
	}
	if( $return ){
		return $output;
	}else{
		echo $output;
	}
}
endif;

#-----------------------------------------------------------------
# Excerpt Functions
#-----------------------------------------------------------------

// Replace "[...]" in excerpt with "..."
//................................................................
if ( ! function_exists( 'new_trim_excerpt' ) ) :
function new_trim_excerpt($excerpt) {
	return str_replace('[...]', '...', $excerpt);
}
endif;
add_filter('wp_trim_excerpt', 'new_trim_excerpt');

if( ! function_exists( 'media_center_is_force_excerpt' ) ) :
	function media_center_is_force_excerpt() {
		return apply_filters( 'mc_is_force_excerpt', false );
	}
endif;

// Custom Length Excerpts
//................................................................
/**
 * Usage:
 *
 * echo custom_excerpt(get_the_content(), 30);
 * echo custom_excerpt(get_the_content(), 50);
 * echo custom_excerpt($your_content, 30);
 * 
 */
if( ! function_exists( 'custom_excerpt' ) ) :
function custom_excerpt($excerpt = '', $excerpt_length = 300, $tags = '', $trailing = '...') {
	global $post;
	
	if ( has_excerpt() ) {
		// see if there is a user created excerpt, if so we use that without any trimming
		return get_the_excerpt();
	} else {
		// otherwise make a custom excerpt
		$string_check = explode(' ', $excerpt);
		if (count($string_check, COUNT_RECURSIVE) > $excerpt_length) {
			$excerpt = strip_shortcodes( $excerpt );
			$new_excerpt_words = explode(' ', $excerpt, $excerpt_length+1); 
			array_pop($new_excerpt_words);
			$excerpt_text = implode(' ', $new_excerpt_words); 
			$temp_content = strip_tags($excerpt_text, $tags);
			$short_content = preg_replace('`\[[^\]]*\]`','',$temp_content);
			$short_content .= $trailing;
			
			return $short_content;
		} else {
			// no trimming needed, excerpt is too short.
			return $excerpt;
		}
	}
}
endif;

// Show Post Content (excerpt or full post)
//...............................................

if ( ! function_exists( 'media_center_post_content' ) ) :
	function media_center_post_content( $post_id = false, $content = false, $excerpt = false ) {
		global $post, $custom_query;

		$post_id = ($post_id) ? $post_id : $post->ID;
		$force_post_excerpts  = media_center_is_force_excerpt();

		if ( ! is_single() && ( $force_post_excerpts || is_search() ) ) {
			echo media_center_post_excerpt();
		} else {
			if( has_excerpt() ){
				echo media_center_post_excerpt();
			} else {
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mediacenter' ) );
			}
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'mediacenter' ), 'after' => '</div>' ) );
		}
	}
endif;

// Display Post Excerpt
//...............................................
if( ! function_exists( 'media_center_post_excerpt' ) ) :
function media_center_post_excerpt(){
	global $post, $custom_query;

	$excerpt_length = 75 ; // Excerpt length
	$excerpt_length = ( isset($custom_query->query) && isset($custom_query->query['excerpt_length']) && $custom_query->query['excerpt_length'] ) ? $custom_query->query['excerpt_length'] : $excerpt_length;

	$read_more = __( 'Read More', 'mediacenter' );
	$read_more_exclude = array( 'quote', 'link', 'status', 'aside' ); // post formats to exclude read more link
	$post_excerpt = '<p>' . custom_excerpt( get_the_excerpt(), $excerpt_length ) . '</p>';

	if( $read_more != -1 && !in_array( get_post_format(), $read_more_exclude ) ){
		$post_excerpt .= sprintf( '<a href="%s" class="le-button huge btn">%s</a>', get_permalink(), $read_more );
	}

	return $post_excerpt;
}
endif;

// Post Meta Data
//...............................................

if ( ! function_exists( 'media_center_post_meta' ) ):
	function media_center_post_meta(){
		$postFormat = get_post_format();
		if ( $postFormat != 'quote' && $postFormat != 'link' ){
			echo '<ul class="meta">';
			echo '<li class="post-author">' . sprintf( __( 'Posted By : %s', 'mediacenter' ), media_center_post_author() ) . '</li>';
			if ( is_blog_layout_grid() || is_single() ){
				echo '<li class="date">'.get_the_date().'</li>';
			}
			echo '<li class="categories">'.get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'mediacenter' ) ). '</li>';
			if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) :
				echo '<li class="comments">';
					comments_popup_link( __( 'Leave a comment', 'mediacenter' ), __( '1 Comment', 'mediacenter' ), __( '% Comments', 'mediacenter' ) );
				echo '</li>';
			endif;
			edit_post_link( __( 'Edit', 'mediacenter' ), '<li class="edit-link">', '</li>' );
			echo '</ul>';
		}else{
			if ( is_blog_layout_grid() ){
				echo '<ul class="meta">';
				echo '<li class="date">'.get_the_date().'</li>';
				edit_post_link( __( 'Edit', 'mediacenter' ), '<li class="edit-link">', '</li>' );
				echo '</ul>';
			}
		}
	}
endif;

// Post author link
//...............................................

if ( ! function_exists( 'media_center_post_author' ) ):
	function media_center_post_author( $link = true ){
		$author_name = get_the_author();
		if( $link ) {
			$post_author = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="Post author" data-rel="tooltip" data-placement="left" rel="author">' . $author_name . '</a>';			
		} else {
			$post_author = $author_name;
		}
		
		return $post_author;
	}
endif;

// Comments Form
//...............................................

if ( ! function_exists( 'media_center_comments_form_args' ) ):
	function media_center_comments_form_args(){
		
	}
endif;

// Post Icon
//...............................................

if ( ! function_exists( 'media_center_post_icon' ) ):
	function media_center_post_icon( $postFormat = '', $dataFilter = false, $return = false, $link = true ){
		if(empty($postFormat)){
			$postFormat = get_post_format();
		}
		switch($postFormat){
			case 'image':
				$dataFilterValue = 'format-image';
				$icon = 'fa fa-image';
			break;
			case 'gallery':
				$dataFilterValue = 'format-gallery';
				$icon = 'fa fa-th-large';
			break;
			case 'video':
				$dataFilterValue = 'format-video';
				$icon = 'fa fa-film';
			break;
			case 'audio':
				$dataFilterValue = 'format-audio';
				$icon = 'fa fa-music';
			break;
			case 'quote':
				$dataFilterValue = 'format-quote';
				$icon = 'fa fa-quote-left';
			break;
			case 'link':
				$dataFilterValue = 'format-link';
				$icon = 'fa fa-link';
			break;
			case 'status':
				$dataFilterValue = 'format-status';
				$icon = 'fa fa-comment-o';
			break;
			case 'chat':
				$dataFilterValue = 'format-chat';
				$icon = 'fa fa-comments-o';
			break;
			case 'aside':
				$dataFilterValue = 'format-aside';
				$icon = 'fa fa-hand-o-left';
			break;
			default :
				$dataFilterValue = 'format-standard';
				$icon = 'fa fa-paragraph';
		}

		if( $link ){
			if( $dataFilter ){
				$output = '<a href="#" data-filter=".'.$dataFilterValue.'"><i class="'.$icon.'"></i></a>';
			}else{
				$output = '<a href="#"><i class="'.$icon.'"></i></a>';
			}
		}else{
			$output = '<i class="' . $icon . '"></i>';
		}

		if( $return ){
			return $output;
		}else{
			echo $output;
		}
	}
endif;

// Post Thumbnail
//...............................................

if ( ! function_exists( 'media_center_post_thumbnail' ) ):
	function media_center_post_thumbnail( $post_id = false ){
		global $post;
		$post_id = ( $post_id ) ? $post_id : $post->ID;
		if ( has_post_thumbnail( $post_id ) ) :
	?>
		<figure class="icon-overlay icn-link post-media">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail();?>
			</a>
		</figure><!-- /.post-media -->
	<?php
		endif;
	}
endif;

#-----------------------------------------------------------------
# Post Format Media
#-----------------------------------------------------------------

// Output Gallery (slide show) for Post Format
//...............................................
if ( !function_exists( 'media_center_gallery_slideshow' ) ) :
    function media_center_gallery_slideshow($post_id , $thumbnail = 'post-thumbnail') {
    	global $post;
    	$post_id = ($post_id) ? $post_id : $post->ID;

    	// Get the media ID's
		$ids = esc_attr(get_post_meta($post_id, 'postformat_gallery_ids', true));

		// Query the media data
		$attachments = get_posts( array(
			'post__in' => explode(",", $ids),
			'orderby' => 'post__in',
			'post_type' => 'attachment',
			'post_mime_type' => 'image',
			'post_status' => 'any',
			'numberposts' => -1
		));

		// Create the media display
		if ($attachments) {
			echo '<div class="post-media">';
			echo '<div class="owl-carousel owl-inner-pagination owl-inner-nav owl-blog-post-gallery">';
			foreach ($attachments as $attachment): ?>
			<div class="item">
				<figure>
					<?php echo wp_get_attachment_image($attachment->ID, $thumbnail); ?>
				</figure>
			</div><!-- /.item -->
		<?php 
			endforeach;
			echo '</div>';
			echo '</div>';
		}			
	}
endif;

// Output Audio Player for Post Format
//...............................................

if ( !function_exists( 'media_center_audio_player' ) ) :
    function media_center_audio_player($post_id, $width = 1200) {

    	// Get the player media
		$mp3    = get_post_meta($post_id, 'postformat_audio_mp3', TRUE);
		$ogg    = get_post_meta($post_id, 'postformat_audio_ogg', TRUE);
		$embed  = get_post_meta($post_id, 'postformat_audio_embedded', TRUE);
		$height = get_post_meta($post_id, 'postformat_poster_height', TRUE);

		if ( isset($embed) && $embed != '' ) {
			// Embed Audio
			if( !empty($embed) ) {
				// run oEmbed for known sources to generate embed code from audio links
				echo '<div class="post-media">'. $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) ) .'</div>';

				return; // and.... Done!
			}

		} else {
		    // Other audio formats ?>

			<script type="text/javascript">
		
				jQuery(document).ready(function(){

					if(jQuery().jPlayer) {
						jQuery("#jquery_jplayer_<?php echo $post_id; ?>").jPlayer({
							ready: function (event) {

								// set media
								jQuery(this).jPlayer("setMedia", {
								    <?php 
								    if($mp3 != '') :
										echo 'mp3: "'. $mp3 .'",';
									endif;
									if($ogg != '') :
										echo 'oga: "'. $ogg .'",';
									endif; ?>
									end: ""
								});
							},
							<?php if( !empty($poster) ) { ?>
							size: {
	        				    width: "<?php echo $width; ?>px",
	        				    height: "<?php echo $height . 'px'; ?>"
	        				},
	        				<?php } ?>
							swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
							cssSelectorAncestor: "#jp_interface_<?php echo $post_id; ?>",
							supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
						});
					
					}
				});
			</script>

			<div id="jquery_jplayer_<?php echo $post_id; ?>" class="jp-jplayer jp-jplayer-audio"></div>

			<div class="jp-audio-container">
				<div class="jp-audio">
					<div class="jp-type-single">
						<div id="jp_interface_<?php echo $post_id; ?>" class="jp-interface">
							<ul class="jp-controls">
								<li><div class="seperator-first"></div></li>
								<li><div class="seperator-second"></div></li>
								<li><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i><span>play</span></a></li>
								<li><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i><span>pause</span></a></li>
								<li><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i><span>mute</span></a></li>
								<li><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i><span>unmute</span></a></li>
							</ul>
							<div class="jp-progress-container">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
							</div>
							<div class="jp-volume-bar-container">
								<div class="jp-volume-bar">
									<div class="jp-volume-bar-value"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
		} // End if embedded/else
    }
endif;

// Video Player / Embeds (self-hosted, jPlayer)
//...............................................

if ( !function_exists( 'media_center_video_player' ) ) :
    function media_center_video_player($post_id, $width = 1200) {
	
    	// Check for embedded video
    	$embed = get_post_meta($post_id, 'postformat_video_embed', true); 
		if( !empty($embed) ) {
			$embed = do_shortcode( $embed );
			// run oEmbed for known sources to generate embed code from video links
			echo '<div class="video-container post-media"><div class="embed-responsive embed-responsive-16by9">'. $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) ) .'</div></div>';

			return; // and.... Done!
		}


		// Get the player media options
    	$height = get_post_meta($post_id, 'postformat_video_height', true);
    	$m4v = get_post_meta($post_id, 'postformat_video_m4v', true);
    	$ogv = get_post_meta($post_id, 'postformat_video_ogv', true);
    	$webm = get_post_meta($post_id, 'postformat_video_webm', true);
    	$poster = get_post_meta($post_id, 'postformat_video_poster', true);
	
		?>
	    <script type="text/javascript">
	    	jQuery(document).ready(function(){
			
	    		if(jQuery().jPlayer) {
	    			jQuery("#jquery_jplayer_<?php echo $post_id; ?>").jPlayer({
	    				ready: function (event) {
							// mobile display helper
							// if(event.jPlayer.status.noVolume) {	$('#jp_interface_<?php echo $post_id; ?>').addClass('no-volume'); }
							// set media
	    					jQuery(this).jPlayer("setMedia", {
	    						<?php if($m4v != '') : ?>
	    						m4v: "<?php echo $m4v; ?>",
	    						<?php endif; ?>
	    						<?php if($ogv != '') : ?>
	    						ogv: "<?php echo $ogv; ?>",
	    						<?php endif; ?>
	    						<?php if($webm != '') : ?>
	    						webmv: "<?php echo $webm; ?>",
	    						<?php endif; ?>
	    						<?php if ($poster != '') : ?>
	    						poster: "<?php echo $poster; ?>"
	    						<?php endif; ?>
	    					});
	    				},
	    				size: {
	    				    width: "<?php echo $width ?>px",
	    				    // height: "<?php echo $height . 'px'; ?>"
	    				},
	    				swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
	    				cssSelectorAncestor: "#jp_interface_<?php echo $post_id; ?>",
	    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
	    			});
	    		}
	    	});
	    </script>

	    <div id="jquery_jplayer_<?php echo $post_id; ?>" class="jp-jplayer jp-jplayer-video"></div>

	    <div class="jp-video-container">
	        <div class="jp-video">
	            <div class="jp-type-single">
	                <div id="jp_interface_<?php echo $post_id; ?>" class="jp-interface">
	                    <ul class="jp-controls">
	                    	<li><div class="seperator-first"></div></li>
	                        <li><div class="seperator-second"></div></li>
	                        <li><a href="#" class="jp-play" tabindex="1"><i class="fa fa-play"></i><span>play</span></a></li>
	                        <li><a href="#" class="jp-pause" tabindex="1"><i class="fa fa-pause"></i><span>pause</span></a></li>
	                        <li><a href="#" class="jp-mute" tabindex="1"><i class="fa fa-volume-up"></i><span>mute</span></a></li>
	                        <li><a href="#" class="jp-unmute" tabindex="1"><i class="fa fa-volume-off"></i><span>unmute</span></a></li>
	                    </ul>
	                    <div class="jp-progress-container">
	                        <div class="jp-progress">
	                            <div class="jp-seek-bar">
	                                <div class="jp-play-bar"></div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="jp-volume-bar-container">
	                        <div class="jp-volume-bar">
	                            <div class="jp-volume-bar-value"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php 

	}
endif;

// Isoptope Format Filter
//...............................................

if ( !function_exists( 'media_center_isotope_filter' ) ) :
	function media_center_isotope_filter(){
?>
	<div class="row inner-bottom-xs">
		<div class="col-sm-12">
			<ul class="format-filter text-center">
				<li><a class="active" href="#" data-filter="*" title="All" data-rel="tooltip" data-placement="top"><i class="icon-th"></i></a></li>
				<li><a href="#" data-filter=".format-standard" title="Standard" data-rel="tooltip" data-placement="top"><i class="icon-edit"></i></a></li>
				<li><a href="#" data-filter=".format-image" title="Image" data-rel="tooltip" data-placement="top"><i class="icon-picture-1"></i></a></li>
				<li><a href="#" data-filter=".format-gallery" title="Gallery" data-rel="tooltip" data-placement="top"><i class="icon-picture"></i></a></li>
				<li><a href="#" data-filter=".format-video" title="Video" data-rel="tooltip" data-placement="top"><i class="icon-video-1"></i></a></li>
				<li><a href="#" data-filter=".format-audio" title="Audio" data-rel="tooltip" data-placement="top"><i class="icon-music-1"></i></a></li>
				<li><a href="#" data-filter=".format-quote" title="Quote" data-rel="tooltip" data-placement="top"><i class="icon-quote"></i></a></li>
				<li><a href="#" data-filter=".format-link" title="Link" data-rel="tooltip" data-placement="top"><i class="icon-popup"></i></a></li>
			</ul><!-- /.format-filter -->
		</div><!-- /.col -->
	</div><!-- /.row -->
<?php
	}
endif;

#-----------------------------------------------------------------
# Blog & Post Functions
#-----------------------------------------------------------------

// Get Blog Layout Details
//...............................................................

function get_blog_layout_details(){
	$blogLayout = media_center_blog_layout();
	$availableLayouts = get_available_blog_layouts();
	return $availableLayouts[$blogLayout];
}

// Is Blog Layout a Grid ?
//...............................................................

function is_blog_layout_grid(){
	$layoutDetails = get_blog_layout_details();
	return $layoutDetails['isGrid'];
}

// Get Available Blog Layouts
//...............................................................
function get_available_blog_layouts(){
	$layouts = array(
			'sidebar_right' => array(
				'label' => __( 'Sidebar Right' , 'mediacenter' ),
				'hasSidebar' => true,
				'isGrid' => false
			),
			'sidebar_left' => array(
				'label' => __( 'Sidebar Left' , 'mediacenter' ),
				'hasSidebar' => true,
				'isGrid' => false
			),
			'without_sidebar' => array(
				'label' => __( 'Without Sidebar' , 'mediacenter' ),
				'hasSidebar' => false,
				'isGrid' => false
			),
		);
	return $layouts;
}

// Get Available Blog Layouts
//...............................................................
function get_available_post_layouts(){
	return get_available_blog_layouts();
}

// Get Post Layout Details
//...............................................................
function get_post_layout_details(){
	$post_layout = media_center_blog_layout();
	$layouts = get_available_post_layouts();
	return $layouts[$post_layout];
}


// Comment Style
//...............................................................
if ( ! function_exists( 'media_center_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own media_center_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function media_center_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'mediacenter' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'mediacenter' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
<li <?php comment_class('comment-item'); ?> id="comment-<?php comment_ID(); ?>">

	<div class="row no-margin">
		
		<div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
			<div class="avatar icon-overlay icn-link">
				<?php echo get_avatar( $comment->comment_author_email , 70 );?>
			</div><!-- /.avatar -->
		</div><!-- /.col -->
		<div class="col-xs-12 col-lg-11 col-sm-10 no-margin-right">
			<div class="comment-body">
				
				<div class="meta-info">
					<header class="row no-margin">
						<div class="pull-left flip">
							<h4 class="author"><?php echo get_comment_author_link(); ?></h4>
							<?php if( $comment->user_id === $post->post_author ): ?>
								<span class="label label-default"><?php echo __( 'Post author', 'mediacenter' ); ?></span>
							<?php endif;?>
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<span class="label label-danger"><?php _e( 'Awaiting moderation.', 'mediacenter' ); ?></span>
							<?php endif; ?>
							<span class="date"><?php echo get_comment_date(); ?></span>
						</div><!-- /.pull-left -->
						<div class="pull-right flip">
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'mediacenter' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div><!-- /.pull-right -->
					</header><!-- /.row -->
					
				</div><!-- /.meta-info -->

				<div class="comment-content"><?php comment_text(); ?></div>

			</div><!-- /.comment-body -->
		</div><!-- /.col -->

	</div><!-- /.row -->

</li><!-- /.comment -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'media_center_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 */
function media_center_content_nav( $html_id ) {
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation inner-bottom-xs" role="navigation">
		<h1 class="sr-only screen-reader-text"><?php _e( 'Post navigation', 'mediacenter' ); ?></h1>
		<div class="nav-links clearfix">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '%title', 'mediacenter' ) );
			else :
				echo '<div class="pull-left flip">';
				previous_post_link( '%link', __( '&larr; %title', 'mediacenter' ) );
				echo '</div>';
				echo '<div class="pull-right flip">';
				next_post_link( '%link', __( '%title &rarr;', 'mediacenter' ) );
				echo '</div>';
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if( ! function_exists( 'media_center_blog_pagination' ) ) :
/**
 * Displays blog navigation.
 */
function media_center_blog_pagination( $html_id ){
	global $wp_query;

	$html_id = esc_attr( $html_id );

	get_pagination( $html_id, $wp_query, 4 );
}

endif;