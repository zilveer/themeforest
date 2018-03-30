<?php // Featued post image
$args = array( 'postid' => $post->ID, 'width' => 800, 'height' => 533, 'wrap' => 'div', 'wrap_class' => 'post-image fitvid', 'exclude_video' => false, 'resizer' => '850auto' );
$image = get_obox_media( $args );

 // Pages must only look for the page settings, and hide certain items by default
if( is_page() ) :
	$options_suffix = '_page';
	$category = "false";
	$post_links = "false";
	$tags = "false";
	$further_reading = "false";
else :
	$options_suffix = '';
	$category = get_option( "ocmx_meta_category" );
	$tags = get_option( "ocmx_meta_tags" );
	$post_links = get_option( "ocmx_meta_post_links" );
endif;

// Setup which post meta to show or hide
$date = get_option( "ocmx_meta_date" . $options_suffix );
$author_link = get_option( "ocmx_meta_author" . $options_suffix );
$author = get_option( "ocmx_meta_author_block" . $options_suffix );
$social = get_option( "ocmx_meta_social" . $options_suffix );
$social_code = get_option( "ocmx_social_tag" ); ?>

<div class="title-container">
	<div class="title">
		<h2 class="post-title typography-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php if( $post->post_excerpt != ''  ) { echo '<h3 class="sub-title">' . get_the_excerpt() . '</h3>';} ?>
		<?php if( get_post_type() != 'attachment' && ( $author_link != "false" ) ) { ?>
			<h5 class="post-author">
				<?php _e("written by ", "ocmx"); the_author_posts_link(); ?>
			</h5>
		<?php } //Hide the author unless enabled in Theme Options ?>
	</div>
</div>
<div class="copy clearfix">
	<?php if( $image !="" ) { echo $image; } // Show the Featured Image or Video ?>

	<?php the_content(); ?>

	<?php wp_link_pages( array(
			'link_before'	=> '<span>',
			'link_after'	=> '</span>',
			'before'		=> '<p class="inner-post-pagination">' . __('<span>Pages:</span>', 'ocmx'),
			'after'		=> '</p>'
		)); ?>

	<div class="post-meta">
		<?php if( isset( $social_code ) && $social_code !="" ) { ?>
			<div class="social"><?php echo get_option("ocmx_social_tag"); ?></div>
		<?php } elseif( $social != "false" ) { // Show sharing if enabled in Theme Options
			get_template_part( 'functions/sharing-buttons' );
			} // Show sharing if enabled in Theme Options  ?>

		<?php if( get_post_type() != 'attachment' && ( $date != "false" || $author_link != "false" || $category !="false") ) { ?>
			<h5 class="post-date">
				<?php if( $date != "false" ) { echo the_time( get_option( 'date_format' ) ); } // Hide the date unless enabled in Theme Options ?>
				<?php if( $author_link != "false" ) { _e("written by ", "ocmx"); the_author_posts_link(); } //Hide the author unless enabled in Theme Options ?>
				<?php if( !is_page() && $category != "false" ) { _e("in ",'ocmx'); the_category(", ",'ocmx'); } ?>
			</h5>
		<?php } // Show all post meta if enabled in theme Options ?>
	</div>
</div>

<?php if( !is_page() && has_tag() && $tags != "false" ) { ?>
	<ul class="tags"><?php the_tags('<li>','</li><li>','</li>'); ?></ul>
<?php } // Show tags if enabled in Theme Options & post has tags ?>

<?php if( !is_page() && 'post' == get_post_type() && $post_links !="false" ) { ?>
	<ul class="next-prev-post-nav">
		<li>
			<?php if ( get_adjacent_post( false, '', true ) ): // if there are older posts ?>
				<small><?php _e('Previous Post', 'ocmx'); ?></small>
				<?php previous_post_link("%link", "%title"); ?>
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</li>
		<li>
			<?php if ( get_adjacent_post( false, '', false ) ): // if there are newer posts ?>
				<small><?php _e('Next Post', 'ocmx'); ?></small>
				<?php next_post_link("%link", "%title"); ?>
			<?php else : ?>
				&nbsp;
			<?php endif; ?>
		</li>
	</ul>
<?php } // if is post ?>

<!-- Begin Author Block -->
<?php if( $author != "false" ) { ?>
	<div class="author-container">
		<div class="author-content">
			<div class="author-image"><?php echo get_avatar( get_the_author_meta('email'), "100" ); ?></div>
			<div class="author-body">
				<h3 class="author-name"><?php the_author_posts_link(); ?></h3>
				<p class="author-bio">
					<?php the_author_meta('description'); ?>
				</p>
			</div>
		</div>
	</div>
<?php } // Show author block if enabled in Theme Options