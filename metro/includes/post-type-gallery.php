<?php 
if ( is_singular() ) { // single post mode

	?>
	<div <?php post_class('post-full'); ?> id="post-<?php the_ID(); ?>">
		<div class="post-meta">
			<div class="post-date"><?php the_time( get_option('date_format') ); ?></div>
			<?php if(get_option(OM_THEME_PREFIX . 'post_hide_categories') != 'true' && $categories = get_the_category_list(', ')) { ?>
				<div class="post-categories">
					<?php echo '<span class="label">'.__('Categories:','om_theme').' </span>'.$categories ?>
				</div>
			<?php } ?>
			<?php the_tags('<div class="post-tags"><span class="label">'.__('Tags:','om_theme').' </span>', ', ', '</div>' ) ?>
			<?php if(get_option(OM_THEME_PREFIX.'post_show_author') == 'true') { ?>
				<div class="post-author"><?php _e('by','om_theme'); ?> <?php the_author(); ?></div>
			<?php } ?>
		</div>
		<div class="post-text">
			<?php if(get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'gallery_mode', true) == 'masonry') { ?>
				<div class="eat-left eat-right"><?php om_slides_gallery_m($post->ID); ?></div>
			<?php } else { ?>
				<?php om_slides_gallery($post->ID); ?>
			<?php } ?>
			<?php the_content(); ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php
	
} else { // posts list mode

	$attachments = om_get_post_gallery_images($post->ID, array('limit' => 4));
	?>
	<div <?php post_class('post-big'); ?> id="post-<?php the_ID(); ?>">
		<div class="eat-left">
			<div class="post-head">
				<div class="post-date block-1 zero-mar" title="<?php the_time( get_option('date_format') ); ?>"><div class="block-inner"><div class="post-date-inner"><div><?php the_time('d'); ?></div><?php the_time('M'); ?></div></div></div>
				<div class="post-title">
					<div class="post-title-inner">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<?php if(get_option(OM_THEME_PREFIX . 'post_hide_categories') != 'true' && $categories = get_the_category_list(', ')) { ?>
							<div class="post-categories">
								<?php echo '<span class="label">'.__('Categories:','om_theme').' </span>'.$categories ?>
							</div>
						<?php } ?>
						<?php the_tags('<div class="post-tags"><span class="label">'.__('Tags:','om_theme').' </span>', ', ', '</div>' ) ?>
						<div class="post-comments">
							<?php comments_popup_link( '<span class="label">'.__('Comments:','om_theme').' </span>'.__('No','om_theme'), '<span class="label">'.__('Comments:','om_theme').' </span> 1', '<span class="label">'.__('Comments:','om_theme').' </span> %'); ?>
						</div>
						<?php if(get_option(OM_THEME_PREFIX.'post_show_author') == 'true') { ?>
							<div class="post-author"><?php _e('by','om_theme'); ?> <?php the_author(); ?></div>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<div class="post-tbl-wrapper">
			<div class="post-tbl">
				<?php	if( !empty($attachments) ) { ?>
					<div class="post-pic block-3 zero-mar">
						<div class="block-3 zero-mar">
							<div class="block-inner move-left">
								<a href="<?php the_permalink(); ?>"><?php
									$attachment=array_shift($attachments);
									$src=wp_get_attachment_image_src( $attachment->ID, 'thumbnail-post-big' );
									?><img src="<?php echo $src[0] ?>" alt="<?php echo htmlspecialchars($attachment->post_title)?>" width="<?php echo $src[1] ?>" height="<?php echo $src[2] ?>" />
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="post-data">
					<?php	if( !empty($attachments) ) { ?>
						<div class="post-gallery-thumbs">
							<?php
							$i=0;
							foreach($attachments as $attachment) {
								$i++;
								$src=wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
								?><div class="item block-1 pic-<?php echo $i?>"><div class="block-inner"><a href="<?php the_permalink(); ?>#slide-<?php echo $attachment->ID ?>"><img src="<?php echo $src[0] ?>" alt="<?php echo htmlspecialchars($attachment->post_title)?>" width="<?php echo $src[1] ?>" height="<?php echo $src[2] ?>" /></a></div></div><?php
							}
							?>
						</div>
					<?php } ?>
					<div class="post-text">
						<?php
							if( has_excerpt() ) {
								om_custom_excerpt_more( get_the_excerpt() );
							} else {
								if( get_option(OM_THEME_PREFIX . 'blog_excerpt_mode') == 'auto' ) {
									remove_filter('excerpt_length', 'om_excerpt_length');
									add_filter('excerpt_length', 'om_blog_excerpt_length');
									the_excerpt();
									remove_filter('excerpt_length', 'om_blog_excerpt_length');
									add_filter('excerpt_length', 'om_excerpt_length');
								} else {
									the_content( __('Read more', 'om_theme') );
								}
							}
						?>
					</div>
					
				</div>
			</div>
		</div>
	</div>	
	<?php
	
}
