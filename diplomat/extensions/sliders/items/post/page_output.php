<?php
tmm_enqueue_script('owlcarousel');
tmm_enqueue_style('owlcarousel');
tmm_enqueue_style('owltransitions');

$slider_class = 'post-slider post-image';
//$height = $data['slider_options']['height'];
$height = '670';
//$slider_height = '700';

$image_alias = '1140*'.$height;
?>

<div class="post-slider-wrapper" style="overflow: hidden">

    <div class="<?php echo esc_attr($slider_class); ?>">

        <?php
        foreach ($slides as $slide){
                    ?>
            <div class="post-alternate-3 item post">

                <div class="entry-media">

                    <?php if (!empty($slide['lm_link'])){ ?>
                        <a href="<?php echo esc_url($slide['lm_link']); ?>" class="image-post  item-overlay">
                    <?php } ?>
                            <img src="<?php echo esc_url(TMM_Helper::get_image($slide['imgurl'], $image_alias));?>" alt="">
                    <?php if (!empty($slide['lm_link'])){ ?>
                        </a>
                    <?php } ?>


                    <div class="entry-content">

                        <?php if (!empty($slide['title'])){ ?>

                            <header class="entry-header">

                                <h3 class="entry-title">
                                    <?php if ($slide['lm_link']){ ?>
                                        <a href="<?php echo esc_url($slide['lm_link']); ?>">
                                    <?php } ?>
                                        <?php echo esc_html($slide['title']); ?>
                                    <?php if ($slide['lm_link']){ ?>
                                        </a>
                                    <?php } ?>
                                </h3>

                            </header>

                        <?php } ?>

                        <?php
                        if (isset($slide['slide_content']) && !empty($slide['slide_content'])){

                            $content = TMM_Slider::remove_empty_tags($slide['slide_content']);

                            $content = do_shortcode(shortcode_unautop($content));
                            echo esc_html($content);
                        }
                        ?>

                        <footer class="entry-footer">

                            <?php if (isset($slide['post_date']) && $slide['date']!='none'){ ?>
                                <span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(mysql2date('d.m.Y', $slide['post_date']))); ?>"><?php echo esc_html(TMM_Slider::get_date_format($slide['date'], $slide['post_date'])); ?></a></span>
                            <?php } ?>

                            <?php if (isset($slide['author_link']) && $slide['author_link']){
                            $post = get_post($slide['post_id']);
                            $author_id  = $post->post_author;
                            $author_name = get_the_author_meta('display_name', $author_id);
                            ?>
                                <span class="byline"><a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>"><?php echo esc_html($author_name); ?></a></span>
                            <?php } ?>
                            <?php if (isset($slide['comments_link']) && $slide['comments_link']){ ?>
                                <span class="comments-link"><a href="<?php  echo esc_url(get_permalink($slide['post_id'])); ?>#comments"><?php echo esc_html(get_comments_number($slide['post_id'])); ?></a></span>
                            <?php } ?>

                        </footer>

                    </div>

                </div>

            </div><!--/ .post-alternate-3-->

        <?php
        }
    ?>
    </div><!--/ .post-slider-->

</div><!--/ .post-slider-wrapper-->

<script>

    (function($) {
        var postSlider = $('.post-slider'),
            sliderWrapper = $('.post-slider-wrapper');

        //postSlider.height(<?php // echo $slider_height ?>).css({'opacity':0});
        postSlider.css({'opacity':0});

        var spinner = jQuery('<div id="spinningSquaresG">' +
        '<div id="spinningSquaresG_1" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_2" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_3" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_4" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_5" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_6" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_7" class="spinningSquaresG"></div>' +
        '<div id="spinningSquaresG_8" class="spinningSquaresG"></div>' +
        '</div>');
        sliderWrapper.append(spinner);

        jQuery(window).on('load', function (e) {
            postSlider.css({'opacity':1});
            sliderWrapper.find('#spinningSquaresG').remove();
        });

        $(function() {

            if (postSlider.length) {
               postSlider.owlCarousel({
                   slideSpeed: <?php echo esc_js($data['slider_options']['speed']) ?>,
                   navigation: <?php echo ($data['slider_options']['pagination']=='1') ? 'true' : 'false'; ?>,
                   autoPlay : <?php echo ($data['slider_options']['autoplay']) ? esc_js($data['slider_options']['delay']) : 'false' ?>,
                   stopOnHover : true,
                   paginationSpeed: 400,
                   singleItem: true,
                   theme : "owl-theme",
                   transitionStyle : "fadeUp"
                });
            }

            var sliderItem = postSlider.find('.image-post.item-overlay');

            jQuery(window).on('load', function (e) {
                postSlider.height(sliderItem.height());
                sliderWrapper.height(sliderItem.height());
            });

        });
    })(jQuery);

</script>