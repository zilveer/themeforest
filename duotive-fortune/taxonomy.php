<?php
	/* TAXONOMY PAGES TEMPLATE */
	get_header();
?>
    <section id="content" class="clearfix page-widh-sidebar">
        <div class="page  portfolio-columns portofolio-columns-sidebar">       
		<?php /* LOOP TO DISPLAY PROJECTS */ ?>
        
        <?php // NO PROJECTS TO DISPLAY? ?>
        <?php if ( ! have_posts() ) : ?>
            <h4><?php echo dt_NotFoundContent; ?></h4>
        <?php endif; ?>
        <?php // HAVE POSTS TO DISPLAY? ?>
        <?php $k = 1; ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <article class="project project-two-columns clearfix <?php echo $project_category; if ( $k%2 == 0 ) echo ' project-last'; ?>">
            <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
            <?php $dt_ProjectImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
            <?php if ( $dt_ProjectImageCrop == '' || $dt_ProjectImageCrop == 'inherit' ) $dt_ProjectImageCrop = $dt_CropLocation; ?>                                                                                 
            <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
            <?php $dt_projectImagebehaviour = get_post_meta($post->ID, "dt-behaviour", true); if ( $dt_projectImagebehaviour == '' ) $dt_projectImagebehaviour = 'readmore';?>
            <?php $dt_ProjectColumnsNoImageClass = ' project-content-radius'; ?>
            <?php if ( has_post_thumbnail() ): ?>
                <?php $dt_ProjectColumnsNoImageClass = ''; ?>
                <?php if( $dt_projectImagebehaviour == 'readmore' ): ?>
                    <div class="project-image">
                        <a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                            <span class="portfolio-icon portfolio-icon-more"></span>
                            <img src="<?php resizeimage($thumbnail_src,280,185,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                        </a>                     
                    </div>       
                <?php endif; ?>
                <?php if( $dt_projectImagebehaviour == 'image' ): ?>
                    <div class="project-image">
                        <a class="post-image" href="<?php echo $thumbnail_src; ?>" title="<?php the_title();?>" rel="modal-window[portfolio-images]">
                            <span class="portfolio-icon portfolio-icon-image"></span>
                            <img src="<?php resizeimage($thumbnail_src,280,185,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                        </a>                     
                    </div>       
                <?php endif; ?> 
                <?php if( $dt_projectImagebehaviour == 'video' ): ?>
                    <?php $dt_ProjectVideoSrc = ''; $dt_ProjectVideoSrc = get_post_meta($post->ID, "dt-portfolio-video", true); ?>
                    <div class="project-image">
                        <a class="post-image" href="<?php echo $dt_ProjectVideoSrc; ?>" title="<?php the_title();?>" rel="modal-window[portfolio-images]">
                            <span class="portfolio-icon portfolio-icon-video"></span>
                            <img src="<?php resizeimage($thumbnail_src,280,185,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                        </a>                     
                    </div>       
                <?php endif; ?>
                <?php if( $dt_projectImagebehaviour == 'slideshow' ): ?>
                    <div class="project-image">
                        <a class="post-image" href="<?php echo $thumbnail_src; ?>" title="<?php the_title();?>" rel="modal-window[project-slideshow-<?php echo $post->ID; ?>]">
                            <span class="portfolio-icon portfolio-icon-slideshow"></span>
                            <img src="<?php resizeimage($thumbnail_src,280,185,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                        </a>                     
                    </div>       
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
            <div class="project-content<?php echo $dt_ProjectColumnsNoImageClass; ?> clearfix">                                
                <h4>
                    <a href="<?php the_permalink(); ?>" title="<?php echo dt_Permalink.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                        <?php the_title(); ?>
                    </a>
                </h4>                         
                <?php the_content(''); ?>
                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo dt_ReadMore; ?></a>                            
            </div>                            
        </article>
        <?php if($k%2==0) echo '<div class="row-sep"></div>'; $k++; ?>
        <?php endwhile;?>
        <?php if(function_exists('wp_pagenavi')): ?>
            <nav id="navigation">
                <?php wp_pagenavi();?>  
            </nav>                   
        <?php endif; ?>
        <!-- end of page -->
        </div>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>
