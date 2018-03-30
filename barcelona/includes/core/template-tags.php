<?php

/*
 * Comment List Callback
 */
if ( ! function_exists( 'barcelona_comments_cb' ) ) {
	function barcelona_comments_cb( $comment, $args, $depth ) {

		global $post;

		$GLOBALS['comment'] = $comment;
	?>
		<div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
				<div class="comment-author vcard">
					<div class="author-image">
						<?php if ( 0 != $args['avatar_size'] ) {echo get_avatar( $comment, $args['avatar_size'] );} ?>
					</div>
					<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
					<time datetime="<?php comment_time( 'c' ); ?>" class="comment-date">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>"><?php echo esc_html( get_comment_date() ); ?></a>
					</time>
					<?php edit_comment_link( esc_html__( 'Edit', 'barcelona' ), '  ', '' ); ?>
				</div><!-- .comment-author -->
				<div class="comment-content">
					<?php if ( $comment->comment_approved == '0' ): ?>
					<div class="alert alert-warning">
						<?php esc_html_e( 'Your comment is awaiting moderation.', 'barcelona' ); ?>
					</div>
					<?php endif; ?>
					<?php echo nl2br( get_comment_text() ); ?>
				</div><!-- .comment-content -->
				<div class="comment-meta">
					<ul class="clearfix">
						<li class="comment-reply">
							<?php
							comment_reply_link( array_merge( $args, array(
								'reply_text' => '<span class="fa fa-reply"></span>',
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) );
							?>
						</li>

						<?php

						if ( barcelona_get_option( 'show_comment_voting' ) == 'on' ):

							foreach ( array( 'up', 'down' ) as $k ):

							?>
							<li class="comment-vote<?php if ( $barcelona_voted = barcelona_is_voted_comment() ) { echo ' comment-vote-disabled'; } ?>">
								<button class="btn-vote btn-vote-<?php echo sanitize_html_class( $k ) . ( $barcelona_voted == $k ? ' btn-voted' : '' ); ?>" data-nonce="<?php echo wp_create_nonce( 'barcelona-comment-vote' ); ?>" data-type="<?php echo esc_attr( $k ); ?>" data-vote-type="comment" data-vote-id="<?php echo esc_attr( $comment->comment_ID ) .'_'. esc_attr( $post->ID ); ?>">
									<span class="fa fa-thumbs-<?php echo sanitize_html_class( $k ); ?>"></span>
									<span class="vote-num"><?php barcelona_comment_vote( $comment->comment_ID, $k ); ?></span>
								</button>
							</li>
							<?php

							endforeach;

						endif;

						?>

					</ul>
				</div><!-- .comment-metadata -->
			</article><!-- .comment-body -->
	<?php

	}
}

/*
 * Comments Navigation
 */
if ( ! function_exists( 'barcelona_comments_nav' ) ) {
	function barcelona_comments_nav( $position = 'top' ) {

	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
	<nav class="comments-nav comments-nav-<?php echo sanitize_html_class( $position ); ?>">

		<ul class="clearfix">
		<?php

			if ( $prev_link = get_previous_comments_link( esc_html__( '&laquo; Older Comments', 'barcelona' ) ) ) {
				printf( '<li class="nav-previous">%s</li>', $prev_link );
			}

			if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments &raquo;', 'barcelona' ) ) ) {
				printf( '<li class="nav-next">%s</li>', $next_link );
			}

		?>
		</ul>

	</nav><!-- .comments-nav -->
	<?php endif;

	}
}

/*
 * Post Voting
 */
if ( ! function_exists( 'barcelona_post_voting' ) ) {
	function barcelona_post_voting() {

	if ( barcelona_get_option( 'show_voting' ) == 'on' ): ?>
	<div class="post-vote row<?php if ( $barcelona_voted = barcelona_is_voted_post() ) { echo ' post-vote-disabled'; } ?>">

		<div class="col col-left col-xs-6">
			<button class="btn btn-vote btn-vote-up<?php echo ( $barcelona_voted == 'up' ) ? ' btn-voted' : ''; ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'barcelona-post-vote' ) ); ?>" data-type="up" data-vote-type="post">
				<span class="fa fa-thumbs-up"></span><?php esc_html_e( 'Vote Up', 'barcelona' ); ?>
			</button>
		</div>

		<div class="col col-right col-xs-6">
			<button class="btn btn-vote btn-vote-down<?php echo ( $barcelona_voted == 'down' ) ? ' btn-voted' : ''; ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'barcelona-post-vote' ) ); ?>" data-type="down" data-vote-type="post">
				<span class="fa fa-thumbs-down"></span><?php esc_html_e( 'Vote Down', 'barcelona' ); ?>
			</button>
		</div>

	</div><!-- .post-vote -->
	<?php endif;

	}
}

/*
 * Social Sharing
 */
if ( ! function_exists( 'barcelona_social_sharing' ) ) {
	function barcelona_social_sharing() {

		if ( barcelona_get_option( 'show_social_sharing' ) == 'on' ): ?>
		<div class="post-sharing">

			<ul class="list-inline text-center">
				<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_the_permalink() ); ?>" target="_blank" title="<?php printf( esc_html__( 'Share on %s', 'barcelona' ), 'Facebook' ); ?>"><span class="fa fa-facebook"></span></a></li>
				<li><a href="https://twitter.com/home?status=<?php echo urlencode( get_the_title() .' - '. get_the_permalink() ); ?>" target="_blank" title="<?php printf( esc_html__( 'Share on %s', 'barcelona' ), 'Twitter' ); ?>"><span class="fa fa-twitter"></span></a></li>
				<li><a href="https://plus.google.com/share?url=<?php echo urlencode( get_the_permalink() ); ?>" target="_blank" title="<?php printf( esc_html__( 'Share on %s', 'barcelona' ), 'Google+' ); ?>"><span class="fa fa-google-plus"></span></a></li>
				<li><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_the_permalink() ); ?>&amp;media=<?php barcelona_thumbnail_url( 'barcelona-lg' ); ?>&amp;description=<?php echo urlencode( get_the_title() ); ?>" target="_blank" title="<?php printf( esc_html__( 'Share on %s', 'barcelona' ), 'Pinterest' ); ?>"><span class="fa fa-pinterest"></span></a></li>
				<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode( get_the_permalink() ); ?>&amp;title=<?php echo urlencode( get_the_title() ); ?>&amp;summary=<?php echo urlencode( get_the_excerpt() ); ?>&amp;source=<?php esc_attr( get_bloginfo( 'name' ) ) ?>" target="_blank" title="<?php printf( esc_html__( 'Share on %s', 'barcelona' ), 'Linkedin' ); ?>"><span class="fa fa-linkedin"></span></a></li>
			</ul>

		</div><!-- .post-sharing -->
		<?php endif;

	}
}

