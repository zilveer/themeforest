<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Believe
 */

$m = 0;

/* Start the Loop */
while ( have_posts() ) { the_post();
	global $ch_from_search, $ch_from_archive, $ch_blog_image_layout, $more;
	$more        = 0;
	$show_sep    = false;
	$style       = '';
	$clear       = '';
	$excerpt     = get_the_excerpt();
	$top_left    = "";
	$small_image = false;
	$post_date_d = get_the_date( 'd' );
	$post_date_m = get_the_date( 'F' );
	if ( !isset($show_date) ) {
		$show_date = true;
	}

	// Determine blog image size
	if ( $ch_blog_image_layout == 'with_full_image' || $ch_from_search || $ch_from_archive ) {
		if ( LAYOUT == 'sidebar-no' || $ch_from_search || $ch_from_archive ) {
			$img_width  = '1014';
			$img_height = '400';
		} else {
			$img_width  = '665';
			$img_height = '315';
			$top_left   = 'style="top: 38%; left: 45%;"';
		}
		$clear     = ' style="float: none;"';
		$style     = ' style=""';
		$span_size = 'span24';
	} else {
		$img_width   = '326';
		$img_height  = '240';
		$top_left    = 'style="top: 37%; left: 41%;"';
		$small_image = true;
		$span_size   = 'span8';
	}
	$img           = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-image' );
	$entry_utility = '';

	$entry_utility .= '
		<div class="entry-top-utility">';

		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'ch' ) );
			if ( $categories_list && $show_cat == 'true' ) {
				$entry_utility .= '
				<div class="category-link">
				' . sprintf( __( '<span class="%1$s"></span> %2$s', 'ch' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				$show_sep = true;
				$entry_utility .= '
				</div>';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'ch' ) );
			if ( $tags_list && $show_tags == 'true' ) {
				if ( $show_sep ) {
					$entry_utility .= '
					<div class="sep">&nbsp;</div>';
				}
				$entry_utility .= '
				<div class="tag-link">
				' . sprintf( __( '<span class="%1$s"></span> %2$s', 'ch' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true;
				$entry_utility .= '
				</div>';
			}
		}
		if ( $show_sep ) {
			$entry_utility .= '
			<div class="sep">&nbsp;</div>';
		}
		$entry_utility .= '
		<div class="clearfix"></div>
		</div>';
	?>
	<div class="entry-content<?php if ( !isset($img[0]) ) { echo ' no-image'; } ?><?php if ( $m == 0 ) { echo ' first-entry'; } ?> row-fluid">
		<?php
		if ( !isset( $from_shortcode ) ) {
			$from_shortcode = FALSE;
		}
		if ( ( isset($img[0]) && !$from_shortcode ) || ( isset($img[0]) && $from_shortcode && $show_image == 'true' ) ) {
			?>
		<div class="entry-image <?php echo $ch_blog_image_layout; ?>"<?php echo $clear; ?>>
			<?php
			if ( $small_image ) {
				$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'gallery-large');

				if ( LAYOUT != 'sidebar-no' ) {
					$image_span_size = ' span8';
				} else {
					$image_span_size = ' span8';
				}
			?>
			<a class="size-thumbnail<?php echo $image_span_size; ?>" href="<?php echo get_permalink(); ?>">
				<img src="<?php echo $img[0]; ?> "<?php echo $style; ?> class="img-polaroid <?php echo $span_size; ?>" alt="" />
				<div class="border">
					<div class="open no_pluss" <?php echo $top_left; ?>></div>
				</div>
			</a>
			<?php if ( $show_date == 'true' ) { ?>
			<div class="post-date">
				<div class="post-day"><?php echo $post_date_d; ?></div>
				<div class="post-month"><?php echo $post_date_m; ?></div>
			</div>
			<?php } ?>
			<div class="entry-content-c">
				<div class="item-title-bg">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'ch'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<div class="clearfix"></div>
				<?php echo $entry_utility; ?>
				<?php
				if ( is_search() ) {
					the_excerpt();
					if( empty($excerpt) )
						echo 'No excerpt for this posting.';

				} else {
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'ch' ) . '</span>', 'after' => '</div>' ) );
				}
				?>
				<div class="entry-bottom-utility">
					<div class="entry-utility">
						<?php if ( 'post' == get_post_type() ) {
							//ch_posted_on();

							if ( comments_open() && !post_password_required() && !is_page() ) : ?>
							<a href="<?php comments_link(); ?>" class="link blue"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a>
						<?php endif;
						}?>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php if (!$small_image) { ?>
			<a class="size-thumbnail" href="<?php echo get_permalink(); ?>">
				<img src="<?php echo $img[0]; ?> "<?php echo $style; ?> class="img-polaroid <?php echo $span_size; ?>" alt="" />
				<div class="border">
					<div class="open no_pluss" <?php echo $top_left; ?>></div>
				</div>
			</a>
			<div class="clearfix"></div>
			<?php if ( $show_date == 'true' ) { ?>
			<div class="post-date">
				<div class="post-day"><?php echo $post_date_d; ?></div>
				<div class="post-month"><?php echo $post_date_m; ?></div>
			</div>
			<?php } ?>
			<div class="entry-content-c">
				<div class="item-title-bg">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'ch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				</div>
				<div class="clearfix"></div>
				<?php echo $entry_utility; ?>
				<div class="clearfix"></div>
				<?php
				if ( is_search() ) {
					the_excerpt();
					if( empty($excerpt) )
						echo 'No excerpt for this posting.';

				} else {
					the_content();
					wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'ch' ) . '</span>', 'after' => '</div>' ) );
				}
				?>
				<div class="entry-bottom-utility">
					<div class="entry-utility">
						<?php if ( 'post' == get_post_type() ) {
							//ch_posted_on();

							if ( comments_open() && !post_password_required() && !is_page() ) : ?>
							<a href="<?php comments_link(); ?>" class="link blue"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a>
						<?php endif;
						}?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
		<?php
		} else { ?>
		<?php if ( $show_date == 'true' ) { ?>
		<div class="post-date">
			<div class="post-day"><?php echo $post_date_d; ?></div>
			<div class="post-month"><?php echo $post_date_m; ?></div>
		</div>
		<?php } ?>
		<div class="entry-content-c">
			<div class="item-title-bg">
				<div class="clearfix"></div>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'ch' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</div>
			<div class="clearfix"></div>
			<?php echo $entry_utility; ?>
			<div class="clearfix"></div>
			<?php
			if ( is_search() ) {
				the_excerpt();
				if( empty($excerpt) )
					echo 'No excerpt for this posting.';

			} else {
				the_content();
				wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'ch' ) . '</span>', 'after' => '</div>' ) );
			}
			?>
			<div class="entry-bottom-utility">
				<div class="entry-utility">
					<?php if ( 'post' == get_post_type() ) {
						//ch_posted_on();

						if ( comments_open() && !post_password_required() && !is_page() ) : ?>
						<a href="<?php comments_link(); ?>" class="link blue"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></a>
					<?php endif;
					}?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php
		}
		?>
	</div>
<?php $m++; }