<?php
/**
Template Name: Blog 2 Columns
 * @package Sellya
 * @subpackage Sellya
 */

global $smof_data;

get_header(); 
?>
<section id="midsection" class="container">
<div class="row">
 <?php get_blogleftbar(); ?>
	<div class="span9" id="content">
		<div class="row-fluid">
			<div class="blog blog-2-column">
            
            <?php 
				if(have_posts()): while(have_posts()): the_post();		
			?>            
			
                <header class="archive-header">
                    
                    <h1 class="archive-title"><?php ?><?php the_title();?></h1>
                    
                </header><!-- .archive-header -->
                
             
            <?php 
			endwhile; endif;
            
			$paged = get_query_var('paged')?get_query_var('paged'):1;
			if(!is_home())
				query_posts("post_type=post&paged=$paged");
				
			if ( have_posts() ) : ?>      					
					<?php
					$blog = get_page_by_path('blog');
					
					$blogurl = get_permalink($blog->ID);
					
					$i = 0;
					/* Start the Loop */
					while ( have_posts() ) : the_post(); ?>
                    
                    <?php $eclass = $i%2 == 0 ? 'span6 span-first-child':'span6'?>
                    
                    <div id="post-<?php the_ID(); ?>" <?php post_class($eclass)?>>
                    
                    	<div class="span12">
                        	<a href="<?php the_permalink();?>" rel="bookmark" title="<?php the_title();?>">
                            	<?php the_post_thumbnail(array(323,169));?>
                            </a>                            
                            <div class="span12">
                            
                            	<h2 class="blog_title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
                            	
                                <div class="authorinfo">
                                	<?php
                                        $tags = get_the_tags(get_the_ID());							
                                        if(!empty($tags)):
										
										$t = 0;									
                                        ?>
                                        <i class="icon-tags"></i>                               
                                        <?php foreach($tags as $tag):
										if($t>0) echo ',';
										
										$t++;
										?>
                                        
                                            <a rel="tag" href="<?php echo get_tag_link($tag->term_id);?>"><?php echo ucfirst($tag->name);?></a>
                                        <?php endforeach;?>                                
                                   <?php endif;?>&nbsp;
                                
                                	<i class="icon-user"></i>&nbsp;<a href="<?php echo get_the_author_meta('user_url')?>" rel="author"><?php echo get_the_author()?></a>&nbsp;&nbsp;<i class="icon-tag"></i>
									<?php 
									$cats = get_the_category();
									
									foreach($cats as $m=>$cat):
									
										if($m > 0)
											echo ', ';
										
										echo "<a href='".get_category_link($cat->term_id)."'>$cat->name</a>";
									
									endforeach;
									
									?>
                                </div>
                                
                                <?php echo get_sellya_blog_short_text(get_the_content());?>
                                
                                <div class="postinfo">
									
                                    <a class="readmore" href="<?php the_permalink()?>"><?php echo __('Read More&nbsp;<i class="icon-circle-arrow-right"></i>','sellya');?></a>
                                    <span class="comments_count"><?php comments_popup_link(__( '<i class="icon-comments"></i> No comments', 'sellya' ),__( '<i class="icon-comment-alt"></i> 1 comment', 'sellya' ),__( '<i class="icon-comments-alt"></i> % comments', 'sellya' ),'',__( '<i class="icon-lock"></i> Comments off', 'sellya' ))?></span>
                                </div><!--.postinfo -->
                            </div> <!--.span5 -->                                   
                        </div><!--.image -->						
					</div>	<!--.span -->
					
					<?php 
					$i++;
					endwhile; 
					
					?>
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
		
				
			<?php endif; //if ( have_posts() )?>
            <?php 
			
			if(!is_home())
				wp_reset_query();
            ?>   
			</div>
		</div>
	</div>
</div>
	
</section>
<?php get_footer(); ?>