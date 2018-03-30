<?php include_once('admin/func_wp_load.php'); ?>
<!-- THREE FOOTER AREA -->
    <div id="footer-area"></div>
    <div class="grid_12 margin footer-link" style="list-style:none;">
    <?php if (dynamic_sidebar('sidebar-footer') ) : ?> 
    	
    <?php else : ?>
    	<p><?php echo get_option('footer_text_1',true); ?></p>
        <p><?php echo get_option('footer_text_2',true); ?></p>
        
    <?php endif; ?>
    
    </div> <!-- /.footer-link -->
    <div class="grid_12 social-icon">
    <?php $link_url = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; ?>
    	<ul>
        <?php if(get_option('im_footer_sb_facebook', true) == 'true'){ ?>
        	<li><a href="http://www.facebook.com/share.php?u=<?php echo $link_url; ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_facebook_box_blue.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_twitter', true) == 'true'){ ?>
            <li><a href="http://twitthis.com/twit?url=<?php echo $link_url; ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_twitter_box_blue.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_google', true) == 'true'){ ?>
            <li><a href="http://www.google.com/buzz/post?url=<?php echo $link_url; ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_google_buzz_box.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_yahoo', true) == 'true'){ ?>
        	<li><a href="http://myweb2.search.yahoo.com/myresults/bookmark?t=&u=<?php echo $link_url; ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_yahoo_box_lilac.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_de', true) == 'true'){ ?>
        	<li><a href="http://del.icio.us/post?url1=<?php echo $link_url; ?>&title=<?php bloginfo('template_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_de_box.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_in', true) == 'true'){ ?>
        	<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $link_url; ?>>&title=<?php bloginfo('name'); ?>&ro=false"><img src="<?php bloginfo('template_url'); ?>/image/social_in_box.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_sb', true) == 'true'){ ?>
        	<li><a href="http://www.stumbleupon.com/submit?url=<?php echo $link_url; ?>&title=<?php bloginfo('name'); ?>""><img src="<?php bloginfo('template_url'); ?>/image/social_sb_box.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_te', true) == 'true'){ ?>
        	<li><a href="http://technorati.com/favorites/?sub=favthis&add=<?php echo $link_url; ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_te_box.png" alt="" /></a></li>
        <?php } ?>
        <?php if(get_option('im_footer_sb_rss', true) == 'true'){ ?>
            <li><a href="<?php bloginfo('rss_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/image/social_rss_box_orange.png" alt="" /></a></li>
        <?php } ?>
        </ul>
    </div>
    
    <?php echo get_option('im_theme_google_analytics', true); ?>
    <div class="requ"><?php wp_footer(); ?></div>
</div>
</body>
</html>