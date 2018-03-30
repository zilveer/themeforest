<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>

<!-- - - - - - - - - - - - Entry - - - - - - - - - - - - - - -->

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class("entry clearfix single"); ?>>

	        <?php get_template_part('content', 'header'); ?>

            <?php if (TMM::get_option("blog_single_show_all_metadata") !== '0') : ?>
                <ul class="entry-meta">
                    <?php if (TMM::get_option("blog_single_show_date") !== '0') : ?>
                        <li><b><?php _e('Date', 'cardealer'); ?>:</b>&nbsp;<a href="<?php echo home_url() ?>/<?php echo get_the_date('Y') ?>/<?php echo get_the_date('m') ?>"><?php echo get_the_date() ?></a></li>
                    <?php endif; ?>
                    <?php if (TMM::get_option("blog_single_show_author") !== '0') : ?>
                        <li><b><?php _e('Author', 'cardealer'); ?>:</b>&nbsp;<?php the_author() ?></li>
                    <?php endif; ?>
                    <?php if (TMM::get_option("blog_single_show_tags") !== '0') : ?>
                        <li class="tags"><?php the_tags(__('<b>Tags</b>', 'cardealer') . ': ', '', '') ?></li>
                    <?php endif; ?>
                    <?php if (TMM::get_option("blog_single_show_category") !== '0') : ?>
                        <?php $categories_list = get_the_category_list(' '); ?>
                        <?php if (!empty($categories_list)) : ?>
                            <li class="tags"><b><?php _e('Categories', 'cardealer'); ?>:</b>&nbsp;<?php echo $categories_list ?></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>

            <div class="entry-body">

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

				the_content();
                tmm_link_pages();
	            tmm_layout_content(get_the_ID());
				?>

            </div><!--/ .entry-body -->

        </article>

        <?php if (TMM::get_option("blog_single_show_author") !== '0'): ?>
            <div class="bio clearfix">

                <h3 class="section-title"><?php _e('About the Author', 'cardealer'); ?></h3>
                <?php $user = get_userdata($post->post_author); ?>
                <?php if (is_object($user)): ?>
                    <?php echo get_avatar($user->ID, 54, TMM_THEME_URI . '/images/avatar.png'); ?>
                    <div class="bio-info clearfix"><p><?php echo stripslashes($user->description); ?></p></div><!--/ bio-info-->
                <?php endif; ?>
            </div><!--/ .bio-->
        <?php endif; ?>

		<?php
		$social_shares = class_exists('TMM_AddThis_Controller') ? do_shortcode('[tmm_addthis]') : '';

        if ( !empty($social_shares) ) {
             ?>
            
            <div class="social-share-block">

                <h3 class="section-title"><?php _e('Social Shares', 'cardealer'); ?>:</h3>

                <?php echo $social_shares; ?>

            </div><!--/ .social-share-block-->

            <?php
        }
        ?>


        <?php if (TMM::get_option("blog_single_show_related_posts")): ?>
            <div class="related clearfix">

                <h3 class="section-title"><?php _e('Related Posts', 'cardealer') ?></h3>

                <?php
                $tags = wp_get_post_tags($post->ID);
                $tag_ids = array();

                if ($tags) {
                    foreach ($tags as $tag_item)
                        $tag_ids[] = $tag_item->term_id;
                }

                $query = new WP_Query(array(
                    'tag__in' => $tag_ids,
                    'post_type' => 'post',
                    'post__not_in' => array($post->ID),
                    'showposts' => 3
                        )
                );
                ?>

                <ul>
                    <?php
                    $i = 0;
                    if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
                            ?>
                            <li class="<?php if ($i == 3) echo 'last'; ?>">
                                <a class="single-image" href="<?php the_permalink(); ?>"><img alt="" src="<?php echo TMM_Helper::get_post_featured_image($post->ID, '220*134'); ?>"></a>
                                <a href="<?php the_permalink(); ?>"><h6><?php the_title(); ?></h6></a>
                            </li>
                            <?php
                            $i++;
                        endwhile;
                    endif;
                    ?>
                </ul>

                <?php wp_reset_postdata(); ?>

            </div><!--/ .related-->

        <?php endif; ?>


        <?php
        if (TMM::get_option("blog_single_show_comments") !== '0') {
            comments_template();
        }
        ?>

        <?php if (TMM::get_option("blog_single_show_fb_comments")) : ?>  

            <h3 class="section-title"><?php _e('Facebook Comments', 'cardealer') ?></h3>
            <div class="fb-comments" data-href="<?php the_permalink() ?>" data-width=""></div>

        <?php endif; ?>

        <?php
    endwhile;
endif;
?>

<?php get_footer(); ?>

