<?php
/**
 * Template functions used for posts.
 *
 * @package unicase
 */

if ( ! function_exists( 'unicase_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 * @since 1.0.0
	 */
	function unicase_post_header() { ?>
		<header class="entry-header">
		<?php
		if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {
			$comments_link = sprintf( '<a href="%s" class="comments-link pull-right flip icon-comments hidden-xs"><i class="fa fa-comment"></i><span class="comment-count">%d</span></a>', esc_url( get_comments_link() ), get_comments_number() );
		}
		if ( is_single() ) {
			
			the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>' );
			unicase_posted_on();
		} else {

			the_title( sprintf( '<h2 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );			
			
			if ( 'post' == get_post_type() ) {
				unicase_posted_on();
			}
		}
		?>
		</header><!-- .entry-header -->
		<?php
	}
}

if( ! function_exists( 'unicase_post_media_attachment' ) ) {
	/**
	 * Displays the media attachment of the post
	 * @since 1.0.0
	 */
	function unicase_post_media_attachment() { 
		
		$post_format = get_post_format();
		
		ob_start();

		if( $post_format == 'gallery' ){
			unicase_gallery_slideshow( get_the_ID() );	
		} else if ( $post_format == 'video' ){
			unicase_video_player( get_the_ID() );
		} else if ( $post_format == 'audio' ){
			unicase_audio_player( get_the_ID() );
		} else if ( $post_format == 'image' || has_post_thumbnail() ){
			the_post_thumbnail( 'unicase_blog-single-thumb', array( 'itemprop' => 'image' ) );
		} else {
			$post_icon = unicase_get_post_icon( $post_format );
			$enable_placeholder_img = apply_filters( 'unicase_post_placeholder_img', FALSE );
			echo unicase_get_thumbnail( get_the_ID(), 'unicase_blog-single-thumb', $enable_placeholder_img, TRUE, $post_icon );
		}

		$media_attachment = ob_get_clean();

		if( ! empty( $media_attachment ) ) {
			echo '<div class="media-attachment">' . $media_attachment . '</div>';
		}

	}
}

if( ! function_exists( 'unicase_post_thumbnail' ) ) {
	/**
	 * Displays the image attachment of the post
	 * @since 1.0.0
	 */
	function unicase_post_thumbnail( $image_size = 'post-thumbnail' ) { 
		$post_icon = unicase_get_post_icon();
		echo '<div class="media-attachment">';
			echo unicase_get_thumbnail( get_the_ID(), $image_size, TRUE, TRUE, $post_icon );
		echo '</div>';
	}
}

if( ! function_exists( 'unicase_post_loop_description' ) ) {
	
	function unicase_post_loop_description() {

		if( apply_filters( 'unicase_force_excerpt', FALSE ) ) {
			unicase_post_excerpt();
			unicase_post_readmore();
		} else {
			unicase_post_content();
		}
	}
}

if ( ! function_exists( 'unicase_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 * @since 1.0.0
	 */
	function unicase_post_content() {

		?>
		<div class="entry-content ">
		
		<?php

			$post_format = get_post_format();

			if( $post_format === 'quote' ) :
				$quote_text = get_post_meta ( get_the_ID() , 'postformat_quote_text' , true );
				$quote_source = get_post_meta( get_the_ID() , 'postformat_quote_source' , true );
				
				if( ! empty( $quote_text ) ) : ?>
					<blockquote>
						<p><?php echo esc_html( $quote_text ); ?></p>
						<cite><?php echo esc_html( $quote_source ); ?></cite>
					</blockquote>
				<?php endif;

			elseif( $post_format === 'link' ) :
				
				$post_url = get_post_meta ( get_the_ID() , 'postformat_link_url' , true ); ?>
				<?php if( ! empty( $post_url ) ) : ?>
					<p>
						<a href="<?php echo esc_url( $post_url ); ?>" target="_blank">
							<?php echo esc_attr( $post_url ); ?>
						</a>
					</p>
				<?php endif;

			endif;

			the_content(
				sprintf(
					__( 'Continue reading %s', 'unicase' ),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				)
			);

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'unicase' ),
				'after'  => '</div>',
			) );
		?>

		</div><!-- .entry-content -->
		
		<?php
	}
}


if ( ! function_exists( 'unicase_post_excerpt' ) ) {
	/**
	 * Display the post excerpt with a link to the single post
	 * @since 1.0.0
	 */
	function unicase_post_excerpt() {
		
		?>
		<div class="post-excerpt">
		
		<?php

			$post_format = get_post_format();

			if( $post_format === 'quote' ) :
				
				$quote_text 	= get_post_meta ( get_the_ID() , 'postformat_quote_text' , true );
				$quote_source 	= get_post_meta( get_the_ID() , 'postformat_quote_source' , true );
				
				if( ! empty( $quote_text ) ) : ?>
					<blockquote>
						<p><?php echo esc_html( $quote_text ); ?></p>
						<cite><?php echo esc_html( $quote_source ); ?></cite>
					</blockquote>
				<?php endif;

			elseif( $post_format === 'link' ) :
				
				$post_url = get_post_meta ( get_the_ID() , 'postformat_link_url' , true ); ?>
				<?php if( ! empty( $post_url ) ) : ?>
					<p>
						<a href="<?php echo esc_url( $post_url ); ?>" target="_blank">
							<?php echo esc_attr( $post_url ); ?>
						</a>
					</p>
				<?php endif;

			endif;

			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'unicase' ),
				'after'  => '</div>',
			) );
		?>

		</div><!-- .post-excerpt -->
		
		<?php
	}
}

