<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
?>
<?php
	global $majesty_options;
	if( is_archive() ) {
		$blog_type 	 = $majesty_options['blog_archive_type'];
	} else {
		$blog_type 	 = $majesty_options['blog_type'];
	}
	$blog_loop   = isset ( $majesty_options['loop_masonry'] ) ? $majesty_options['loop_masonry'] : 0 ;
	$article_css = 'blog_single';
	if( ! is_single() ) {
		$article_css = sama_get_css_for_blog('article');
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $article_css ); ?>>

<?php if ( ! is_single() ) { ?>

		<?php if ( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault' ) { ?>
			<?php
				$css_figure  = sama_get_css_for_blog('thumbnail');
				$css_content = sama_get_css_for_blog('content');
			?>
			<?php if ( has_post_thumbnail() && $blog_type != 'wpdefault' ) { ?>
				<figure class="<?php echo esc_attr( $css_figure ); ?>">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php
							$thumb_size = sama_get_thumb_size_blog();
							the_post_thumbnail( esc_attr( $thumb_size ), array('class'=>'img-responsive'));
						?>
					</a>
					<figcaption class="text-center">
						<span class="btn btn-gold primary-bg white"><?php sama_output_html5_time_format(); ?></span>
					</figcaption>
				</figure>
			<?php } elseif( has_post_thumbnail() && $blog_type == 'wpdefault' ) { ?>
				<figure class="<?php echo esc_attr( $css_figure ); ?>">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
						<?php
							$thumb_size = sama_get_thumb_size_blog();
							the_post_thumbnail( esc_attr( $thumb_size ), array('class'=>'img-responsive'));
						?>
					</a>
				</figure>
			<?php } ?>
			<div class="<?php echo esc_attr( $css_content ); ?>">
					<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="post-category">
						<i class="fa fa-video-camera"></i>
						<?php the_terms( get_the_ID(), 'category', '', ', ', '' ); ?>
					</div>
					<div class="post-meta">
					  <ul>
						<li><i class="fa fa-user"></i> <?php esc_html_e('By', 'theme-majesty'); ?> <?php the_author_posts_link(); ?></li>
						<li><?php the_tags( '<i class="fa fa-tags"></i> ', ', ', ''); ?></li>
						<li><i class="fa fa-comments"></i> <?php comments_popup_link('0', '1', '%'); ?></li>
						<?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
							<li class="sticky-post"><span class="flag-sticky label label-default"><?php esc_html__('Featured', 'theme-majesty'); ?></span></li>
						<?php } ?>
					  </ul>
					</div>

					<div class="entery-content excerpt-content">
						<?php
							if ( $blog_type == 'wpdefault' ) {
								the_content();
							} else {
								the_excerpt();
							}
							// Used In Blog List OR Default Wordpress
							sama_read_more_link();
						?>
					</div>
			</div> <!-- End Blog content -->
			<!-- Divider -->
			<div class="blog-divider">
				<span></span>
				<i class="icon-home-ico"></i>
				<span></span>
			</div>
		<?php } else { ?>
			<?php
				$masonory_larg = sama_get_masonory_larg_3col();
				$masonory_larg_full_width = sama_get_masonory_larg_fullwidth();
				$masonory_larg_2c = sama_get_masonory_larg_2col();
				if( $blog_type == 'blog-masonry-4-col' && in_array( $blog_loop, $masonory_larg_full_width ) ) { ?>
					<figure class="large">	
				<?php } elseif( $blog_type == 'blog-masonry-3-col' && in_array( $blog_loop, $masonory_larg ) ) { ?>
				<figure class="large">
				<?php } elseif( $blog_type == 'blog-masonry-2-col' && in_array( $blog_loop, $masonory_larg_2c ) ) { ?>
				<figure class="large">
				<?php } elseif( $blog_type == 'blog-masonry-full-width' && in_array( $blog_loop, $masonory_larg_full_width ) ) { ?>
				<figure class="large">
				<?php } else { ?>
				<figure>
				<?php } ?>
			
				<?php
					$thumb_size = sama_get_thumb_size_blog();
					the_post_thumbnail( esc_attr( $thumb_size ), array('class'=>'img-responsive'));
				?>
				<figcaption class="text-center">
					<div class="fig_container">
						<i class="fa fa-video-camera"></i>
						<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<?php the_terms( get_the_ID(), 'category', '<p class="post-cats"> ', ', ', '</p>' ); ?>
						<div class="fig_content">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<span class="btn btn-gold primary-bg white"><?php sama_output_html5_time_format(); ?></span>
				</figcaption>
			</figure>
		<?php } ?>

