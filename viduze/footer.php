<?php 
	/*

	 * This file is used to generate footer section of theme.

	 */	
?>
<?php 
          $cp_show_footer = get_option(THEME_NAME_S.'_show_footer','enable');
		  $cp_show_copyright = get_option(THEME_NAME_S.'_show_copyright','enable');
		  $show_footer_slider = get_option(THEME_NAME_S.'_show_footer_slider','enable');
		  $footer_text = do_shortcode( __(get_option(THEME_NAME_S.'_copyright_left_area'), 'cp_front_end') );
		  global $item_xml;
		  
		 ?>

            <footer class="footer">
                  <section class="home">
                    <div class="container"> <?php   if ( has_nav_menu( 'footer_menu' ) ) { wp_nav_menu( array( 'container_id'=>'footer_links', 'theme_location' => 'footer_menu' ) ); };  ?>
                         <a href="#" class="top scroll-topp"><?php __('Back to Top','cp_front_end') ?></a>
                    </div>
                  </section>
                    <section class="container">
                       <?php if( $show_footer_slider == 'enable' ){ ?>
                        <!--Featured Video Gallery-->
                           <?php print_footer_slider($item_xml); ?>
                        <!--/Featured Video Gallery-->
                       <?php } ?> 
                        <article class="footer-widgets">
                          <section class="row"> 
                            <?php if( $cp_show_footer == 'enable' ){ 
                                $cp_footer_class = array(
                                'footer-style1'=>array('1'=>'span3', '2'=>'span3', '3'=>'span3', '4'=>'span3'),
                                'footer-style4'=>array('1'=>'span4', '2'=>'span4', '3'=>'span4', '4'=>'display-none'),
                                );
                                $cp_footer_style = get_option(THEME_NAME_S.'_footer_style', 'footer-style4');
                                for( $i=1 ; $i<=4; $i++ ){
                                    echo '<figure class="' . $cp_footer_class[$cp_footer_style][$i] . ' widget  ">';
                                         dynamic_sidebar('Footer '. $i);
                                    echo '</figure>'; } ?>                                 
                                <?php } ?>
                          </section>
                        </article>
                    </article>
                    <article class="copyrights">
                       <?php if ($footer_text != '' ){
                        echo sprintf(__('<p>%s</p>','cp_front_end'), $footer_text);
                        }else {
                        echo __('<p>Copyright © 2013 VIDEUZE.','cp_front_end'). __('Designed by  <a href="http://crunchpress.com/">CrunchPress.com</a></p>','cp_front_end');
                        }
                     ?> 
                    </article>
                  </section>
            </footer>

           <script type="text/javascript">
               <?php get_template_part( 'cufon', 'replace' ); ?>
	       </script>
           
<?php wp_footer(); ?>

</body></html>