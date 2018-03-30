<?php if(! defined('ABSPATH')){ return; }
/**
 * Single Social - Facebook
 */
?>
<!-- Social sharing -->
<ul class="itemSocialSharing kl-blog-post-socsharing clearfix">

    <!-- Facebook Button -->
    <li class="itemFacebookButton kl-blog-post-socsharing-fb">
        <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
    </li>

    <!-- Google +1 Button -->
    <li class="itemGooglePlusOneButton kl-blog-post-socsharing-gp">
        <script type="text/javascript">
            jQuery(function($){
                var po = document.createElement('script');
                po.type = 'text/javascript';
                po.async = true;
                po.src = 'https://apis.google.com/js/plusone.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(po, s);
            });
        </script>
        <div class="g-plusone" data-size="medium"></div>
    </li>

    <!-- Twitter Button -->
    <li class="itemTwitterButton kl-blog-post-socsharing-tw">
        <a href="//twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a>
        <script>window.twttr = (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
          if (d.getElementById(id)) return t;
          js = d.createElement(s);
          js.id = id;
          js.src = "https://platform.twitter.com/widgets.js";
          fjs.parentNode.insertBefore(js, fjs);

          t._e = [];
          t.ready = function(f) {
            t._e.push(f);
          };

          return t;
        }(document, "script", "twitter-wjs"));</script>
    </li>

    <!-- Pin Button -->
    <li class="kl-blog-post-socsharing-pin">
      <a data-pin-do="buttonPin" data-pin-count="beside" data-pin-save="true" href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" class="pin-it-button"></a>
        <script async defer src="//assets.pinterest.com/js/pinit.js"></script>
    </li>

</ul><!-- end social sharing -->
