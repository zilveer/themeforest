<?php
cs_slider_gallery_template_redirect();

global $post, $cs_node, $cs_theme_option, $cs_counter_node, $cs_video_width;
$cs_node = new stdClass();
get_header();
$cs_layout = '';
$cause_status = '';
$cause_end_date = '';

if (have_posts()):

    while (have_posts()) : the_post();

        $cs_xmlObject_transaction = new stdclass();

        $cs_menu = get_post_meta($post->ID, "cs_cause_meta", true);
        $cause_end_date = get_post_meta($post->ID, "cause_end_date", true);

        $percentage_amount = 0;

        $payment_gross = 0;

        if ($cs_menu <> "") {

            $cs_xmlObject = new SimpleXMLElement($cs_menu);

            $cs_layout = $cs_xmlObject->sidebar_layout->cs_layout;

            $cs_sidebar_left = $cs_xmlObject->sidebar_layout->cs_sidebar_left;

            $cs_sidebar_right = $cs_xmlObject->sidebar_layout->cs_sidebar_right;

            if ($cs_layout == "left") {

                $cs_layout = "content-right col-md-9";
            } else if ($cs_layout == "right") {

                $cs_layout = "content-left col-md-9";
            } else {

                $cs_layout = "col-md-12";
            }

            $sub_title = $cs_xmlObject->sub_title;

            $cause_social_share = $cs_xmlObject->cause_social_share;

            $cause_goal_amount = $cs_xmlObject->cause_goal_amount;

            $payment_gross_total = 0;

            $cause_related = $cs_xmlObject->cause_related;

            $cause_related_post_title = $cs_xmlObject->cause_related_post_title;



            $cause_raised_amount = $payment_gross_total;
        } else {

            $sub_title = '';

            $cause_social_share = '';

            $cause_related = '';

            $cause_related_post_title = '';

            $cause_goal_amount = '0';

            $cause_raised_amount = '0';

            $cs_layout = "col-md-12";
        }

        $cs_cause = get_post_meta($post->ID, "cs_cause_transaction_meta", true);

        if ($cs_cause <> "") {

            $cs_xmlObject_transaction = new SimpleXMLElement($cs_cause);

            $payment_gross = get_post_meta($post->ID, 'cs_cause_raised_amount', true);

            $payment_gross = 0;

            $percentage_amount = 0;

            if (count($cs_xmlObject_transaction->transaction) > 0) {

                foreach ($cs_xmlObject_transaction->transaction as $transct) {

                    $payment_gross = $payment_gross + $transct->payment_gross;
                }
            }
            $percentage_amount = '200';
            if ($payment_gross <> '0' && $cs_xmlObject->cause_goal_amount <> '0') {

                $percentage_amount = (($payment_gross / $cs_xmlObject->cause_goal_amount) * 100);

                if ($percentage_amount > 100 || $percentage_amount == '100') {

                    $percentage_amount = 100;
                    if ($cs_theme_option['trans_switcher'] == "on") {
                        $cause_status = __('Closed', 'AidReform');
                    } else {
                        $cause_status = $cs_theme_option['cause_status'];
                    }
                }
            }
            if (strtotime($cause_end_date) < strtotime(date('m/d/Y'))) {
                if (isset($cs_theme_option["trans_switcher"])) {
                    if ($cs_theme_option['trans_switcher'] == "on") {
                        $cause_status = __('Closed', 'AidReform');
                    }
                } else {
                    if (isset($cs_theme_option["cause_status"])) {
                        $cause_status = $cs_theme_option['cause_status'];
                    }
                }
            }
        } else {

            $percentage_amount = 0;

            $payment_gross = 0;
        }
        ?>

        <!-- Columns Start -->

        <div class="clear"></div>

        <!-- Content Section Start -->

        <div id="main" role="main">

            <!-- Container Start -->

            <div class="container">

                <!-- Row Start -->

                <div class="row">

                    <!--Left Sidebar Starts-->

                    <?php if ($cs_layout == 'content-right col-md-9') { ?>

                        <aside class="sidebar-left col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_left)) : ?><?php endif; ?></aside>

                    <?php } ?>

                    <!--Left Sidebar End-->

                    <!-- Blog Detail Start -->

                    <div class="<?php echo $cs_layout; ?>">




                        <div class="cause-detail fullwidth">



                            <?php
                            if ($cs_xmlObject->cause_gallery <> '') {
                                cs_gallery_slider($cs_xmlObject->cause_gallery);
                            }
                            ?>

                            <div class="text-sec">

                                <div class="progress-desc fullwidth">

                                    <span class="progress-box raised-amount"> <strong><?php
                                            if (isset($cs_theme_option['paypal_currency_sign'])) {
                                                echo $cs_theme_option['paypal_currency_sign'];
                                            }
                                            ?><?php echo number_format($payment_gross); ?></strong>

                                        <?php
                                        if (isset($cs_theme_option['trans_switcher'])) {
                                            if ($cs_theme_option['trans_switcher'] == "on") {
                                                _e('Raised', 'AidReform');
                                            }
                                        } else {
                                            if (isset($cs_theme_option['cause_raised'])) {
                                                echo $cs_theme_option['cause_raised'];
                                            }
                                        }
                                        ?>

                                    </span>

                                    <span class="progress-box donors-amount"> <strong><?php echo count($cs_xmlObject_transaction->transaction); ?></strong>

                                        <?php
                                        if (isset($cs_theme_option['trans_switcher'])) {
                                            if ($cs_theme_option['trans_switcher'] == "on") {
                                                _e('Donors', 'AidReform');
                                            }
                                        } else {
                                            if (isset($cs_theme_option['cause_donors'])) {
                                                echo $cs_theme_option['cause_donors'];
                                            }
                                        }
                                        ?>

                                    </span>

                                    <span class="progress-box goal-amount">

                                        <strong><?php
                                            if (isset($cs_theme_option['paypal_currency_sign'])) {
                                                echo $cs_theme_option['paypal_currency_sign'];
                                            }
                                            ?><?php echo number_format((float) $cs_xmlObject->cause_goal_amount); ?></strong>

                                        <?php
                                        if (isset($cs_theme_option['trans_switcher'])) {
                                            if ($cs_theme_option['trans_switcher'] == "on") {
                                                $trans_featured = _e('Goal', 'AidReform');
                                            }
                                        } else {
                                            if (isset($cs_theme_option['cause_goal'])) {
                                                echo $cs_theme_option['cause_goal'];
                                            }
                                        }
                                        ?>

                                    </span>

                                </div>

                                <div class="right-desc">

                                    <div class="progress-bar-box">
                                        <div class="progress-bar-charity" data-loadbar="<?php echo round($percentage_amount); ?>" data-loadbar-text="<?php echo round($percentage_amount); ?>%">
                                            <?php //echo $percentage_amount;  ?>
                                            <?php
                                            if (count($cs_xmlObject_transaction->transaction) == '0' || ($payment_gross == '0')) {
                                                echo'<div class="bgcolr" style="padding: 0px 0px 0px 0%;">
											<span></span>
											 </div>';
                                            } else {
                                                ?>		
                                                <div class="bgcolr" style="padding: 0px 0px 0px <?php echo round($percentage_amount); ?>%;">
                                                    <span></span>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <time><?php
                                            if (isset($cs_theme_option['trans_switcher'])) {
                                                if ($cs_theme_option['trans_switcher'] == "on") {
                                                    $trans_featured = _e('End Date', 'AidReform');
                                                }
                                            } else {
                                                if (isset($cs_theme_option['cause_end_date'])) {
                                                    echo $cs_theme_option['cause_end_date'];
                                                }
                                            }
                                            ?>, <?php echo date('F d, Y', strtotime($cs_xmlObject->cause_end_date)); ?></time>

                                    </div>
                                    <?php
                                    if (isset($cause_status) && $cause_status <> '') {
                                        echo '<span class="btn theme-default bgcolr btndonate"><em class="fa fa-heart-o"></em>' . $cause_status . ' </span>';
                                    } else {
                                        if (isset($cs_xmlObject->cause_paypal_email) && $cs_xmlObject->cause_paypal_email <> '') {
                                            cs_donate_button($cs_xmlObject->cause_paypal_email);
                                        } else {
                                            cs_donate_button();
                                        }
                                    }
                                    ?>

                                </div>

                            </div> 

                            <div class="detail_text rich_editor_text fullwidth">

                                <?php
                                the_content();

                                wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'AidReform') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>'));

                                if ($cs_cause <> "") {
                                    if (isset($cs_xmlObject->cs_donations_show) && $cs_xmlObject->cs_donations_show == 'on') {
                                        if (count($cs_xmlObject_transaction->transaction) > 0) {
                                            ?>

                                            <div class="donar-table">

                                                <h2 class="cs-section-title"><?php
                                                    if ($cs_theme_option['trans_switcher'] == "on") {
                                                        $trans_featured = _e('Donors', 'AidReform');
                                                    } else {
                                                        echo $cs_theme_option['cause_donors'];
                                                    }
                                                    ?></h2>

                                                <ul>

                                                    <?php
                                                    $cause_cout = 1;

                                                    foreach ($cs_xmlObject_transaction->transaction as $transct) {
                                                        ?>

                                                        <li><span class="counter"><?php echo $cause_cout; ?></span><a><?php echo $transct->address_name; ?></a><p><span><?php echo $transct->payment_gross; ?> <?php echo $cs_theme_option['paypal_currency']; ?></span><a><?php
                                                                    if ($cs_theme_option['trans_switcher'] == "on") {
                                                                        _e('Donation', 'AidReform');
                                                                    } else {
                                                                        echo $cs_theme_option['cause_donation'];
                                                                    }
                                                                    ?></a></p></li>

                                                        <?php
                                                        $cause_cout++;
                                                    }
                                                    ?>

                                                </ul>

                                            </div>

                                            <?php
                                        }
                                    }
                                }
                                ?>

                            </div>

                            <div class="share-post fullwidth">

                                <?php
                                $before_cat = '<div class="float-left"><em class="fa fa-list"></em> ';

                                $categories_list = get_the_term_list(get_the_id(), 'cs_cause-category', $before_cat, ', ', '</div>');

                                if ($categories_list) {
                                    printf(__('%1$s', 'AidReform'), $categories_list);
                                }
                                ?>

                                <?php
                                $before_cat = '<div class="float-right"><em class="fa fa-tags"></em> ';

                                $categories_list = get_the_term_list(get_the_id(), 'cs_cause-tag', $before_cat, ', ', '</div>');

                                if ($categories_list) {
                                    printf(__('%1$s', 'AidReform'), $categories_list);
                                }
                                ?>

                            </div>

                            <div class="share-post fullwidth">

                                <?php
                                if ($cause_social_share == "on") {

                                    cs_social_share();
                                }

                                cs_next_prev_custom_links('cs_cause');
                                ?>

                            </div>

                            <!-- Post Sharing Section End -->

                            <?php
                            if ($cs_xmlObject->cause_related == 'on') {

                                wp_reset_query();

                                if ($cs_xmlObject->cause_related_post_title <> '') {
                                    ?>

                                    <header class="cs-heading-title"><h2 class="cs-section-title float-left"><?php echo $cs_xmlObject->cause_related_post_title; ?> </h2></header>

                                <?php } ?>

                                <div class="our_causes fullwidth">

                                    <?php
                                    $custom_taxterms = '';

                                    $custom_taxterms = wp_get_object_terms($post->ID, array('cs_cause-category', 'cs_cause-tag'), array('fields' => 'ids'));

                                    // arguments

                                    $args = array(
                                        'post_type' => 'cs_cause',
                                        'post_status' => 'publish',
                                        'posts_per_page' => 8, // you may edit this number
                                        'orderby' => 'DESC',
                                        'tax_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'taxonomy' => 'cs_cause-tag',
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            ),
                                            array(
                                                'taxonomy' => 'cs_cause-category',
                                                'field' => 'id',
                                                'terms' => $custom_taxterms
                                            )
                                        ),
                                        'post__not_in' => array($post->ID),
                                    );

                                    $custom_query = new WP_Query($args);

                                    if ($custom_query->have_posts()):

                                        while ($custom_query->have_posts()): $custom_query->the_post();

                                            $post_xml = get_post_meta($post->ID, "cs_cause_meta", true);

                                            if ($post_xml <> '') {

                                                $cs_xmlObject = new SimpleXMLElement($post_xml);
                                            }

                                            $cs_tr = get_post_meta($post->ID, "cs_cause_transaction_meta", true);

                                            if ($cs_tr <> '') {

                                                $cs_xmlObject_transaction = new SimpleXMLElement($cs_tr);
                                            }

                                            $image_url = cs_attachment_image_src(get_post_thumbnail_id($post->ID), '262', '262');

                                            $no_image = '';

                                            if ($image_url == "") {

                                                $no_image = 'no-img';
                                            }

                                            $payment_gross = 0;

                                            $percentage_amount = 0;

                                            if (count($cs_xmlObject_transaction->transaction) > 0) {

                                                foreach ($cs_xmlObject_transaction->transaction as $transct) {

                                                    $payment_gross = $payment_gross + $transct->payment_gross;
                                                }

                                                if ($payment_gross <> '0' && $cs_xmlObject->cause_goal_amount <> '0') {
                                                    $percentage_amount = (($payment_gross / $cs_xmlObject->cause_goal_amount) * 100);
                                                    if ($percentage_amount > 100) {
                                                        $percentage_amount = 100;
                                                    }
                                                }
                                            }
                                            ?>

                                            <!-- Element Size Start -->

                                            <article <?php post_class($no_image); ?>>

                                                <figure>

                                                    <?php if ($image_url <> "") { ?><img src="<?php echo $image_url; ?>" alt=""><?php } ?>

                                                    <figcaption>

                                                        <div class="text">

                                                            <h2 class="cs-post-title">

                                                                <a href="<?php the_permalink(); ?>" class="colrhvr"><?php
                                                                    echo substr(get_the_title(), 0, 24);
                                                                    if (strlen(get_the_title()) > 24)
                                                                        echo '...';
                                                                    ?></a>

                                                            </h2>

                                                            <!--<div class="progress-bar-charity" data-loadbar="< ?php echo round($percentage_amount);?>" data-loadbar-text="< ?php echo round($percentage_amount);?>%">
                                                                                                            < ?php //echo $percentage_amount; ?>											
                                                                <div class="bgcolr" style="padding: 0px 0px 0px < ?php echo round($percentage_amount);?>%;">
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            -->

                                                            <div class="progress-bar-charity" data-loadbar="<?php echo round($percentage_amount); ?>" data-loadbar-text="<?php echo round($percentage_amount); ?>%">
                                                                <?php //echo $percentage_amount;  ?>
                                                                <?php
                                                                if (count($cs_xmlObject_transaction->transaction) == '0' || ($payment_gross == '0')) {
                                                                    echo'<div class="bgcolr" style="padding: 0px 0px 0px 0%;">
                                        <span></span>
                                         </div>';
                                                                } else {
                                                                    ?>		
                                                                    <div class="bgcolr" style="padding: 0px 0px 0px <?php echo round($percentage_amount); ?>%;">
                                                                        <span></span>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="progress-desc fullwidth">

                                                                <span class="progress-box"> <strong>$<?php echo $payment_gross; ?></strong>

                                                                    <?php
                                                                    if (isset($cs_theme_option['trans_switcher'])) {
                                                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                                                            _e('Raised', 'AidReform');
                                                                        }
                                                                    } else {
                                                                        if (isset($cs_theme_option['cause_raised'])) {
                                                                            echo $cs_theme_option['cause_raised'];
                                                                        }
                                                                    }
                                                                    ?>

                                                                </span>

                                                                <span class="progress-box"> <strong><?php echo count($cs_xmlObject_transaction->transaction); ?></strong>

                                                                    <?php
                                                                    if (isset($cs_theme_option['trans_switcher'])) {
                                                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                                                            _e('Donors', 'AidReform');
                                                                        }
                                                                    } else {
                                                                        if (isset($cs_theme_option['cause_donors'])) {
                                                                            echo $cs_theme_option['cause_donors'];
                                                                        }
                                                                    }
                                                                    ?>

                                                                </span>

                                                                <span class="progress-box">

                                                                    <strong><?php
                                                                        if (isset($cs_theme_option['paypal_currency_sign'])) {
                                                                            echo $cs_theme_option['paypal_currency_sign'];
                                                                        }
                                                                        ?><?php echo $cs_xmlObject->cause_goal_amount; ?></strong>

                                                                    <?php
                                                                    if (isset($cs_theme_option['trans_switcher'])) {
                                                                        if ($cs_theme_option['trans_switcher'] == "on") {
                                                                            $trans_featured = _e('Goal', 'AidReform');
                                                                        }
                                                                    } else {
                                                                        if (isset($cs_theme_option['cause_goal'])) {
                                                                            echo $cs_theme_option['cause_goal'];
                                                                        }
                                                                    }
                                                                    ?>

                                                                </span>

                                                            </div>

                                                            <div class="desc fullwidth">

                                                                <p><?php cs_get_the_excerpt('100', false); ?></p>

                                                                <?php
                                                                $before_cat = '<div class="post-category-list"><em class="fa fa-list"></em>';

                                                                $categories_list = get_the_term_list(get_the_id(), 'cs_cause-category', $before_cat, ', ', '</div>');

                                                                if ($categories_list) {
                                                                    printf(__('%1$s', 'AidReform'), $categories_list);
                                                                }
                                                                ?>

                                                                <a class="btnshare-post addthis_button_compact"><em class="fa fa-share-square-o"></em></a>

                                                            </div>

                                                        </div>

                                                    </figcaption>
                                                </figure>
                                            </article>
                                            <!-- Element Size End -->
                                            <?php
                                        endwhile;
                                    endif;
                                    wp_reset_query();
                                    ?>
                                </div>
                            <?php } ?>   
                            <!-- About Author Start -->
                            <?php if (get_the_author_meta('description')) { ?>
                                <div class="about-author">
                                    <figure>
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 63)); ?></a>
                                    </figure>
                                    <div class="text">
                                        <h6><a class="colrhover" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php echo get_the_author_meta('nickname'); ?></a></h6>
                                        <span><?php echo get_the_author(); ?></span>

                                        <p class="line"><?php the_author_meta('description'); ?></p>

                                        <?php if (get_the_author_meta('twitter')) { ?>

                                            <a class="follow-tweet" href="http://twitter.com/<?php the_author_meta('twitter'); ?>" target="_blank"><i class="icon-twitter icon-2x"></i>@<?php the_author_meta('twitter'); ?></a>

                                        <?php } ?>

                                    </div>

                                </div>

                                <!-- About Author End -->

                            <?php } ?>

                            <?php comments_template('', true); ?>

                            <!-- Blog Post End -->

                        </div>
                    </div>
                    <!--Right Sidebar Starts-->

                    <?php if ($cs_layout == 'content-left col-md-9') { ?>

                        <aside class="sidebar-right col-md-3"><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($cs_sidebar_right)) : ?><?php endif; ?></aside>

                    <?php } ?>

                    <?php
                endwhile;
            endif;
            ?>

            <!--Content Area End-->

            <!-- Columns End -->

            <!--Footer-->

            <?php get_footer(); ?>