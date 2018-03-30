<?php
/*
Template Name: Portfolio - Full - Grid
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
    <section id="content" class="clearfix">
    	<div class="content-header-sep"></div>
        	<div class="page page-full portfolio-grid">                
            	<?php if ( $pagination == '-1' ): ?>
					<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#filtrable').isotope();						
                            $('#filters a').click(function(){
                                var selector = $(this).attr('data-filter');
                                $('#filtrable').isotope({ filter: selector,animationEngine: 'best-available' });
                                $(".active").removeClass("active");
                                $(this).parent("li").addClass("active");							
                                return false;
                            });
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
                    <?php query_posts($args); ?>
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <?php $categories = get_the_terms( $post->ID, 'portfolio'); ?>
                        <?php $project_category = ''; ?>
                        <?php foreach($categories as $cateogry): ?>
                            <?php if ( $project_category != '' ) $project_category .= ' '; ?>
                            <?php $project_category .= $cateogry->slug; ?>
                        <?php endforeach; ?>
                        <article class="project clearfix <?php echo $project_category; ?>">
                            <?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                            <?php $dt_ProjectImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
                            <?php if ( $dt_ProjectImageCrop == '' || $dt_ProjectImageCrop == 'inherit' ) $dt_ProjectImageCrop = $dt_CropLocation; ?>                                                                                 
                            <div class="project-images clearfix">
                            <?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&orderby=menu_order&order=ASC&post_parent=' . $post->ID );  ?>                                            
                            <?php foreach ( $attached_images as $attached_image ): ?>
                                <?php $thumbnail_src = wp_get_attachment_url($attached_image->ID); ?>
                                <a class="project-image" href="<?php echo $thumbnail_src; ?>" rel="modal-window[<?php echo $post->ID; ?>]" title="<?php echo $attached_image->post_title;?>">
                                    <span class="portfolio-icon portfolio-icon-more"></span>                                
                                    <img src="<?php resizeimage($thumbnail_src,149,130,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                </a>                        
                            <?php endforeach; ?>
                            </div>
                            <div class="project-content clearfix">
                                <h4>
                                    <a href="<?php the_permalink(); ?>" title="<?php echo dt_Permalink.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>                         
                                <?php the_content(''); ?>
                                <a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php echo dt_ReadMore; ?></a>                            
                            </div>                            
                        </article>
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
    <!-- end of content -->
    </section>                                      
	<?php endif;?>          
<?php endforeach;?>
<?php get_footer(); ?>