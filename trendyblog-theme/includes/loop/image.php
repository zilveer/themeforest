<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	//blog style
	if(is_category()) {
		$blogStyle = df_get_custom_option( get_cat_id( single_cat_title("",false) ), 'blogStyle', false );
	} elseif(is_tax()){
		$blogStyle = df_get_custom_option( get_queried_object()->term_id, 'blogStyle', false );
	} else {
		$blogStyle = get_post_meta ( DF_page_ID(), "_".THEME_NAME."_blogStyle", true ); 	
	}
	
	if($blogStyle=="1" || $blogStyle=="4") {
		$width = 500;
		$height = 500;
	} else if($blogStyle=="2") {
		$width = 500;
		$height = 300;
	} else if($blogStyle=="3") {
		$width = 1900;
		$height = 700;
	}  else if($blogStyle=="5") {
		$width = 1140;
		$height = 684;
	} else {
		$width = 500;
		$height = 500;	
	}


	$image = get_post_thumb($post->ID,$width,$height); 
	$imageL = get_post_thumb($post->ID,0,0); 


	if(df_get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true) {
?>
    <div class="thumb_hover">
        <a href="<?php the_permalink();?>">
        	<?php echo df_image_html($post->ID,$width,$height);?>
        </a>
    </div>

<?php } ?>
