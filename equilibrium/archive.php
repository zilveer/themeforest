<?php get_header(); ?>

<?php 
	$sidebar_disabled = intval( of_get_option( 'blog_page_sidebar_disabled' ) ); 
	$image_width = ( $sidebar_disabled ) ? 160 : 140;
	$image_height = ( $sidebar_disabled ) ? 150 : 130;
	$quality = 90;
	$post_type = of_get_option( 'post_type' ); //get the post type; excerpt or full post.
?>	

	<!-- START #blog-posts -->
	<div id="blog-posts" <?php echo $grid = ( $sidebar_disabled ) ? '' : 'class="page-content"'; ?>">		
	
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
			<!-- START .post -->
			<article class="post group" id="post-<?php the_ID(); ?>">
				
				<!-- START .post-meta -->
				<ul class="post-meta alpha <?php echo $grid = ( $sidebar_disabled ) ? 'grid_4 column-width' : 'grid_2'; ?>">
					
					<?php if ( has_post_thumbnail() ) { ?>
						
						<li class="post-thumb">
							<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
			    			<a href="<?php the_permalink(); ?>">
			    	    		<img src="<?php echo get_template_directory_uri() . '/timthumb.php?src=' . $large_image_url[0]; ?>&amp;h=<?php echo $image_height; ?>&amp;w=<?php echo $image_width; ?>&amp;q=<?php echo $quality; ?>" alt="<?php _e( 'Post Thumbnail', 'onioneye' ); ?>" />
			    			</a>
						</li>
						
					<?php } ?>
					
					<li class="post-time"><time pubdate><?php $pub_date = mysql2date( __( 'D, F jS, Y', 'onioneye' ), $post->post_date ); echo $pub_date; ?></time></li>
					
					<?php if( $has_category = is_object_in_term( get_the_ID(), 'category' ) ) { //check if a post has a category/categories, and display its name/names if it does ?>
					
						<li><?php _e( 'In: ', 'onioneye' ) . ' ' . the_category(', '); ?></li>
					
					<?php } ?> 
					
					<li><?php comments_popup_link( __('No Comments &#187;', 'onioneye' ), __( '1 Comment &#187;', 'onioneye' ), _n( '% comment', '% comments', get_comments_number(), 'onioneye' ) ); ?></li>
					<li class="author"><?php printf(__('by %s', 'onioneye'), get_the_author()); ?></li>
					<?php edit_post_link( __('Edit', 'onioneye'), '<li class="edit-post">', '</li>' ); // Display the edit link, if logged in ?>
					
				</ul>
				<!-- END .post-meta -->
				
				<!-- START .post-content -->
				<div class="post-content omega <?php echo $grid = ( $sidebar_disabled ) ? 'grid_8 full-width-post' : 'grid_6 post-content-position'; ?>">
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" class="post-title" rel="bookmark" title="<?php printf( __( 'Permanent Link to %s', 'onioneye' ), get_the_title()); ?>"><?php the_title(); ?></a></h2>
					<?php if( $post_type === 'excerpt' ) { wpe_excerpt( 'wpe_excerptlength_index', 'new_excerpt_more' ); } else { the_content( __( 'Read The Rest', 'onioneye' ) ); } ?>
				</div>
				<!-- END .post-content -->
			
			</article>
			<!-- END .post -->
						
		<?php endwhile; ?>
		
		<!-- START .blog-pagination -->
		<section class="blog-pagination group alpha">
			<p>
				<?php next_posts_link( __('&laquo; Older Entries', 'onioneye' ) ); ?>
				<?php previous_posts_link( __( 'Newer Entries &raquo;', 'onioneye' ) ); ?>
			</p>
		</section>
		<!-- END .blog-pagination -->
	
	</div>
	<!-- END #blog-posts -->
	
	<?php if( ! $sidebar_disabled ) { ?>
		<?php get_sidebar( 'blog' ); ?>
	<?php } ?>
	
<?php get_footer(); ?>
