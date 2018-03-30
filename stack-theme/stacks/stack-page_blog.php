<?php 
	$blog_page = get_post( get_option('page_for_posts') );
?>
<div class="stack stack-page-content stack-page-blog" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	<div class="span8">
	<div class="padding-right-20">
		
		<?php if( $blog_page->post_content != '' && get_option('page_for_posts') != 0 ): ?>
			<?php echo wpautop( $blog_page->post_content ); ?>
			<div class="vspace-40"></div>
		<?php endif; ?>

		<?php if( have_posts() ): while ( have_posts() ) : the_post(); ?>
			<article>
				<div class="article-head">
					<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="post-meta">
						<?php if( theme_options('blog', 'meta_date') == 'on' ): ?>
							<span class="meta-item"><span><?php echo get_the_date(); ?></span></span>
						<?php endif; ?>
						<?php if( theme_options('blog', 'meta_author') == 'on' ): ?>
							<span class="meta-item"><span><?php echo the_author_posts_link(); ?></span></span>
						<?php endif; ?>
						<?php if( theme_options('blog', 'meta_category') == 'on' && get_the_category_list() != '' ): ?>
							<span class="meta-item">
								<span><?php echo get_the_category_list(', '); ?></span>
							</span>
						<?php endif; ?>
						<?php if( theme_options('blog', 'meta_comment') == 'on' && comments_open() ): ?>
							<span class="meta-item">
								<span><?php comments_popup_link(__('No Comments','theme_front'), __('1 Comment','theme_front'), __('% Comments','theme_front'), '', ''); ?></span>
							</span>
						<?php endif; ?>
					</div>

				</div>

				<a href="<?php the_permalink(); ?>">
				<?php 
					if( get_post_thumbnail_id() ) {
						echo gen_responsive_image_block( get_post_thumbnail_id(), array(
								array( 'width' => 290, 'media' => '(max-width: 767px)' ),
								array( 'width' => 290*2, 'media' => '(max-width: 767px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
								array( 'width' => 456, 'media' => '(min-width: 768px)' ),
								array( 'width' => 456*2, 'media' => '(min-width: 768px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' ),
								array( 'width' => 600, 'media' => '(min-width: 980px)' ),
								array( 'width' => 600*2, 'media' => '(min-width: 980px) and (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi)' )
							) 
						);
					}	
				?>
				</a>

				<div class="article-body">
					<?php the_excerpt(); ?>
					<?php if( theme_options('blog', 'read_more_text') ): ?>
						<p><a href="<?php the_permalink(); ?>"><?php echo theme_options('blog', 'read_more_text'); ?></a></p>
					<?php endif; ?>
				</div>
			</article>
			
		<?php endwhile; else: ?>

			<?php _e( 'Sorry, nothing Found', 'theme_front' ); ?>

		<?php endif; ?>

			<?php posts_nav_link(' ', "<span class='button nextpostslink'>".__('Next Page &rarr;', 'theme_front')."</span>", "<span class='button previouspostslink'>".__("&larr; Previous Page", 'theme_front')."</span>"); ?>

	</div>
	</div><!-- .span8 -->
	
	<aside class="span4 sidebar">
		<?php if ( dynamic_sidebar( 'blog' ) ); ?>
	</aside>

</div>
</div>
</div><!-- .stack-blog -->