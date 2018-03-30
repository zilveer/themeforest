<?php get_header(); ?>

			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <?php zilla_page_before(); ?>
				<!-- BEGIN .hentry-->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php zilla_page_start(); ?>
				
					<h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
                    <!-- BEGIN .entry-meta-header-->
					<div class="entry-meta-header">
						<?php edit_post_link( __('edit', 'zilla'), '<span class="edit-post">[', ']</span>' ); ?>
					<!-- END .entry-meta-header-->
                    </div>
                    <?php endif; ?>

					<!-- BEGIN .entry-content -->
					<div class="entry-content">
						<?php 
						    the_content();
    						wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
						?>
					<!-- END .entry-content -->
					</div>
                
                <?php zilla_page_end(); ?>
				<!-- END .hentry-->
				</div>
				<?php zilla_page_after(); ?>
				
				<?php 
				    zilla_comments_before();
				    comments_template('', true); 
				    zilla_comments_after();
				?>

				<?php endwhile; endif; ?>
			
			<!-- END #primary .hfeed-->
			</div>
			
<?php get_sidebar('page'); ?>

<?php get_footer(); ?>