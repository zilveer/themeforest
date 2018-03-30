<?php
	/* SINGLE PAGES TEMPLATE */
	get_header();
	$dt_SinglePostSidebar = get_option('dt_SinglePostSidebar','no');
    $dt_SinglePostSidebarOver = get_post_meta($post->ID, "single-sidebar", true);
	if ( $dt_SinglePostSidebarOver != '' && $dt_SinglePostSidebarOver != 'inherit' )  $dt_SinglePostSidebar = $dt_SinglePostSidebarOver;	
	if ( $dt_SinglePostSidebar == 'no' ) $dt_SinglePostID = 'single'; else $dt_SinglePostID = 'single-full-width'; 
	if ( $dt_SinglePostSidebar == 'no' ) $dt_PostImageWidth = '650'; else  $dt_PostImageWidth = '960';

	$dt_SinglePostInfo = get_option('dt_SinglePostInfo','no');
	
	$dt_SinglePostImage = get_option('dt_SinglePostImage','no');
	if( $dt_SinglePostImage == 'yes' ) $dt_SinglePostClass = ' no-featured-image';
	$dt_CropLocation = get_option('dt_CropLocation','c'); 
	$dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true);
	if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation;
	$dt_PostImageHeight = get_post_meta($post->ID, "single-height", true); 
	$dt_PostImageHeight = trim(str_replace('px','',$dt_PostImageHeight));
	if ( $dt_PostImageHeight == '' ) $dt_PostImageHeight = 300;  
	
	$dt_SinglePostSlide = get_post_meta($post->ID, "single-slideshow", true);	
	if ( $dt_SinglePostSlide == '' ) $dt_SinglePostSlide = 'no';
	
	$dt_SinglePostRelated = get_option('dt_SinglePostRelated','no');	
	$dt_SinglePostComments = get_option('dt_SinglePostComments','no');	

