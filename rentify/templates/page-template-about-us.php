<?php 
/**
 * Template Name: About Us Page
 *
 */
 ?>

<?php get_template_part('templates/header','construction');?>

<?php 
	if(has_post_thumbnail()){
		$background_image_id = get_post_thumbnail_id(get_the_ID());
		if($background_image_id){
			$background_image = wp_get_attachment_image_src( $background_image_id ,'large');
			$background_image = $background_image[0]; 
		}
	}else{
		$banner_bg_color = get_post_meta( get_the_ID(), '_rentify_page_banner_color', true );
		if(isset($banner_bg_color) && !empty($banner_bg_color)){
			$background_color = $banner_bg_color;
		}else{
			$background_color = '#000';
		}         
	}
?>

<div class="breadecrumb"> 
    <div class="uou-block-3c secondary" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image);}?>);background-size:cover;">
        <div class="container">
            <h1><?php the_title(); ?></h1> 
            <ul class="breadcrumbs">
	        <?php 
	        	if (function_exists("the_breadcrumb")) {
	            	the_breadcrumb();
	         	} 
	        ?>  
	      </ul>
		</div>
    </div> 
</div>




<?php echo do_shortcode(apply_filters('the_content',$post->post_content)); ?>
		



<?php get_footer();