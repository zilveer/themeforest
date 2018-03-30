<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class("entry clearfix"); ?>>

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

                    <div class="title-content">

                        <h4>
                            <a href="<?php the_permalink() ?>">
                                <?php the_title() ?>
                            </a>
                        </h4>

                    </div>

                    <?php if (TMM::get_option("blog_listing_show_all_metadata") !== '0') : ?>
                        <ul class="entry-meta">
                            <?php if (TMM::get_option("blog_listing_show_date") !== '0') : ?>
                                <li>
	                                <b><?php _e('Date', 'cardealer'); ?>:</b>
	                                <?php if($post->post_type === 'post') { ?>
	                                <a href="<?php echo get_month_link( get_the_date('Y'), get_the_date('m') ) ?>">
	                                <?php } ?>
		                                <?php echo get_the_date() ?>
	                                <?php if($post->post_type === 'post') { ?>
	                                </a>
	                                <?php } ?>
                                </li>
                            <?php endif; ?>
                            <?php if (TMM::get_option("blog_listing_show_author") !== '0') : ?>
                                <li><b><?php _e('Author', 'cardealer'); ?>:</b>&nbsp;<?php the_author() ?></li>
                            <?php endif; ?>
                            <?php if (TMM::get_option("blog_listing_show_tags") !== '0') : ?>
                                <li class="tags"><?php the_tags(__('<b>Tags</b>', 'cardealer') . ': ', '', '') ?></li>
                            <?php endif; ?>
                            <?php if (TMM::get_option("blog_listing_show_category") !== '0') : ?>
                                <?php $categories_list = get_the_category_list(' '); ?>
                                <?php if (!empty($categories_list)) : ?>
                                    <li class="tags"><b><?php _e('Categories', 'cardealer'); ?>:</b>&nbsp;<?php echo $categories_list ?></li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>

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

                </div><!--/ .entry-body-->

                <div class="clear"></div>

            </div>

        </div>
        <footer class="meta clearfix">
            <?php if (TMM::get_option("blog_single_show_comments") !== '0') : ?>
                <a class="icon-comments"
                   href="<?php the_permalink() ?>#comments"><?php echo get_comments_number(); ?> <?php _e('comments', 'cardealer'); ?></a>
            <?php endif; ?>
            <a class="button orange" href="<?php the_permalink() ?>"><?php _e('Details', 'cardealer'); ?></a>
        </footer>

	</article>

<?php
endwhile;
else:
	get_template_part('content', 'nothingfound');
endif;
?>	



