<?php
	/* SINGLE PAGES TEMPLATE */
	get_header();
	
	$dt_SingleProjectLayout = get_option('dt_SingleProjectLayout','1');
	$dt_SingleProjectLayoutLocal = get_post_meta($post->ID, "dt_project_layout", true);
	if ( $dt_SingleProjectLayoutLocal != '' && $dt_SingleProjectLayoutLocal != 'inherit' )  $dt_SingleProjectLayout = $dt_SingleProjectLayoutLocal;	
	    
	$dt_SingleProjectSidebar = get_option('dt_SingleProjectSidebar','no');
    $dt_SingleProjectSidebarOver = get_post_meta($post->ID, "single-project-sidebar", true);

	if ( $dt_SingleProjectSidebarOver != '' && $dt_SingleProjectSidebarOver != 'inherit' )  $dt_SingleProjectSidebar = $dt_SingleProjectSidebarOver;	
	if ( $dt_SingleProjectSidebar == 'no' ) $dt_SingleProjectID = 'single'; else $dt_SingleProjectID = 'single-full-width'; 
	if ( $dt_SingleProjectSidebar == 'no' ) $dt_ProjectImageWidth = '590'; else  $dt_ProjectImageWidth = '900';
	$dt_CropLocation = get_option('dt_CropLocation','c'); 
	$dt_ProjectImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
	if ( $dt_ProjectImageCrop == '' || $dt_ProjectImageCrop == 'inherit' ) $dt_ProjectImageCrop = $dt_CropLocation;
	
	$dt_SingleProjectComments = get_option('dt_SingleProjectComments','no');	

