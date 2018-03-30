<?php get_header(); ?>

<div class="maincontainer">
	   		<div class="pagetitle"><h1><?php the_title(); ?></h1></div>
			<div class="contentwrapper1">

 				 <div class="contentleft">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							
							

							<div class="entry">
							<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
								<ul class="post-meta">
									<li class="post-meta-date"><strong><?php the_date(); ?></strong></li>
									<li class="post-meta-auth"><?php the_author(); ?></li>
									<?php if ( has_category() ) { ?>
									<li class="post-category"><?php the_category(', '); ?></li>
									<?php } if ( has_tag() ) {?>
									<li class="post-tags"><?php the_tags(); ?></li>
									<?php } ?>
								</ul>
								<?php 
								if ( has_post_thumbnail() ) {
									//add_image_size( 'featured-image', 607, 250, true ); 
								echo the_post_thumbnail('featured-image');
								} else {
									// the current post lacks a thumbnail
								}
								 the_content();
								
								wp_link_pages(array('before' => '<p>'.__('Pages:','bw_themes'),'after' => '</p>', 'next_or_number' => 'number')); ?>
							</div>
							
							<?php edit_post_link(__('Edit this entry', 'bw_themes'),'','.'); ?>
							
						</div>
					<div class="clear"></div>
					<?php comments_template(); ?>

					<?php endwhile; endif; ?>
	
				</div>
				<div class="contentright">
					<?php get_sidebar(); ?>
				</div>		
			</div><!-- contentwrapper -->
			<div class="footerwrapper">
				<?php get_footer(); ?>