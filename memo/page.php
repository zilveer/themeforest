<?php get_header(); ?>

			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<!--BEGIN .hentry-->
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    
                    <!--BEGIN .entry-header-->
					<div class="entry-header">
					    <h1 class="page-title"><?php the_title(); ?><?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">[', ']</span>' ); ?></h1>
					<!--END .entry-header-->
                    </div>

                    <!--BEGIN .entry-content -->
                    <div class="entry-content">
                    	<?php the_content(__('Read more...', 'framework')); ?>
                    <!--END .entry-content -->
                    </div>

                    <!--BEGIN .entry-footer-->
                    <div class="entry-footer clearfix">
                        <span class="entry-permalink"><a href="<?php the_permalink(); ?>"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'framework'); ?></a></span>
                        <span class="entry-tags"><?php the_tags('/&nbsp;&nbsp;'.__('Tagged:', 'framework').' ', ', ', ''); ?></span>
                        <?php if( get_option('tz_post_like') == true ) { ?>
                            <span class="entry-like"><?php tz_printlikes($post->ID); ?></span>
                        <?php } ?>
                        
                        <?php $comments = get_comments_number(); ?>
                        <?php if( comments_open() || ($comments > 0) ) { ?>
                        <span class="entry-comments"><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a></span>
                        <?php } ?>
                    <!--END .entry-footer-->
                    </div>
                    
				<!--END .hentry-->
				</div>
				
				<?php comments_template('', true); ?>

				<?php endwhile; endif; ?>
			
			<!--END #primary .hfeed-->
			</div>
			
<?php get_sidebar(); ?>

<?php get_footer(); ?>