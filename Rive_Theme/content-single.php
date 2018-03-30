<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Believe
 */

$show_sep    = false;
$style       = '';
$clear       = '';
$excerpt     = get_the_excerpt();
$top_left    = "";
$small_image = false;
$post_date_d = get_the_date( 'd' );
$post_date_m = get_the_date( 'F' );

if ( LAYOUT == 'sidebar-no' ) {
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

$img           = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-image' );
$entry_utility = '';

$entry_utility .= '
	<div class="entry-top-utility">';

	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'ch' ) );
		if ( $categories_list ) {
			$entry_utility .= '
			<div class="category-link">
			' . sprintf( __( '<span class="%1$s"></span> %2$s', 'ch' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
			$show_sep = true;
			$entry_utility .= '
			</div>';
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'ch' ) );
		if ( $tags_list ) {
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
<div class="entry-content<?php if ( !isset($img[0]) ) { echo ' no-image'; } ?> row-fluid">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		if ( isset($img[0]) ) {
			?>
		<div class="entry-image"<?php echo $clear; ?>>
			<a class="size-thumbnail" href="<?php echo get_permalink(); ?>">
				<img src="<?php echo $img[0]; ?> "<?php echo $style; ?> class=" img-polaroid <?php echo $span_size; ?>" alt="" />
				<div class="border">
					<div class="open no_pluss" <?php echo $top_left; ?>></div>
				</div>
			</a>
			<div class="clearfix"></div>
			<div class="post-date">
				<div class="post-day"><?php echo $post_date_d; ?></div>
				<div class="post-month"><?php echo $post_date_m; ?></div>
			</div>
			<div class="entry-content-c">
				<div class="clearfix"></div>
				<?php echo $entry_utility; ?>
				<div class="clearfix"></div>
				<?php the_content(); ?>
				<?php edit_post_link( __( 'Edit', 'ch' ), '<span class="edit-link button blue">', '</span>' ); ?>
			</div>
		</div>
		<div class="clearfix"></div>
		<?php
		} else { ?>
		<div class="post-date">
			<div class="post-day"><?php echo $post_date_d; ?></div>
			<div class="post-month"><?php echo $post_date_m; ?></div>
		</div>
		<div class="entry-content-c">
			<div class="clearfix"></div>
			<?php echo $entry_utility; ?>
			<div class="clearfix"></div>
			<?php the_content(); ?>
			<?php edit_post_link( __( 'Edit', 'ch' ), '<span class="edit-link button blue">', '</span>' ); ?>
		</div>
		<div class="clearfix"></div>
		<?php
		}
		?>
		<?php
		// If a user has filled out their description, show a bio on their entries
		if ( get_the_author_meta( 'description' ) ) { ?>
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'ch_author_bio_avatar_size', 100 ) ); ?>
			</div><!-- end of author-avatar -->
			<div id="author-description">
				<div class="author-name"><?php printf( esc_attr__( '%s', 'ch' ), get_the_author() ); ?></div>
				<p><?php the_author_meta( 'description' ); ?></p>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'ch' ), get_the_author() ); ?>
					</a>
				</div><!-- end of author-link	-->
			</div><!-- end of author-description -->
			<div class="clearer"></div>
		</div><!-- end of entry-author-info -->
		<?php } ?>
	</div>
</div>