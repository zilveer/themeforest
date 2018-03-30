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
<!--Portfolio-->
<section id="portfolio-list-just-view" class="contBg" data-bg="<?php echo $bg; ?>"  >
	<div class="portfolio-list">
        <div class="portfolio-list-back"><a href="#<?php echo $href; ?>"><?php echo __('Back Category','newidea'); ?></a></div>
        <div class="clear"></div>
        <div class="portfolio-list-items">
        <?php
            $slugs[] = $slug;
            $args = array(
                'posts_per_page' => -1, 
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_categories',
                        'field' => 'slug',
                        'terms' => $slugs)
                    )
                );
            $the_query = new WP_Query($args);
            if($the_query->have_posts()){
                
            // The Loop
            while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
           
            <div class="portfolio-list-item" >
                <div>
                    <a title="<?php echo esc_attr(get_the_content()); ?>" target="<?php echo intval(newidea_get_post_meta_key('portfolio-foramt')) == 2 ? '_blank' : ''; ?>" data-format="<?php echo intval(newidea_get_post_meta_key('portfolio-foramt')); ?>" href="<?php 
						if(intval(newidea_get_post_meta_key('portfolio-foramt')) == 0){
							if( has_post_thumbnail(get_the_ID())) {
								$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
								echo $full_image[0];
							}
						}else if(intval(newidea_get_post_meta_key('portfolio-foramt')) == 1){
							echo newidea_get_post_meta_key('portfolio-preview-media');
						}else{
							echo newidea_get_post_meta_key('portfolio-preview-link');
						}
					?>" title="<?php echo esc_html(get_the_content()); ?>">
                    <div class="ps_img">
						<?php if(has_post_thumbnail(get_the_ID()) ){?>
							<?php echo get_the_post_thumbnail(get_the_ID(), 'portfolio-thumbnails' ,array('alt' => get_the_title(),'title' => get_the_title())); ?>
                        <?php } ?>
                    </div>
                    <div class="ps_desc">
                        <h6><?php echo get_the_title(); ?></h6>
                    </div>
                    <div class="ps_tip"></div>
                    </a>
                </div>
            </div>
            <?php endwhile; }?>
        </div>
        <a class="prev disabled"></a>
        <a class="next disabled"></a>
    </div>
 </section>