if( ! function_exists( 'unicase_post_readmore' ) ) {
	function unicase_post_readmore() {
		?>
		<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-readmore btn-uppercase"><?php echo apply_filters( 'unicase_blog_post_readmore_text', esc_html__( 'Read More', 'unicase' ) ); ?></a>
		<?php
	}
}

if ( ! function_exists( 'unicase_post_meta' ) ) {
	/**
	 * Display the post meta
	 * @since 1.0.0
	 */
	function unicase_post_meta() {
		?>
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', ', ' );

			if ( $tags_list ) : ?>
			<aside class="entry-meta">
				<span class="tags-links">
					<?php
					echo '<span class="screen-reader-text">' . esc_attr( esc_html__( 'Tags: ', 'unicase' ) ) . '</span>';
					echo wp_kses_post( $tags_list );
					?>
				</span>
			</aside>
			<?php endif; // End if $tags_list ?>

			<?php endif; // End if 'post' == get_post_type() ?>
		<?php
	}
}

if ( ! function_exists( 'unicase_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function unicase_paging_nav() {
		global $wp_query;

		$args = array(
			'type' 		=> 'list',
			'next_text' => '&nbsp;<span class="meta-nav"><i class="fa fa-angle-right"></i></span>',
			'prev_text'	=> '&nbsp;<span class="meta-nav"><i class="fa fa-angle-left"></i></span>'
			);

		the_posts_pagination( $args );
	}
}

if ( ! function_exists( 'unicase_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function unicase_post_nav() {
		$args = array(
			'next_text' => '%title &nbsp;<span class="meta-nav">&rarr;</span>',
			'prev_text'	=> '<span class="meta-nav">&larr;</span>&nbsp;%title',
			);
		the_post_navigation( $args );
	}
}

if ( ! function_exists( 'unicase_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function unicase_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s" itemprop="datePublished">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s" itemprop="datePublished">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'unicase' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'By %s', 'post author', 'unicase' ),
			'<span class="vcard author"><span class="fn" itemprop="author"><a class="url fn n" rel="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'
		);

		echo apply_filters( 'unicase_single_post_posted_on_html', sprintf( '<div class="post-meta"><span class="posted-on">%s</span><span class="byline">%s</span></div>', $posted_on, $byline ), $posted_on, $byline );

	}
}

