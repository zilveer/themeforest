<?php get_header(); ?>

<header class="entry-header">
	<?php if ( get_the_title() ) { ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
	<?php } ?>
	<?php if ( $page_description = get_post_meta( $post->ID, 'flow_post_description', true ) ) { ?>
		<div class="page-description"><?php echo $page_description; ?></div>
	<?php } ?>
	
	<div class="single-meta clearfix">
		<div class="blog-comments-wrapper <?php if(get_comments_number() == '0'){ echo 'blog-comments-wrapper-zero'; } ?>">
			<div class="blog-comments-icon">
				<svg version="1.1" class="blog-comments-icon-shape" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="24.083px" viewBox="0 0 25 24.083" enable-background="new 0 0 25 24.083" xml:space="preserve"><g><path fill-rule="evenodd" clip-rule="evenodd" fill="none" d="M8.013,17H4c-2.072,0-3-1.507-3-3V4c0-1.822,1.178-3,3-3h17 c1.767,0,3,1.233,3,3v10c0,1.475-1.122,3-3,3h-8.265l-4.737,4.681L8.013,17z"/></g></svg>
				<?php if(comments_open()){ ?>
					<?php if(get_comments_number() > 999){ $comments_number = __('1k+', 'flowthemes'); }else{ $comments_number = '%'; } ?>
					<div class="blog-comments-value"><?php comments_popup_link('0', '1', $comments_number, '', ''); ?></div>
				<?php } ?>
			</div>
		</div>
		<div class="single-date"><?php echo esc_html( get_the_date() ); ?></div>
		<?php if ( has_tag() ) { ?>
			<div class="single-tags"><?php the_tags( ' ', ' ' ); ?></div>
		<?php } ?>
	</div>
</header>

<div class="site-content clearfix" role="main">
	<div class="content-area">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'flowthemes' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</article>
		<?php endwhile; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php comments_template(); ?>
<div class="rbp-single">
	<?php echo do_shortcode( '[recent_posts header="false"]' ); ?>
</div>
<?php flow_post_nav(); ?>

<?php get_footer(); ?>