/*
 * Author box
 */
if ( ! function_exists( 'barcelona_author_box' ) ) {
	function barcelona_author_box( $barcelona_author_id = NULL, $is_inverse = true ) {

	if ( barcelona_get_option( 'show_author_box' ) != 'on' && ! is_page_template( 'page-authors.php' ) ) {
		return false;
	}

	if ( is_null( $barcelona_author_id ) ) {

		$barcelona_obj = get_queried_object();

		$barcelona_author_id = is_author() ? $barcelona_obj->data->ID : get_the_author_meta( 'ID' );

		if ( empty( $barcelona_author_id ) ) {
			return false;
		}

	}

	$barcelona_author_social_links = barcelona_get_author_social_links( $barcelona_author_id );
	$barcelona_is_template = is_page_template( 'page-authors.php' );

	$barcelona_cls = array( 'author-box' );
	if ( $is_inverse ) {
		$barcelona_cls[] = 'author-box-inverse';
	}

	?>
	<div class="<?php echo implode( ' ', $barcelona_cls ); ?>">

		<div class="author-image">
			<?php

			if ( $barcelona_is_template ) {
				echo '<a href="'. esc_url( get_author_posts_url( $barcelona_author_id ) ) .'" rel="author">';
			}

			echo get_avatar( get_the_author_meta( 'user_email', $barcelona_author_id ), 164 );

			if ( $barcelona_is_template ) {
				echo '</a>';
			}

			?>
		</div>

		<div class="author-details">

			<span class="author-name">
				<a href="<?php echo esc_url( get_author_posts_url( $barcelona_author_id ) ); ?>" rel="author">
					<?php the_author_meta( 'display_name', $barcelona_author_id ); ?>
				</a>
			</span>

			<span class="author-title">
				<?php the_author_meta( 'job_title', $barcelona_author_id ); ?>
			</span>

			<?php if ( is_array( $barcelona_author_social_links ) ): ?>
			<ul class="author-social list-inline">
				<?php foreach ( $barcelona_author_social_links as $v ): ?>
					<li>
						<a href="<?php echo esc_url( $v['href'] ); ?>">
							<span class="fa fa-<?php echo sanitize_html_class( $v['icon'] ); ?>"></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

			<p class="author-desc">
				<?php the_author_meta( 'description', $barcelona_author_id ); ?>
			</p>

		</div><!-- .author-details -->

	</div><!-- .author-box -->
	<?php

	}
}

/*
 * Breadcrumb
 */
if ( ! function_exists( 'barcelona_breadcrumb' ) ) {
	function barcelona_breadcrumb() {

		if ( barcelona_get_option( 'show_breadcrumb' ) != 'on' ) {
			return;
		}

		$barcelona_post_type = is_single() ? get_post_type() : NULL;
		$barcelona_sep_icon = '';
		$barcelona_items = '';

		if ( ( $barcelona_post_type == 'post' && ! is_attachment() ) || is_category() ) {

			$barcelona_categories = is_category() ? array() : get_the_category();
			$barcelona_current_cat = $barcelona_last_cat = is_category() ? get_queried_object() : $barcelona_categories[0];

			$barcelona_counter = 3;
			while ( $barcelona_current_cat->category_parent != '0' ) {

				$barcelona_current_cat = get_category( $barcelona_current_cat->category_parent );

				$barcelona_items = $barcelona_sep_icon .'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. esc_url( get_category_link( $barcelona_current_cat ) ) .'"><span itemprop="name">'. esc_html( $barcelona_current_cat->name ) .'</span></a><meta itemprop="position" content="%'. $barcelona_counter .'%" /></li>'. $barcelona_items;

				$barcelona_counter++;

			}

			$barcelona_items .= $barcelona_sep_icon .'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><'. ( is_category() ? 'span' : 'a href="'. esc_url( get_category_link( $barcelona_last_cat ) ) .'"' ) .' itemprop="item"><span itemprop="name">'. esc_html( $barcelona_last_cat->name ) .'</span></'. ( is_category() ? 'span' : 'a' ) .'><meta itemprop="position" content="%2%" /></li>';

			if ( $barcelona_counter > 3 ) {

				$barcelona_arr = array_reverse( range( 2, $barcelona_counter - 1 ) );
				foreach( $barcelona_arr as $k => $v ) {
					$barcelona_items = str_replace( 'itemprop="position" content="%'. intval( $k + 2 ) .'%"', 'itemprop="position" content="'. intval( $v ) .'"', $barcelona_items );
				}

			} else {
				$barcelona_items = str_replace( 'content="%2%"', 'content="2"', $barcelona_items );
			}

		} else if ( is_archive() || is_search() || is_page() ) {

			$barcelona_title = is_search() ? esc_html__( 'Search Results', 'barcelona' ) : esc_html( get_the_archive_title() );

			if ( is_author() ) {

				$barcelona_title = esc_html__( 'Author Archive', 'barcelona' );

			} else if ( is_year() ) {

				$barcelona_title = esc_html__( 'Yearly Archive', 'barcelona' );

			} else if ( is_month() ) {

				$barcelona_title = esc_html__( 'Monthly Archive', 'barcelona' );

			} else if ( is_day() ) {

				$barcelona_title = esc_html__( 'Daily Archive', 'barcelona' );

			} else if ( is_tag() ) {

				$barcelona_title = esc_html__( 'Tag Archive', 'barcelona' );

			} else if ( is_page() ) {

				global $post;

				$barcelona_title = esc_html( $post->post_title );

			}

			$barcelona_items .= $barcelona_sep_icon .'<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="item"><span itemprop="name">'. $barcelona_title .'</span></span><meta itemprop="position" content="2" /></li>';

		}

		$barcelona_items = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. esc_url( home_url( '/' ) ) .'">'. esc_html_x( 'Home', 'breadcrumb', 'barcelona' ) .'</a><meta itemprop="position" content="1" /></li>'. $barcelona_items;

		echo '<div class="breadcrumb-wrapper"><div class="container"><ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">'. $barcelona_items .'</ol></div></div>';

	}
}

