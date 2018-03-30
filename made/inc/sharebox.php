<?php //get theme options
global $oswc_single, $oswc_misc;

//set theme options
$oswc_sharebox_hide = $oswc_single['sharebox_hide'];
$oswc_twitter_name = $oswc_misc['twitter_name'];
$oswc_share_twitter_show = $oswc_single['twitter_show'];
$oswc_share_facebook_show = $oswc_single['facebook_show'];
$oswc_share_digg_show = $oswc_single['digg_show'];
$oswc_share_stumbleupon_show = $oswc_single['stumbleupon_show'];
$oswc_share_plusone_show = $oswc_single['plusone_show'];
$oswc_share_yahoo_show = $oswc_single['yahoo_show'];
$oswc_share_pinterest_show = $oswc_single['pinterest_show'];
$oswc_share_tumblr_show = $oswc_single['tumblr_show'];
$oswc_share_email_show = $oswc_single['email_show'];
?>

<?php // use variables from page custom fields instead of made options page (if they exist)
$override = get_post_meta($post->ID, "Hide Sharebox", $single = true);
if($override!="" && $override!="null") {
	$oswc_sharebox_hide=$override;
	if($oswc_sharebox_hide=="false") {
		$oswc_sharebox_hide=false;	
	} else {
		$oswc_sharebox_hide=true;
	}
}
?>

<?php if(!$oswc_sharebox_hide) { ?>
    
    <div id="sharebox-wrapper">
    
        <div id="sharebox" class="absolute">
        
            <div class="inner">
            
                <?php if($oswc_share_twitter_show) { ?>
                        
                    <!-- Twitter -->
                    <div class="panel twitter" title="Tweet this article">                        
                        <a href="http://twitter.com/share" class="twitter-share-button"
                          data-url="<?php echo rawurlencode(the_permalink()) ?>"
                          data-via="<?php echo $oswc_twitter_name; ?>"
                          data-text="<?php the_title(); ?>"
                          data-count="vertical">Tweet</a>
                    </div>
                    
                <?php } ?>
    
                <?php if($oswc_share_facebook_show) { ?>
                
                    <!-- Facebook -->
                    <div class="panel" title="Like on Facebook">
                        <iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo rawurlencode(get_permalink()); ?>&amp;layout=box_count&amp;show_faces=true&amp;width=50&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:65px;" allowTransparency="true"></iframe>
                    </div>
                
                <?php } ?>
                
                <?php if($oswc_share_plusone_show) { ?>
                
                    <!-- Google +1 -->
                    <div class="panel" title="Google +1">
                        <g:plusone size="tall"></g:plusone>
                    </div>
                    
                    <br class="clearer" />
                    
                <?php } ?>
                                
                <?php if($oswc_share_pinterest_show) { ?>
                
                	<?php
					// Featured Image for Pinterest
					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
					$image_url = $large_image_url[0];			
					?>
                
                    <!-- Pinterest -->
                    <div class="panel" title="Pinterest">
                        <a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode(the_permalink()); ?>&media=<?php echo rawurlencode($image_url); ?>" class="pin-it-button" count-layout="vertical">Pin It</a>
                    </div>
                    
                <?php } ?>
                
                <?php if($oswc_share_yahoo_show) { ?>
                
                    <!-- Yahoo Messenger -->
                    <div class="panel" title="Yahoo Messenger">
                        <a alt='send to yahoo messenger' href='ymsgr:im?+&amp;msg=<?php the_title(); ?>%20%20%20<?php echo rawurlencode(get_permalink()); ?>'><img src='<?php echo get_template_directory_uri(); ?>/images/yahoo.png'></a>
                    </div>
                    
                <?php } ?>
                
                <?php if($oswc_share_digg_show) { ?>
            
                    <!-- Digg -->
                    <div class="panel" title="Digg this article">
                        <a class="DiggThisButton DiggMedium" href="http://digg.com/submit?url=<?php echo rawurlencode(the_permalink()) ?>&title=<?php the_title(); ?>&bodytext=<?php the_excerpt(); ?>"></a>                        
                    </div>
                    
                <?php } ?>
                
                <?php if($oswc_share_stumbleupon_show) { ?>
            
                    <!-- StumbleUpon -->
                    <div class="panel" title="Submit to StumbleUpon">
                        <script src="http://www.stumbleupon.com/hostedbadge.php?s=5"></script>
                    </div>
                    
                <?php } ?>
                
                <?php if($oswc_share_tumblr_show) { ?>
            
                    <!-- Tumblr -->
                    <div class="panel" title="Share on Tumblr">
                        <a href="http://www.tumblr.com/share" title="Share on Tumblr" style="display:inline-block; text-indent:-9999px; overflow:hidden; width:61px; height:20px; background:url('http://platform.tumblr.com/v1/share_2.png') top left no-repeat transparent;">Share on Tumblr</a>
                    </div>
                    
                <?php } ?>
                
                <?php if($oswc_share_email_show) { ?>
                
                    <!-- Email -->
                    <div class="panel" title="Email to a friend">
                        <a href="mailto:type%20email%20address%20here?subject=I%20wanted%20to%20share%20this%20post%20with%20you%20from%20<?php bloginfo('name'); ?>&body=<?php the_title(); ?> - <?php echo rawurlencode(the_permalink()) ?>" target="_blank" class="share-email">&nbsp;</a>
                    </div>
                    
                <?php } ?>
            
            </div>
        
        </div>
        
    </div>
    
    <script type="text/javascript">
    /*sharebox scrolling*/
    var mediaTop = jQuery('div#sharebox').offset().top; 
    var media = jQuery('div#sharebox');
    
    jQuery(document).scroll( function() {
       var scrollTop = jQuery(document).scrollTop();
    
       //fix/unfix as necessary
       if (mediaTop < scrollTop) {
           jQuery(media).addClass('fixed'); 
       }
       else { 
           jQuery(media).removeClass('fixed'); 
       }
    });
    </script>
    
<?php } ?>