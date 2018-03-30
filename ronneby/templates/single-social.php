<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby; ?>
<div class="post-social">

    <time class="date">
        <span class="day"><?php echo get_the_date('d'); ?></span>
        <span class="month"><?php echo get_the_date('F Y'); ?></span>
    </time>


    <div class="post-format clearfix">
        <?php get_template_part('templates/entry-meta/post-format-icon'); ?>
    </div>

    <?php
    if (isset($dfd_ronneby['post_share_button']) && strcmp($dfd_ronneby['post_share_button'],'1') === 0) {
        if (isset($dfd_ronneby['custom_share_code']) && $dfd_ronneby['custom_share_code']) {
            echo $dfd_ronneby['custom_share_code'];
        } else {  ?>

            <div class="count">
                <div class="fb-like" data-send="false" data-layout="box_count" data-width="50" data-show-faces="false" data-font="arial"></div>
                <script type="text/javascript">
                    (function (d, s, id) {
                        var js = undefined,
                            fjs = d.getElementsByTagName(s)[0];

                        if (d.getElementById(id)) {
                            return;
                        }

                        js = d.createElement(s);
                        js.id = id;
                        js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';

                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
            </div>


            <div class="count">
                <div class="g-plusone" data-size="tall"></div>
                <script type="text/javascript">
                    (function () {
                        var po = document.createElement('script'),
                            s = document.getElementsByTagName('script')[0];

                        po.type = 'text/javascript';
                        po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';

                        s.parentNode.insertBefore(po, s);
                    })();
                </script>
            </div>

            <div class="count">
                <a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-lang="en">Tweet</a>
                <script type="text/javascript">
                    !function (d, s, id) {
                        var js = undefined,
                            fjs = d.getElementsByTagName(s)[0];

                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = '//platform.twitter.com/widgets.js';

                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'twitter-wjs');
                </script>
            </div>

        <?php }
    } ?>
</div>