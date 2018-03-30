<?php
/**
 * The template for displaying posts in the Audio Post Format
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
		<div class="post-thumbnail clearfix">
			<?php 
				$mp3 = get_post_meta( $post->ID, 'mega_audio_mp3', true );
				$ogg = get_post_meta( $post->ID, 'mega_audio_ogg', true );
				$audioposter = get_post_meta( $post->ID, 'mega_audio_poster', true );
				
				$audioembed = get_post_meta( $post->ID, 'mega_audio_embed_code', true );
				
				$poster_attachment_id = mega_get_attachment_id( $audioposter );
				if ( $poster_attachment_id ) {
					$poster_thumb = wp_get_attachment_image_src($poster_attachment_id,'post-thumb');	
					$audioposter = $poster_thumb[0];
				}
			?>
			
			<?php if ($audioembed !='') { ?>
			<?php echo stripslashes(htmlspecialchars_decode($audioembed));?>
	
		<?php } else { ?>
	
			<?php if ($audioposter): ?><div class="audio-poster"><img src="<?php echo $audioposter;?>"/></div><?php endif;?>
			
			<script type="text/javascript">					
					jQuery(document).ready(function(){				
							if(jQuery().jPlayer) {
								jQuery("#jquery_jplayer_<?php the_ID(); ?>").jPlayer({
									ready: function () {
										jQuery(this).jPlayer("setMedia", {
											<?php if($mp3 != '') : ?>
											mp3: "<?php echo $mp3; ?>",
											<?php endif; ?>
											<?php if($ogg != '') : ?>
											oga: "<?php echo $ogg; ?>",
											<?php endif; ?>
										});
									},									
									swfPath: "<?php echo get_template_directory_uri(); ?>/js",
									cssSelectorAncestor: "#jp_container_<?php the_ID(); ?>",
									supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
								});								
							}
					});
			</script>
    
			<div id="jquery_jplayer_<?php the_ID(); ?>" class="jp-jplayer-audio"></div>
						<div id="jp_container_<?php the_ID(); ?>" class="jp-audio minimal">
								<div class="jp-type-single">
									<div class="jp-gui jp-interface">
											<div class="jp-progress">
												<div class="jp-seek-bar">
													<div class="jp-play-bar"></div>
												</div>
											</div>
											<div class="jp-current-time">00:00</div>
											<div class="jp-duration">00:00</div>												
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
													<li><a class="jp-repeat" tabindex="1">repeat</a></li>
													<li><a class="jp-repeat-off" tabindex="1">jp-repeat-off</a></li>
												</ul>												
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
					<i class="icon-music"></i>
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