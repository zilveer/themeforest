<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

 global $cththemes_options ;

 ?>	
 			<?php
			if (!empty($cththemes_options['footer_info']) || !empty($cththemes_options['footer_copyright'])): ?>
			    <!--=============== footer ===============-->
			    <footer class="page-footer">
			        <?php 
			            if(is_active_sidebar('footer_widgets_widget')){    ?>
			            <div class="container">
			            	<div class="row">
			            		<?php
			                        dynamic_sidebar('footer_widgets_widget');
			                    ?>
			            		
			            	</div>
			            </div>
			        <?php } ?>
			        <?php echo wp_kses_post( $cththemes_options['footer_info'] ); ?>
			        <?php 
                    if(is_active_sidebar('footer_copyright_widget')){
                        dynamic_sidebar('footer_copyright_widget');
                    }
                    ?>

			        <?php echo wp_kses_post( $cththemes_options['footer_copyright'] );?>
			    </footer><!-- footer end    -->
			<?php
			endif; ?>
			<?php if($cththemes_options['to_top_icon']['url']) :?>
			<a href="#top" class="back_to_top"><img src="<?php echo esc_url($cththemes_options['to_top_icon']['url']);?>" alt="<?php _e('back to top','gather');?>"></a>
 			<?php endif;?>
 			<?php if($cththemes_options['show_style_switcher']):?>
 			<!-- 
			 Choose Color Theme : Only for Demo
			 ====================================== -->
			<div class="color-picker">
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('green'); return false;" class="color_green"></a>
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('purple'); return false;" class="color_purple"></a>
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('red'); return false;" class="color_red"></a>
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('yellow'); return false;" class="color_yellow"></a>
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('mint'); return false;" class="color_mint"></a>
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('blue'); return false;" class="color_blue"></a>
			    <a href="javascript:void(0);" onclick="setActiveStyleSheet('black'); return false;" class="color_black"></a>
			</div>
			<!-- End // .color-theme-picker -->
			<?php endif;?>
	    <?php wp_footer(); ?>
	</body>
</html>
