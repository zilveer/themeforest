<?php
/*
Template Name: Blog - Type 1
*/
	get_header();
?>
	<?php $blogs = blog_require();?>
    <?php $pagination = get_option('dt_BlogPaginationType1'); ?>    
    <?php $title = get_the_title(); ?>      
	<?php foreach ( $blogs as $blog) :?> 
		<?php if ( is_page($blog->PAGE)): ?>
        	<?php $blog_ids = $blog->CATEGORIES; ?> 
                <section id="content" class="clearfix page-widh-sidebar">
                <div class="content-header-sep content-header-sep-no-padding"></div>
                <div id="blog-type-1" class="page">              	               	
				<?php 
                    global $more; $more = 0; if ( is_front_page () ) $paged = get_query_var( 'page' );
                    query_posts('post_type=post&posts_per_page='.$pagination.'&cat='.$blog_ids.'&paged=' . $paged);
                    if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                	<article id="post-<?php the_ID(); ?>" <?php post_class('post post-type-1 clearfix'); ?>>
						<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php dt_Permalink.the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>                        
						<?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID.'&order=DESC&orderby=menu_order' );  ?> 
						<?php $attached_images = array_values($attached_images); ?>
                        <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                        <?php $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
                        <?php if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation; ?>                               
                        <?php if ( count($attached_images) == 1 ): ?>                
							<?php if ( has_post_thumbnail() ): ?>                                                 
                                <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                <a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                    <img src="<?php resizeimage($thumbnail_src,650,250,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
							<script type="text/javascript">
                            $(window).load(function() {
                                $('#blog-type-1-slideshow-<?php echo $post->ID; ?>').nivoSlider({effect:'fade',directionNav:false,manualAdvance:true});
                            });
                            </script>                        
                            <div id="blog-type-1-slideshow-<?php echo $post->ID; ?>" class="blog-type-1-slideshow">
                                <?php foreach($attached_images as $attached_image): ?>   
                                    <img src="<?php resizeimage($attached_image->guid,650,250,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>                                             
                    	<div class="post-content clearfix">                        
                            <?php the_content(''); ?>
                            <a class="more-link" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><span><span><?php echo dt_ReadMore; ?></span></span></a>
						</div>
                        <hr />                                          
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