/*
 * Featured image
 */
if ( ! function_exists( 'barcelona_featured_img' ) ) {
	function barcelona_featured_img( $barcelona_fimg_id=NULL ) {

		global $post;

		$barcelona_in_loop = in_the_loop();
		$barcelona_post_format = barcelona_get_post_format();
		$barcelona_is_media = in_array( $barcelona_post_format, array( 'audio', 'gallery', 'video' ) );
		$barcelona_display = 'full';
		$barcelona_fimg_disabled = false;

		if ( is_null( $barcelona_fimg_id ) ) {
			$barcelona_fimg_id = sanitize_key( barcelona_get_option( 'featured_image_style' ) );
		}

		if ( $barcelona_fimg_id == 'none' ) {
			$barcelona_fimg_id = 'cl';
			$barcelona_fimg_disabled = true;
		}

		if ( $barcelona_is_media && in_array( $barcelona_fimg_id, array( 'sp', 'fp', 'fs' ) ) ) {
			$barcelona_fimg_id = 'sw';
		}

		if ( in_array( $barcelona_post_format, array( 'gallery', 'video' ) ) && $barcelona_fimg_id != 'cl' ) {
			$barcelona_fimg_id = 'fw';
		}

		if ( $barcelona_in_loop && $barcelona_is_media && $barcelona_fimg_id != 'cl' ) {
			$barcelona_display = 'title';
			$barcelona_fimg_id = 'cl';
		}

		// Post title
		$barcelona_post_title = '<h1 class="post-title">'. esc_html( $post->post_title ) .'</h1>';
		if ( is_attachment() && ! empty( $post->post_excerpt ) ) {
			$barcelona_post_title .= '<h3 class="post-excerpt">'. esc_html( $post->post_excerpt ) .'</h3>';
		}

		if ( barcelona_get_option( 'show_title' ) == 'off' ) {
			$barcelona_post_title = '';
		}

		// Post meta
		$barcelona_post_meta = barcelona_post_meta( barcelona_get_option( 'post_meta_choices' ), false, false );

		$barcelona_media_output = '';
		if ( $barcelona_post_format == 'gallery' ) {

			$barcelona_gallery = get_post_meta( get_the_ID(), 'barcelona_format_gallery', true );

			if ( ! empty( $barcelona_gallery ) ) {
				$barcelona_size = ( $barcelona_fimg_id == 'fw' ) ? 'barcelona-lg' : 'barcelona-md';
				$barcelona_media_output = do_shortcode( '[gallery ids="'. esc_attr( $barcelona_gallery ) .'" size="'. esc_attr( $barcelona_size ) .'" type="featured"]' );
			}

		} else if ( in_array( $barcelona_post_format, array( 'audio', 'video' ) ) ) {

			$barcelona_media_format_type = barcelona_get_option( 'format_'. $barcelona_post_format .'_type', true );

			if ( $barcelona_media_format_type == 'internal' ) {
				$barcelona_media_output = barcelona_get_option( 'format_'. $barcelona_post_format .'_url', true );
			} else if ( $barcelona_media_format_type == 'external' ) {
				$barcelona_media_output = barcelona_get_option( 'format_'. $barcelona_post_format .'_embed', true );
			}

			if ( ! empty( $barcelona_media_output ) ) {

				$barcelona_media_output = hybrid_media_grabber( array(
					'split_media'   => true,
					'content'       => $barcelona_media_output
				) );

			}

		}

		$barcelona_featured_image_url = $barcelona_fimg_disabled ? false : barcelona_get_thumbnail_url( ( $barcelona_fimg_id == 'cl' ? 'barcelona-md' : 'barcelona-full' ), NULL, false );

		$barcelona_featured_image_credit = barcelona_get_option( 'featured_image_credit', true );

		$barcelona_fimg_classes = array(
			'fimg-wrapper',
			'fimg-'. $barcelona_fimg_id
		);

		if ( empty( $barcelona_post_meta ) ) {
			$barcelona_fimg_classes[] = 'fimg-no-meta';
		}

		if ( $barcelona_is_media ) {

			$barcelona_fimg_classes = array_merge( $barcelona_fimg_classes, array(
				'fimg-media',
				'fimg-media-'. $barcelona_post_format
			));

			if ( isset( $barcelona_media_format_type ) ) {
				$barcelona_fimg_classes[] = 'fimg-media-'. $barcelona_media_format_type;
			}

		}

		if ( ! $barcelona_featured_image_url || $barcelona_is_media ) {

			if ( empty( $barcelona_post_title ) ) {
				return false;
			}

			$barcelona_fimg_classes[] = 'fimg-no-thumb';
			$barcelona_featured_image_credit = '';

		}

		if ( $barcelona_in_loop && $barcelona_fimg_id == 'cl' ) { ?>
			<header class="post-image">

				<?php if ( $barcelona_featured_image_url && ! $barcelona_is_media ): ?>
				<?php if ( ! empty( $barcelona_featured_image_credit ) ): ?>
				<span class="featured-image-credit"><?php echo esc_html( $barcelona_featured_image_credit ); ?></span>
				<?php endif; ?>
				<script>jQuery(document).ready(function($){ $('.fimg-inner').backstretch('<?php echo esc_url( $barcelona_featured_image_url[0] ); ?>', {fade: 600}); });</script>
				<?php endif; ?>

				<div class="<?php echo implode( ' ', array_unique( $barcelona_fimg_classes ) ); ?>">

					<?php
					if ( $barcelona_post_format == 'video' && $barcelona_display != 'title' ) {
						echo $barcelona_media_output;
						$barcelona_display = 'title';
					}
					?>

					<div class="featured-image">
						<div class="fimg-inner">
							<div class="vm-wrapper">
								<div class="vm-middle">
									<?php echo ( $barcelona_display == 'title' ? '' : $barcelona_media_output ) . $barcelona_post_title ."\n". $barcelona_post_meta; ?>
								</div>
							</div>
						</div>
					</div>

				</div><!-- .fimg-wrapper -->

			</header>

		<?php } elseif ( ! $barcelona_in_loop && $barcelona_fimg_id != 'cl' ) {

			$barcelona_fimg_classes[] = 'container'. ( $barcelona_fimg_id != 'fw' ? '-fluid' : '' );

			if ( in_array( $barcelona_fimg_id, array( 'fw', 'sw' ) ) && $barcelona_featured_image_url && ! $barcelona_is_media ) { ?>
			<script>jQuery(document).ready(function($){ $('.fimg-inner').backstretch('<?php echo esc_url( $barcelona_featured_image_url[0] ); ?>', {fade: 600}); });</script>
			<?php }

			echo '<div class="'. implode( ' ', array_unique( $barcelona_fimg_classes ) ) .'">';

			if ( $barcelona_fimg_id == 'fw' ): ?>

				<div class="featured-image">
					<?php if ( ! empty( $barcelona_featured_image_credit ) ): ?>
					<span class="featured-image-credit"><?php echo esc_html( $barcelona_featured_image_credit ); ?></span>
					<?php endif; ?>
					<div class="fimg-inner">
						<div class="vm-wrapper">
							<div class="vm-middle">
								<?php echo $barcelona_is_media ? $barcelona_media_output : $barcelona_post_title ."\n". $barcelona_post_meta; ?>
							</div>
						</div>
					</div>
				</div>

			<?php elseif ( $barcelona_fimg_id == 'sw' ): ?>

				<div class="featured-image">

					<?php if ( ! empty( $barcelona_featured_image_credit ) ): ?>
					<span class="featured-image-credit"><?php echo esc_html( $barcelona_featured_image_credit ); ?></span>
					<?php endif; ?>

					<div class="fimg-inner">

						<?php if ( $barcelona_post_format == 'audio' ) { ?>
						<div class="vm-wrapper">
							<div class="vm-middle">
								<?php echo $barcelona_media_output; ?>
							</div>
						</div>
						<?php } else { ?>
						<div class="container">
							<div class="vm-wrapper">
								<div class="vm-middle">
									<?php echo $barcelona_post_title ."\n". $barcelona_post_meta; ?>
								</div>
							</div>
						</div>
						<?php } ?>

					</div>

				</div>

			<?php elseif ( $barcelona_fimg_id == 'sp' ): ?>

				<div class="featured-image">

					<?php if ( ! empty( $barcelona_featured_image_credit ) ): ?>
					<span class="featured-image-credit"><?php echo esc_html( $barcelona_featured_image_credit ); ?></span>
					<?php endif; ?>

					<div class="container">
						<div class="fimg-inner">

							<div class="vm-wrapper">
								<div class="vm-middle">
									<?php echo $barcelona_post_title ."\n". $barcelona_post_meta; ?>
								</div>
							</div>

						</div>
					</div>

					<?php if ( $barcelona_featured_image_url ): ?>
					<div class="barcelona-parallax-wrapper">
						<div class="barcelona-parallax-inner">
							<img src="<?php echo esc_url( $barcelona_featured_image_url[0] ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" />
						</div>
					</div>
					<?php endif; ?>

				</div>

			<?php elseif ( $barcelona_fimg_id == 'fs' ): ?>

				<div class="featured-image">

					<?php if ( ! empty( $barcelona_featured_image_credit ) ): ?>
					<span class="featured-image-credit"><?php echo esc_html( $barcelona_featured_image_credit ); ?></span>
					<?php endif; ?>

					<div class="container">
						<div class="fimg-inner">

							<div class="vm-wrapper">
								<div class="vm-middle">
									<?php echo $barcelona_post_title ."\n". $barcelona_post_meta; ?>
								</div>
							</div>

						</div>
					</div>

					<?php if ( $barcelona_featured_image_url ): ?>
					<div class="barcelona-parallax-wrapper">
						<div class="barcelona-parallax-inner">
							<img src="<?php echo esc_url( $barcelona_featured_image_url[0] ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" />
						</div>
					</div>
					<?php endif; ?>

				</div>

			<?php elseif ( $barcelona_fimg_id == 'fp' ): ?>

				<div class="featured-image">

					<div class="container">
						<div class="fimg-inner">

							<div class="vm-wrapper">
								<div class="vm-middle">
									<?php echo $barcelona_post_title ."\n". $barcelona_post_meta; ?>
								</div>
							</div>

						</div>
					</div>

					<?php if ( $barcelona_featured_image_url ): ?>
					<div class="barcelona-parallax-wrapper">

						<?php if ( ! empty( $barcelona_featured_image_credit ) ): ?>
						<span class="featured-image-credit"><?php echo esc_html( $barcelona_featured_image_credit ); ?></span>
						<?php endif; ?>

						<div class="barcelona-parallax-inner">
							<img src="<?php echo esc_url( $barcelona_featured_image_url[0] ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" />
						</div>

					</div>
					<?php endif; ?>

				</div>

			<?php endif;

			echo '</div>';

		}

	}
}

