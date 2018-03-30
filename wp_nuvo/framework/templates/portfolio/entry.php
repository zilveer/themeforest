<?php
    wp_enqueue_style('colorbox');
    wp_enqueue_script('jquery-colorbox');

    $post_id = get_the_ID();

    $project_title = get_post_meta($post_id, '_probusiness_project_title', true);
    $project_desctiption = get_post_meta($post_id, '_probusiness_project_description', true);
    $skill = get_post_meta($post_id, '_probusiness_portfolio_skill', true);
    $client = get_post_meta($post_id, '_probusiness_portfolio_client', true);
    $link = get_post_meta($post_id, '_probusiness_portfolio_link', true);
    $facebook = get_post_meta($post_id, '_probusiness_portfolio_link_facebook', true);
    $twitter = get_post_meta($post_id, '_probusiness_portfolio_link_twitter', true);
    $pinterest = get_post_meta($post_id, '_probusiness_portfolio_link_pinterest', true);
    $google = get_post_meta($post_id, '_probusiness_portfolio_link_google', true);
?>
<article id="post_<?php echo esc_attr($post_id); ?>" <?php post_class('cs-portfolio-item post-content'); ?>>
    <div class="cs-portfolio-header <?php if ( is_archive() ) { echo 'span6'; }else{ echo 'span8'; } ?>">
        <span class="post-featured-img">
            <?php
               if (has_post_thumbnail()){
                    $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full', false);
                    $image_large = $attachment_image[0];
                    echo '<img alt="" src="'. esc_attr($attachment_image[0]) .'" />';
                }
            ?>
        </span>
        <?php if ( is_archive() ) { ?>
            <div class="cs-portfolio-info">
                <a class="cs-portfolio-colorbox" href="<?php echo esc_url($image_large); ?>"><i class="fa fa-search"></i></a>
            </div>
        <?php } ?>
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
                <div class="cs-portfolio-description"><?php echo the_content(); ?></div>
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
                    <span class="portfolio-terms"><a href="<?php echo $link; ?>"><?php echo $link; ?></a></span>
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
                        <a href="//www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>%2F&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="above"><img alt="" src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
                    </li>
                    <?php } ?>
                    <?php if($google == 'on'){ ?>
                    <li class="google-share">
                        <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
                            '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
                            src="https://www.gstatic.com/images/icons/gplus-16.png" alt="Share on Google+"/></a>
                    </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
    </div>
    <sc<?php echo 'ri';?>pt type="text/javascript">
        jQuery( document ).ready(function() {
             jQuery(".cs-portfolio-colorbox").colorbox({maxWidth:'700px', maxHeight: '700px'});
        });
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