<?php } else { // Display single post ?>
	<?php
		$post_layout = get_post_meta( get_the_ID(), '_sama_post_layout', true );
		if ( $post_layout != 'fullwidth' ) { ?>
			<div class="col-md-12">
		<?php } ?>
	
	<div class="blog_row">
		<?php
			$video_oembed_url 	= get_post_meta( get_the_ID(), '_sama_oembed', true );
			$video_url_mp4 	  	= get_post_meta( get_the_ID(), '_sama_video_mp4', true );
			if( ! empty( $video_oembed_url ) ) {
				if( $post_layout == 'fullwidth' ) {
					$args = array('width' => 1170);
				} else {
					$args = array('width' => 400);
				}
				echo '<div class="embed-responsive embed-responsive-16by9">'. wp_oembed_get( esc_url( $video_oembed_url ) ) . '</div>';
			} elseif ( ! empty( $video_url_mp4 ) ) {
				$video_url_webm	= get_post_meta( get_the_ID(), '_sama_video_webm', true );
				$video_url_ogg	= get_post_meta( get_the_ID(), '_sama_video_ogg', true );
				$video_poster	= get_post_meta( get_the_ID(), '_sama_video_poster', true );
				$video_attr		= get_post_meta( get_the_ID(), '_sama_video_attr', true );
				$video_attr 	= apply_filters('sama_html5_video_attributes', $video_attr);
				$output_attr	= 'autoplay ';
				if( ! empty ( $video_poster ) ) {
					$output_attr .= 'poster="'. esc_url( $video_poster ) .'" ';
				}
				if( ! empty ( $video_attr ) ) {

					if( in_array( 'preload', $video_attr ) ) {
						$output_attr .= 'preload=auto';
					} else {
						$output_attr .= 'preload=none';
					}
					if( in_array( 'controls', $video_attr ) ) {
						$output_attr .= ' controls';
					}
					if( in_array( 'loop', $video_attr ) ) {
						$output_attr .= ' loop';
					}
					if( in_array( 'muted', $video_attr ) ) {
						$output_attr .= ' muted';
					}
					
				}
				?>
					<div class="video-wrap">
						<video <?php echo wp_kses_post( $output_attr ); ?>>
							<source src="<?php echo esc_url( $video_url_mp4 ); ?>" type="video/mp4" />
							<?php if( ! empty( $video_url_webm ) ) { ?>
								<source src="<?php echo esc_url( $video_url_webm ); ?>" type="video/webm" />
							<?php } ?>
							<?php if( ! empty( $video_url_ogg ) ) { ?>
								<source src="<?php echo esc_url( $video_url_ogg ); ?>" type="video/ogg" />
							<?php } ?>
						</video>
					</div>
	<?php
				
			} elseif ( has_post_thumbnail() ) { ?>
				<figure class="blog-img">
					<?php sama_single_post_thumbnail(); ?>
				</figure>
		<?php } ?>
		
		<header class="entery-header">
			<h1><?php the_title(); ?></h1>
		</header>
		<div class="post-meta">
			<ul>
				<li><i class="fa fa-calendar"></i> <?php sama_output_html5_time_format(); ?></li>
				<li><i class="fa fa-user"></i> <?php esc_html_e('By', 'theme-majesty'); ?>&#160;<?php the_author_posts_link(); ?></li>
				<?php the_terms( get_the_ID(), 'category', '<li><i class="fa fa-folder-open"></i> ', ', ', '</li>' ); ?>
				<li><i class="fa fa-comments"></i> <?php comments_popup_link('0', '1', '%'); ?></li>
			</ul>
		</div>
			
		<div class="entery-content">
			<?php 
				the_content();
				
				wp_link_pages( array(
					'before'      => '<div class="page-links"><strong class="page-links-title">' . esc_html__( 'Pages:', 'theme-majesty' ) . '</strong>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				));
			?>
		</div>
			
		<footer class="entry-footer">
			<?php edit_post_link( esc_html__( 'Edit', 'theme-majesty' ), '<span class="edit-link">', '</span>' ); ?>
		</footer>
		<?php if ( $post_layout != 'fullwidth' ) { ?>
			</div></div>
		<?php } ?>
		<div class="post-tags-social">
			<?php
				global $majesty_allowed_tags;
				the_tags( '<p>'. esc_html__('Tags', 'theme-majesty') .'</p><ul class="labels"><li><span class="label label-tagged">', '</span></li><li><span class="label label-tagged">', '</span></li></ul>');
				
				if ( $majesty_options['single_display_share_icon'] ) {
					get_template_part('tpl/post-share-icon');
				}
			?>
		</div>
		<div class="clearfix"></div>
		<?php if ( $post_layout == 'fullwidth' ) { ?>
			</div>
		<?php } ?>
<?php } ?>
</article>