<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Agera
 * @since Agera 1.0
 */

get_header(); 
$sidebar_position = 'right'; ?>
		
		<div id="content" role="main">
			<div class="page-container search-page sidebar-<?php echo $sidebar_position; ?>">
			
			<?php if (have_posts()) { ?>
				
				<header class="page-header search-result">
					<h3 class="page-title"><?php printf( __( 'Search Results for: "%s"', 'agera' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
				</header>

				<?php /* Start the Loop */ ?>
					<?php while ($wp_query->have_posts()) {
	        	 	$wp_query->the_post();
	  				$postNumber++;
	 				if($postNumber == count($posts)) { ?> 
						<article class="blog-post last-child">
	  				<?php } elseif ($postNumber == 1) {?>
	 					 <article class="blog-post first-child">
	    			<?php } else { ?>
	   					 <article class="blog-post">
	    			<?php } ?>
	    			
	    			<header>
		      			<h2 class="page-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		       				<?php the_title(); ?>
		        		</a></h2>
		      			<small>
		      				<?php the_time('M d Y');?>
		      				|
		      				<?php the_time('g:i a');?>
		      				| by
		      				<?php
							the_author_posts_link(); ?>
		      				|
		     				 <?php comments_number('0 comments','1 comment','% comments'); ?>
		      				| in
		      				<?php the_category(', '); ?>
		      			</small>
	    			</header>
	                <?php if (has_post_thumbnail()) { ?>
						<span class="post-thumbnail" >
						<?php if (isset($mp_option['agera_lbox_or_link']) && $mp_option['agera_lbox_or_link'] == "lightbox") { ?>							
								<span class="img-holder">
									<a href="<?php $image_id = get_post_thumbnail_id();$image_url = wp_get_attachment_image_src($image_id,'full', true);	echo $image_url[0];  ?>	" data-rel="lightbox">
									<span class="zoom-link"></span>
									
									<?php 
									if($sidebar_position == 'none')
										the_post_thumbnail('blog_post_thumb_big');
									else
										the_post_thumbnail('blog_post_thumb');
									?>
										<span class="loop"></span>
									</a>
								</span>
				 	  <?php } else { ?>
								<span class="img-holder">
	                            
									<a href="<?php the_permalink(); ?>">
	                                <span class="link"></span>
									<?php the_post_thumbnail('blog_post_thumb'); ?>
									</a>
								</span>
						<?php } ?>
						</span>
	                    <?php } ?>
	                    
	                    
	      			<?php the_content('', TRUE, ''); ?>
	      			<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>    
	      				<div class="more-link-container">
	                    <a href="<?php the_permalink();?>" class="more-link">Read More <span class="moreArrow"></span></a>
	                    </div>
	      			<?php } ?>
	    			</article><!-- end blog-post -->
	    		<?php } ?>

			<?php } else { ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'agera' ); ?></h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'agera' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php } ?>

			</div><!-- #content -->
		</section><!-- #primary -->
<aside class="sidebar sidebar-<?php echo $sidebar_position; ?>">
	<?php get_sidebar(); ?>
</aside>
<?php get_footer(); ?>