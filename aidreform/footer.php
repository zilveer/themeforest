			   

             </div>

            <!-- Row End -->

        </div>

            <div class="clear"></div>

        <!-- Container End -->

	</div>

    <!-- Content Section End -->

    <div class="clear"></div>

    

		<?php global $cs_theme_option;

			if(isset($cs_theme_option['show_partners']) and $cs_theme_option['show_partners'] == "all"){

				echo cs_show_partner();

			}elseif(isset($cs_theme_option['show_partners']) and $cs_theme_option['show_partners'] == "home"){

				if(is_home() || is_front_page()){

					echo cs_show_partner();

				}

			} 

		?>   

        <div class="clear"></div>

            <!-- Footer Widgets Start -->

             <div id="footer-widgets" class="fullwidth">

                <!-- Container Start -->
				<?php if( is_active_sidebar('footer-widget') ) { ?>
                <div class="container">

                    <!-- Footer Widgets Start -->

                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget')) : ?><?php endif; ?>

                    <!-- Footer Widgets End -->

                </div>
                <?php } ?>

                <!-- Container End -->

                <footer id="footer">

                	<div class="container">

                        <p class="copright float-left">

                            <?php 
								if(isset($cs_theme_option['copyright'])){
									echo do_shortcode(htmlspecialchars_decode($cs_theme_option['copyright'])); 
								}else{
									 
									 echo "&copy;".gmdate("Y");
								?>
                            		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'AidReform' ) ); ?>">
										<?php echo get_option('blogname');  ?>
                                    </a>
                                     Wordpress All rights reserved
                            <?php 
								
								}
								if(isset($cs_theme_option['powered_by'])){ echo do_shortcode(htmlspecialchars_decode($cs_theme_option['powered_by'])); }
							?>

                        </p>

                        <div class="followus float-right">

                            <h3>
							<?php 
							if(isset($cs_theme_option['trans_follow_us']) and $cs_theme_option['trans_follow_us'] <> ''){ 
								$cs_follow_us = $cs_theme_option['trans_follow_us'];
							}else{
								$cs_follow_us = __('Follow Us','AidReform');
							}
							
							if(isset($cs_theme_option['trans_switcher']) and $cs_theme_option['trans_switcher'] == "on"){ _e('Follow Us','AidReform');}else{ 
								echo $cs_follow_us;
							}
							
							?>
                            </h3>

                            <?php cs_social_network(); ?>

                        </div>

                    </div>

                </footer>

            </div>

        <!-- Footer Start -->

    <div class="clear"></div>

    <!-- Login Inn Start -->

    <div class="modal hide fade login_inn webkit " id="loginbox" role="dialog">

    	<button type="button" class="close backcolorhover" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>

		<div class="header webkit">

            <header>

                <h3 class="heading-color"><?php _e('Log In','AidReform');?></h3>

            </header>

             <form class="webkit" action="<?php echo home_url(); ?>/wp-login.php" method="post">

				<ul>

                    <li>

                        <span><i class="icon-user"></i></span>

                        <input name="log" id="user_login" value="<?php _e('Username','AidReform'); ?>" onfocus="if(this.value=='<?php _e('Username','AidReform'); ?>') {this.value='';}" onblur="if(this.value=='') {this.value='<?php _e('Username','AidReform'); ?>';}" type="text" />           

                    </li>

                    <li>

                        <span class="password"><i class="icon-key"></i></span>

			        	<input name="pwd" value="<?php _e('password','AidReform'); ?>" onfocus="if(this.value=='<?php _e('password','AidReform'); ?>') {this.value='';}" onblur="if(this.value=='') {this.value='<?php _e('password','AidReform'); ?>';}" type="password" class="bar" />

                    </li>

                    <li>

                        <input type="hidden" name="redirect_to" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />                                        

                        <label>

                        	<input name="rememberme" value="forever" id="rememberme" type="checkbox" class="left" />

							<?php _e('Remember Me', 'AidReform'); ?>

                        </label>

					</li>

                    <li>

                        <span class="log"><i class="icon-signin"></i></span>

                        <input class="backcolr" type="submit" value="<?php _e('Log In','AidReform');?>">

                    </li>

                </ul>

            </form>

        </div>

        <div class="footer webkit">

           <a class="colrhover" href="<?php echo home_url() ; ?>/wp-login.php?action=lostpassword"> <i class="icon-question-sign"></i><?php _e('Lost Password','AidReform'); ?>?</a>

            <div class="sign">

            	  <?php 	

				  	if ( get_option("users_can_register") == 1 and !is_user_logged_in() ) { ?>

						<form action="<?php echo home_url() ; ?>/wp-login.php?action=register">

                            <label><?php _e('Register', 'AidReform')?></label>

                            <button class="texttransform backcolrhover transition"><?php echo _e('Signup','AidReform'); ?></button>

                        </form>

					<?php }?>	

                  

              </div>

        </div>

    </div>

    <!-- Login Inn End -->

    <div class="clear"></div>

</div>

<!-- Wrapper End -->

<?php 

	cs_footer_settings();

	wp_footer();	

?>

</body>

</html>