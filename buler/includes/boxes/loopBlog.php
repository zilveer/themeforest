<?php global $pmc_data, $sitepress ?>

	<div class="entry">
		<div class = "meta">
			<div class="topLeftBlog">	
				<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class = "post-meta">
					<?php the_time('F j, Y') ?> <?php echo pmc_translation('translation_by','By: ') ?> <?php echo get_the_author_link() ?> - <a href="<?php echo get_permalink( get_the_id() ) ?>#commentform"><?php comments_number(); ?></a>
				</div>	
			</div>
			
			<div class="blogContent">
				<div class="blogcontent"><?php echo shortcontent('[', ']', '', $post->post_content ,300);?> ...</div>
				<a class="blogmore" href="<?php the_permalink() ?>"><?php echo pmc_translation('translation_morelinkblog','Read more about this...'); ?></a>
			</div>
		</div>		
	</div>