<?php
//get global variables
global $wp_query;
global $qode_options;
global $wpdb;

//init variables
$id = $wp_query->get_queried_object_id();

if(get_post_meta($id, "qode_content-top-padding", true) != ""){
    $content_style = get_post_meta($id, "qode_content-top-padding", true);
}else{
    $content_style = "";
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
    $background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
    $background_color = "";
}

$portfolio_images  = get_post_meta(get_the_ID(), "qode_portfolio_images", true);


//sort portfolio images by user defined input
if (is_array($portfolio_images)){
    usort($portfolio_images, "comparePortfolioImages");
}
?>


<div class="full_width" <?php if($background_color != "") { echo " style='background-color:". esc_attr($background_color) ."'";} ?>>
    <div class="full_width_inner" <?php if($content_style != "") { echo " style='padding-top:". esc_attr($content_style) ."px'";} ?>>
        <div class="portfolio_single portfolio_fullwidth_slider">
            <div class="container" <?php if($background_color != "") { echo " style='background-color:". esc_attr($background_color) ."'";} ?>>
                <div class="container_inner">
                    <div class="two_columns_75_25 clearfix portfolio_container">
                        <div class="column1">
                            <div class="column_inner">
                                <div class="portfolio_single_text_holder">
                                    <h2 class="portfolio_single_text_title"><span><?php the_title(); ?></span></h2>
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="column2">
                            <div class="column_inner">
                                <div class="portfolio_detail">
                                    <?php
                                    //get portfolio custom fields section
                                    get_template_part('templates/portfolio/parts/portfolio-custom-fields');

                                    //get portfolio date section
                                    get_template_part('templates/portfolio/parts/portfolio-date');

                                    //get portfolio categories section
                                    get_template_part('templates/portfolio/parts/portfolio-categories');

                                    //get portfolio tags section
                                    get_template_part('templates/portfolio/parts/portfolio-tags');

                                    //get portfolio share section
                                    get_template_part('templates/portfolio/parts/portfolio-social');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portfolio_owl_slider">
                    <?php
                    $portfolio_m_images = get_post_meta(get_the_ID(), "qode_portfolio-image-gallery", true);
                    if ($portfolio_m_images){
                        $portfolio_image_gallery_array=explode(',',$portfolio_m_images);
                        foreach($portfolio_image_gallery_array as $gimg_id){
                            $title = get_the_title($gimg_id);
                            $alt = get_post_meta($gimg_id, '_wp_attachment_image_alt', true);
                            $image_src = wp_get_attachment_image_src( $gimg_id, 'blog_image_in_grid' );
                            if (is_array($image_src)) $image_src = $image_src[0];
                            ?>
                             <div class="owl-item">
                                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($alt); ?>" />
                            </div>
                            <?php
                        }
                    }

                    if (is_array($portfolio_images) && count($portfolio_images)){
                        foreach($portfolio_images as $portfolio_image){
                            ?>

                            <?php if($portfolio_image['portfolioimg'] != ""){ ?>
                                <?php

                                list($id, $title, $alt) = qode_get_portfolio_image_meta($portfolio_image['portfolioimg']);

                                ?>
                                <div class="owl-item">
                                    <img src="<?php echo esc_url($portfolio_image['portfolioimg']); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                </div>
                            <?php }
                        }
                    }
                    ?>
            </div>

            <div class="container" <?php if($background_color != "") { echo " style='background-color:". esc_attr($background_color) ."'";} ?>>
                <div class="container_inner">
                    <?php
                    get_template_part('templates/portfolio/parts/portfolio-navigation');
                    get_template_part('templates/portfolio/parts/portfolio-comments');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