?>
<section id="content" class="clearfix<?php if ( $dt_SingleProjectSidebar == 'no' ) echo ' page-widh-sidebar'; ?>">
<div class="content-header-sep"></div>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="<?php echo $dt_SingleProjectID; ?>" class="page">
        	<nav id="project-nav">
            	<div class="inner clearfix">
					<?php previous_post_link('<span class="left">%link</span>','&laquo; Prev'); ?> 
                    <?php next_post_link('<span class="right">%link</span>','Next &raquo;'); ?>
                </div>
            </nav>
            <?php if ( $dt_SingleProjectLayout == 1 ) : ?>
				<?php if ( $dt_SingleProjectSidebar == 'yes' ) $dt_ProjectLayoutOneWidth = '739'; else $dt_ProjectLayoutOneWidth = '429'; ?>
                <div class="project-layout-1 clearfix">
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <div class="project-meta">
                            <div class="inner">
                                <?php $dt_ProjectClient = get_post_meta($post->ID, "dt_project_client", true); ?>
                                <?php if ( $dt_ProjectClient != '' ): ?>
                                    <span class="client"><?php echo $dt_ProjectClient; ?></span>
                                <?php endif; ?>
                                <?php $dt_ProjectYear = get_post_meta($post->ID, "dt_project_year", true); ?>
                                <?php if ( $dt_ProjectYear != '' ): ?>
                                    <span class="year"><?php echo $dt_ProjectYear; ?></span>
                                <?php endif; ?>
                                <?php $dt_ProjectServices = get_post_meta($post->ID, "dt_project_services", true);?>
                                <?php if ( $dt_ProjectServices != '' ): ?>
                                    <span class="services"><?php echo $dt_ProjectServices; ?></span>
                                <?php endif; ?>                        
                                <?php
									$taxonomy = 'portfolio';
                                    $tax_terms = wp_get_post_terms($post->ID,$taxonomy);
                                ?>
                                <?php if ( $tax_terms != '' ): ?>
                                    <span class="categories">
                                        <?php	
                                            $tax_term_count = count($tax_terms); 
                                            $counter = 1;
                                            foreach ($tax_terms as $tax_term) {
                                                echo '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . $tax_term->name . '" ' . '>' . $tax_term->name.'</a>';
                                                if ( $counter < $tax_term_count ) echo ', ';
                                                $counter++;
                                            }
                                        ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $dt_SingleProjectComments == 'no' ): ?>
                                    <span class="comments"><a href="#comments" class="scroll"><?php echo comments_number(); ?></a></span>
                                <?php endif; ?>
                            </div>                                                  		
                        </div>                      
                        <?php $dt_SingleProjectSharing = get_option('dt_SingleProjectSharing','no'); ?>
                        <?php if ( $dt_SingleProjectSharing == 'no' ): ?>
                            <div class="project-sharing">
                                <div class="facebook">
                                    <div id="fb-root"></div>
                                    <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#appId=284728074870751&xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="125" data-show-faces="false"></div>
                                </div>
                                <div class="twitter">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="googleplusone">                            
                                    <!-- Place this tag where you want the +1 button to render -->
                                    <g:plusone size="medium"></g:plusone>
                                    
                                    <!-- Place this render call where appropriate -->
                                    <script type="text/javascript">
                                      (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                      })();
                                    </script>
                                </div>
                            </div>                                          
                        <?php endif; ?>
                    </div>
                    <div class="entry-pictures clearfix">
                    <?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID.'&orderby=menu_order&order=ASC' );  ?>                    
                    <?php foreach($attached_images as $attached_image): ?>   
                        <a href="<?php echo $attached_image->guid; ?>" rel="modal-window[<?php echo $post->ID; ?>]">
                            <img src="<?php resizeimage($attached_image->guid,$dt_ProjectLayoutOneWidth,'',$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                        </a>
                    <?php endforeach; ?>                    
                    </div>
                </div>
            <?php endif; ?>
            <?php if ( $dt_SingleProjectLayout == 2 ) : ?>
				<?php $dt_ProjectImageHeight = get_post_meta($post->ID, "single-project-height", true); ?>
                <?php $dt_ProjectImageHeight = trim(str_replace('px','',$dt_ProjectImageHeight)); ?>
                <?php if ( $dt_ProjectImageHeight == '' ) $dt_ProjectImageHeight = 440; ?>
				<div class="project-layout-2 clearfix"> 
                    <div class="project-images">
						<?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID.'&order='.$dt_SinglePostSlideOrder );  ?> 
                        <?php $attached_images = array_values($attached_images); ?>
                        <?php if ( !empty($attached_images) ): ?>
                            <script type="text/javascript">
                            $(window).load(function() {
                                $('#single-slideshow-<?php echo $post->ID; ?>').nivoSlider({effect:'fade',directionNav:false,manualAdvance:false, pauseTime:5000});
                            });
                            </script>                        
                            <div id="single-slideshow-<?php echo $post->ID; ?>" class="single-slideshow" style="height:<?php echo $dt_ProjectImageHeight; ?>px;">
                                <?php foreach($attached_images as $attached_image): ?>   
                                    <img src="<?php resizeimage($attached_image->guid,$dt_ProjectImageWidth,$dt_ProjectImageHeight,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>                          
                    <div class="entry-sidebar">
                        <div class="project-meta">
                            <div class="inner">
                                <?php $dt_ProjectClient = get_post_meta($post->ID, "dt_project_client", true); ?>
                                <?php if ( $dt_ProjectClient != '' ): ?>
                                    <span class="client"><?php echo $dt_ProjectClient; ?></span>
                                <?php endif; ?>
                                <?php $dt_ProjectYear = get_post_meta($post->ID, "dt_project_year", true); ?>
                                <?php if ( $dt_ProjectYear != '' ): ?>
                                    <span class="year"><?php echo $dt_ProjectYear; ?></span>
                                <?php endif; ?>
                                <?php $dt_ProjectServices = get_post_meta($post->ID, "dt_project_services", true);?>
                                <?php if ( $dt_ProjectServices != '' ): ?>
                                    <span class="services"><?php echo $dt_ProjectServices; ?></span>
                                <?php endif; ?>                        
                                <?php
									$taxonomy = 'portfolio';
                                    $tax_terms = wp_get_post_terms($post->ID,$taxonomy);
                                ?>
                                <?php if ( $tax_terms != '' ): ?>
                                    <span class="categories">
                                        <?php	
                                            $tax_term_count = count($tax_terms); 
                                            $counter = 1;
                                            foreach ($tax_terms as $tax_term) {
                                                echo '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . $tax_term->name . '" ' . '>' . $tax_term->name.'</a>';
                                                if ( $counter < $tax_term_count ) echo ', ';
                                                $counter++;
                                            }
                                        ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ( $dt_SingleProjectComments == 'no' ): ?>
                                    <span class="comments"><a href="#comments" class="scroll"><?php echo comments_number(); ?></a></span>
                                <?php endif; ?>
                            </div>                                                  		
                        </div>     
                        <?php $dt_SingleProjectSharing = get_option('dt_SingleProjectSharing','no'); ?>
                        <?php if ( $dt_SingleProjectSharing == 'no' ): ?>                 
                            <div class="project-sharing">
                                <div class="facebook">
                                    <div id="fb-root"></div>
                                    <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#appId=284728074870751&xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="125" data-show-faces="false"></div>
                                </div>
                                <div class="twitter">
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
                                </div>
                                <div class="googleplusone">                            
                                    <!-- Place this tag where you want the +1 button to render -->
                                    <g:plusone size="medium"></g:plusone>
                                    
                                    <!-- Place this render call where appropriate -->
                                    <script type="text/javascript">
                                      (function() {
                                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                        po.src = 'https://apis.google.com/js/plusone.js';
                                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                      })();
                                    </script>
                                </div>
                            </div>                                          
                        <?php endif; ?>
                    </div>  
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>                        
				</div>                              
            <?php endif; ?>
            <?php 
				$dt_SingleProjectRelated = get_option('dt_SingleProjectRelated','no');	
				if ( $dt_SingleProjectRelated == 'no' ):
					if ( $dt_SingleProjectSidebar == 'no' ) $dt_RelatedProjectsNumber = 4; else $dt_RelatedProjectsNumber = 6;

					$categories = get_the_terms($post->ID,'portfolio');					
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;		
					$my_query = new wp_query(array('post_type' => 'project','showposts'=> $dt_RelatedProjectsNumber,'post__not_in' => array($post->ID),'tax_query' => array(array('taxonomy' => 'portfolio','field' => 'id','terms' => $category_ids))));
					if( $my_query->have_posts() )
					{
						echo '<div id="related" class="clearfix">';
							echo '<div id="related-inner" class="clearfix">';
								echo '<h4>'.dt_RelatedProjectsTitle.'</h4>';
								echo '<ul>';
									$i = 1;
									while ($my_query->have_posts())
									{
										$my_query->the_post();
										?>
											<?php if ( has_post_thumbnail() ): ?>
												<?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
												<?php $dt_ProjectImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
												<?php if ( $dt_ProjectImageCrop == '' || $dt_ProjectImageCrop == 'inherit' ) $dt_ProjectImageCrop = $dt_CropLocation; ?>
												<li<?php if ( $i%$dt_RelatedProjectsNumber == 0 ) echo ' class="last-related"'; ?>>
													<h6><?php the_title();?></h6>
													<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>                                        
													<a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
														<img src="<?php echo resizeimage($thumbnail_src,125,77,$dt_ProjectImageCrop); ?>" alt="<?php the_title(); ?>" />
													</a>
													<?php global $more; $more = 0; variable_excerpt(12); ?>
													<a class="read-more" href="<?php echo get_permalink($post->ID); ?>"><?php echo dt_ReadMore; ?></a>                   
												</li>
											<?php endif; ?>                        
										<?php
										$i++;
									}
								echo '</ul>';
							echo '</div>';
						echo '</div>';
					}
				endif;					
		?>   
	<?php wp_reset_query(); ?>        
			<?php if ( $dt_SingleProjectComments == 'no' ): ?>            
                <div class="entry entry-last">                   
                    <?php comments_template( '', true ); ?>
                </div>
             <?php endif; ?>   
        <!--end of single -->
        </div>              
    <?php endwhile; ?>
    <?php if ( $dt_SingleProjectSidebar == 'no' ) : ?>
		<?php get_sidebar(); ?>        
    <?php endif; ?>
<!-- end of content -->
</section>
<?php get_footer(); ?>
