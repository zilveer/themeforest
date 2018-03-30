<?php

class crazyblog_Ajax {

    function __construct() {
        add_action('wp_ajax__crazyblog_ajax_callback', array($this, 'ajax_handler'));
        add_action('wp_ajax_nopriv__crazyblog_ajax_callback', array($this, 'ajax_handler'));

        add_action("wp_ajax_nopriv_crazyblog_like", array(__CLASS__, 'crazyblog_like_system'));
        add_action("wp_ajax_crazyblog_like", array(__CLASS__, 'crazyblog_like_system'));

        add_action("wp_ajax_nopriv_crazyblog_dis_like", array(__CLASS__, 'crazyblog_dis_like_system'));
        add_action("wp_ajax_crazyblog_dis_like", array(__CLASS__, 'crazyblog_dis_like_system'));

        add_action("wp_ajax_nopriv_load_masonary_posts", array(__CLASS__, 'load_masonary_posts'));
        add_action("wp_ajax_load_masonary_posts", array(__CLASS__, 'load_masonary_posts'));

        add_action("wp_ajax_nopriv_load_post_list", array(__CLASS__, 'load_post_list'));
        add_action("wp_ajax_load_post_list", array(__CLASS__, 'load_post_list'));

        add_action("wp_ajax_nopriv_crazyblog_newsletter_module", array(__CLASS__, 'crazyblog_newsletter_module'));
        add_action("wp_ajax_crazyblog_newsletter_module", array(__CLASS__, 'crazyblog_newsletter_module'));

        add_action("wp_ajax_nopriv_crazyblog_ajax_load_more", array(__CLASS__, 'crazyblog_ajax_load_more'));
        add_action("wp_ajax_crazyblog_ajax_load_more", array(__CLASS__, 'crazyblog_ajax_load_more'));

        add_action("wp_ajax_nopriv_theme-install-demo-data", array(__CLASS__, 'crazyblog_demo_importer'));
        add_action("wp_ajax_theme-install-demo-data", array(__CLASS__, 'crazyblog_demo_importer'));
    }

    function ajax_handler() {
        $method = crazyblog_set($_REQUEST, 'subaction');
        if (method_exists($this, $method))
            $this->$method();
        exit;
    }

    static public function crazyblog_newsletter_module() {
        if (isset($_POST['action']) && $_POST['action'] == 'crazyblog_newsletter_module') {
            crazyblog_Newsletter::crazyblog_subscribepopup_submit($_POST);
            exit;
        }
    }

    static public function crazyblog_like_system() {
        if (isset($_POST['action']) && $_POST['action'] == 'crazyblog_like') {
            crazyblog_like_system_($_POST);
            exit;
        }
    }

    static public function crazyblog_dis_like_system() {
        if (isset($_POST['action']) && $_POST['action'] == 'crazyblog_dis_like') {
            crazyblog_dis_like_system_($_POST);
            exit;
        }
    }

