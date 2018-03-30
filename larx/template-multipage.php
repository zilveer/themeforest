<?php

/* Template Name: Multi-page */

$post = $wp_query->post;

get_header();

$alternate_title=get_post_meta(get_the_ID(), '_cmb_alternate_title', true);
if($alternate_title ==''){$alternate_title = $post->post_title;}
$alternate_background=get_post_meta(get_the_ID(), 'alternate_background', true); 
if($alternate_background !==''){
    $th_alternate_background = 'style="background:url(\''.esc_url($alternate_background).'\') 50% 0 no-repeat fixed;background-size:cover;" ';
}else{
	$th_alternate_background ='';
}

$overlay_background_class = '';
$overlay_background=get_post_meta(get_the_ID(), '_cmb_overlay_background', true);
if( $overlay_background !='' && $overlay_background == 'on'){
    $overlay_background_class = 'ws-overlay';
}

?>
	
	<div class="ws-parallax-header parallax-window" data-parallax="scroll" data-image-src="<?php echo esc_url($alternate_background); ?>">        
        <div class="<?php echo esc_attr($overlay_background_class); ?>">            
            <div class="ws-parallax-caption">                
                <div class="ws-parallax-holder">
					<h1><?php echo esc_html($alternate_title); ?></h1>
				</div>
            </div>
        </div>            
    </div>         

<?php
	if (have_posts()) : while (have_posts()) : the_post();?>
        <div class="site-wrapper"> <?php

            the_content(); ?>

        </div> <?php
	endwhile; endif;   

get_footer(); 
?>