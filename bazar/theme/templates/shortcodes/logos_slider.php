<?php
	wp_reset_query();
    
    $args = array(
        'post_type' => 'logo'    
    );
	
	$args['posts_per_page'] = (!is_null( $items )) ? $items : -1;
    
    $tests = new WP_Query( $args );  
    
    $html = '';
    if( !$tests->have_posts() ) return $html;
    
?>

<div class="margin-bottom">
    <div class="logos-slider wrapper">
        <h2><?php echo yit_decode_title($title); ?></h2>
        <div class="list_carousel">
            <ul class="logos-slides">
            
                <?php 
                    wp_enqueue_script( 'caroufredsel' );
                    wp_enqueue_script( 'touch-swipe' );
                    wp_enqueue_script( 'mousewheel' );
                    wp_enqueue_script( 'black-and-white' );
                    
                    while( $tests->have_posts() ) : $tests->the_post();
                        $logo_title = the_title( '<strong><a href="' . get_permalink() . '" class="name">', '</a></strong>', false );
                        $logo_link = yit_get_post_meta( get_the_ID(), '_site-link' );
                ?>
                    <li style="height: <?php echo $height; ?>px;">
                        <?php
                            if ($logo_link != ''):
                                echo '<a href="' . esc_url($logo_link) . '" class="bwWrapper">';
                            else:
                                echo '<a href="#" class="bwWrapper" >';
                            endif;
                            
                            $image_id = get_post_thumbnail_id();  
                            $image_url = wp_get_attachment_image_src($image_id,'full');  
                            $image_url = $image_url[0]; 
                            
                            echo '<img src="'.$image_url.'" style="max-height: '.$height.'px;" class="logo" />';
							
                            echo '</a>';
                        ?>
                    </li>
                <?php endwhile; wp_reset_query(); ?>
            </ul>
        </div>
        <div class="clear"></div>
        <div class="nav">
            <a class="prev" href="#"></a>
            <a class="next" href="#"></a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<script type="text/javascript">
	jQuery(function($){
		
		$('.logos-slides').imagesLoaded(function(){
			$('.logos-slides').carouFredSel({
				auto: true,
				width: '100%',
				prev: '.logos-slider .prev',
				next: '.logos-slider .next',
				swipe: {
					onTouch: true
				},
				scroll : {
					items     : 1,
					duration  :	<?php echo $speed; ?>
				} 
			});
		});
		
		$('.bwWrapper').BlackAndWhite({
			hoverEffect : true, // default true
			// set the path to BnWWorker.js for a superfast implementation
			webworkerPath : false,
			// for the images with a fluid width and height 
			responsive:true,
			speed: { //this property could also be just speed: value for both fadeIn and fadeOut
				fadeIn: 200, // 200ms for fadeIn animations
				fadeOut: 300 // 800ms for fadeOut animations
			}
		});
		
		$("a.bwWrapper[href='#']").click(function(){ return false })
    
	});
</script>

<?php echo $html; ?>