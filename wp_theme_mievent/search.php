<?php 
	get_header(); 
	global $wp_query ;
	$layout=MthemeCore::getOption('posts_layout', 'right');
?>
<div class="main-content content-wrapper">
	<div class="container">
		<div class="row">
			<section class="page-heading">
				<h1 class="h1-72"><?php esc_html_e("Search Result for : " , 'mtheme') ; ?> <?php echo get_search_query(); ?></h1>
			</section>
			<?php
				if($layout=='left')
				{
			?>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<div class="sidebar "><?php get_sidebar(); ?></div>
					</div>
					<div class="posts-listing col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<?php
				}
				elseif($layout=='right')
				{
			?>
				<div class="posts-listing col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<?php
				}
				else
				{
			?>
					<div class="posts-listing col-lg-12">
			<?php
				}
			?>
				
				<?php 
					if(have_posts()) 
					{ 
						while(have_posts()) : the_post();
						global $post ;
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="post-content clearfix">
							
							<div class="author-cmp-detail clearfix">
								<div class="author-img col-lg-2 col-md-2 col-sm-12 col-xs-12 clearfix">
									<?php echo get_avatar(90) ; ?>			</div>
								<div class="author-name col-lg-10 col-md-10 col-sm-12 col-xs-12 clearfix">
									<h3 class="h3-30 notopmargin"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>		
									<p class="author-title"><span><?php esc_html_e("by" , 'mtheme') ; ?> </span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a></p>		
								</div>			
							</div>				
							<p class="blog-text"><?php the_excerpt(); ?></p>
							<a href="<?php the_permalink(); ?>" class="learn-more-btn text-center btn-effect wow animated fadeIn animated"><?php esc_html_e("read more" , 'mtheme') ; ?></a>
							<div class="post-footer clearfix">
								<span class="date"><?php the_date(); ?></span>
								<div class="category">
									<?php the_category(', '); ?>
								</div>			
							</div>
						</div>
					</article>
				
				<?php
						endwhile;
				?>
				<div class="post-pagination">	
					<?php MthemeInterface::renderPagination();
					if(MthemeInterface::isRenderPagination()){ paginate_comments_links();} ?>
				</div>			
				<?php 
					}
					else 
					{ 
				?>
						<article>
							<div class="post-content clearfix">
								<p class="blog-text" style="padding: 10px 30px; margin-bottom: 5%;">
									<?php esc_html_e("SORRY, No Results Found for " , 'mtheme') ; ?> " <?php echo get_search_query(); ?> "
								</p>
							</div>
						</article>	
				<?php
					} 
					
					wp_reset_query();
				?>
				<div class="search_class">
					<section class="page-heading" style="margin-top:10%">
						<h1 class="h1-72"><?php esc_html_e("Try Something else : " , 'mtheme') ; ?></h1>
					</section>
					<?php get_search_form(); ?>
				</div>
				<article>
					<div class="post-content search-rel clearfix">
						<div class="related-posts block" style="margin:20px 0px 0px 0px;">
							<section class="page-heading">
								<h1 class="h1-72"><?php echo _e("Latest Posts : " , 'mtheme'); ?></h1>
							</section>
							<div class="row">
								
						<?php $count3 = 1 ;
							$args = array('post_type' => 'post') ; 
							query_posts($args);
							if(have_posts()):  while(have_posts()): the_post(); 
							global $post ;?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="post-content clearfix">										
										<div class="author-cmp-detail clearfix">										
											<div class="author-name col-lg-10 col-md-10 col-sm-12 col-xs-12 clearfix">
												<h3 class="h3-30 notopmargin"><a href="<?php the_permalink(); ?>"><?php echo substr(strip_tags(get_the_title()) , 0 , 15); ?></a></h3>		
												<p class="author-title"><span><?php esc_html_e("by" , 'mtheme') ; ?> </span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a></p>		
											</div>			
										</div>				
										<p class="blog-text"><?php echo substr(strip_tags(get_the_content()) , 0 , 120)."..."; ?></p>
										<a href="<?php the_permalink(); ?>" class="learn-more-btn text-center btn-effect wow animated fadeIn animated"><?php esc_html_e("read more" , 'mtheme') ; ?></a>
									</div>
								</article>
							</div>
							<?php
								if($count3 == 3) break;
								$count3++;
								endwhile ; endif ;
								wp_reset_query();
							?>
							</div>
						</div> 
					</div>
				</article>	
			</div>
			<?php if($layout=='right') { ?>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="sidebar "><?php get_sidebar(); ?></div>
			</div>
			<?php } ?>
		</div><!-- #row -->
	</div><!-- #container -->	
</div>
<?php get_footer(); ?>