/*
 * Pagination
 */
if ( ! function_exists( 'barcelona_pagination' ) ) {
	function barcelona_pagination( $barcelona_type='numeric', $barcelona_query=false ) {

		global $wp_query, $paged;

		if ( ! $barcelona_query ) {
			$barcelona_query = $wp_query;
		}

		$barcelona_max_num_pages = is_single() ? 99999 : $barcelona_query->max_num_pages;

		if ( $paged == 0 ) {

			$paged = 1;

			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			}

		}

		if ( $barcelona_type == 'none'
				|| $barcelona_max_num_pages <= 1
				|| ( in_array( $barcelona_type, array( 'loadmore', 'infinite' ) ) && $paged >= $barcelona_max_num_pages ) ) {
			return false;
		}

		$barcelona_output = '';
		$barcelona_post_type = get_post_type();

		if ( $barcelona_type == 'numeric' ) {

			$barcelona_output = paginate_links( array(
				'base'      => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ),
				'format'    => '',
				'current'   => max( 1, $paged ),
				'total'     => $barcelona_max_num_pages,
				'prev_text' => esc_html__( '&laquo; Prev', 'barcelona' ),
				'next_text' => esc_html__( 'Next &raquo;', 'barcelona' )
			) );

		} else if ( $barcelona_type == 'nextprev' ) {

			if ( is_single() ) {

				if ( $barcelona_post_type == 'post' && barcelona_get_option( 'show_post_nav' ) == 'on' ) {

					$barcelona_prev = get_previous_post_link( '%link', '<span class="fa fa-angle-left"></span> %title' );
					$barcelona_next = get_next_post_link( '%link', '<span class="fa fa-angle-right"></span> %title' );

					if ( ! is_null( $barcelona_prev ) || ! is_null( $barcelona_next ) ) {
						$barcelona_output = '<div class="row posts-nav"><div class="col col-xs-6">'. $barcelona_prev .'</div><div class="col col-xs-6">'. $barcelona_next .'</div></div>';
					}

				}

			} else {

				$barcelona_output .= get_next_posts_link( esc_html__( '&laquo; Older Entries', 'barcelona' ), $barcelona_max_num_pages );
				$barcelona_output .= get_previous_posts_link( esc_html__( 'Newer Entries &raquo;', 'barcelona' ), $barcelona_max_num_pages );

			}

		} else if ( $barcelona_type == 'loadmore' ) {

			$barcelona_output .= '<button type="button" class="btn btn-full" data-paged="'. $paged .'" data-max-pages="'. $barcelona_max_num_pages .'"><span class="btn-loader"><img src="'. BARCELONA_THEME_PATH .'assets/images/barcelona-loader.gif" alt="'. esc_html__( 'Loading...', 'barcelona' ) .'" /></span><span class="btn-text">'. esc_html__( 'Load More', 'barcelona' ) .'</span></button>';

		} else if ( $barcelona_type == 'infinite' ) {

			$barcelona_output .= '<button type="button" class="btn btn-full" data-paged="'. $paged .'" data-max-pages="'. $barcelona_max_num_pages .'" disabled><span class="btn-loader"><img src="'. BARCELONA_THEME_PATH .'assets/images/barcelona-loader.gif" alt="'. esc_html__( 'Loading...', 'barcelona' ) .'" /></span></button>';

		}

		if ( ! empty( $barcelona_output ) ) {

			$barcelona_output = '<div class="pagination '. sanitize_html_class( 'pagination-'. $barcelona_type ) .'">'. $barcelona_output .'</div>';

		}

		echo $barcelona_output;

		return true;

	}
}