?>
<section id="content" class="clearfix<?php if ( $dt_SinglePostSidebar == 'no' ) echo ' page-widh-sidebar'; ?>">
<div class="content-header-sep"></div>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
        <div id="<?php echo $dt_SinglePostID; ?>" class="page<?php echo $dt_SinglePostClass; ?>">
        	<?php $dt_SinglePostImage = get_option('dt_SinglePostImage','no'); ?>
            <?php if ( $dt_SinglePostImage == 'no' ): ?>
                <?php if( $dt_SinglePostInfo == 'yes' ) $dt_PostImagesClass = ' no-post-metabox'; ?>
                <div class="post-images<?php echo $dt_PostImagesClass; ?>">
                	<?php if ( $dt_SinglePostSlide == 'no' ): ?>
						<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>
                    	<?php if ( $thumbnail_src != '' ) : ?>
                            <a href="<?php echo $thumbnail_src; ?>" style="height:<?php echo $dt_PostImageHeight; ?>px;"> 
                                <img src="<?php resizeimage($thumbnail_src,$dt_PostImageWidth,$dt_PostImageHeight,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php $dt_SinglePostSlideOrder = get_post_meta($post->ID, "single-slideshow-order", true); ?>
                        <?php if ( $dt_SinglePostSlideOrder == '' ) $dt_SinglePostSlideOrder = 'DESC'; ?>                    
						<?php $attached_images =& get_children('post_type=attachment&post_mime_type=image&post_parent='.$post->ID.'&order='.$dt_SinglePostSlideOrder );  ?> 
                        <?php $attached_images = array_values($attached_images); ?>
                        <?php if ( !empty($attached_images) ): ?>
							<script type="text/javascript">
                            $(window).load(function() {
                                $('#single-slideshow-<?php echo $post->ID; ?>').nivoSlider({effect:'fade',directionNav:false,manualAdvance:true});
                            });
                            </script>                        
                            <div id="single-slideshow-<?php echo $post->ID; ?>" class="single-slideshow" style="height:<?php echo $dt_PostImageHeight; ?>px;">
                                <?php foreach($attached_images as $attached_image): ?>   
                                    <img src="<?php resizeimage($attached_image->guid,$dt_PostImageWidth,$dt_PostImageHeight,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ( $dt_SinglePostInfo == 'no' ): ?>
            <div class="post-metabox">
                <?php if ( get_the_author_meta( 'description' ) ) : ?>
                    <div id="author-info" class="clearfix">
                        <div id="author-avatar">
							<?php $avatar_path = get_template_directory_uri().'/images/default-avatar.png'; ?>
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '83'); ?>
                        <!--end of author avatar -->
                        </div>
                        <div id="author-description">
                            <h6><span><?php echo dt_AuthorAbout;?></span><?php echo get_the_author(); ?></h6>
                            <p><?php the_author_meta( 'description' ); ?> <a class="more-url" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo dt_AuthorViewAll; ?></a></p>                            
                        <!-- end of author description -->
                        </div>
                    <!-- end of author info -->
                    </div>
                <?php endif; ?>
                <span class="date"><?php the_time('jS'); echo ' '; the_time('F'); echo ' '; the_time('Y');?></span>
                <span class="author"><?php echo dt_PostedBy; ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a></span>
                <?php if ( $dt_SinglePostComments == 'no' ): ?>
	                <span class="comments"><a href="#comments" class="scroll"><?php echo comments_number(); ?></a></span>
                <?php endif; ?>
				<?php if ( count( get_the_category() ) ) : ?><span class="categories"><?php echo dt_Categories.get_the_category_list( ', ' ); ?></span><?php endif; ?>
                <?php $tags_list = get_the_tag_list( '', '' ); ?>
				<?php if ( $tags_list ): ?><span class="tags clearfix"><?php echo $tags_list; ?></span><?php endif; ?>
            	<div class="post-metabox-bottom"></div>
                <div class="post-metabox-close"><div>INFO</div></div>
            </div>           
            <?php endif; ?>
            <div class="entry">                
                <div class="entry-content entry-last">
                    <?php the_content('Read More'); ?>
                    <?php wp_link_pages( array( 'before' => '<span class="page-link">' . 'Pages:', 'after' => '</span>' ) ); ?>
                </div>
			</div>
            <?php $dt_SinglePostSharing = get_option('dt_SinglePostSharing','no'); ?>
            <?php if ( $dt_SinglePostSharing == 'no' ): ?>
                <div class="single-sharing clearfix">
                    <hr />
                    <div class="facebook">
                        <div id="fb-root"></div>
                        <script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/all.js#appId=284728074870751&xfbml=1";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-like" data-send="false" data-layout="button_count" data-width="" data-show-faces="false"></div>
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
            <?php 
				if ( $dt_SinglePostRelated == 'no' ):
					$dt_SinglePostRelatedType = get_option('dt_SinglePostRelatedType','category');
					if ( $dt_SinglePostSidebar == 'no' ) $dt_RelatedPostsNumber = 4; else $dt_RelatedPostsNumber = 6;
					switch ( $dt_SinglePostRelatedType )
					{
						case 'category':
							$categories = get_the_category($post->ID);
							if ($categories) {
								$category_ids = array();
								foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
								$args=array( 'category__in' => $category_ids,'post__not_in' => array($post->ID),'showposts'=> $dt_RelatedPostsNumber,'ignore_sticky_posts'=>1);
							}
						break;
						case 'tags':
							$tags = wp_get_post_tags($post->ID);
							if ($tags) {
								$tag_ids = array();
								foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
								$args=array('tag__in' => $tag_ids,'post__not_in' => array($post->ID),'showposts'=> $dt_RelatedPostsNumber,'ignore_sticky_posts'=>1);
							}	
						break;							
					}
								
					$my_query = new wp_query($args);
					if( $my_query->have_posts() )
					{
						echo '<div id="related" class="clearfix">';
							echo '<div id="related-inner" class="clearfix">';
								echo '<h4>'.dt_RelatedTitle.'</h4>';
								echo '<ul>';
									$i = 1;
									while ($my_query->have_posts())
									{
										$my_query->the_post();
										?>
											<?php if ( has_post_thumbnail() ): ?>
												<?php $dt_CropLocation = get_option('dt_CropLocation','c'); ?>
												<?php $dt_PostImageCrop = get_post_meta($post->ID, "dt_croplocation", true); ?>
												<?php if ( $dt_PostImageCrop == '' || $dt_PostImageCrop == 'inherit' ) $dt_PostImageCrop = $dt_CropLocation; ?>
												<li<?php if ( $i%$dt_RelatedPostsNumber == 0 ) echo ' class="last-related"'; ?>>
													<h6><?php the_title();?></h6>
													<?php $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID ) ); ?>                                        
													<a class="post-image" href="<?php the_permalink(); ?>" title="<?php the_title();?>">
														<img src="<?php echo resizeimage($thumbnail_src,125,77,$dt_PostImageCrop); ?>" alt="<?php the_title(); ?>" />
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
            <?php if ( $dt_SinglePostComments == 'no' ): ?>                
                <div class="entry entry-last">       
                    <?php comments_template( '', true ); ?>
                </div>
			<?php endif; ?>            
        <!--end of single -->
        </div>              
    <?php endwhile; ?>
    <?php if ( $dt_SinglePostSidebar == 'no' ) : ?>
		<?php get_sidebar(); ?>        
    <?php endif; ?>
<!-- end of content -->
</section>
<?php get_footer(); ?>
