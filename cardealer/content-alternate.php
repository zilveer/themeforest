<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class("entry clearfix secondary"); ?>>
            
            <div class="row">

                <div class="col-md-3">

	                <?php
                    $post_types = array(
	                    'audio',
	                    'video',
	                    'quote',
	                    'gallery',
                    );

                    $post_pod_type = get_post_meta($post->ID, 'post_pod_type', true);
                    $post_type_values = get_post_meta($post->ID, 'post_type_values', true);

                    if (!in_array($post_pod_type, $post_types)) {
	                    $post_pod_type = 'default';
                    }

                    get_template_part('article', $post_pod_type);
                    ?>

                </div>

                <div class="col-md-9">

                    <div class="entry-body">

                        <?php if (TMM::get_option("blog_listing_show_date") !== '0') : ?>
                            <span class="date"><b><?php _e('Date', 'cardealer'); ?>:</b>&nbsp;<a href="<?php echo home_url() ?>/<?php echo get_the_date('Y') ?>/<?php echo get_the_date('m') ?>"><?php echo get_the_date() ?></a></span>
                        <?php endif; ?>

                        <h4>
                            <a href="<?php the_permalink() ?>">
                                <?php the_title() ?>
                            </a>
                        </h4>

                        <p>
                            <?php
                            if( strpos( $post->post_content, '<!--more-->' ) ){
                                the_content();
                            }else{
                                if (TMM::get_option("excerpt_symbols_count")!=='0') {
                                    $symbols_count = (TMM::get_option("excerpt_symbols_count")!=='0' && (TMM::get_option("excerpt_symbols_count"))) ? (int) TMM::get_option("excerpt_symbols_count") : 220;

                                    if (empty($post->post_excerpt)) {
                                       $txt = do_shortcode($post->post_content);
                                       $txt = strip_tags($txt);
                                       echo do_shortcode(mb_substr($txt, 0, $symbols_count) . " ...");
                                    } else {
                                        echo do_shortcode(mb_substr($post->post_excerpt, 0, $symbols_count) . " ...");
                                    }
                                }
                            }
                            ?>
                            
                            <a class="details" href="<?php the_permalink() ?>"><?php _e('Details', 'cardealer'); ?></a>
                        </p>

                    </div><!--/ .entry-body-->

                </div>

            </div>

        </article>

        <?php
    endwhile;
else:
    get_template_part('content', 'nothingfound');
endif;
?>



