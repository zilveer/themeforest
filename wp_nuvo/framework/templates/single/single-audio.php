<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data,$post; ?>
<?php
	wp_enqueue_style( 'media-audio', get_template_directory_uri().'/css/media-audio.css',array(),'2.14.1');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog cs-blog-item">
		<header class="cs-blog-header">
		    <?php if($smof_data['show_post_title'] == '1'): ?>
		    <div class="blog-title-top">
    		    <div class="date-box table-cell">
    				<div class="date left">
                        <span class="day"><?php echo get_the_date('j'); ?></span>
                        <span class="month"><?php echo get_the_date('M'); ?></span>
    				</div>
    				<span class="icon-type-post right"><i class="<?php echo cshero_get_icon_post_type(); ?>"></i></span>
    			</div>
			    <?php echo cshero_title_render(); ?>
			</div>
			<?php endif; ?>
			<?php
			$audio_type = get_post_meta($post->ID, 'cs_post_audio_type', true);
			?>
			<div class="cs-blog-media">
			<?php
				if($audio_type == 'ogg' || $audio_type == 'mp3' || $audio_type == 'wav'){
					$audio_url = get_post_meta($post->ID, 'cs_post_audio_url', true);
					if($audio_url){
						echo do_shortcode('[audio '.$audio_type.'="'.$audio_url.'"][/audio]');
					}
				}
			?>
			</div>
			<div class="cs-blog-meta cs-itemBlog-meta">
				<!-- .info-bar -->
				<?php echo cshero_info_bar_render(); ?>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php
				the_content();
				wp_link_pages( array(
					'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:','wp_nuvo') . '</span>',
					'after'       => '</div>',
					'link_before' => '<span class="page-numbers">',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->