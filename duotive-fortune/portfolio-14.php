<?php
/*
Template Name: Portfolio - Sidebar - 2 columns landscape
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
    <?php $portfolio_ids = explode(',',$portfolio->CATEGORY); ?>
    <section id="content" class="clearfix page-widh-sidebar">
    	<div class="content-header-sep"></div>
        	<div class="page portfolio-columns portofolio-columns-sidebar">
            	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.js"></script>
				<script>
                    $(document).ready(function() {
						$('#filtrable .row-sep').remove();
                        $('#filtrable').isotope({
                              masonry : {
                                columnWidth : 310
                              }
                        });
						//WEBKIT DOUBLE TEXT SHADOW FIX
						if ($.browser.webkit) {
							$('body').addClass('webkit');
						}							
                    });
                </script>							                         
            	<?php if ( $pagination == '-1' ): ?>
                    <script>
						$(document).ready(function() {						
                            $('#filters a').click(function(){
                                var selector = $(this).attr('data-filter');
                                $('#filtrable').isotope({ filter: selector,animationEngine: 'best-available' });
                                $(".active").removeClass("active");
                                $(this).parent("li").addClass("active");							
                                return false;
                            });
							//WEBKIT DOUBLE TEXT SHADOW FIX
							if ($.browser.webkit) {
								$('body').addClass('webkit');
							}							
                        });
                    </script>
                    <nav class="portfolio-filter isotope-item clearfix">
                        <ul id="filters">
                            <li class="active"><a href="#" data-filter="*"><?php echo dt_ProjectsViewAll; ?></a></li>       
                            <?php foreach($portfolio_ids as $portfolio_id): ?>
                            <?php $portfolio_details = get_term_by('id', $portfolio_id, 'portfolio'); ?>         
                                <li><a href="#" data-filter=".<?php echo $portfolio_details->slug; ?>"><?php echo $portfolio_details->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            	<?php if ( $content != '' ): ?>
                	<div class="portfolio-page-content clearfix">
	            		<?php echo $content; ?>
                    <!-- end of portfolio description -->
                    </div>
                <?php endif; ?>
                <section id="filtrable">
					<?php global $more; $more = 0; if ( is_front_page () ) $paged = get_query_var( 'page' ); ?>
					<?php                     
                        $args = array(
                            'posts_per_page' => $pagination,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'portfolio',
                                    'field' => 'id',
                                    'terms' => $portfolio_ids
                                )
                            ),
							'paged' => $paged
                        );
                    ?>        
                    <?php query_posts($args); $k = 1; ?>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php $categories = get_the_terms( $post->ID, 'portfolio'); ?>
                        <?php $project_category = ''; ?>
                        <?php foreach($categories as $cateogry): ?>
                            <?php if ( $project_category != '' ) $project_category .= ' '; ?>
                            <?php $project_category .= $cateogry->slug; ?>
                        <?php endforeach; ?>
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
                    <?php endwhile;endif;?>
                </section>
				<?php if(function_exists('wp_pagenavi')): ?>
                    <nav id="navigation">
                        <?php wp_pagenavi();?>  
                    </nav>                    
                <?php endif; ?>
                <?php wp_reset_query(); ?>                                          
            <!-- end of page -->
            </div>
            <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>                                      
	<?php endif;?>          
<?php endforeach;?>
<?php get_footer(); ?>