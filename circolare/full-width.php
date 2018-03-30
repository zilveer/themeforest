<?php
/*
Template Name: Full_Width
*/
?>
<?php get_header(); ?>
		
		<div class="content-wrapper">
			<!-- Main Content Begin -->
			<div class="main-content main-content-full">
				<div class="main-content-inner" role="main">
				
					<!-- Breadcrumbs -->
					<?php get_template_part( 'breadcrumbs' ); ?>
					
					<?php if ( have_posts() ) :
					$bmeta = get_post_meta( $post->ID );
					$hidetitle = "";
					if(isset($bmeta["hidetitle"][0]))
					$hidetitle = $bmeta["hidetitle"][0];
					
					?><ul id="blogposts">
						<!-- Blog Entry -->
						<?php while ( have_posts() ) : the_post();
						?><li class="blogpost post-schema">
							<article itemscope="" itemtype="http://schema.org/Article">
								<h1 class="blog-post-title-inner" itemprop="name" <?php if($hidetitle == "yes") echo 'style="display: none;"'; ?>><?php the_title() ?></h1>
								<div itemprop="articleBody"><?php the_content() ?></div>
								
								<br class="clear" />
							</article>
						</li>
						<?php endwhile; ?>						
					</ul>
						
					<?php else: ?>
					<h3 class="blog-post-title-inner"><?php _e("404, That page doesn't exist..", 'circolare'); ?></h3>
					<p><?php _e('Sorry, no posts matched your criteria.', 'circolare'); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Footer -->
	<?php get_footer(); ?>