if ( !function_exists( 'unicase_gallery_slideshow' ) ) :
	/**
	 * Output Gallery (slide show) for Post Format.
	 */
    function unicase_gallery_slideshow($post_id , $thumbnail = 'post-thumbnail') {
    	global $post;
    	
    	$post_id = esc_attr( ( $post_id ? $post_id : $post->ID ) );

    	// Get the media ID's
		$ids = esc_attr( get_post_meta($post_id, 'postformat_gallery_ids', true) );

		// Query the media data
		$attachments = get_posts( array(
			'post__in' 			=> explode(",", $ids),
			'orderby' 			=> 'post__in',
			'post_type' 		=> 'attachment',
			'post_mime_type' 	=> 'image',
			'post_status' 		=> 'any',
			'numberposts' 		=> -1
		));

		// Create the media display
		if ($attachments) : 

			wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.10.2', true );
		?>
		<div class="media-attachment-gallery">
			<div id="owl-carousel-<?php echo esc_attr( $post_id ); ?>" class="owl-carousel owl-inner-pagination owl-inner-nav owl-blog-post-gallery">
			<?php foreach ($attachments as $attachment): ?>
				<div class="item">
					<figure>
						<?php echo wp_get_attachment_image($attachment->ID, $thumbnail); ?>
					</figure>
				</div><!-- /.item -->
			<?php endforeach; ?>
			</div>
			
		</div><!-- /.media-attachment-gallery -->
		<script type="text/javascript">
	
			jQuery(document).ready(function(){
				if(jQuery().owlCarousel) {
					jQuery("#owl-carousel-<?php echo esc_attr( $post_id ); ?>").owlCarousel({
						items : 1,
						nav : false,
						slideSpeed : 300,
						dots: true,
						paginationSpeed : 400,
						navText: ["", ""],
						responsive:{
							0:{
								items:1
							},
							600:{
								items:1
							},
							1000:{
								items:1
							}
						}
					});

					jQuery(".slider-next").on( 'click', function () {
						var owl = jQuery(jQuery(this).data('target'));
						owl.trigger('next.owl.carousel');
						return false;
					});

					jQuery(".slider-prev").on( 'click', function () {
						var owl = jQuery(jQuery(this).data('target'));
						owl.trigger('prev.owl.carousel');
						return false;
					});
				}
			});

		</script>
		<?php endif;
	}
endif;

if ( !function_exists( 'unicase_audio_player' ) ) :
	/**
	 *  Output Audio Player for Post Format
	 */
    function unicase_audio_player($post_id, $width = 1200) {
    	global $post;

    	$post_id = esc_attr( ( $post_id ? $post_id : $post->ID ) );

    	// Get the player media
		$mp3    = get_post_meta($post_id, 'postformat_audio_mp3', 		TRUE);
		$ogg    = get_post_meta($post_id, 'postformat_audio_ogg', 		TRUE);
		$embed  = get_post_meta($post_id, 'postformat_audio_embedded', 	TRUE);
		$height = get_post_meta($post_id, 'postformat_poster_height', 	TRUE);

		if ( isset($embed) && $embed != '' ) {
			// Embed Audio
			if( !empty($embed) ) {
				// run oEmbed for known sources to generate embed code from audio links
				echo $GLOBALS['wp_embed']->autoembed( stripslashes( htmlspecialchars_decode( $embed ) ) );

				return; // and.... Done!
			}

		} else if( ! empty( $mp3 ) || ! empty ( $ogg ) ) {

			wp_enqueue_script( 'jplayer', get_template_directory_uri() . '/assets/js/jquery.jplayer.min.js', array( 'jquery' ), '1.10.2', true );
		    
		    // Other audio formats ?>

			<script type="text/javascript">
		
				jQuery(document).ready(function(){

					if(jQuery().jPlayer) {
						jQuery("#jquery_jplayer_<?php echo esc_attr( $post_id ); ?>").jPlayer({
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
	        				    width: "<?php echo esc_js( $width ); ?>px",
	        				    height: "<?php echo esc_js( $height . 'px' ); ?>"
	        				},
	        				<?php } ?>
							swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
							cssSelectorAncestor: "#jp_interface_<?php echo esc_attr( $post_id ); ?>",
							supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
						});
					
					}
				});
			</script>

			<div id="jquery_jplayer_<?php echo esc_attr( $post_id ); ?>" class="jp-jplayer jp-jplayer-audio"></div>

			<div class="jp-audio-container">
				<div class="jp-audio">
					<div class="jp-type-single">
						<div id="jp_interface_<?php echo esc_attr( $post_id ); ?>" class="jp-interface">
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

