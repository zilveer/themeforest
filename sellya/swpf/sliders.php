<?php

function homepage_eislideshow_markup($pp = -1){
	
	$sellya_product_slider = json_decode( get_option('sellya_product_slider'),true) ;
	
	global $woocommerce;
	
	if( !isset($woocommerce) || empty($sellya_product_slider)) return;
	
	$args = array('post_type'=>'product','post__in'=>$sellya_product_slider,'posts_per_page'=>$pp);		
		
	$q = new WP_Query( $args );

	if($q->have_posts()):
		 
	?>
<div class="woocommerce">
        <section id="product-slider">
            <div id="ei-product-slider" class="ei-slider">
                <ul class="ei-slider-large">
                   
                <?php 
                while ( $q->have_posts() ) : $q->the_post();
                ?>
                <li>
                <?php
                
                
                if(has_post_thumbnail()){
                
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()) ,'full',false);
                $image = $image[0];
                
                
                }
                ?>
                   <div class="image">
                   <?php  if ( has_post_thumbnail()) :?>
                       <a href="<?php echo get_permalink();?>" class="product_image">
                    <?php the_post_thumbnail( array(300,300) ); 
                     
                     else  : 
                     
                     $image = get_template_directory_uri().'/images/placholder-300.png';	
                     
                     echo '<img   src="'.$image .'" alt="'.the_title().'"  >';
                      endif; ?>
                    </a>
                       </div>
                   <div class="ei-title">
                    <h2><a href="<?php echo get_permalink();?>"><?php echo the_title(); ?></a></h2>
                    <h3>
                        <a href="<?php echo get_permalink();?>">                        
                            <?php echo blog_one_column_excerpt(get_the_excerpt(),20);  ?>
                        </a>                                
                    </h3>                                
                    <h4>
                        <a href="<?php echo get_permalink();?>">
                         <?php                                
                          do_action( 'woocommerce_after_shop_loop_item_title' );
                        ?>
                          </a><br /><br />
                          
                          <a style="font-size:14px;font-weight:bold" class="button  ajax_add_to_cart_button"  href="<?php echo get_permalink();?>" title="Add to cart">Add to cart</a>
                    </h4>
                    </div>
                </li>
                <?php    endwhile; ?>
                </ul>
                <ul class="ei-slider-thumbs">
                <li class="ei-slider-element">Current</li>
                 <?php while ( $q->have_posts() ) : $q->the_post(); ?>
                    <li><a href="<?php echo get_permalink();?>"><?php echo  the_title() ;?></a></li>
                 <?php   endwhile; ?>
                 
                </ul>
            </div>
        </section>
</div>   
        <script type="text/javascript" src="<?php echo   get_template_directory_uri(); ?>/js/jquery.eislideshow.js"></script>
        <script type="text/javascript">
            jQuery(function($) {
            $('#ei-product-slider').eislideshow({
                        animation                       : 'center',
                        autoplay                        : true,
                        slideshow_interval      : 3000,
                        titlesFactor            : 0
            });
            });
        </script>

	<?php
	
	 endif;
	// Reset Query
	wp_reset_query();

}
?>