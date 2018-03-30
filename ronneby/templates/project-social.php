<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div class="project-social">
    <div>
        <div class="g-plusone" data-size="medium"></div>
        <script type="text/javascript">
            (function () {
                var po = document.createElement('script'),
                        s = document.getElementsByTagName('script')[0];

                po.type = 'text/javascript';
                po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';

                s.parentNode.insertBefore(po, s);
            } )();
        </script>
    </div>
    <div style="margin-right: 20px">
        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
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
            } (document, 'script', 'twitter-wjs');
        </script>
    </div>

    <div style="margin-right: 10px">
        <div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div>
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
            } (document, 'script', 'facebook-jssdk'));
        </script>
    </div>
    <div>
        <a href="http://pinterest.com/pin/create/button/?url=url_text&media=http%3A%2F%2Ftext&description=descr_text" class="pin-it-button" count-layout="horizontal">
            <img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" />
        </a>
        <script type="text/javascript">
            (function (d, s, id) {
                var js = undefined,
                    fjs = d.getElementsByTagName(s)[0];

                if (d.getElementById(id)) {
                    d.getElementById(id).parentNode.removeChild(d.getElementById(id));
                }

                js = d.createElement(s);
                js.id = id;
                js.src = '//assets.pinterest.com/js/pinit.js';

                fjs.parentNode.insertBefore(js, fjs);
            } (document, 'script', 'pinterest-wjs'));
        </script>
    </div>
</div>