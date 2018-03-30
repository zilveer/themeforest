<?php
/**
 * @package Sellya
 * @subpackage Sellya
 */

global $smof_data;

get_header(); 

?>
<section id="midsection" class="container">
<div class="row">
 <?php get_blogleftbar('blog'); ?>
	<div class="span9" id="content">
		<div class="row-fluid">
			<div class="blog">
				<?php if ( have_posts() ) : 
				
					if(get_option('page_for_posts') != 0):
				
						$blog = get_page(intval(get_option('page_for_posts')));
						
						$blogtitle = $blog->post_title;
					
					else:
						
						$blogtitle = "Blog";
						
					endif;
					
				?>
					<header class="archive-header">
						
                        <h1 class="archive-title"><?php printf( __( "%s", 'sellya' ), $blogtitle ) ?></h1>
						
					</header><!-- .archive-header -->
                    					
					<?php
					
					/* Start the Loop */
					while ( have_posts() ) : the_post(); 
					
						$arch_day = get_the_time('d');
						
						$arch_mon = get_the_time('m');
						
						$arch_year = get_the_time('Y');
						
						$day_link = get_day_link($arch_year,$arch_mon,$arch_day);
					
					?>
                    	<div id="post-<?php the_ID(); ?>" <?php post_class('span12')?>>
                        	<h2 class="archive-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                            <div class="entry-meta span12">
                                    <?php //echo __('Posted in','sellya')?> <i class="icon-tag"></i>&nbsp;<?php $cats = get_the_category(); 
									if(!empty($cats)):
									foreach($cats as $i=>$cat):
										
										if($i>0)
											echo ',&nbsp;';
									
										echo "<a href='".get_category_link($cat->term_id)."'>$cat->name</a>";
									endforeach;
									endif;
								?> &nbsp;<?php //echo __('on','sellya')?><i class="icon-calendar"></i>&nbsp;<a href="<?php echo $day_link?>" title="" rel="bookmark"><?php echo get_the_date();?></a><span class="by-author">&nbsp;&nbsp;<?php //echo __('by','sellya')?><i class="icon-user"></i>&nbsp;<span class="author vcard"><a class="url fn n" href="<?php echo get_the_author_meta('user_url')?>" title="View all posts by Arifur Rahman" rel="author"><?php the_author();?></a></span></span>&nbsp;&nbsp;<span><?php comments_popup_link(__( '<i class="icon-comments"></i> No comments', 'sellya' ),__( '<i class="icon-comment-alt"></i> 1 comment', 'sellya' ),__( '<i class="icon-comments-alt"></i> % comments', 'sellya' ),'',__( '<i class="icon-lock"></i> Comments off', 'sellya' ))?></span>.									
                            </div>      
                        </div>
						<?php // get_custom_blog_img();?>
						<div class="image span12"><a class="list-image" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sellya' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('blog-post-img'); ?></a><br /><br />
                        	
                        </div>
                        <div class="span12 post_excerpt">
							<?php echo get_sellya_blog_short_text(get_the_content()); ?><br /><a class="readmore" href="<?php the_permalink()?>"><?php echo __('Read More&nbsp;<i class="icon-circle-arrow-right"></i>','sellya');?></a>
                        </div>
						
					<?php endwhile; ?>
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
					</div>
		
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
	
</section>
<?php get_footer(); ?>