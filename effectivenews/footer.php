      </div> <!--content boxed wrapper-->
            <?php do_action('mom_after_content'); ?>
<?php if (mom_option('hide_footer_widgets') != true ) { ?>
            <footer id="footer">
                <div class="inner">
	     <?php $footer_layout = mom_option('footer_layout'); if ( $footer_layout == 'third') { ?>
			<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>

			</div><!-- End third col -->
			<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div><!-- End third col -->
			<div class="one_third last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>

			</div><!-- End third col -->
	    <?php } elseif ($footer_layout == 'one') { ?>
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
	    <?php } elseif ($footer_layout == 'one_half') { ?>
			<div class="one_half">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_half last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } elseif ($footer_layout == 'fourth') { ?>
			<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fourth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } elseif ($footer_layout == 'fifth') { ?>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_fifth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } elseif ($footer_layout == 'sixth') { ?>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>
			<div class="one_sixth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer6')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'half_twop') { ?>
	    		<div class="one_half" style="margin-right: 3%;">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fourth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
	    
    	    <?php } elseif ($footer_layout == 'twop_half') { ?>
	    		<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fourth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_half last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'half_threep') { ?>
	    		<div class="one_half">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
    	    <?php } elseif ($footer_layout == 'threep_half') { ?>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_half last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'third_threep') { ?>
	    		<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>


    	    <?php } elseif ($footer_layout == 'threep_third') { ?>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_fifth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>
			
			<div class="one_third last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>

    	    <?php } elseif ($footer_layout == 'third_fourp') { ?>
			<div class="one_third">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>


       	    <?php } elseif ($footer_layout == 'fourp_third') { ?>
	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer1')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer2')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer3')){ }else { ?>
	        <?php } ?>
			</div>

	    		<div class="one_sixth">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer4')){ }else { ?>
	        <?php } ?>
			</div>
	    
	    <div class="one_third last">
		<?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('footer5')){ }else { ?>
	        <?php } ?>
			</div>
	    <?php } ?>    

        <div class="clear"></div>                    
                </div> <!--// footer inner-->
            </footer> <!--//footer-->
<?php } ?>
<?php if (mom_option('hide_footer_c') != true ) { ?>
            <div class="copyrights-area">
                <div class="inner">
                    <p class="copyrights-text"><?php echo do_shortcode(mom_option('copyrights')); ?></p>
                    <?php
                    if (mom_option('copyrights_right') == 'social') {
                            get_template_part('elements/social', 'icons');
                        } else {
                            if ( has_nav_menu( 'footer' ) ) { 
                                wp_nav_menu ( array( 'menu_class' => 'footer_menu','container'=> 'ul', 'theme_location' => 'footer' )); 
                            }
                        }
                    ?>
                </div>
            </div>
<?php } ?>
            <div class="clear"></div>
        </div> <!--Boxed wrap-->
        <?php if (mom_option('scroll_top_bt') == 1) { ?><a href="#" class="scrollToTop button"><i class="enotype-icon-arrow-up6"></i></a><?php } ?>
	<?php echo mom_option('footer_script'); ?>
        <?php wp_footer(); ?>
    </body>
</html>