/*
 * Header & Footer logo
 */
if ( ! function_exists( 'barcelona_logo' ) ) {
	function barcelona_logo( $location='header' ) {

	if ( ! in_array( $location, array( 'footer', 'sticky_nav' ) ) ) {
		$location = 'header';
	}

	$barcelona_options = barcelona_get_options( array(
		'show_'. $location .'_logo_as_text',
		$location .'_logo_text',
		$location .'_dark_logo_url',
		$location .'_dark_retina_logo_url',
		$location .'_light_logo_url',
		$location .'_light_retina_logo_url'
	) );

	$barcelona_logo_text = esc_html( get_bloginfo( 'name' ) );

	echo '<span class="logo-location-'. $location .' clearfix">';

	if ( $barcelona_options['show_'. $location .'_logo_as_text'] == 'on' ) {

		echo esc_html( $barcelona_options[ $location .'_logo_text' ] );

	} else if ( ! empty( $barcelona_options[ $location .'_dark_logo_url' ] ) || ! empty( $barcelona_options[ $location .'_light_logo_url' ] ) ) {

		$barcelona_single_cls = ( empty( $barcelona_options[ $location .'_dark_logo_url' ] ) || empty( $barcelona_options[ $location .'_light_logo_url' ] ) ) ? 'logo-single ' : 'logo-both ';

		foreach ( array( 'dark', 'light' ) as $k ) {
			if ( ! empty( $barcelona_options[ $location .'_'. $k .'_logo_url' ] ) ) {
				echo '<span class="logo-img '. $barcelona_single_cls .'logo-'. $k .'"><img src="'. esc_url( $barcelona_options[ $location .'_'. $k .'_logo_url' ] ) .'" alt="'. esc_attr( $barcelona_logo_text ) .'"'. (  ( ! empty( $barcelona_options[ $location .'_'. $k .'_retina_logo_url' ] ) ) ? ' data-at2x="'. esc_url( $barcelona_options[ $location .'_'. $k .'_retina_logo_url' ] ) .'"' : '' ) .' /></span>';
			}
		}

	} else {

		echo $barcelona_logo_text;

	}

	echo '</span>';

	if ( $location == 'header' && barcelona_get_option( 'sticky_nav_logo' ) == 'custom' ) {
		barcelona_logo( 'sticky_nav' );
	}

	}
}