if ( !function_exists( 'unicase_video_player' ) ) :
	/**
	 * Video Player / Embeds (self-hosted, jPlayer)
	 */
    function unicase_video_player($post_id, $width = 1200) {
    	global $post;

    	$post_id = esc_attr( ( $post_id ? $post_id : $post->ID ) );
	
    	// Get the player media options
    	$embed 		= get_post_meta($post_id, 'postformat_video_embed', 	true);
    	$height 	= get_post_meta($post_id, 'postformat_video_height', 	true);
    	$m4v 		= get_post_meta($post_id, 'postformat_video_m4v', 		true);
    	$ogv 		= get_post_meta($post_id, 'postformat_video_ogv', 		true);
    	$webm 		= get_post_meta($post_id, 'postformat_video_webm', 		true);
    	$poster 	= get_post_meta($post_id, 'postformat_video_poster', 	true);

		if( !empty($embed) ) {
			$embed = do_shortcode( $embed );
			// run oEmbed for known sources to generate embed code from video links
			echo '<div class="video-container"><div class="embed-responsive embed-responsive-16by9">'. $GLOBALS['wp_embed']->autoembed( stripslashes(htmlspecialchars_decode($embed)) ) .'</div></div>';

			return; // and.... Done!
		} else if( ! empty( $m4v ) || ! empty ( $ogv ) || ! empty ( $webm ) || ! empty ( $poster ) ) {
			wp_enqueue_script( 'jplayer', get_template_directory_uri() . '/assets/js/jquery.jplayer.min.js', array( 'jquery' ), '1.10.2', true );
		
			?>
		    <script type="text/javascript">
		    	jQuery(document).ready(function(){
				
		    		if(jQuery().jPlayer) {
		    			jQuery("#jquery_jplayer_<?php echo esc_attr( $post_id ); ?>").jPlayer({
		    				ready: function (event) {
								// mobile display helper
								// if(event.jPlayer.status.noVolume) {	$('#jp_interface_<?php echo esc_attr( $post_id ); ?>').addClass('no-volume'); }
								// set media
		    					jQuery(this).jPlayer("setMedia", {
		    						<?php if($m4v != '') : ?>
		    						m4v: "<?php echo esc_js( $m4v ); ?>",
		    						<?php endif; ?>
		    						<?php if($ogv != '') : ?>
		    						ogv: "<?php echo esc_js( $ogv ); ?>",
		    						<?php endif; ?>
		    						<?php if($webm != '') : ?>
		    						webmv: "<?php echo esc_js( $webm ); ?>",
		    						<?php endif; ?>
		    						<?php if ($poster != '') : ?>
		    						poster: "<?php echo esc_js( $poster ); ?>"
		    						<?php endif; ?>
		    					});
		    				},
		    				size: {
		    				    width: "<?php echo esc_js( $width ); ?>px",
		    				},
		    				swfPath: "<?php echo get_template_directory_uri(); ?>/assets/js",
		    				cssSelectorAncestor: "#jp_interface_<?php echo esc_attr( $post_id ); ?>",
		    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
		    			});
		    		}
		    	});
		    </script>

		    <div id="jquery_jplayer_<?php echo esc_attr( $post_id ); ?>" class="jp-jplayer jp-jplayer-video"></div>

		    <div class="jp-video-container">
		        <div class="jp-video">
		            <div class="jp-type-single">
		                <div id="jp_interface_<?php echo esc_attr( $post_id ); ?>" class="jp-interface">
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
	}
endif;


if( !function_exists( 'unicase_single_post_social_icons' ) ) {
	function unicase_single_post_social_icons() {

		if( apply_filters( 'unicase_show_single_post_share', TRUE ) ) :

			$url = get_permalink();
			$title = get_the_title();

			if( has_post_thumbnail() ) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

				if( isset( $thumbnail[0] ) ) {
					$thumbnail_src = $thumbnail[0];
				}
			}

			$single_post_social_icons_args = apply_filters( 'unicase_single_post_social_icons_args', array(
				'facebook'		=> array(
					'share_url'	=> 'http://www.facebook.com/sharer.php',
					'icon'		=> 'fa fa-facebook',
					'name'		=> esc_html__( 'Facebook', 'unicase' ),
					'params'	=> array(
						'u'				=> 'url'
					)
				),
				'twitter'		=> array(
					'share_url'	=> 'https://twitter.com/share',
					'icon'		=> 'fa fa-twitter',
					'name'		=> esc_html__( 'Twitter', 'unicase' ),
					'params'	=> array(
						'url'			=> 'url',
						'text'			=> 'title',
						'via'			=> 'via',
						'hastags'		=> 'hastags'
					)
				),
				'google_plus'	=> array(
					'share_url'	=> 'https://plus.google.com/share',
					'name'		=> esc_html__( 'Google Plus', 'unicase' ),
					'icon'		=> 'fa fa-google-plus',
					'params'	=> array(
						'url'			=> 'url'
					)
				),
				'pinterest'		=> array(
					'share_url'	=> 'https://pinterest.com/pin/create/bookmarklet/',
					'name'		=> esc_html__( 'Pinterest', 'unicase' ),
					'icon'		=> 'fa fa-pinterest',
					'params'	=> array(
						'media'			=> 'thumbnail_src',
						'url'			=> 'url',
						'is_video'		=> 'is_video',
						'description'	=> 'title'
					)
				),
				'digg'			=> array(
					'share_url'	=> 'http://digg.com/submit',
					'name'		=> esc_html__( '', 'unicase' ),
					'icon'		=> 'fa fa-digg',
					'params'	=> array(
						'url'			=> 'url',
						'title'			=> 'title',
					)
				),
				'email'			=> array(
					'share_url'	=> 'mailto:yourfriend@email.com',
					'name'		=> esc_html__( 'Email', 'unicase' ),
					'icon'		=> 'fa fa-envelope',
					'params'	=> array(
						'subject'		=> 'title',
						'body'			=> 'url',
					)
				),
			) );

			?>
			<div class="block-social-icons">
				<span><?php echo apply_filters( 'unicase_single_post_share_title', esc_html__( 'share post:', 'unicase' ) ); ?></span>
				<ul class="list-unstyled list-social-icons">
				<?php foreach( $single_post_social_icons_args as $key => $social_icon ): ?>
					<?php 
						$query_args = array();
						foreach( $social_icon['params'] as $param_key => $param ) {

							if( isset( $$param ) ) {
								$query_args[ $param_key ] = $$param;
							}
						}

						$share_url = add_query_arg( $query_args, $social_icon['share_url'] );
					?>
					<li class="<?php echo esc_attr( $key ); ?>">
						<a class="<?php echo esc_attr( $social_icon['icon'] ); ?>" href="<?php echo esc_url( $share_url ); ?>" title="<?php esc_attr( $social_icon['name'] ); ?>"></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php
		endif;
	}
}

if( ! function_exists( 'unicase_author_info' ) ) {
	/**
	 * Display Author Info
	 */
	function unicase_author_info() {
		if( apply_filters( 'show_author_info', false ) ) :
			?>
			<div class="blog-post-author-details">
				<div class="row">
					<div class="col-md-2">
						<?php echo get_avatar( get_the_author_meta( 'ID' ) , 100 ); ?>
					</div>

					<div class="col-md-10">
						<h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></h5>
						<p><?php echo get_the_author_meta( 'description' );?></p>
					</div>
				</div>
			</div>
			<?php
		endif;
	}
}

if( ! function_exists( 'unicase_excerpt_more' ) ) {
	function unicase_excerpt_more() {
		return apply_filters( 'unicase_excerpt_more', '...' );
	}
}

if( ! function_exists( 'unicase_carousel_excerpt_length' ) ) {
	function unicase_carousel_excerpt_length() {
		return apply_filters( 'unicase_carousel_excerpt_length', 10 );
	}
}
