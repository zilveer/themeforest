				<?php  

					if ( ! yiw_get_option( 'show_linksbar' ) )
						return;

                     $current_user = wp_get_current_user();



                ?>
				<ul id="linksbar" class="group">
		            
		            <?php if ( function_exists( 'yiw_minicart' ) && yiw_get_option( 'show_linksbar_cart' ) ) : ?>
		        	<li class="icon cart">
						<?php yiw_minicart(); ?>
					</li>         
		        	<?php endif; ?>

		            
		            <?php if ( yiw_get_option( 'show_linksbar_login' ) ) : ?>

		        	<li class="icon lock">

                        <?php if ( $current_user->ID != 0 ) : ?>

                            <a href="<?php echo wp_logout_url( yiw_curPageURL() ); ?>"><?php _e('Logout', 'yiw') ?></a> |

                        <?php else : ?>

                           <?php if (is_shop_installed()): ?>

                           <?php

                                if ( is_woocommerce_installed() ) {
                                    $accountPage = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
                                }
                                else if( is_jigoshop_installed() )  {
                                    $accountPage = get_permalink( get_option( 'jigoshop_myaccount_page_id' ) );
                                }

                                $link_login='<a href="' . $accountPage . '">' . __('Login', 'yiw') . ' <span> / </span> ' . __('Register', 'yiw') . '</a> |';
                                echo $link_login ;
                            ?>

                           <?php else: ?>

                            <?php
                                $link_login  = '<a href="' . wp_login_url() . '">' . __('Login', 'yiw') . '</a>';
                                $link_login .= wp_register(' <span> / </span> ','', false);
                                echo   $link_login;
                            ?>

                          <?php endif;?>

                        <?php endif; ?>
					</li>

		        	<?php endif; ?>   
		        	
		        	<?php 
						$args = array(
							'container' => 'none', 
							'fallback_cb' => 'wp_page_menu', 
							'items_wrap' => '%3$s',
							'after' => ' | ',
	        				'depth' => 1, 
							'theme_location' => 'linksbar',
							'fallback_cb' => ''
						);
						
						wp_nav_menu( $args );
					?>
		        
		        </ul>