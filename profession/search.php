<?php 
	get_header(); 
	
	// Intro
	get_template_part('article', 'menu'); 

?>
<div class="blog-content wrap">
	<div class="container">	
	
		<?php if ( $pageTitle = have_posts() ) { ?>
			
			<div class="row">
				<div class="blog-header span12">
					
					<?php $pageTitle = have_posts() ? sprintf(__("Search Results for: %s", TEXTDOMAIN), $s) : ''?>
						
					<h2> <?php echo $pageTitle; ?> </h2> 
						
				</div>
			</div>
			
		 <?php } ?>

		<!-- blog post items --> 
		<div class="row clearfix">
			<?php if ( have_posts() ) : ?>
				<div class="posts span12">
					<?php  while ( have_posts() ) : the_post(); ?>			

						<div  <?php post_class('post'); ?> id="post_<?php the_ID(); ?>">

							<?php $content_span = 'span6';?>
						
							<!-- item  -->
							<div class="row clearfix">
							
								<?php if ( has_post_thumbnail() ){ ?>
								
									<div class="post-image span5">
										<?php the_post_thumbnail('full'); ?>
										<a title="<?php printf( esc_attr__('Permalink to %s', TEXTDOMAIN), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><div class="post-hover"></div></a>
									</div>
									
								<?php } else { 
								
									$content_span = 'span11';
									
								} ?>
									

								<div class="post-content <?php echo $content_span; ?>">
									<div class="blog-post-title">
										<h5>
											<a title="<?php printf( esc_attr__('Permalink to %s', TEXTDOMAIN), the_title_attribute('echo=0') ); ?>" href="<?php the_permalink(); ?>" rel="bookmark"><?php echo px_filter ( get_the_title() ? get_the_title() : get_the_time('F j') ); ?></a>
										</h5>
									</div>
									<div class="blog-post-seperator"></div>
									<div class="blog-post-meta">
										<?php echo ( get_the_time('F') ); ?>  &nbsp;<?php echo ( get_the_time('Y') ); ?> / <?php echo ( get_the_time('j') ); ?> <span class="blog-post-meta-seperator">|</span>
										<span class="post_comments"><?php comments_popup_link( __('No Comments', TEXTDOMAIN) , __('1 Comment', TEXTDOMAIN), __('% Comments', TEXTDOMAIN) ); ?></span>
									</div>
									<div class="blog-post-content">
										<?php the_excerpt();  ?>
									</div>
								</div>	
								
							</div>	
							<!-- item  Ends -->
						</div>

					<?php endwhile; ?> 
					
					<div style="height:200px;"></div>
					
				</div>
			<?php else: ?>
				
				<div class="blog-header span12">
					<h6><?php _e("Sorry, but you are looking for something that isn't here. Try another search", TEXTDOMAIN); ?></h6>
				</div>
			
			<?php endif; ?>
		</div>
	
	</div>
</div>


<?php get_footer();?>