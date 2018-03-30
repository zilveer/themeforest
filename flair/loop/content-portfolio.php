<?php
	/**
	 * This loop is used to create items for the portfolio archives and also the homepage template.
	 * Any custom functions prefaced with ebor_ are found in /ebor_framework/theme_functions.php
	 * First let's declare $post so that we can easily grab everthing needed.
	 */
	 global $post;
	 
	 if(!( has_post_thumbnail() ))
		return false;
		
	 $icon = 'fa-eye';
	 
	 /**
	  * Next, we need to grab the featured image URL of this post, so that we can trim it to the correct size for the chosen size of this post.
	  */
	 $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
	 
	 if( get_post_format() == 'video' ){
	 	$url[0] = get_post_meta( $post->ID, "_ebor_the_video_1", true );
	 	$icon = 'fa-film';
	 }
?>

<li class="cbp-item <?php echo ebor_the_isotope_terms(); ?>">
    <div class="cbp-caption">
    
        <div class="cbp-caption-defaultWrap">
            <?php the_post_thumbnail('portfolio'); ?>
        </div>
        
        <?php if( get_option('only_lightbox','0') == '1' ) : ?>
        	<div class="cbp-caption-activeWrap">
            	<a href="<?php echo $url[0]; ?>" class="cbp-lightbox">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                        	<?php the_title('<h5>','</h5>'); ?>
                        </div>
                    </div>
                </a>
            </div>
        <?php elseif( get_option('portfolio_lightbox', '1') == '1' ) : ?>
	        <div class="cbp-caption-activeWrap">
	            <div class="cbp-l-caption-alignCenter">
	                <div class="cbp-l-caption-body">
	                	
	                	<?php the_title('<h5>','</h5>'); ?>
	                	
	                    <a href="<?php the_permalink(); ?>" class="cbp-singlePage cbp-l-caption-buttonLeft">
	                    	<i class="fa fa-link"></i>
	                    </a>
	                    
	                    <?php if( $url[0] ) : ?>
		                    <a href="<?php echo $url[0]; ?>" class="cbp-lightbox cbp-l-caption-buttonRight" data-title="<?php the_title(); ?>"> 
								<i class="fa <?php echo $icon; ?>"></i>
							</a>
						<?php endif; ?>
						
	                </div>
	            </div>
	        </div>
        <?php else : ?>
        	<div class="cbp-caption-activeWrap">
	        	<a href="<?php the_permalink(); ?>" class="cbp-singlePage">
		            <div class="cbp-l-caption-alignCenter">
		                <div class="cbp-l-caption-body">
		                	<?php the_title('<h5>','</h5>'); ?>
		                </div>
		            </div>
	            </a>
	        </div>
        <?php endif; ?>	        
        
    </div>
</li>