<?php
/**
 * Recent Posts - Video Post Format
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
$video_embed = rwmb_meta( 'sd_video_url', 'type=oembed' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-video-entry clearfix' ); ?>> 
	<div class="sd-entry-wrapper clearfix"> 
		<div class="sd-entry-video-wrapper">
			<div class="sd-entry-video"> <?php echo $video_embed; ?> </div>
		</div>
		<!-- sd-entry-video-wrapper -->

		<div class="sd-entry-content">
			<header>
				<div class="sd-content-wrap">
					<h3 class="sd-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink la %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">	<?php the_title(); ?></a>
					</h3>
					<div class="sd-latest-blog-meta">
						<span class="sd-latest-blog-date"><?php the_time( get_option( 'date_format') ); ?></span> <?php echo _x( 'BY', 'by author', 'sd-framework' ); ?> 
						<span class="sd-latest-author-date"><?php the_author(); ?></span>
					</div>
					<!-- sd-latest-blog-meta -->
				</div>
				<!-- sd-content-wrap -->
			</header>
			<p class="sd-latest-blog-excerpt"><?php echo substr( get_the_excerpt(), 0, 80 ) . '...'; ?></p>
			<a class="sd-more sd-link-trans" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e( 'READ MORE', 'sd-framework' ); ?></a>
		</div>
		<!-- sd-entry-content -->
	</div>
	<!-- sd-entry-wrapper -->
</article>
