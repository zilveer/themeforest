<?php
if( !is_404()){
?>
        <div id="footer">
            <div class="container">   
                <div class="row">                                                         
                    <!-- Copyright -->                                                       
                    <div class="col-sm-6 col-md-6 f-copyright">
						<?php $footer_text = th_theme_data('footer_text');
						if($footer_text != '') { ?>					
							<span><?php echo wp_kses_post(th_theme_data('footer_text')); ?></span>
						<?php } else { ?>
							<span><?php _e('&copy; Copyright LARX - All Rights Reserved', 'larx'); ?></span>
						<?php } ?>
                    </div>                      
                    <div class="col-sm-6 col-md-6">
						<?php $switch_footer_social = th_theme_data('switch_footer_social');
						if($switch_footer_social == 1){ ?>
							<?php $th_footer_social_target = th_theme_data('th_footer_social_target'); ?>
							<!-- Social Icons -->                              
							<ul class="footer-social">
								<?php if(th_theme_data('footer_facebook_url')): ?>
									<li><a target="<?php echo $th_footer_social_target; ?>" href="<?php echo esc_url(th_theme_data('footer_facebook_url')); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>
								<?php endif;?>

								<?php if(th_theme_data('footer_twitter_url')): ?>
									<li><a target="<?php echo $th_footer_social_target; ?>" href="<?php echo esc_url(th_theme_data('footer_twitter_url')); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>
								<?php endif;?>

								<?php if(th_theme_data('footer_skype_url')): ?>
									<li><a target="<?php echo $th_footer_social_target; ?>" href="<?php echo esc_url(th_theme_data('footer_skype_url')); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-skype fa-stack-1x fa-inverse"></i></span></a></li>
								<?php endif;?>

								<?php if(th_theme_data('footer_pinterest_url')): ?>
									<li><a target="<?php echo $th_footer_social_target; ?>" href="<?php echo esc_url(th_theme_data('footer_pinterest_url')); ?>"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest fa-stack-1x fa-inverse"></i></span></a></li>
								<?php endif;?>
								<?php echo wp_kses_post(th_theme_data('footer_custom_social')); ?>
							</ul>
						<?php } ?>
                    </div>
                </div><!-- /row -->
            </div><!-- /container -->
        </div>
<?php
} else{
    wp_enqueue_script('bg-animation', '', '', '', true);
}
?>
        <!-- End Footer -->
        <?php wp_footer() ?>
    </body>
</html>