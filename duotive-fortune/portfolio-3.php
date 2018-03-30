<?php
/*
Template Name: Portfolio - Full - Masonry layout
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
        	<div class="page page-full portfolio-masonry">                
            	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.isotope.js"></script>
                <script>
					$(document).ready(function() {
						$('#filtrable').isotope({layoutMode : 'masonry'});						
						<?php if ( $pagination == '-1' ): ?>
						$('#filters a').click(function(){
							var selector = $(this).attr('data-filter');
							$('#filtrable').isotope({ filter: selector,animationEngine: 'best-available',layoutMode : 'masonry'});
							$(".active").removeClass("active");
							$(this).parent("li").addClass("active");							
							return false;
						});				
						<?php endif; ?>
						$("#filtrable article .project-content-with-image").css({"opacity": "0"});
						$("#filtrable article").hover(
							function() {
								$(this).find('.project-content-with-image').stop().animate({"opacity": "1"}, 300);
							},
							function() {
								$(this).find('.project-content-with-image').stop().animate({"opacity": "0"}, 300);
						});								
					});
				</script>
				<?php $portfolio_ids = explode(',',$portfolio->CATEGORY); ?>
                <?php if ( $pagination == '-1' ): ?>
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
                        <?php $dt_ProjectThumbnailSize = get_post_meta($post->ID, "dt_project_size_masonry", true); ?>
                        <?php if ( $dt_ProjectThumbnailSize == '' || $dt_ProjectThumbnailSize == '1' ) {$dt_ProjectClass = 'thumbnail-size-1 '; $dt_ProjectThumbnailWidth = '172';$dt_ProjectThumbnailHeight = '172';} ?>
                        <?php if ( $dt_ProjectThumbnailSize == '2' ) {$dt_ProjectClass = 'thumbnail-size-2 '; $dt_ProjectThumbnailWidth = '354';$dt_ProjectThumbnailHeight = '172';} ?>
                        <?php if ( $dt_ProjectThumbnailSize == '3' ) {$dt_ProjectClass = 'thumbnail-size-3 '; $dt_ProjectThumbnailWidth = '172';$dt_ProjectThumbnailHeight = '354';} ?>
                        <?php if ( $dt_ProjectThumbnailSize == '4' ) {$dt_ProjectClass = 'thumbnail-size-4 '; $dt_ProjectThumbnailWidth = '354';$dt_ProjectThumbnailHeight = '354';} ?>
                                                                        
						<?php if ( has_post_thumbnail() ): ?>                        
                            <article class="project clearfix <?php echo $dt_ProjectClass.$project_category; ?>">
                            	<a class="" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
									<?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
                                    <?php $dt_ProjectImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
                                    <?php if ( $dt_ProjectImageCrop == '' || $dt_ProjectImageCrop == 'inherit' ) $dt_ProjectImageCrop = $dt_CropLocation; ?>                                                         
                                    <?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                                    <img src="<?php resizeimage($thumbnail_src,$dt_ProjectThumbnailWidth,$dt_ProjectThumbnailHeight,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                    <span class="project-content project-content-with-image clearfix">
                                        <h6><?php the_title(); ?></h6>   
                                        <?php if ( $dt_ProjectThumbnailSize == '' ||  $dt_ProjectThumbnailSize == 1 ): ?>
                                        	<?php variable_excerpt(12); ?>                                        
                                        <?php else: ?>
	                                        <?php the_content(''); ?>                                        
                                        <?php endif; ?>
                                    </span>                       
                                </a>     
                            </article>
						<?php else: ?>
                            <article class="project project-text-only clearfix <?php echo $dt_ProjectClass.$project_category; ?>">
                            	<a class="" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                                    <span class="project-content clearfix">
                                        <h6><?php the_title(); ?></h6>                         
                                        <?php the_content(''); ?>
                                    </span>                            
                                </a>
                            </article>                                                    
						<?php endif; ?>                        
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