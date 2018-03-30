<?php
/*
Template Name: Blog - Type 2
*/
	get_header();
?>
	<?php $blogs = blog_require();?>
    <?php $pagination = get_option('dt_BlogPaginationType2'); ?>    
    <?php $title = get_the_title(); ?>      
	<?php foreach ( $blogs as $blog) :?> 
		<?php if ( is_page($blog->PAGE)): ?>
        	<?php $blog_ids = $blog->CATEGORIES; ?> 
                <section id="content" class="clearfix page-widh-sidebar">
                <div class="content-header-sep"></div>
                <div class="page">              	               	
				<?php 
                    global $more; $more = 0; if ( is_front_page () ) $paged = get_query_var( 'page' );
                    query_posts('post_type=post&posts_per_page='.$pagination.'&cat='.$blog_ids.'&paged=' . $paged);
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                	<article id="post-<?php the_ID(); ?>" <?php post_class('post post-type-2 clearfix'); ?>>
						<?php if ( has_post_thumbnail() ): ?>
                            <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                            <?php $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
                            <?php if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation; ?>                                                         
                            <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                            <a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                <img src="<?php resizeimage($thumbnail_src,590,260,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
                            </a>
                        <?php endif; ?>                      
                    	<div class="post-content clearfix">                        
                            <h5><a href="<?php the_permalink(); ?>" title="<?php dt_Permalink.the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h5>                        
                            <?php the_content(''); ?>
                            <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo dt_ReadMore; ?></a>
						</div>                            
                        <div class="post-meta clearfix">
                        	<?php $dt_SinglePostComments = get_option('dt_SinglePostComments','no'); ?>
							<span class="date"><?php the_time('F j, Y'); ?></span>
                            <span class="author<?php if ( $dt_SinglePostComments == 'yes' ) echo ' author-no-bottom-margin'; ?>"><?php echo dt_PostedBy; ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a></span> 
                            <?php if ( $dt_SinglePostComments == 'no' ): ?>
	                            <span class="comments"><a title="<?php echo get_the_title().' - '.dt_Comments;?>" href="<?php the_permalink(); ?>#comments"><?php echo comments_number('0', '1', '%').' '.dt_Comments; ?></a></span>
                            <?php endif; ?>
                        </div>                    
                    </article>
				<?php endwhile;endif;?> 
                <?php if(function_exists('wp_pagenavi')): ?>
                    <nav id="navigation">
                        <?php wp_pagenavi();?>  
                    </nav>        
                <?php else: ?>
	                <nav id="navigation">
                    	<div class="wp-pagenavi">
    	            		<?php posts_nav_link(); ?>
                        </div>
                    </nav>                
                <?php endif; ?>
                <?php wp_reset_query(); ?>                
                <!-- end of page -->
                </div>
            <?php get_sidebar(); ?>
        <!-- end of content -->
        </section>
        <?php endif; ?>
	<?php endforeach; ?>        
<?php get_footer(); ?>