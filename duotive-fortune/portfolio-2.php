<?php
/*
Template Name: Portfolio - Full - Category View
*/
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
        $content = get_the_content();
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
		$title = get_the_title();
	?>       
<?php endwhile; ?>
<?php $portfolios = portfolio_require(); ?>
<?php $resizelocation = get_option('resize-location'); ?>

<?php foreach ( $portfolios as $portfolio) :?>
    <?php if ( is_page($portfolio->PAGE)): ?>
    <?php $pagination = $portfolio->ITEMS; ?>
    <section id="content" class="clearfix">
    	<div class="content-header-sep"></div>
        	<div class="page page-full portfolio-category-view">                
            	<?php if ( $content != '' ): ?>
                	<div class="portfolio-page-content clearfix">
	            		<?php echo $content; ?>
                    <!-- end of portfolio description -->
                    </div>
                <?php endif; ?>
                <section class="portfolio-category-container">
					<?php global $more; $more = 0; if ( is_front_page () ) $paged = get_query_var( 'page' ); ?>                
					<?php $portfolio_ids = explode(',',$portfolio->CATEGORY); ?>                    
                    <?php $i=1; ?>
                    <?php foreach($portfolio_ids as $portfolio_id): ?>
                        <?php $portfolio_details = get_term_by('id', $portfolio_id, 'portfolio'); ?>
                        <div class="dt-onethird<?php if($i%3==0) echo ' dt-onethirdlast'; ?>">
                            <h4><?php echo $portfolio_details->name; ?></h4>
                            <?php                     
                                $args = array(
                                    'posts_per_page' => $pagination,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'portfolio',
                                            'field' => 'id',
                                            'terms' => $portfolio_id
                                        )
                                    ),
                                    'paged' => $paged
                                );
                            ?>        
                            <?php query_posts($args); ?>
                            <?php $k = 1; ?>
                            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php if ( has_post_thumbnail() ): ?>
                                    <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                                    <?php $dt_ProjectImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
                                    <?php if ( $dt_ProjectImageCrop == '' || $dt_ProjectImageCrop == 'inherit' ) $dt_ProjectImageCrop = $dt_CropLocation; ?>                                                         
                                    <?php $dt_projectImagebehaviour = get_post_meta($post->ID, "dt-behaviour", true); if ( $dt_projectImagebehaviour == '' ) $dt_projectImagebehaviour = 'readmore';?>
                                    <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <?php if( $dt_projectImagebehaviour == 'readmore' ): ?>
                                        <a class="project-image<?php if($k%5==0) echo ' project-image-last'; ?>" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                            <span class="portfolio-icon portfolio-icon-more"></span>
                                            <img src="<?php resizeimage($thumbnail_src,48,48,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $dt_projectImagebehaviour == 'image' ): ?>
                                        <a class="project-image<?php if($k%5==0) echo ' project-image-last'; ?>" href="<?php echo $thumbnail_src; ?>" title="<?php the_title();?>" rel="modal-window[portfolio-images]">
                                            <span class="portfolio-icon portfolio-icon-image"></span>
                                            <img src="<?php resizeimage($thumbnail_src,48,48,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $dt_projectImagebehaviour == 'video' ): ?>
                                    	<?php $dt_ProjectVideoSrc = ''; $dt_ProjectVideoSrc = get_post_meta($post->ID, "dt-portfolio-video", true); ?>
                                        <a class="project-image<?php if($k%5==0) echo ' project-image-last'; ?>" href="<?php echo $dt_ProjectVideoSrc; ?>" title="<?php the_title();?>" rel="modal-window[portfolio-images]">
                                            <span class="portfolio-icon portfolio-icon-video"></span>
                                            <img src="<?php resizeimage($thumbnail_src,48,48,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $dt_projectImagebehaviour == 'slideshow' ): ?>
                                        <a class="project-image<?php if($k%5==0) echo ' project-image-last'; ?>" href="<?php echo $thumbnail_src; ?>" title="<?php the_title();?>" rel="modal-window[project-slideshow-<?php echo $post->ID; ?>]">
                                            <span class="portfolio-icon portfolio-icon-slideshow"></span>
                                            <img src="<?php resizeimage($thumbnail_src,48,48,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                        </a>
										<?php $attached_images =& get_children('post_type=attachment&orderby=menuorder&post_mime_type=image&post_parent=' . $post->ID );  ?>
                                        <div class="portfolio-modal-images">
                                            <?php foreach ( $attached_images as $attached_image ): ?>
                                                <?php if ( $attached_image->ID != get_post_thumbnail_id($post->ID) ) : ?>
                                                    <?php $thumbnail_src = wp_get_attachment_url($attached_image->ID); ?>
                                                    <a rel="modal-window[project-slideshow-<?php echo $post->ID; ?>]" href="<?php echo $thumbnail_src; ?>" title="<?php echo $attached_image->post_title; ?>"></a>                            
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>                                           
                                    <?php endif; ?>                                                                                                            
                                <?php endif; ?>
                                <?php $k++; ?>
                            <?php endwhile;endif;?>
						</div> 
                        <?php if($i%3==0) echo '<div class="sep"></div>'; ?>
                        <?php $i++; ?>                        
                    <?php endforeach; ?>                    
                </section>
				<?php if(function_exists('wp_pagenavi')): ?>
                    <nav id="navigation">
                        <?php wp_pagenavi();?>  
                    </nav>                    
                <?php endif; ?>  
                <?php wp_reset_query(); ?>                                        
            <!-- end of page -->
            </div>
    <!-- end of content -->
    </section>                                      
	<?php endif;?>          
<?php endforeach;?>
<?php get_footer(); ?>