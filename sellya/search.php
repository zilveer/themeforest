<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package sellya Sport
 * @subpackage sellya_sport
 */

get_header(); ?>
<section id="midsection" class="container">
	<div class="row">
		<?php get_leftbar(); ?>
		<div class="span9" id="content">
			<div class="row-fluid">
				<div class="blog blog-one-column">
					<header class="search-header">
						<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'sellya' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header>
					<?php if ( have_posts() ) : ?>
					
						<?php while ( have_posts() ) : the_post(); 
						
							$arch_day = get_the_time('d');
						
							$arch_mon = get_the_time('m');
							
							$arch_year = get_the_time('Y');
							
							$day_link = get_day_link($arch_year,$arch_mon,$arch_day);
						
						?>
							
							<div class="span12 span-first-child">
                    
                    	<div class="span4 span-first-child">
                        	<a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title();?>">
                            	<?php the_post_thumbnail(array(211,211));?>
                            </a>
                        </div><!--.image -->                           
                        <div class="span8">                            
                            <h2 class="blog_title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            <?php echo blog_one_column_excerpt(get_the_excerpt(),31); ?><a class="readmore" href="<?php the_permalink()?>">Read More</a>
                            <div class="postinfo">
                            	<div class="postinfo_left">
                            	<a href="<?php echo $day_link?>"><em><?php echo get_the_date('d M Y');?></em></a> Posted in:
								<?php $cats = get_the_category(); 
									if(!empty($cats)):
									foreach($cats as $i=>$cat):
										
										if($i>0)
											echo ',&nbsp;';
									
										echo "<a href='".get_category_link($cat->term_id)."'><em>$cat->name</em></a>";
									endforeach;
									endif;
								?>
                                </div>
                                <span class="comments_count"><?php comments_popup_link(__( 'No comments', 'sellya' ),__( '1 comment', 'sellya' ),__( '% comments', 'sellya' ))?></span>
                            </div>
                        </div> <!--.span8 -->                                   
                        						
					</div>	<!--.span12 -->
							
						<?php endwhile; ?>
						
			
					<?php else : ?>
			
						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php _e( 'Nothing Found', 'sellya' ); ?></h1>
							</header>
			
							<div class="entry-content">
								<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'sellya' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->
			
					<?php endif; ?>
	
	
					<div class="pagination">
						<?php
							global $wp_query;					
							$big = 999999999; // need an unlikely integer					
							echo paginate_links( array(
								'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
								'format' => '?paged=%#%',
								'current' => max( 1, get_query_var('paged') ),
								'total' => $wp_query->max_num_pages,
								'type' => 'list'
							) );
						?>
					</div><!--.pagination -->
				</div><!--.blog -->
			</div><!--.row-fluid -->
		</div><!--#content -->
	</div><!--.row -->
</section><!--#midsection -->
	
<?php get_footer(); ?>