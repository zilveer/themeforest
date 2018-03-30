<?php
/**
 *
 * @subpackage newidea
 * @since newidea 4.0
 *
 */
 
//Don't remove it,it's important
$root = '../../../';
if(file_exists($root.'wp-load.php')){
	require_once($root.'wp-load.php');
}else if(file_exists($root.'wp-config.php')){
	require_once( $root.'wp-config.php' );
}
	
$slug = isset($_REQUEST['slug']) ? $_REQUEST['slug'] : "";
$href = isset($_REQUEST['href']) ? $_REQUEST['href'] : "";
$bg = isset($_REQUEST['bgimg']) ? $_REQUEST['bgimg'] : "";
?>
<!--Sub Portfolio-->
<section id="portfolio-sub-category" class="contBg" data-bg="<?php echo $bg; ?>"  >
    <div class="portfolio-container">
        <div class="portfolio-list-back"><a href="#<?php echo $href; ?>"><?php echo __('Back Category','newidea'); ?></a></div>
        <div class="clear"></div>
        <!-- sub portfolio section -->
        <div id="ps_sub_slider" class="ps_slider">
            <div class="ps_albums">
            <?php

				$categories = get_terms('portfolio_categories',array('order'=>'DESC' , 'orderby'=>'id','parent'=>$slug));

				if(count($categories) > 0){
				
				$categories = newidea_get_portfolio_sort_by_id($categories);
                    
                // The Loop
                foreach($categories as $category){
                    $img = get_tax_meta($category->term_id,'newidea_image_field_id');
					$imgurl = "";
					if(isset($img['id'])){
						$attachment_image = wp_get_attachment_image_src($img['id'], "portfolio-cats-thumbnails"); 
						$imgurl = $attachment_image[0];
					}
                    
                    $bgimg = get_tax_meta($category->term_id,'newidea_image_bg');
                    $bgimgurl = isset($bgimg['url']) ? $bgimg['url'] : "";
                ?>
                <div class="ps_album" data-url="<?php echo get_template_directory_uri().'/portfolio-list.php'; ?>" data-slug="<?php echo $category->slug; ?>" data-href="<?php echo $href; ?>" data-bg="<?php echo $bgimgurl; ?>">
                    <div class="albumCont">
                        <div class="ps_img"><img src="<?php echo $imgurl; ?>" height="260" width="200" alt="<?php echo $category->name; ?>" />
                        </div>
                        <div class="ps_desc">
                            <h6 class="title"><?php echo $category->name; ?></h6>
                        </div>
                        <div class="ps_tip"></div>
                    </div>
                </div>
                <?php } }?>
            </div>
            <a class="prev disabled"></a>
            <a class="next disabled"></a>
        </div>
    </div>
</section>