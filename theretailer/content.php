<?php
	global $theretailer_theme_options;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if (is_single()) : ?>
        <h1 class="entry-title gbtr_post_title_listing"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'theretailer' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1> 
        <?php else : ?>
        <h2 class="entry-title gbtr_post_title_listing"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'theretailer' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php endif ?>  
	</header><!-- .entry-header -->
    
    <footer class="entry-meta">
        
        <span class="author vcard"><i class="fa fa-user"></i>&nbsp;&nbsp;<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'theretailer' ), get_the_author() ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></span>
        <span class="date-meta"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark" class="entry-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a></span>
        <?php if ( is_single() ) : ?>
        <span class="categories-meta"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo get_the_category_list(', '); ?></span>
        <?php endif; ?>
        
		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><i class="fa fa-comment-o"></i>&nbsp;&nbsp;<?php comments_popup_link( __( 'Leave a comment', 'theretailer' ), __( '1 Comment', 'theretailer' ), __( '% Comments', 'theretailer' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'theretailer' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	
    </footer><!-- .entry-meta -->
    
    <div class="gbtr_bold_sep"></div>

	<?php if ( has_post_thumbnail() ) : ?>        
        	
        	<?php if ( is_single() ) : ?>
	            
	            <?php if ( (isset($theretailer_theme_options['featured_image_single_post'])) && ($theretailer_theme_options['featured_image_single_post'] == 1) ) : ?>

		            <div class="entry-thumbnail">
						
						<?php the_post_thumbnail(array(620,99999)); ?>
					
					</div>

				<?php endif; ?>
			
			<?php else: ?>
				
				<div class="entry-thumbnail">
					
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'theretailer' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail(array(620,99999)); ?></a> 
				
				</div>

			<?php endif; ?>
        
    <?php endif; ?>
	
    <div class="entry-content">
		<?php if (is_single()) { ?>
        	<?php the_content(); ?>
            
			<div class="tags_share_wrapper <?php echo  has_tag() ? ' post_with_tags':' post_without_tags'; ?>">
				
				<?php //if ( (isset($theretailer_theme_options['sharing_options_blog'])) && ($theretailer_theme_options['sharing_options_blog'] == "1" ) ) : ?>
					<div class="box-share-container post-share-container">
						<a class="trigger-share-list" href="#"><i class="fa fa-share-alt"></i><?php _e( 'Share this post', 'theretailer' )?></a>
						<div class="box-share-list">
                        
                        	<?php
								//Get the Thumbnail URL
								$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
							?>
							
							<div class="box-share-list-inner">
								<a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a>
								<a href="//twitter.com/share?url=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a>
								<a href="//plus.google.com/share?url=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-google-plus"></i><span>Google</span></a>
								<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($src[0]) ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" class="box-share-link" target="_blank"><i class="fa fa-pinterest"></i><span>Pinterest</span></a>
							</div><!--.box-share-list-inner-->
							
						</div><!--.box-share-list-->
					</div>
				<?php //endif; ?>
				
				<?php if ( has_tag() ) : ?>
					<span class="tags-meta"><i class="fa fa-tag"></i>&nbsp;&nbsp;<?php echo get_the_tag_list('',', ',''); ?></span>
				<?php endif; ?>
				<br /><br /><br />
			</div>
        <?php } else { ?>
        	<?php if ( ($theretailer_theme_options['show_full_post']) && ($theretailer_theme_options['show_full_post'] == 1) ) { ?>
				<?php global $more; $more = 0; the_content(__( 'Continue reading &raquo;', 'theretailer' )); ?>
            <?php } else { ?>
                <?php global $more; $more = 0; the_excerpt(__( 'Continue reading &raquo;', 'theretailer' )); ?>
                <?php echo '<a class="more-link auto" href='.get_permalink($post->ID ).'>'.__( 'Continue reading &raquo;', 'theretailer' ).'</a>'; ?>
            <?php } ?>
            <?php } ?>
        <div class="clr"></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theretailer' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    
    
    
</article><!-- #post-<?php the_ID(); ?> -->