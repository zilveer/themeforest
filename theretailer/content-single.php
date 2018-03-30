<?php
	global $theretailer_theme_options;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title gbtr_post_title_listing"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'theretailer' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>      
	</header><!-- .entry-header -->
    
    <footer class="entry-meta">
        
        <span class="author vcard"><i class="fa fa-user"></i>&nbsp;&nbsp;<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'theretailer' ), get_the_author() ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></span>
        <span class="date-meta"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_time() ); ?>" rel="bookmark" class="entry-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></a></span>
        <span class="categories-meta"><i class="fa fa-folder-open-o"></i>&nbsp;&nbsp;<?php echo get_the_category_list(', '); ?></span>
        
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
        <?php } else { ?>
        	<?php if ( ($theretailer_theme_options['show_full_post']) && ($theretailer_theme_options['show_full_post'] == 1) ) { ?>
				<?php global $more; $more = 0; the_content(__( 'Continue reading &raquo;', 'theretailer' )); ?>
            <?php } else { ?>
                <?php global $more; $more = 0; the_excerpt(__( 'Continue reading &raquo;', 'theretailer' )); ?>
            <?php } ?>
            <?php } ?>
        <div class="clr"></div>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theretailer' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
    
    
    
</article><!-- #post-<?php the_ID(); ?> -->