    static public function load_masonary_posts() {
        if (isset($_POST['action']) && $_POST['action'] == 'load_masonary_posts') {
            $category = explode(',', $_POST['cat']);
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'offset' => $_POST['offset'],
                'orderby' => $_POST['orderby'],
                'order' => $_POST['order'],
                'posts_per_page' => 3,
            );

            if (!empty($category))
                $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category));

            $query = new WP_Query($args);

            $no_image = '';
            $year = get_the_time('Y');
            $month = get_the_time('m');
            $day = get_the_time('d');
            if ($_POST['increment'] == '1') {
                $sizes = array('crazyblog_343x410', 'crazyblog_376x350', 'crazyblog_343x410');
            } elseif ($_POST['increment'] == '2') {
                $sizes = array('crazyblog_343x410', 'crazyblog_376x350', 'crazyblog_376x350');
            }
            $walker = 0;
            if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
                    $cats = get_the_category(get_the_ID());
                    ?>
                    <div class="col-md-4 <?php
                    foreach ($cats as $c)
                        echo crazyblog_set($c, 'slug') . " ";
                    ?>">
                        <div class="grid-post" id="#post-<?php echo get_the_ID(); ?>">
                            <div class="grid-post-img">
                                <span><i class="fa fa-film"></i></span>
                                <?php the_post_thumbnail($sizes[$walker]); ?>
                                <a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link"></i></a>
                            </div>
                            <div class="cat">
                                <?php echo crazyblog_get_post_categories(get_the_ID(), ', '); ?>
                            </div>
                            <ul class="meta">
                                <li><a title="" href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>"><?php echo get_the_date(get_option('post_format')); ?></a></li>
                                <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>                            
                            </ul>
                            <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                        </div>
                    </div>
                    <?php
                    $walker++;
                endwhile;
                wp_reset_postdata();
            else : {
                    echo "true";
                }
            endif;
            exit;
        }
    }

    static public function load_post_list() {

        if (isset($_POST['action']) && $_POST['action'] == 'load_post_list') {
            $category = explode(',', $_POST['cat']);

            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => $_POST['orderby'],
                'order' => $_POST['order'],
                'offset' => $_POST['offset'],
                'posts_per_page' => 1,
            );

            if (!empty($category))
                $args['tax_query'] = array(array('taxonomy' => 'category', 'field' => 'slug', 'terms' => (array) $category));

            $query = new WP_Query($args);

            $no_image = '';
            $year = get_the_time('Y');
            $month = get_the_time('m');
            $day = get_the_time('d');
            $counter = 0;

            if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
                    if ($_POST['offset'] % 2 != 0) :
                        ?>
                        <div class="lookbook-post">
                            <div class="lookbook-detail">
                                <div class="lookbook-border">
                                    <span><i class="fa fa-image"></i></span>
                                    <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                                    <ul class="meta">
                                        <li><a title="" href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>"><?php echo get_the_date(get_option('post_format')); ?></a></li>
                                        <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                    </ul>
                                    <p><?php echo character_limiter(get_the_content(), $_POST['limit']); ?></p>
                                    <div class="post-info">
                                        <a class="btn" href="<?php the_permalink(); ?>" title=""><?php esc_html_e('CONTINUE READING', 'crazyblog'); ?></a>
                                        <span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text(get_comments_number(get_the_ID())) ?></span></span>
                                        <span>
                                            <i class="fa fa-share-alt"></i>
                                            <span class="share-link">
                                                <?php crazyblog_social_share_output(array('facebook', 'twitter', 'pinterest', 'dribbble')); ?>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="lookbook-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('crazyblog_608x446'); ?></a>
                            </div>
                        </div><!-- Lookbook Post -->
                    <?php else: ?>
                        <div class="lookbook-post reverse">
                            <div class="lookbook-image">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('crazyblog_608x446'); ?></a>
                            </div>
                            <div class="lookbook-detail">
                                <div class="lookbook-border">
                                    <span><i class="fa fa-image"></i></span>
                                    <h3><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                                    <ul class="meta">
                                        <li><a title="" href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>"><?php echo get_the_date(get_option('post_format')); ?></a></li>
                                        <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                    </ul>
                                    <p><?php echo character_limiter(get_the_content(), $_POST['limit']); ?></p>
                                    <div class="post-info">
                                        <a class="btn" href="<?php the_permalink(); ?>" title=""><?php esc_html_e('CONTINUE READING', 'crazyblog'); ?></a>
                                        <span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text(get_comments_number(get_the_ID())) ?></span></span>
                                        <span>
                                            <i class="fa fa-share-alt"></i>
                                            <span class="share-link">
                                                <?php crazyblog_social_share_output(array('facebook', 'twitter', 'pinterest', 'dribbble')); ?>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Lookbook Post -->
                    <?php endif; ?>
                    <?php
                    $counter++;
                endwhile;
                wp_reset_postdata();
            else : {
                    echo "true";
                }
            endif;
            exit;
        }
    }

    function crazyblog_contact_form_submit() {

        if (!count($_POST))
            return;

        $t = $GLOBALS['_sh_base']; //printr($t);
        $settings = crazyblog_opt();

        /** set validation rules for contact form */
        crazyblog_Validation::get_instance()->set_rules('contact_name', '<strong>' . esc_html__('Name', 'crazyblog') . '</strong>', 'required|min_length[4]|max_lenth[30]');

        crazyblog_Validation::get_instance()->set_rules('contact_email', '<strong>' . esc_html__('Email', 'crazyblog') . '</strong>', 'required|valid_email');

        crazyblog_Validation::get_instance()->set_rules('contact_phone', '<strong>' . esc_html__('Phone', 'crazyblog') . '</strong>', 'numeric');


        crazyblog_Validation::get_instance()->set_rules('contact_message', '<strong>' . esc_html__('Message', 'crazyblog') . '</strong>', 'required|min_length[5]');
        if (crazyblog_set($settings, 'contact_captcha_status')) {
            if (crazyblog_set($_POST, 'contact_captcha') !== crazyblog_set($_SESSION, 'captcha')) {
                crazyblog_Validation::get_instance()->_error_array['captcha'] = esc_html__('Invalid captcha entered, please try again.', 'crazyblog');
            }
        }

        $messages = '';

        if (crazyblog_Validation::get_instance()->run() !== FALSE && empty(crazyblog_Validation::get_instance()->_error_array)) {
            $name = crazyblog_Validation::get_instance()->post('content_name');
            $email = crazyblog_Validation::get_instance()->post('contact_email');

            $message = crazyblog_Validation::get_instance()->post('contact_message');

            $contact_to = ( crazyblog_set($settings, 'contact_email') ) ? crazyblog_set($settings, 'contact_email') : get_option('admin_email');

            $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n";
            wp_mail($contact_to, esc_html__('Contact Us Message', 'crazyblog'), $message, $headers);

            $message = crazyblog_set($settings, 'success_message') ? $settings['success_message'] : sprintf(esc_html__('Thank you <strong>%s</strong> for using our Contact form! Your email was successfully sent and we will be in touch with you soon.', 'crazyblog'), $name);

            //$messages = '<div class="alert alert-success">'.esc_html__('SUCCESS! ', 'crazyblog').$message.'</div>';
            echo "<fieldset>";
            echo "<div id='success_page'>";
            echo "<h1>Email Sent Successfully.</h1>";
            echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us.</p>";
            echo "</div>";
            echo "</fieldset>";
            exit;
        } else {

            if (is_array(crazyblog_Validation::get_instance()->_error_array)) {

                foreach (crazyblog_Validation::get_instance()->_error_array as $msg) {
                    $messages .= '<div class="alert alert-error">' . esc_html__('Error! ', 'crazyblog') . $msg . '</div>';
                }
            }
        }

        echo wp_kses($messages, true);
        exit;
    }

    function crazyblog_form_builder() {
        if (!count($_POST))
            return;
        echo crazyblog_Forms::get_instance()->post();
    }

    function crazyblog_dummy_data() {

        if (isset($_POST['subaction']) && $_POST['subaction'] == 'crazyblog_dummy_data') {
            crazyblog_Xml_importer::get_instance()->crazyblog_demo_importer($_POST);
            //crazyblog_Xml_importer::get_instance()->crazyblog_remove_backup(ABSPATH . 'wp-content/themes/backup/backup/');
            //rmdir(ABSPATH . 'wp-content/themes/backup');
            exit;
        }
    }

    static public function crazyblog_ajax_load_more() {
        if (isset($_POST['action']) && crazyblog_set($_POST, 'action') == 'crazyblog_ajax_load_more') {
            $offset = (crazyblog_set($_POST, 'offset') ) ? intval(crazyblog_set($_POST, 'offset')) : 0;
            $posts_per_page = crazyblog_set($_POST, 'posts_per_page');
            $post_type = (crazyblog_set($_POST, 'post_type') ) ? crazyblog_set($_POST, 'post_type') : 'post';
            $orderby = (crazyblog_set($_POST, 'orderby') ) ? crazyblog_set($_POST, 'orderby') : 'date';
            $order = (crazyblog_set($_POST, 'order') ) ? crazyblog_set($_POST, 'order') : 'post';
            $cats = (crazyblog_set($_POST, 'cats') ) ? crazyblog_set($_POST, 'cats') : '';

            ob_start(); // buffer output instead of echoing it
            $args = array(
                'post_type' => $post_type,
                'offset' => $offset,
                'posts_per_page' => $posts_per_page,
                'orderby' => $orderby,
                'order' => $order
            );
            if (!empty($cats)) {
                $args['category_name'] = $cats;
            }
            $posts_query = new WP_Query($args);


            if ($posts_query->have_posts()) {
                $result['have_posts'] = true;
                $counterM = 0;
                $reminder = crazyblog_set($_POST, 'offset') % 6;
                $imag = array('crazyblog_470x540', 'crazyblog_462x343', 'crazyblog_470x540', 'crazyblog_470x540', 'crazyblog_462x343', 'crazyblog_462x343');
                if ($reminder != 0) {
                    $counterM = $reminder;
                }
                $counter = 0;
                while ($posts_query->have_posts()) {
                    $posts_query->the_post();
                    $format = get_post_format();
                    $post_meta = get_post_meta(get_the_ID(), 'crazyblog_post_meta', true);
                    $meta = crazyblog_set(crazyblog_set($post_meta, 'crazyblog_post_format_options'), '0');
                    $view = (get_post_meta(get_the_ID(), 'crazyblog_post_views', true)) ? get_post_meta(get_the_ID(), 'crazyblog_post_views', true) : '0';
                    $style = ($counter == 0 || $counter % 3 === 0) ? '' : 'style2';
                    if (crazyblog_set($_POST, 'type') == 'weekly_posts') {
                        ?>
                        <div class="col-md-6">
                            <div class="weekly-post">
                                <div class="weekly-post-thumb">
                                    <?php if ($format == 'video'): ?>
                                        <a class="image-link" href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail('crazyblog_454x344') ?></a>
                                        <?php
                                        if (crazyblog_set($meta, 'crazyblog_post_video_link') != ''):
                                            crazyblog_View::get_instance()->crazyblog_enqueue_scripts(array('df-poptrox'));
                                            ?>
                                            <span class="lightbox">
                                                <a href="<?php echo crazyblog_set($meta, 'crazyblog_post_video_link') ?>" title="" class="cat-btn">
                                                    <?php esc_html_e('Video ', 'crazyblog') ?><i class="fa fa-play"></i>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a class="image-link" href="<?php the_permalink() ?>" title=""><?php the_post_thumbnail('crazyblog_454x344') ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="weekly-post-detail">
                                    <ul class="meta">
                                        <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                        <li><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) ?><?php esc_html_e(' AGO', 'crazyblog') ?></li>
                                    </ul>
                                    <h2><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
                                    <p><?php echo wp_trim_words(get_the_content(), $num_words = 22, $more = null); ?></p>
                                    <div class="post-info">
                                        <span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text(get_comments_number(get_the_ID())) ?></span></span>
                                        <span class="view"><i class="fa fa-eye"></i><span><?php echo crazyblog_restyle_text($view) ?></span></span>
                                        <span>
                                            <i class="fa fa-share-alt"></i>
                                            <span class="share-link">
                                                <?php crazyblog_social_share_output(array('facebook', 'twitter', 'pinterest', 'google-plus')); ?>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $light_box = 'jQuery(document).ready(function ($) {
                                                            $("span.lightbox").poptrox({
                                                                    usePopupCaption: false,
                                                                    usePopupNav: false,
                                                            });
							});';
                        ?>
                        <?php wp_add_inline_script('crazyblog_df-poptrox', $light_box); ?>
                        <?php
                    }else if (crazyblog_set($_POST, 'type') == 'fashion_posts') {
                        ?>
                        <div class="col-md-4">
                            <div class="fashion-post">
                                <a class="image-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                    <?php the_post_thumbnail('crazyblog_470x540') ?>
                                </a>
                                <div class="fashion-detail">
                                    <ul class="meta">
                                        <li><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) ?><?php esc_html_e(' AGO', 'crazyblog') ?></li>
                                        <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                    </ul>
                                    <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
                                    <div class="post-info">
                                        <span class="view"><i class="fa fa-comments"></i><span><?php echo crazyblog_restyle_text(get_comments_number(get_the_ID())) ?></span></span>
                                        <span class="view"><i class="fa fa-eye"></i><span><?php echo crazyblog_restyle_text($view) ?></span></span>
                                        <span>
                                            <i class="fa fa-share-alt"></i>
                                            <span class="share-link">
                                                <?php crazyblog_social_share_output(array('facebook', 'twitter', 'pinterest', 'google-plus')); ?>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- Fashion Post -->
                        </div>
                        <?php
                    } else if (crazyblog_set($_POST, 'type') == 'creative_grid_posts') {
                        ?>
                        <div class="col-md-4">
                            <div class="creative-post">
                                <div class="creative-img">
                                    <?php the_post_thumbnail('crazyblog_462x343') ?>
                                </div>
                                <div class="creative-post-name">
                                    <h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
                                    <ul class="meta">
                                        <li><i class="fa fa-heart"></i> <?php echo crazyblog_post_counter(get_the_ID()) ?></li>
                                        <li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text($view) ?></li>
                                    </ul>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e('Read More', 'crazyblog') ?></a>
                                </div>
                            </div><!-- Creative Post -->
                        </div>
                        <?php
                    } else if (crazyblog_set($_POST, 'type') == 'magzine_list') {
                        ?>
                        <div class="magazine-post">
                            <div class="mag-post-img">
                                <a class="image-link" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                    <?php the_post_thumbnail('crazyblog_454x344') ?>
                                </a>
                            </div>
                            <div class="mag-post-detail">
                                <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
                                <span><?php echo get_the_date(get_option('post_format')); ?></span>
                                <p><?php echo wp_trim_words(get_the_content(), 20, null) ?></p>
                                <a class="continue" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e('Read More', 'crazyblog') ?></a>
                                <ul class="meta">
                                    <li><i class="fa fa-heart"></i> <?php echo crazyblog_post_counter(get_the_ID()) ?></li>
                                    <li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text($view) ?></li>
                                </ul>
                            </div>
                        </div>
                        <?php
                    } else if (crazyblog_set($_POST, 'type') == 'creative_grid_posts_masonry') {
                        ?>
                        <div class="col-md-4" data-ch="<?php echo esc_attr($counterM) ?>">
                            <div class="creative-post">
                                <div class="creative-img">
                                    <?php the_post_thumbnail(crazyblog_set($imag, $counterM)) ?>
                                </div>
                                <div class="creative-post-name">
                                    <h4><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h4>
                                    <ul class="meta">
                                        <li><i class="fa fa-heart"></i> <?php echo crazyblog_post_counter(get_the_ID()) ?></li>
                                        <li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text($view) ?></li>
                                    </ul>
                                    <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php esc_html_e('Read More', 'crazyblog') ?></a>
                                </div>
                            </div><!-- Creative Post -->
                        </div>
                        <?php
                        $counterM++;
                        if ($counterM == 6) {
                            $counterM = 0;
                        }
                    } else if (crazyblog_set($_POST, 'type') == 'modern_blog_listing') {
                        ?>
                        <div class="travel-post <?php echo esc_attr($style) ?>">
                            <a class="image-link" href="#" title="">
                                <?php the_post_thumbnail('medium') ?>
                            </a>
                            <div class="travel-post-details">
                                <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
                                <ul class="meta">
                                    <li><a title="" href="#">March 17, 2016 </a></li>
                                    <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                    <li><a href="javascript:void(0)" title=""><i class="fa fa-heart"></i><?php echo crazyblog_post_counter(get_the_ID()) ?></a></li>
                                    <li><a href="javascript:void(0)" title=""><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text($view) ?></a></li>
                                </ul>									
                                <p><?php echo wp_trim_words(get_the_content(), $num_words = 22, $more = null); ?></p>
                                <a class="readmore" href="<?php the_permalink() ?>" title=""><?php esc_html_e('READ MORE', 'crazyblog') ?></a>
                            </div>
                        </div>
                        <?php
                        $counterM++;
                        if ($counterM == 6) {
                            $counterM = 0;
                        }
                    } else if (crazyblog_set($_POST, 'type') == 'simple_recipe_grid') {
                        ?>
                        <div class="col-md-4">
                            <div class="post-style2">
                                <div class="post-thumb2">
                                    <?php the_post_thumbnail('medium') ?>
                                    <div class="post2-info">
                                        <a href="javascript:void(0)" title=""><i class="fa fa-link"></i></a>
                                        <div class="share">
                                            <ul class="social-btns">
                                                <?php crazyblog_social_share_output(array('facebook', 'twitter', 'pinterest', 'google-plus'), false, false, true); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-detail2">
                                    <ul class="meta">
                                        <li><a href="<?php echo esc_url(get_day_link($year, $month, $day)); ?>" title=""><?php echo get_the_date(get_option('post_format')); ?></a></li>
                                        <li><?php esc_html_e('By ', 'crazyblog'); ?><a title="" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></li>
                                    </ul>
                                    <h2><a class="call-popup detail-popup" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
                                    <ul class="likeshare">
                                        <li><i class="fa fa-heart-o"></i> <?php echo crazyblog_post_counter(get_the_ID()) ?></li>
                                        <li><i class="fa fa-eye"></i> <?php echo crazyblog_restyle_text($view) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    $counter++;
                }
                wp_reset_postdata();
                if (crazyblog_set($_POST, 'type') == 'creative_grid_posts_masonry') {
                    $result['masonry'] = true;
                }
                $result['html'] = ob_get_clean();
            } else {
                $result['have_posts'] = false;
            }
            echo json_encode($result);
            exit;
        }
    }

    static public function crazyblog_demo_importer() {
        if (isset($_POST['action']) && $_POST['action'] == 'theme-install-demo-data') {
            if (crazyblog_set($_POST, 'data') != 'undefined') {
                $demo = crazyblog_set($_POST, 'data');
            } else {
                $demo = 'single';
            }

            if (file_exists(crazyblog_ROOT . "core/application/library/backup/xml/" . $demo . ".xml")) {
                define('WP_LOAD_IMPORTERS', true);
                if (!class_exists('WP_Import')) {
                    if (function_exists('crazyblog_wp_importer')) {
                        crazyblog_wp_importer();
                    }
                }
                $content_xml = crazyblog_ROOT . "core/application/library/backup/xml/" . $demo . ".xml";
                if (!is_file($content_xml)) {
                    printr('wrong file');
                } else {
                    $importer = new WP_Import();
                    $importer->fetch_attachments = true;
                    $importer->import($content_xml);
                    include_once crazyblog_ROOT . 'core/application/library/import_export.php';
                    $importer = new crazyblog_import_export();
                    $importer->import();
                }
            }
            die();
        }
    }

}
