<?php global $jaw_data; ?>

<div class="row">
    <div class="col-lg-<?php echo esc_attr(jaw_template_get_var('box_size', 'auto')); ?>">     

        <div id="admin_info" class="shortcode_about_author">
            <div class="about_author" itemtype="http://schema.org/Person" itemscope itemprop="author">
                <h3 class="author_name"  itemprop="name"><?php echo get_the_author(); ?></h3>
                <div class="author_link"><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php _e('About the author', 'jawtemplates'); ?></a></div>                    
            </div>

            <div class="author_info">
                <div class="author_image">
                    <?php echo get_avatar(get_the_author_meta('ID', jaw_template_get_var('id'))); ?>
                </div>
                <div class="author_desc">
                    <p><?php echo get_the_author_meta("description", jaw_template_get_var('id')); ?></p>
                    <?php
                    if (get_the_author_meta('facebook', jaw_template_get_var('id')) ||
                            get_the_author_meta('twitter', jaw_template_get_var('id')) ||
                            get_the_author_meta('google', jaw_template_get_var('id')) ||
                            get_the_author_meta('youtube', jaw_template_get_var('id')) ||
                            get_the_author_meta('linkedin', jaw_template_get_var('id')) ||
                            get_the_author_meta('vimeo', jaw_template_get_var('id')) ||
                            get_the_author_meta('flickr', jaw_template_get_var('id'))) {
                        ?>
                        <div class="share_post" role="main">
                            <ul class="socialshare-icon">
                                <li>
                                    <span class="follow-me-title">
                                        <?php _e("Follow me on:", "jawtemplates"); ?>
                                    </span>
                                </li>
                                <?php if (get_the_author_meta('facebook', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-facebook" target="_blank" href="<?php echo esc_url(get_the_author_meta('facebook', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-facebook4"></span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (get_the_author_meta('twitter', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-twitter" target="_blank" href="<?php echo esc_url(get_the_author_meta('twitter', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-twitter3"></span>
                                        </a>
                                    </li>
                                <?php } ?>                            
                                <?php if (get_the_author_meta('google', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-google" target="_blank" href="<?php echo esc_url(get_the_author_meta('google', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-google-plus4"></span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php if (get_the_author_meta('youtube', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-youtube" target="_blank" href="<?php echo esc_url(get_the_author_meta('youtube', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-youtube"></span>
                                        </a>
                                    </li>
                                <?php } ?>

                                <?php if (get_the_author_meta('linkedin', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-linkedin" target="_blank" href="<?php echo esc_url(get_the_author_meta('linkedin', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-linkedin"></span>
                                        </a>
                                    </li>
                                <?php } ?> 

                                <?php if (get_the_author_meta('vimeo', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-vimeo" target="_blank" href="<?php echo esc_url(get_the_author_meta('vimeo', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-vimeo3"></span>
                                        </a>
                                    </li>
                                <?php } ?>  

                                <?php if (get_the_author_meta('flickr', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-flickr" target="_blank" href="<?php echo esc_url(get_the_author_meta('flickr', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-flickr4"></span>
                                        </a>
                                    </li>
                                <?php } ?>  

                                <?php if (get_the_author_meta('pinterest', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-pinterest" target="_blank" href="<?php echo esc_url(get_the_author_meta('pinterest', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-pinterest"></span>
                                        </a>
                                    </li>
                                <?php } ?>  
                                <?php if (get_the_author_meta('instagram', jaw_template_get_var('id'))) { ?>
                                    <li>
                                        <a class="link-instagram" target="_blank" href="<?php echo esc_url(get_the_author_meta('instagram', jaw_template_get_var('id'))); ?>">
                                            <span class="icon-instagram"></span>
                                        </a>
                                    </li>
                                <?php } ?>  

                            </ul>
                            <div class="clear"></div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!-- End Content row -->

    </div>
</div>