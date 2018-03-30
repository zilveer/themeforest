<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */
?>


<!-- CONTACT -->
<section id="contact">
    <!-- map -->
    <div id="gmap_canvas"></div> 
    <?php
    global $tlazya_evential;
    $glat = $tlazya_evential['map_lat'];
    $glng = $tlazya_evential['map_lng'];
    $gzoom = $tlazya_evential['map_zoom'];
    $gct1 = $tlazya_evential['map_marker_title'];
    $gct2 = $tlazya_evential['map_marker_content'];
    if ((isset($tlazya_evential['map_lat']) && $tlazya_evential['map_lat'] != '') && (isset($tlazya_evential['map_lng']) && $tlazya_evential['map_lng'] != '')) {
        ?>
        <?php echo do_shortcode('[rms-googlemap lat="' . esc_attr($glat) . '" lng="' . esc_attr($glng) . '" zoom="' . esc_attr($gzoom) . '" contents="' . esc_html($gct1) . '" contents2="' . esc_html($gct2) . '"]'); ?>
        <?php
    } else {
        ?>
        <?php echo do_shortcode('[rms-googlemap lat="23.835027" lng="90.368574" zoom="16" contents="ThemeonLab" contents2="Quality Template Provide"]'); ?>
	<?php } ?>    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                <?php if(isset($tlazya_evential['address_info']) && $tlazya_evential['address_info'] != ''){ ?>
                <div class="contact">
                    <?php
                    global $tlazya_evential;
                    if (isset($tlazya_evential['title_info']) && $tlazya_evential['title_info'] != '') {
                        echo '<h2 class="uppercase">' . esc_html($tlazya_evential['title_info']) . '</h2>';
                    }
                    ?>
                    <?php
                    global $tlazya_evential;
                    if (isset($tlazya_evential['contact_content']) && $tlazya_evential['contact_content'] != '') {
                        echo esc_html($tlazya_evential['contact_content']);
                    }
                    ?>
                    <ul class="address fa-ul">                    
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['address_info']) && $tlazya_evential['address_info'] != '') {
                            echo '<li><i class="fa-li fa fa-home"></i>' . esc_html($tlazya_evential['address_info']) . '</li>';
                        }
                        ?>


                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['mail_info']) && $tlazya_evential['mail_info'] != '') {
                            echo '<li><i class="fa-li fa fa-envelope"></i><a href="mailto:' . esc_attr($tlazya_evential['mail_info']) . '" title="contact mail">' . esc_html($tlazya_evential['mail_info']) . '</a></li>';
                        }
                        ?>

                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['phone_info']) && $tlazya_evential['phone_info'] != '') {
                            echo '<li><i class="fa-li fa fa-phone-square"></i><a href="#" title="' . esc_attr($tlazya_evential['phone_info']) . '">' . esc_html($tlazya_evential['phone_info']) . '</a></li>';
                        }
                        ?>

                    </ul>                    
                    <div class="social">
                        <div class="clearfix"></div>
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['facebook_url']) && $tlazya_evential['facebook_url'] != '') {
                        ?>
                            <a href="<?php echo esc_url($tlazya_evential['facebook_url']); ?>" title="facebook">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        <?php } ?> 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['twitter_url']) && $tlazya_evential['twitter_url'] != '') {
                            ?><a href="<?php echo esc_url($tlazya_evential['twitter_url']); ?>" title="twitter">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>								
                            </a>
                        <?php } ?>  
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['google_url']) && $tlazya_evential['google_url'] != '') {
                            ?><a href="<?php echo esc_url($tlazya_evential['google_url']); ?>" title="google plus">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                </span>									
                            </a>
                        <?php } ?>  
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['youtube_url']) && $tlazya_evential['youtube_url'] != '') {
                            ?><a href="<?php echo esc_url($tlazya_evential['youtube_url']); ?>" title="youtube">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                                </span>			
                            </a>
                        <?php } ?> 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['linkedin_url']) && $tlazya_evential['linkedin_url'] != '') {
                            ?><a href="<?php echo esc_url($tlazya_evential['linkedin_url']); ?>" title="linkedin">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                </span>		
                            </a>
                        <?php } ?>                                 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['dribble_url']) && $tlazya_evential['dribble_url'] != '') {
                            ?><a href="<?php echo esc_url($tlazya_evential['dribble_url']); ?>" title="dribble">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-dribbble fa-stack-1x fa-inverse"></i>
                                </span>									
                            </a>
                        <?php } ?>  
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['behance_url']) && $tlazya_evential['behance_url'] != '') {
                            ?><a title="behance" href="<?php echo esc_url($tlazya_evential['behance_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-behance fa-stack-1x fa-inverse"></i>
                                </span>		
                            </a>
                        <?php } ?>                                
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['pin_url']) && $tlazya_evential['pin_url'] != '') {
                            ?><a title="pinterest" href="<?php echo esc_url($tlazya_evential['pin_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-pinterest fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>  
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['vimeo_url']) && $tlazya_evential['vimeo_url'] != '') {
                            ?><a title="vimeo" href="<?php echo esc_url($tlazya_evential['vimeo_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-vimeo-square fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>   
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['rss_url']) && $tlazya_evential['rss_url'] != '') {
                            ?><a title="rss" href="<?php echo esc_url($tlazya_evential['rss_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-rss fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?> 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['skype_url']) && $tlazya_evential['skype_url'] != '') {
                            ?> <a title="skype" href="<?php echo esc_url($tlazya_evential['skype_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-skype fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?> 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['github_url']) && $tlazya_evential['github_url'] != '') {
                            ?><a title="github" href="<?php echo esc_url($tlazya_evential['github_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github-alt fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>  
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['flickr_url']) && $tlazya_evential['flickr_url'] != '') {
                            ?><a title="flickr" href="<?php echo esc_url($tlazya_evential['flickr_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-flickr fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?> 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['dropbox_url']) && $tlazya_evential['dropbox_url'] != '') {
                            ?><a title="dropbox" href="<?php echo esc_url($tlazya_evential['dropbox_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-dropbox fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>  
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['bitbucket_url']) && $tlazya_evential['bitbucket_url'] != '') {
                            ?><a title="bitbucket" href="<?php echo esc_url($tlazya_evential['bitbucket_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-bitbucket fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>                                 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['instagram_url']) && $tlazya_evential['instagram_url'] != '') {
                            ?><a title="instagram" href="<?php echo esc_url($tlazya_evential['instagram_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>                                 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['soundcloud_url']) && $tlazya_evential['soundcloud_url'] != '') {
                            ?><a title="soundcloud" href="<?php echo esc_url($tlazya_evential['soundcloud_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-soundcloud fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>                                 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['stack_url']) && $tlazya_evential['stack_url'] != '') {
                            ?><a href="<?php echo esc_url($tlazya_evential['stack_url']); ?>" title="stack-overflow">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-stack-overflow fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>                                 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['wordpress_url']) && $tlazya_evential['wordpress_url'] != '') {
                            ?><a title="wordpress" href="<?php echo esc_url($tlazya_evential['wordpress_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-wordpress fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>                                 
                        <?php
                        global $tlazya_evential;
                        if (isset($tlazya_evential['tumblr_url']) && $tlazya_evential['tumblr_url'] != '') {
                            ?><a title="tumblr" href="<?php echo esc_url($tlazya_evential['tumblr_url']); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-tumblr fa-stack-1x fa-inverse"></i>
                                </span>											
                            </a>
                        <?php } ?>                      
                        <div class="clearfix"></div>
                        <div class="footer_copyright">                            
                            <?php
                            global $tlazya_evential;
                            if (isset($tlazya_evential['footer_copyright']) && $tlazya_evential['footer_copyright'] != '') {
                                echo $tlazya_evential['footer_copyright'];
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>	
    </div>
</section>
<!-- Your Your google tracking code will goes here -->
<?php get_template_part( 'content', 'contact' ); ?> 
<script type="text/javascript">
<?php
global $tlazya_evential;
if (isset($tlazya_evential['google_tracking']) && $tlazya_evential['google_tracking'] != '') {
    echo $tlazya_evential['google_tracking'];
}
?>
</script>
<?php wp_footer(); ?>
</body>
</html>