/*
 * Social Icons
 */
if ( ! function_exists( 'barcelona_social_icons' ) ) {
	function barcelona_social_icons( $items=array() ) {

	$output = '';

	if ( ! is_array( $items ) || empty( $items ) ) {
		$items = false;
	}

	$barcelona_social_links = barcelona_get_social_links();

	foreach ( $barcelona_social_links as $k => $v ) {
		if ( $items && ! in_array( $k, $items ) ) {
			unset( $barcelona_social_links[ $k ] );
		}
	}

	if ( ! empty( $barcelona_social_links ) ) {

		$output = '<ul class="social-icons">';

		foreach ( $barcelona_social_links as $k => $v ) {
			$output .= '<li><a target="_blank" href="'. esc_url( $v['href'] ) .'" title="'. esc_attr( $v['title'] ) .'"><span class="fa fa-'. sanitize_html_class( $v['icon'] ) .'"></span></a></li>';
		}

		$output .= '</ul>';

	}

	return $output;

	}
}

/*
 * Post summary overlay icon
 */
if ( ! function_exists( 'barcelona_psum_overlay' ) ) {
	function barcelona_psum_overlay( $echo=true ) {

	$barcelona_post_format = barcelona_get_post_format();

	$output = '';

	switch ( $barcelona_post_format ) {
		case 'aside':
			$barcelona_icon = 'sticky-note';
			break;
		case 'audio':
			$barcelona_icon = 'volume-up';
			break;
		case 'gallery':
			$barcelona_icon = 'th-large';
			break;
		case 'image':
			$barcelona_icon = 'image';
			break;
		case 'video':
			$barcelona_icon = 'play';
			break;
	}

	if ( isset ( $barcelona_icon ) ) {
		$output = '<div class="overlay trs"><span class="fa fa-'. sanitize_html_class( $barcelona_icon ) .'"></span></div>';
	}

	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}

	return true;

	}
}

/*
 * Header Ad
 */
if ( ! function_exists( 'barcelona_header_ad' ) ) {
	function barcelona_header_ad() {

	$barcelona_ads = barcelona_get_options( array(
		'add_header_ad',
		'header_style',
		'header_ad_1',
		'header_ad_2'
	) );

	if ( $barcelona_ads['header_style'] == 'a' && $barcelona_ads['add_header_ad'] != 'off' ) {

		foreach ( array( 'lg', 'sm' ) as $k => $v ):

			$barcelona_code = $barcelona_ads[ 'header_ad_'. ($k+1) ];

			if ( ! empty( $barcelona_code ) ): ?>
			<div class="navbar-bn visible-<?php echo sanitize_html_class( $v ) . ( $v == 'lg' ? ' visible-md' : '' ); ?>">
				<?php echo do_shortcode( $barcelona_code ); ?>
			</div>
			<?php endif;

		endforeach;

	}

	}
}

/*
 * Post Content Ad
 */
if ( ! function_exists( 'barcelona_post_ad' ) ) {
	function barcelona_post_ad() {

	$barcelona_ads = barcelona_get_options( array(
		'show_post_content_ad',
		'post_content_ad',
		'post_content_ad_1',
		'post_content_ad_2'
	) );

	if ( $barcelona_ads['show_post_content_ad'] == 'on' || $barcelona_ads['post_content_ad'] == 'custom' ) {

		foreach ( array( 'lg', 'md' ) as $k => $v ):

			$barcelona_code = $barcelona_ads[ 'post_content_ad_'. ($k+1) ];

			if ( ! empty( $barcelona_code ) ): ?>
			<div class="content-bn visible-<?php echo sanitize_html_class( $v ) . ( $v == 'lg' ? ' visible-sm' : '' ); ?>">
				<?php echo do_shortcode( $barcelona_code ); ?>
			</div>
			<?php endif;

		endforeach;

	}

	}
}

/*
 * Related posts
 */
