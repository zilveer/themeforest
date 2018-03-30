<?php 

    wp_register_script('bxslider', get_template_directory_uri() . '/js/jquery.bxslider.js', 'jquery', '1.0', TRUE);

    wp_register_script('jm-bxslider', get_template_directory_uri() . '/js/jquery.jm-bxslider.js', 'jquery', '1.0', TRUE);

    wp_enqueue_script('bxslider');

    wp_enqueue_script('jm-bxslider');

    

    $date = time() . '_' . uniqid(true);

    

    $post_id = get_the_ID();

    

    $project_title = get_post_meta($post_id, '_probusiness_project_title', true);

    $project_desctiption = get_post_meta($post_id, '_probusiness_project_description', true);

    $skill = get_post_meta($post_id, '_probusiness_portfolio_skill', true);

    $client = get_post_meta($post_id, '_probusiness_portfolio_client', true);

    $link = get_post_meta($post_id, '_probusiness_portfolio_link', true);

    $facebook = get_post_meta($post_id, '_probusiness_portfolio_link_facebook', true);

    $twitter = get_post_meta($post_id, '_probusiness_portfolio_link_twiter', true);

    $pinterest = get_post_meta($post_id, '_probusiness_portfolio_link_pinterest', true);

    $google = get_post_meta($post_id, '_probusiness_portfolio_link_google', true);

?>

<article id="post_<?php echo esc_attr($post_id); ?>" <?php post_class('cs-portfolio-item post-content'); ?>>

    <div class="cs-portfolio-header <?php if ( is_archive() ) { echo 'span6'; }else{ echo 'span8'; } ?>">

        <span class="post-featured-img">

            <?php

            $enable_gallery_slider = get_post_meta($post_id, '_probusiness_gallery_slider', true);

            if (!empty($enable_gallery_slider) && $enable_gallery_slider == 'on') {                

            $gallery_ids = cs_grab_ids_from_gallery();

            }

            ?>

            <?php if(!empty($gallery_ids)){ ?>

            <div id="gallery-<?php echo $date; ?>" class="gallery"> 

                <div class="cs-nav">

                    <ul>

                        <li class="prev"></li>

                        <li class="next"></li>

                    </ul>

                </div>

                <div id="slides-<?php echo esc_attr($date); ?>" data-moveslides="1" data-auto="true" data-prevselector="#gallery-<?php echo esc_attr($date); ?> .prev" data-nextselector="#gallery-<?php echo esc_attr($date); ?> .next" data-onsliderload="jmnewspro<?php echo $date; ?>" data-touchenabled="1" data-controls="true" data-pager="false" data-pause="4000" data-auto="false" data-infiniteloop="true" data-adaptiveheight="true" data-speed="500" data-autohover="true" data-slidemargin="20" data-maxslides="1" data-minslides="1" data-slidewidth="150" data-slideselector="" data-easing="swing" data-usecss="" data-resize="1" class="slider jm-bxslider">

                    <?php

                    foreach ($gallery_ids as $image_id) {                            

                        $image_attr = wp_get_attachment_image_src($image_id, 'full', false);

                        echo '<div class="image"><img alt="" style="width:100%" src="'.esc_attr(esc_attr($image_attr[0])).'"/></div>';

                    }

                    ?>

                </div>

            </div>

            <?php }else{

                if (has_post_thumbnail()){

                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full', false);

                    echo '<img alt="" src="'. esc_attr($attachment_image[0]) .'" />';

                } else {

                    $attachment_image = cs_get_theme_option('default_portfolio_image_feature');

                    if($attachment_image != ''){

                        echo '<img alt="" src="' . esc_attr($attachment_image) . '" />';

                    }                    

                }

            } ?>

        </span>

    </div>

    <div class="cs-portfolio-content <?php if ( is_archive() ) { echo 'span6'; }else{ echo 'span4'; } ?>">

        <?php if ( is_archive() ) { ?>

            <h4 class="cs-portfolio-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>

        <?php }else{ ?>

            <h4 class="cs-portfolio-title"><?php echo $project_title; ?></h4>

        <?php } ?>

            <?php if( is_archive() ){ ?>

            <div class="cs-portfolio-category">

                <?php echo get_the_term_list( $post_id, 'portfolio_category', '', ', ', ''); ?> 

            </div>

        <?php } ?>

        <div class="portfolio-description">                

            <?php if ( is_archive() ) {?>

                <div class="cs-portfolio-description"><?php the_excerpt(); ?></div>

            <?php } else { ?>

                <div class="cs-portfolio-description"><?php echo strip_shortcodes($post->post_content); ?></div>                    

            <?php } ?>

        </div>

        <?php if ( is_archive() ) { ?>

            <div class="cs-read-more-button">

                <a class="cs-read-more" href="<?php the_permalink(); ?>" title="Read More" class="read-more-link"><i class="fa fa-share"></i>Read More</a>

            </div>

        <?php }else{ ?>

            <div class="portfolio-info">                

                <h4><?php echo $project_desctiption; ?></h4>

                <?php if($skill != ''){ ?>

                <div class="portfolio-info-box">

                    <span class="portfolio-view">Skill: </span>

                    <span class="portfolio-terms"><?php echo $skill; ?></span>

                </div>

                <?php } ?>

                <?php if($client != ''){ ?>

                <div class="portfolio-info-box">

                    <span class="portfolio-view">Client: </span>

                    <span class="portfolio-terms"><?php echo $client; ?></span>

                </div>

                <?php } ?>

                <?php if($link != ''){ ?>

                <div class="portfolio-info-box">

                    <span class="portfolio-view">Link: </span>

                    <span class="portfolio-terms"><a href="<?php echo esc_url($link); ?>"><?php echo $link; ?></a></span>

                </div>

                <?php } ?>

            </div>

            <?php if($facebook == 'on' || $twitter == 'on' || $pinterest == 'on' || $google == 'on'){ ?>

                <ul class="portfolio-share">

                    <?php if($facebook == 'on'){ ?>  

                    <li class="facebook-share">

                        <div class="fb-share-button" data-href="<?php the_permalink(); ?>" data-type="icon"></div>

                    </li>

                    <?php } ?>

                    <?php if($twitter == 'on'){ ?>

                    <li class="twitter-share">

                        <a href="<?php the_permalink(); ?>" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="small" data-count="none">Tweet</a>

                    </li>

                    <?php } ?>

                    <?php if($pinterest == 'on'){ ?>

                    <li class="pinterest-share">

                        <a href="//www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>%2F&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="above"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>

                    </li>

                    <?php } ?>

                    <?php if($google == 'on'){ ?>

                    <li class="google-share">

                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,

                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img alt=""

                            src="https://www.gstatic.com/images/icons/gplus-16.png" alt="Share on Google+"/></a>

                    </li>

                    <?php } ?>

                </ul>

            <?php } ?>

        <?php } ?>

    </div>

    <scr<?php echo 'ip';?>t type="text/javascript">

        function jmnewspro<?php echo $date; ?>(){}

        //share facebook

        (function(d, s, id) {

            var js, fjs = d.getElementsByTagName(s)[0];

            if (d.getElementById(id)) return;

            js = d.createElement(s); js.id = id;

            js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";

            fjs.parentNode.insertBefore(js, fjs);

        }(document, 'script', 'facebook-jssdk'));

        //share twiter

        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

    </script> 

</article>