<?php
	$thb_post_id = get_the_ID();
	$thb_category = get_the_category();
	$thb_tags = get_the_tags();
	$thb_link_url = thb_get_post_format_link_url();
	$thb_format = thb_get_post_format();
	$thb_title = get_the_title();
	$thb_title_alt = get_the_title();
	$wrapper_classes = 'post-wrapper';
	$thb_post_type = get_post_type( $thb_post_id );
	$thb_permalink = get_permalink( get_the_ID() );

	if ( $thb_post_type == 'works' ) {
		$thb_permalink = thb_portfolio_item_get_permalink();
	}

	if( $thb_format === 'quote' ) {
		$thb_title_alt = thb_get_post_format_quote_text();
		$thb_subtitle = thb_get_post_format_quote_author();
	}

	if( post_password_required() ) {
		$thb_title = __('Protected: ', 'thb_text_domain') . get_the_title();
	}

	$feature_image_src = '';

	if( $thb_format === 'image' ) {
		$feature_image_src = thb_get_post_format_image_src( $thb_thumb_size );
	}
	elseif( $thb_format !== 'gallery' && $thb_format !== 'aside' ) {
		$feature_image_src = thb_get_featured_image( $thb_thumb_size );
	}

	if ( !empty( $feature_image_src ) ) {
		$wrapper_classes .= ' w-image';
	}
?>

<div class="<?php echo $wrapper_classes; ?>">

	<?php
		if ( $thb_format != 'video' ) {

			if ( !empty( $feature_image_src ) ) {
				$thb_image_config = array();

				if ( isset( $thb_thumbnails_open_post ) && $thb_thumbnails_open_post ) {
					$thb_image_config['link_href'] = get_permalink( get_the_ID() );
				}

				if( $thb_format === 'image' ) {
					thb_post_format_image( $thb_thumb_size, $thb_image_config );
				}
				elseif( $thb_format !== 'gallery' && $thb_format !== 'aside' ) {
					thb_featured_image( $thb_thumb_size, $thb_image_config );
				}
			}

			if( $thb_format === 'gallery' ) {
				thb_post_format_gallery( $thb_thumb_size, 'full', 'rsTHB' );
			}

		}

		if ( thb_page_has_video( get_the_ID() ) || thb_page_has_audio( get_the_ID() ) ) {
			echo '<div class="format-embed-wrapper">';
				if( $thb_format === 'video' ) {
					thb_post_format_video();
				} elseif ( $thb_format === 'audio' ) {
					thb_post_format_audio();
				}
			echo '</div>';
		}
	?>

	<div class="loop-post-content">

		<?php if( $thb_format != 'aside' ) : ?>

			<header class="item-header">
				<?php if ( !empty( $thb_title ) || !empty( $thb_title_alt ) ) : ?>
					<?php if( $thb_format === 'quote' ) : ?>
						<h1 class="entry-title" <?php thb_livestyle_element( 'loop_header_quote_classic' ); ?>>
							<a href="<?php echo esc_url( $thb_permalink ); ?>" rel="permalink">
								<?php echo $thb_title_alt; ?>
							</a>
						</h1>
					<?php else : ?>
						<h1 class="entry-title" <?php thb_livestyle_element( 'loop_header_classic' ); ?>>
							<a href="<?php echo esc_url( $thb_permalink ); ?>" rel="permalink">
								<?php echo $thb_title; ?>
							</a>
						</h1>
					<?php endif; ?>
				<?php endif; ?>

				<?php if( thb_get_post_format() === 'quote' ) : ?>

					<span class="quote-author">
						<?php
							if ( ( $thb_quote_url = thb_get_post_format_quote_url() ) != '' ) {
								printf( '<a href="%s">%s</a>', $thb_quote_url, $thb_subtitle );
							} else {
								echo $thb_subtitle;
							}
						?>
					</span>

				<?php else : ?>

					<?php
						$timestamp = strtotime( get_the_date() );
						$microdate = date( 'Ymd', $timestamp );
					?>

					<div class="loop-post-meta" <?php thb_livestyle_element( 'loop_post_meta_classic' ); ?>>
						<ul>
							<li class="updated published thb-post-date" title="<?php echo $microdate; ?>"><?php echo get_the_date(); ?></li>
							<li class="vcard author thb-post-author"><?php _e('by', 'thb_text_domain'); ?> <span class="fn"><?php the_author_posts_link(); ?></span></li>
							<li class="comments">
								<a href="<?php comments_link(); ?>">
									<?php thb_comments_number(); ?>
								</a>
							</li>
						</ul>
					</div>

				<?php endif; ?>

				<?php if( thb_get_post_format() === 'link') : ?>
					<span class="post-format-link-url">
						<a href="<?php echo $thb_link_url; ?>" rel="external">
							<?php echo $thb_link_url; ?>
						</a>
					</span>
				<?php endif; ?>

			</header>

		<?php endif; ?>

		<?php if( thb_get_post_format() != 'quote') : ?>

			<div class="item-content entry-content">
				<?php if( get_the_excerpt() != '' && $thb_format != 'aside' ) : ?>
					<div class="thb-text">
						<?php if( !post_password_required() ) : ?>
							<?php the_excerpt(); ?>
						<?php else : ?>
							<?php _e('This post is password protected.', 'thb_text_domain'); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $thb_format == 'aside' ) : ?>
					<div class="thb-text">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if( thb_get_post_format() != 'aside' ) : ?>
				<a class="thb-btn thb-read-more" href="<?php echo esc_url( $thb_permalink ); ?>" rel="permalink">
					<?php _e( 'Read more', 'thb_text_domain' ); ?>
				</a>
			<?php endif; ?>

		<?php endif; ?>

		<?php if ( thb_is_blog_likes_active() ) : ?>
			<?php thb_like(); ?>
		<?php endif; ?>

	</div>

</div>