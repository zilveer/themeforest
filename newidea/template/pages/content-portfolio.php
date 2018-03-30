<?php
/**
 * Portfolio Content
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id, $object_id, $default_background;

$post = get_page($object_id);
$bg = $default_background;

if( newidea_get_post_meta_key('default-image', $post->ID) != ""){
	$bg = newidea_get_post_meta_key('default-image', $post->ID);
}
?>
<!--Portfolio-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg'); ?> data-bg="<?php echo $bg;?>"  >
	<div class="portfolio-container">
   		<!-- new portfolio section -->
        <div class="ps_slider">
			<div class="ps_albums">
            <?php
				
				$categories = get_terms('portfolio_categories',array('order'=>'DESC' , 'orderby'=>'id','parent'=>0,'hide_empty'=>0));

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
					
					$sub_categories = get_terms('portfolio_categories',array('order'=>'DESC','orderby'=>'id','parent'=>$category->term_id));
					
            	?>
                
                <?php if(count($sub_categories) > 0) : ?>
                	<div <?php post_class('ps_album'); ?> data-type="sub" data-url="<?php echo get_template_directory_uri().'/portfolio-subcategory.php'; ?>" data-slug="<?php echo $category->term_id; ?>" data-href="<?php echo $page_id; ?>" data-bg="<?php echo $bgimgurl; ?>">
                <?php else : ?>
                	<div <?php post_class('ps_album'); ?> data-type="images" data-url="<?php echo get_template_directory_uri().'/portfolio-list.php'; ?>" data-slug="<?php echo $category->slug; ?>" data-href="<?php echo $page_id; ?>" data-bg="<?php echo $bgimgurl; ?>">
                <?php endif; ?>
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