if ( ! function_exists( 'barcelona_related_posts' ) ) {
	function barcelona_related_posts() {

	if ( barcelona_get_option( 'show_related_posts' ) != 'on' || ! is_single() ) {
		return;
	}

	$barcelona_post_id = get_the_ID();

	$barcelona_tags = wp_get_post_tags( $barcelona_post_id );

	$barcelona_posts_per_page = barcelona_get_option( 'related_posts_num' );
	$barcelona_col_number = intval( barcelona_get_option( 'related_posts_columns' ) );
	if ( ! is_numeric( $barcelona_col_number ) || $barcelona_col_number == 0 || ! is_single() ) {
		$barcelona_col_number = 3;
	}

	$barcelona_post_ids = array();
	if ( ! is_null( $barcelona_tags ) ) {

		$barcelona_tags_str = '';
		foreach ( $barcelona_tags as $t ) {
			$barcelona_tags_str .= ','. $t->slug;
		}

		$barcelona_q_params = array(
			'tag'                   => ltrim( $barcelona_tags_str, ',' ),
			'post_type'             => 'post',
			'post_status'           => 'publish',
			'posts_per_page'        => $barcelona_posts_per_page,
			'post__not_in'          => array( $barcelona_post_id ),
			'ignore_sticky_posts'   => false,
			'order_by'              => 'date',
			'order'                 => 'DESC'
		);

		$barcelona_q = new WP_Query( $barcelona_q_params );

		if ( $barcelona_q->have_posts() ) {

			while( $barcelona_q->have_posts() ) {
				$barcelona_q->the_post();
				$barcelona_post_ids[] = get_the_ID();
			}

			wp_reset_postdata();

		}

		$barcelona_post_ids = array_unique( $barcelona_post_ids );

	}

	$barcelona_diff = $barcelona_posts_per_page - count( $barcelona_post_ids );

	if ( $barcelona_diff > 0 ) {

		$barcelona_cats = get_the_category();

		$barcelona_cat_in = array();
		foreach ( $barcelona_cats as $t ) {
			$barcelona_cat_in[] = $t->term_id;
		}

		$barcelona_q_params = array(
			'category__in'          => $barcelona_cat_in,
			'post_type'             => 'post',
			'post_status'           => 'publish',
			'posts_per_page'        => $barcelona_diff,
			'ignore_sticky_posts'   => false,
			'post__not_in'          => array( $barcelona_post_id ),
			'order_by'              => 'date',
			'order'                 => 'DESC'
		);

		$barcelona_q = new WP_Query( $barcelona_q_params );

		if ( $barcelona_q->have_posts() ) {

			while( $barcelona_q->have_posts() ) {
				$barcelona_q->the_post();
				$barcelona_post_ids[] = get_the_ID();
			}

			wp_reset_postdata();

		}

		$barcelona_post_ids = array_unique( $barcelona_post_ids );

	}

	$barcelona_retrieved_posts = count( $barcelona_post_ids );

	if ( $barcelona_retrieved_posts > 0 ) {

		$barcelona_posts_num_exceed = $barcelona_retrieved_posts % $barcelona_col_number;

		if ( $barcelona_posts_num_exceed > 0 ) {
			$barcelona_post_ids = array_slice( $barcelona_post_ids, 0, $barcelona_retrieved_posts - $barcelona_posts_num_exceed );
		}

		$barcelona_q_params = array(
			'post__in' => $barcelona_post_ids,
			'orderby' => 'post__in'
		);

		$barcelona_q = new WP_Query( $barcelona_q_params );

		$barcelona_mod_header = '<div class="box-header archive-header has-title"><h2 class="title">'. esc_html__( 'Related Posts', 'barcelona' ) .'</h2></div>';

		include( locate_template( 'includes/modules/module-f.php' ) );

	}

	}
}

/*
 * Featured Posts
 */
if ( ! function_exists( 'barcelona_featured_posts' ) ) {
	function barcelona_featured_posts() {

		global $barcelona_mod_header, $barcelona_duplication_prevented_posts, $post;

		$barcelona_fp_type = 'category';
		$barcelona_has_autoplay = false;

		if ( is_page_template( 'page-modules.php' ) ) {

			global $post;
			$barcelona_fp_type = 'page';

			$barcelona_q = barcelona_get_featured_posts_query( $post->ID, $barcelona_fp_type );
			$barcelona_has_autoplay = ( get_post_meta( $post->ID, 'barcelona_fp_is_autoplay', true ) == 'on' );
            $barcelona_fp_owl_choices = get_post_meta( $post->ID, 'barcelona_fp_owl_choices', true );

		} else if ( is_category() ) {

			$barcelona_cat_id = get_query_var( 'cat' );

			$barcelona_q = barcelona_get_featured_posts_query( $barcelona_cat_id, $barcelona_fp_type );
			$barcelona_has_autoplay = ( barcelona_get_option( 'fp_is_autoplay__category_' . $barcelona_cat_id ) == 'on' );
            $barcelona_fp_owl_choices = get_post_meta( $post->ID, 'barcelona_fp_owl_choices', true );

		}

		if ( ! isset( $barcelona_q ) || ! $barcelona_q ) {
			return false;
		}


		if ( $barcelona_q->have_posts() ):

			$barcelona_fp_style = $barcelona_q->fp_style;

			$barcelona_owl_data = array(
				'dots' => 'false',
				'items' => 2,
				'center' => 'false',
				'nav' => 'true',
				'rtl' => is_rtl() ? 'true' : 'false',
				'breakpoint' => '0:1,992:',
				'loop' => 'false',
				'slideby' => 2
			);


		if (is_array($barcelona_fp_owl_choices) && in_array('autoplay', $barcelona_fp_owl_choices)) {
		    $barcelona_owl_data['autoplay'] = 'true';
		}
		if (is_array($barcelona_fp_owl_choices) && in_array('loop', $barcelona_fp_owl_choices)) {
		    $barcelona_owl_data['loop'] = 'true';
		}
		if (is_array($barcelona_fp_owl_choices) && in_array('stophover', $barcelona_fp_owl_choices)) {
		    $barcelona_owl_data['autoplayHoverPause'] = 'true';
		}
		if (is_array($barcelona_fp_owl_choices) && in_array('mousedrag', $barcelona_fp_owl_choices)) {
		    $barcelona_owl_data['mouseDrag'] = 'true';
		}
		if (is_array($barcelona_fp_owl_choices) && in_array('touchdrag', $barcelona_fp_owl_choices)) {
		    $barcelona_owl_data['touchDrag'] = 'true';
		}

			if ( $barcelona_has_autoplay ) {
				$barcelona_owl_data['loop'] = 'true';
				$barcelona_owl_data['autoplay'] = 'true';
			}

			if ( $barcelona_fp_style == 'a' ) {

				$barcelona_owl_data['items'] = $barcelona_owl_data['slideby'] = 1;
				$barcelona_owl_data['breakpoint'] .= '1';

			} else {

				$barcelona_owl_data['breakpoint'] .= '2';

			}

			?>
			<div class="featured-posts fptype-<?php echo sanitize_html_class( $barcelona_fp_type ); ?> fpstyle-<?php echo sanitize_html_class( $barcelona_fp_style ); ?>">

				<div class="container">

					<div class="owl-carousel owl-theme "<?php echo implode( array_map( function( $v, $k ) { return ' data-'. sanitize_key( $k ) .'="'. esc_attr( $v ) .'"'; }, $barcelona_owl_data, array_keys( $barcelona_owl_data ) ) ); ?>>

						<?php $i = 0; while ( $barcelona_q->have_posts() ): $barcelona_q->the_post();

						if ( $barcelona_q->prevent_duplication == 'on' && is_array( $barcelona_duplication_prevented_posts ) ) {
							$barcelona_duplication_prevented_posts[] = get_the_ID();
						}

						$barcelona_h = 2;
						if ( ( $barcelona_fp_style == 'c' && ($i+1)%3 != 0 ) || ( $barcelona_fp_style == 'd' && $i%3 != 0 ) || $barcelona_fp_style == 'e' ) {
							$barcelona_h = 1;
						}

						if ( ( ( $barcelona_fp_style == 'c' && $barcelona_q->post_count % 3 == 1 ) || ( $barcelona_fp_style == 'd' && $barcelona_q->post_count % 3 == 2 ) ) && $i == $barcelona_q->post_count - 1 ) {
							$barcelona_h = 2;
						}

						$barcelona_c = $barcelona_fp_style == 'a' ? 1 : 2;
						$barcelona_thumbnail_url = barcelona_get_thumbnail_url( 'barcelona-lg' );

						?>

						<?php if ( ( $barcelona_fp_style != 'c' || ($i-1)%3 != 0 ) && ( $barcelona_fp_style != 'd' || ($i+1)%3 != 0 ) ) { ?>
						<div class="item fp-col">
						<?php } ?>

							<div id="fpBox<?php echo intval( $i + 1 ); ?>" class="post-summary fp-box fp-box-h<?php echo intval( $barcelona_h ); ?> fp-box-c<?php echo intval( $barcelona_c ); ?>" data-bg="<?php echo esc_url( $barcelona_thumbnail_url[0] ); ?>">
								<div class="fp-inner">
									<div class="vm-wrapper">
										<div class="vm-middle">
											<h2 class="post-title"><?php echo esc_html( get_the_title() ); ?></h2>
											<?php barcelona_post_meta( $barcelona_q->post_meta_choices, false ); ?>
											<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="mask-title"><?php echo esc_html( get_the_title() ); ?></a>
										</div>
									</div>
								</div>
							</div>

							<?php if ( ! barcelona_is_empty( $barcelona_thumbnail_url[0] ) ) { ?>
							<script>jQuery(document).ready(function($){ $('#fpBox<?php echo intval( $i + 1 ); ?>').backstretch('<?php echo esc_url( $barcelona_thumbnail_url[0] ); ?>', {fade: 400}); });</script>
							<?php } ?>

						<?php if ( ( ( $barcelona_fp_style != 'c' || $i%3 != 0 ) && ( $barcelona_fp_style != 'd' || ($i-1)%3 != 0 ) ) || $i == $barcelona_q->post_count - 1 ) { ?>
						</div>
						<?php } ?>

						<?php $i++; endwhile; wp_reset_postdata(); ?>

					</div>

				</div>

			</div><!-- .featured-posts -->
			<?php

			if ( isset( $barcelona_mod_header ) ) {
				echo '<div class="container">'. $barcelona_mod_header .'</div>';
			}

			return true;

		endif;

		return false;

	}
}

