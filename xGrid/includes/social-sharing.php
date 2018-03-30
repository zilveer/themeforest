<?php
/**
 * Share Buttons
 */
global $bd_data, $post;

$thumb      = bd_post_image('full');
$permalink  = get_permalink( get_the_ID() );
$titleget   = get_the_title();

if( bdayh_get_option( 'social_lang_type' ) ){
    $social_lang_type = bdayh_get_option( 'social_lang_type' );
} else {
    $social_lang_type ='en-US';
}
?>
    <script type="text/javascript">
        window.___gcfg = {lang: '<?php echo $social_lang_type ?>'};
        (function(w, d, s) {
            function go(){
                var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
                    if (d.getElementById(id)) {return;}
                    js = d.createElement(s); js.src = url; js.id = id;
                    fjs.parentNode.insertBefore(js, fjs);
                };
                load('//connect.facebook.net/en/all.js#xfbml=1', 'fbjssdk');
                load('https://apis.google.com/js/plusone.js', 'gplus1js');
                load('//platform.twitter.com/widgets.js', 'tweetjs');
            }
            if (w.addEventListener) { w.addEventListener("load", go, false); }
            else if (w.attachEvent) { w.attachEvent("onload",go); }
        }(window, document, 'script'));
    </script>

<?php if(array_key_exists('social_sharing_box',$bd_data)) { ?>
    <div class="post-sharing-box">
       <span class="title"><?php _e( 'Share this Story', 'bd' ) ?></span>

        <?php if($bd_data['social_displays'] == 'sharing_box_v1'){ ?>
            <ul class="post-share-box-social-networks social-icons">
                <?php if($bd_data['sharing_facebook']): ?>
                    <li class="facebook">
                        <a class="ttip" title="facebook" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $permalink;?>','Facebook','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink;?>">
                            <i class="social_icon-facebook"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($bd_data['sharing_twitter']): ?>
                    <li class="twitter">
                        <a class="ttip" title="twitter" onClick="window.open('http://twitter.com/share?url=<?php echo $permalink; ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>','Twitter share','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://twitter.com/share?url=<?php echo $permalink; ?>&amp;text=<?php echo str_replace(" ", "%20", $titleget); ?>">
                            <i class="social_icon-twitter"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($bd_data['sharing_linkedin']): ?>
                    <li class="linkedin">
                        <a class="ttip" title="linkedin" onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink; ?>','Linkedin','width=863,height=500,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink; ?>">
                            <i class="social_icon-linkedin"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($bd_data['sharing_reddit']): ?>
                    <li class="reddit">
                        <a class="ttip" title="reddit" onClick="window.open('http://reddit.com/submit?url=<?php echo $permalink; ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>','Reddit','width=617,height=514,left='+(screen.availWidth/2-308)+',top='+(screen.availHeight/2-257)+''); return false;" href="http://reddit.com/submit?url=<?php echo $permalink; ?>&amp;title=<?php echo str_replace(" ", "%20", $titleget); ?>">
                            <i class="social_icon-reddit"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($bd_data['sharing_tumblr']): ?>
                    <li class="tumblr">
                        <?php
                        $str = $permalink;
                        $str = preg_replace('#^https?://#', '', $str);
                        ?>
                        <a class="ttip" title="tumblr" onClick="window.open('http://www.tumblr.com/share/link?url=<?php echo $str; ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>','Tumblr','width=600,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="http://www.tumblr.com/share/link?url=<?php echo $str; ?>&amp;name=<?php echo str_replace(" ", "%20", $titleget); ?>">
                            <i class="social_icon-tumblr"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($bd_data['sharing_google']): ?>
                    <li class="google">
                        <a class="ttip" title="google" onClick="window.open('https://plus.google.com/share?url=<?php echo $permalink; ?>','Google plus','width=585,height=666,left='+(screen.availWidth/2-292)+',top='+(screen.availHeight/2-333)+''); return false;" href="https://plus.google.com/share?url=<?php echo $permalink; ?>">
                            <i class="social_icon-google"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if($bd_data['sharing_pinterest']): ?>
                    <li class="pinterest">
                        <?php $full_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); ?>
                        <a class="ttip" title="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink() ); ?>&amp;description=<?php echo urlencode( $post->post_title ); ?>&amp;media=<?php echo urlencode( $full_image[0] ); ?>" target="_blank" />
                        <i class="social_icon-pinterest"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

        <?php } elseif($bd_data['social_displays'] == 'sharing_box_v2'){ ?>

            <ul class="social_sharing_box_large">

                <?php if($bd_data['sharing_facebook']): ?>
                    <li class="facebook">
                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;width&amp;layout=box_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:65px; width:105px" allowTransparency="true"></iframe>
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_twitter']): ?>
                    <li class="twitter">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-width="70" data-height="70" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php echo $bd_data['share_twitter_username'] ?>" data-lang="en" data-count="vertical">tweet</a>
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_google']): ?>
                    <li class="google">
                        <div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>">
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_linkedin']): ?>
                    <li class="linkedin">
                        <script src="//platform.linkedin.com/in.js" type="text/javascript">
                            lang: en_US
                        </script>
                        <script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="top"></script>
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_pinterest']): ?>
                    <li class="pinterest">
                        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $thumb ?>" data-pin-do="buttonPin" data-pin-config="above"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
                    </li>
                <?php endif; ?>

            </ul>

        <?php } elseif($bd_data['social_displays'] == 'sharing_box_v3'){ ?>

            <ul class="social_sharing_box_small">

                <?php if($bd_data['sharing_facebook']): ?>
                    <li class="facebook">
                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;share=false&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:105px" allowTransparency="true"></iframe>
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_twitter']): ?>
                    <li class="twitter">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-via="<?php echo $bd_data['share_twitter_username'] ?>" data-lang="en">tweet</a>
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_google']): ?>
                    <li class="google">
                        <div class="g-plusone" data-size="medium" data-href="<?php the_permalink(); ?>">
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_linkedin']): ?>
                    <li class="linkedin">
                        <script src="http://platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-url="<?php the_permalink(); ?>" data-counter="right"></script>
                    </li>
                <?php endif; ?>

                <?php if($bd_data['sharing_pinterest']): ?>
                    <li class="pinterest">
                        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
                        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $thumb ?>" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
                    </li>
                <?php endif; ?>

            </ul>

        <?php } ?>

    </div><!-- .post-share/-->
<?php } ?>