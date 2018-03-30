<?php
/**
 * The template for displaying posts in the Video Post Format
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
		<div class="post-thumbnail clearfix">
			<?php
				$m4v = get_post_meta( $post->ID, 'mega_video_m4v', true );
				$ogv = get_post_meta( $post->ID, 'mega_video_ogv', true );
				$poster = get_post_meta( $post->ID, 'mega_video_poster', true );
				$youtube_vimeo = get_post_meta( $post->ID, 'mega_youtube_vimeo_url', true ); 
				$embed = get_post_meta( $post->ID, 'mega_video_embed_code', true ); 
					
				$ratio_width = get_post_meta( $post->ID, 'mega_video_ratio_width', true );
				$ratio_height = get_post_meta( $post->ID, 'mega_video_ratio_height', true );
													
				$ratio = '';
				if ( !empty( $ratio_width ) ) 
				$ratio = ( (int)$ratio_height / (int)$ratio_width * 100 ) .'%';
					
				$poster_attachment_id = mega_get_attachment_id( $poster );
				if ( $poster_attachment_id ) {
					$poster_thumb = wp_get_attachment_image_src( $poster_attachment_id, 'post-thumb' );	
					$poster = $poster_thumb[0];
				}
			 ?>
			
			<?php if ( $youtube_vimeo !='' ) { ?>
			<div class="fluid-video" <?php if ( !empty( $ratio ) ) echo 'style="padding-top:'. $ratio .'; padding-bottom:0;"'; ?>>
				<?php mega_get_video( $post->ID, 960, 538 ); ?>
			</div>
		<?php } 
		
		else if ( $embed !='' ) { ?>
			<div class="fluid-video" <?php if ( !empty($ratio) ) echo 'style="padding-top:'. $ratio .'; padding-bottom:0;"'; ?>>
				<?php echo stripslashes( htmlspecialchars_decode( $embed ) );?>
			</div>
		<?php } 
		
		else { ?>

	 
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
					ready: function () {
						jQuery(this).jPlayer("setMedia", {
							<?php if($m4v != '') : ?>
							m4v: "<?php echo $m4v; ?>",
							<?php endif; ?>
							<?php if($ogv != '') : ?>
							ogv: "<?php echo $ogv; ?>",
							<?php endif; ?>
							<?php if ($poster != '') : ?>
							poster: "<?php echo $poster; ?>"
							<?php endif; ?>
						});
					},
					size: {
						width: "100%",
						height: "100%",
						cssClass: "minimal"   
					},
					autohide :{hold:2000},
					swfPath: "<?php echo get_template_directory_uri(); ?>/js",
					cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
					supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
				});
			});
        </script>
    
		<div id="jp_container_<?php the_ID(); ?>" class="jp-video">
				<div class="jp-type-single">
						<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer jp-jplayer-video" <?php if (!empty($ratio)) echo 'style="padding-top:'.$ratio.';padding-bottom:0;"'; ?>></div>
						<div class="jp-gui">
							<div class="jp-video-play">
								<a class="jp-video-play-icon" tabindex="1">Play</a>
							</div>
							<div class="jp-interface">
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
								<div class="jp-current-time">00:00</div>
								<div class="jp-duration">00:00</div>			
								<div class="jp-controls-holder">
									<ul class="jp-controls">
										<li><a class="jp-play" tabindex="1"></a></li>
										<li><a class="jp-pause" tabindex="1"></a></li>
										<li><a class="jp-mute" tabindex="1"></a></li>
										<li><a class="jp-unmute" tabindex="1"></a></li>
									</ul>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
									<ul class="jp-toggles">
										<li><a class="jp-full-screen" tabindex="1">Full Screen</a></li>
										<li><a class="jp-restore-screen" tabindex="1">Restore Screen</a></li>
									</ul>
								</div>
							</div>							
						</div>
						<div class="jp-no-solution">
								<span><?php _e( 'Update Required', 'mega' ); ?> </span>
								<?php _e( 'To play the media you will need to either update your browser to a recent version or update your Flash plugin.', 'mega' ); ?>
						</div>
				</div>
		</div>
        
   <?php } ?>
		</div><!-- .post-thumbnail clearfix -->
		
		<div class="entry-content-meta-wrapper">
		
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent Link to %s', 'mega' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php if ( is_sticky() ) : ?>
						<i class="icon-pushpin"></i>
					<?php else : ?>
						<i class="icon-film"></i>
					<?php endif; ?>
					<span class="sep"> / </span>
					<i class="icon-calendar"></i>
					<?php mega_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

		</header><!-- .entry-header -->
		
			<div class="entry-content clearfix">
				<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'mega' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mega' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
				
			<footer class="entry-meta">
		
				<?php $show_sep = false; ?>
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'mega' ) );
					if ( $categories_list ):
				?>
				<span class="cat-links">
					<?php printf( __( '<span class="%1$s"><i class="icon-folder-open"></i></span> %2$s', 'mega' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
					$show_sep = true; ?>
				</span>
				<?php endif; // End if categories ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'mega' ) );
					if ( $tags_list ):
					if ( $show_sep ) : ?>
				<span class="sep"> / </span>
					<?php endif; // End if $show_sep ?>
				<span class="tag-links">
					<?php printf( __( '<span class="%1$s"><i class="icon-tags"></i></span> %2$s', 'mega' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
					$show_sep = true; ?>
				</span>
				<?php endif; // End if $tags_list ?>
				<?php endif; // End if 'post' == get_post_type() ?>

				<?php if ( comments_open() ) : ?>
				<?php if ( $show_sep ) : ?>
				<span class="sep"> / </span>
				<?php endif; // End if $show_sep ?>
				<span class="comments-link"><?php comments_popup_link( '<i class="icon-comment"></i> '. __( 'Comment', 'mega' ) .'', __( '<b>1</b> Comment', 'mega' ), __( '<b>%</b> Comments', 'mega' ) ); ?></span>
				<?php endif; // End if comments_open() ?>

				<?php if ( $show_sep ) : ?>
				<?php $sep = '<span class="sep"> / </span>' ?>
				<?php endif; // End if $show_sep ?>
				<?php edit_post_link( __( '<i class="icon-edit"></i> Edit', 'mega' ), '' . $sep . '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- #entry-meta -->
			</div><!-- .entry-content-meta-wrapper -->
		
			<?php if ( is_single() ) : // Checks if any single post is being displayed ?>
				<nav id="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'mega' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', __( 'Older <i class="icon-chevron-right"></i>', 'mega' ) ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', __( '<i class="icon-chevron-left"></i> Newer', 'mega' ) ); ?></span>
				</nav><!-- #nav-single -->
			
			<?php comments_template( '', true ); ?>
			<?php endif; // End if ( is_single() ) ?>
		
	</article><!-- #post-<?php the_ID(); ?> -->
