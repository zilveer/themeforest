    <footer id="footer" class="footer-outer-wrapper">
            <div class="footer-wrapper container">
               <?php if(st_get_setting("show_footer_widget",'y')!='n'){ ?>
                <div class="footer-columns row footer-sidebar">
                    <div class="three columns">
                        <?php dynamic_sidebar('footer_1'); ?>
                    </div>
                     <div class="three columns">
                         <?php dynamic_sidebar('footer_2'); ?>
                    </div>
                     <div class="three columns">
                         <?php dynamic_sidebar('footer_3'); ?>
                    </div>
                     <div class="three columns">
                        <?php dynamic_sidebar('footer_4'); ?>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>
                
                <div class="footer-copyright-wrapper row">
                    <div class="twelve columns">
                        <div class="footer-copyright">
                            <div class="copy-left left">
                                <?php echo stripcslashes(st_get_setting("footer_copyright")); ?>
                            </div>
                            <div class="copy-social right">
                                <ul class="footer-social">
                                   <?php 
                                   $socials = array(
                                        'twitter'=> array('title'=>__('Twitter','smooththemes'),'icon'=>'social-twitter'),
                                        'facebook'=>array('title'=>__('Facebook','smooththemes'),'icon'=>'social-facebook'),
                                        'google_plus'=>array('title'=>__('Google Plus','smooththemes'),'icon'=>'social-google-plus'),
                                        'youtube'=>array('title'=>__('Facebook','smooththemes'),'icon'=>'social-youtube'),
                                   );
                                   
                                   foreach($socials as $k=> $v){
                                         $link = st_get_setting($k);
                                         if($link){
                                             $socials[$k]['url'] =  $link;
                                         }else{
                                            unset($socials[$k]);
                                         }
                                   }
                                   
                                    $skype = st_get_setting('skype');
                                    if(count($socials) || $skype!=''){
                                    ?>
                                    <li class="stay_connected"><?php _e('Stay Connected','smooththemes') ; ?></li>
                                    <?php 
                                    foreach($socials as $social){ 
                                        echo '<li class="'.$social['icon'].'"><a target="_blank" href="'.esc_attr($social['url']).'">'.esc_html($social['title']).'</a></li>';
                                    }

                                        if($skype!=''){
                                            echo '<li class="social-skype"><a href="skype:'.esc_attr($skype).'?call">'.__('Skype','smooththemes').'</a></li>';
                                        }
                                     } ?>
                                    <?php
                                      
                                     ?>

                                </ul>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div> <!-- END .footer-wrapper -->
            
        </footer> <!-- END .footer-outer-wrapper -->


    </div><!-- END .body-wrapper -->
</div><!-- END .body-outer-wrapper -->
<?php wp_footer(); ?>
	
</body>
</html>