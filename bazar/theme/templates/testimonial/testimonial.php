<!-- START TESTIMONIALS -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	        
	            <div class="clear"></div>
	            <div class="posts">
	                <?php                      
	                    $item_id = get_the_ID();
	                    $title = is_null( get_the_title() ) ? __( '(this post has no title)', 'yit' ) : the_title('<h2>', '</h2>', false);
						
						//$title = (yit_get_option('link-testimonials')) ? the_title( '<a href="' . get_permalink() . '" class="name">', '</a>', false ) : the_title('<p class="name">', '</p>',false);
						$label = yit_get_post_meta( get_the_ID(), '_site-label' );
						$siteurl = yit_get_post_meta( get_the_ID(), '_site-url' );
						$website = '';
						if ($siteurl != ''):
							if ($label != ''):
								$website = '<a class="website" href="' . esc_url($siteurl) . '">' . $label . '</a>';
							else:
								$website = '<a class="website" href="' . esc_url($siteurl) . '">' . $siteurl . '</a>';
							endif;
						else:
							$website = '<span class="website">' . $label . '</span>';
						endif;
						$thumb = (get_the_post_thumbnail( null, 'thumb-testimonial' )) ? 'testimonial-thumb' : '';
	                ?>                
	                <div id="post-<?php echo $item_id ?>" class="hentry-post group testimonial-post internal-post">
						<div class="post_content group">
	                        
		                        <div class="testimonial-page span<?php echo yit_get_sidebar_layout() != 'sidebar-no' ? 9 : 12 ?>">
		                        	<div class="testimonial-text-full <?php echo $thumb; ?>">
		                        		<blockquote><?php wpautop( the_content() ); ?></blockquote>
								        <?php if (has_post_thumbnail()) :  ?>
									        <div class="thumbnail">
									        	<?php yit_image( "size=thumb-testimonial" );//echo get_the_post_thumbnail( null, 'thumb-testimonial' ); ?>   
									        </div>
								        <?php endif; ?>
							        </div>
							        <div class="testimonial-name"><?php echo the_title('<p class="name">', '</p>',false) . $website; ?></div>				        	
						        </div>
					        
	                    </div>
	                </div>            
	            </div>
	        
	        </div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php do_action( 'yit_before_sidebar' ) ?>
	        <?php get_sidebar() ?>
	        <?php do_action( 'yit_after_sidebar' ) ?>
	    </div>
    </div>
</div>
<!-- END TESTIMONIALS -->