/*
 * Post Meta
 */
if ( ! function_exists( 'barcelona_post_meta' ) ) {
	function barcelona_post_meta( $barcelona_opt, $barcelona_sep=true, $echo=true ) {

		global $post;

		$barcelona_html = '';
		$barcelona_cls = array( 'post-meta clearfix' );
		$barcelona_post_type = get_post_type( $post->ID );

		if ( ! $barcelona_sep ) {
			$barcelona_cls[] = 'no-sep';
		}

		$barcelona_categories_html = '';
		if ( $barcelona_post_type == 'post' ) {

			$barcelona_categories = get_the_category();

			$barcelona_categories_html = '<ul class="list-inline">';
			foreach ( $barcelona_categories as $c ) {
				$barcelona_categories_html .= '<li><a href="'. esc_url( get_category_link( $c ) ) .'">'. esc_html( $c->name ) .'</a></li>';
			}
			$barcelona_categories_html .= '</ul>';

		}

		if ( is_array( $barcelona_opt ) && ! empty( $barcelona_opt ) ) {

			$barcelona_html = '<ul class="'. implode( ' ', $barcelona_cls ) .'">';

			if ( in_array( 'date', $barcelona_opt ) ) {
				$barcelona_html .= '<li class="post-date"><span class="fa fa-clock-o"></span>'. esc_html( get_the_time( BARCELONA_DATE_FORMAT ) ) .'</li>';
			}

			if ( in_array( 'author', $barcelona_opt ) ) {
				$barcelona_html .= '<li class="post-author"><span class="fa fa-user"></span><a href="'. get_author_posts_url( $post->post_author ) .'" rel="author">'. get_the_author_meta( 'display_name', $post->post_author ) .'</a></li>';
			}

			if ( in_array( 'views', $barcelona_opt ) ) {
				$barcelona_html .= '<li class="post-views"><span class="fa fa-eye"></span>'. barcelona_get_post_views() .'</li>';
			}

			if ( in_array( 'likes', $barcelona_opt ) ) {
				$barcelona_html .= '<li class="post-likes"><span class="fa fa-thumbs-up"></span>'. barcelona_get_post_vote() .'</li>';
			}

			if ( in_array( 'comments', $barcelona_opt ) ) {
				$barcelona_html .= '<li class="post-comments"><span class="fa fa-comments"></span>'. intval( $post->comment_count ) .'</li>';
			}

			if ( in_array( 'categories', $barcelona_opt ) ) {
				$barcelona_html .= '<li class="post-categories"><span class="fa fa-bars"></span>'. $barcelona_categories_html .'</li>';
			}

			$barcelona_html .= '</ul>';

		}

		if ( $echo ) {
			echo $barcelona_html;
		}

		return $barcelona_html;

	}
}